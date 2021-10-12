<?php

use App\User;
use Departments\Models\DepartmentManager;
use ModelAttachments\Models\ModelAttachment;
use ModelQuizzes\Models\ModelQuiz;
use Pages\Models\Page;
use Projects\Models\Project;
use ProjectUtilities\Models\ProjectUtilities;
use Properties\Models\Properties;
use Sales\Models\LeadFollow;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Students\Models\Student;

// use Auth;

function BuildFields($name , $value = null , $type="text" ,$other = null){
    $lang = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
    $out = "";
    if($other != null)
    {
        $others = "";
        foreach($other as $key => $o){
            $others .= "$key ='$o' ";
        }
    }else{
        $others = null;
    }
    foreach($lang as  $key => $lan){
        $newValue = $value != null ? $value[$lan] : null;
        $out .='<div class="col-lg-12" style="margin-bottom:10px;">';
        $out .='<label for="'.$name.'['.$lan.']" >'.ucfirst($name).'</label >';
        if($type != 'textarea'){
            $out .='<input type = "'.$type.'" class="form-control "  name="'.$name.'['.$lan.']" id = "'.$name.'['.$lan.']" placeholder="Please Enter '.$name.'" '.$others.' value="'.$newValue.'"  />';
        }else{
            $out .='<textarea name="'.$name.'['.$lan.']" id="'.$name.'['.$lan.']" class="form-control ckeditor" placeholder="Please Enter '.$name.'" '.$others.' value="'.$newValue.'">'.$newValue.'</textarea>';
        }
        $out .='</div>';
    }
    return $out;
}

function megaMenu($chunk = 4 , $mainName = 'Cats'  , $field = 'title' , $url = 'cat/' , $urlFiled = 'id' , $data){
    $chunkArray = [
        4 => 3,
        3 => 4,
        6 => 2,
        2 => 6 ,
        12 =>1
    ];
    if(!$chunkArray[$chunk]){
        dd('This number of cols not valid');
    }
    $out ='<li class="nav-item dropdown">';
    $out .='<a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    $out .= $mainName;
    $out .='</a>';
    $out .='<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
    foreach($data->chunk($chunk) as $d){
        $out .='<div class="col-lg-'.$chunkArray[$chunk].'">';
        foreach($d as $item){
            $out .='<a class="dropdown-item" href="'.url($url.$item->{$urlFiled}).'">'.$item->{$field}.'</a>';
        }
        $out .='</div>';
    }
    $out .='</div>';
    $out .='</li>';
    return $out;
}

function getDir()
{
      return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocaleDirection();
}

function getDirection()
{
      $cD = getDir();
      return $cD == 'rtl' ? 'right' : 'left';
}

function getReverseDirection()
{
      $cD = getDir();
      return $cD == 'rtl' ? 'left' : 'right';
}

function checkIfLinkyouTube($url){
    $rx = '~
                ^(?:https?://)?              # Optional protocol
                 (?:www\.)?                  # Optional subdomain
                 (?:youtube\.com|youtu\.be)  # Mandatory domain name
                 /watch\?v=([^&]+)           # URI with video id as capture group 1
                 ~x';
    $has_match = preg_match($rx,  $url , $matches);
    if(isset($matches[1]) && $matches[1] != ''){
      return true;
    }else{
        return false;
    }
}


function statisticsWidget($data){
    $statisticsHtml = '';
    for ($i=0; $i < count($data); $i++) {
        ($data[$i][3] == '') ? $data[$i][3] = 'azura' : $data[$i][3] = $data[$i][3];
        if (hasPermissionsStatistics($data[$i][4]) != 'hasnot' && hasPermissionsStatistics($data[$i][4]) != 'notfound') {
            $statisticsHtml .= '
                <div class="col-lg-3 col-md-6">
                    <div class="card" style="border-top: 3px solid;">
                        <div class="body">
                            <div class="d-flex align-items-center">
                                <div style="width: 40px; height: 40px;" class="icon-in-bg bg-'.$data[$i][3].' text-white rounded-circle"><i class="fa fa-'.$data[$i][2].'"></i></div>
                                <div class="ml-4" style="margin-left:0.7rem !important">
                                    <span style="font-size: 14px;color: white;">'.$data[$i][1].'</span>
                                    <h4 class="mb-0 font-weight-medium">'.$data[$i][0].'</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

    }
    return $statisticsHtml;
}

function breadcrumbWidget($currentPageName,$pages){
    $breadcrumb = '';
    if (count($pages) == 0) {
        $breadcrumb = '<li class="breadcrumb-item" style="color: #ffffff;font-weight:bold;"><i class="fa fa-bars"></i>&nbsp;'.$currentPageName.'</li>';
    }else{
        $breadcrumb .= '<li class="breadcrumb-item"><a style="color: #ffffff;font-weight:bold;" href="'.route("home").'"><i class="fa fa-home"></i>&nbsp;'.transWord('Home').'</a></li>';
            for ($i=0; $i < count($pages); $i++) {
                if ($pages[$i][1] == '' || $pages[$i][1] == '#') {
                    $breadcrumb .= '<li class="breadcrumb-item"><a style="color: #ffffff;font-weight:bold;" href=""><i class="fa fa-bars"></i>&nbsp;'.$pages[$i][0].'</a></li>';
                }else if(is_array($pages[$i][1])){
                    $breadcrumb .= '<li class="breadcrumb-item"><a style="color: #ffffff;font-weight:bold;" href="'.route($pages[$i][1][0],$pages[$i][1][1]).'"><i class="fa fa-bars"></i>&nbsp;'.$pages[$i][0].'</a></li>';
                }else{
                    $breadcrumb .= '<li class="breadcrumb-item"><a style="color: #ffffff;font-weight:bold;" href="'.route($pages[$i][1]).'"><i class="fa fa-bars"></i>&nbsp;'.$pages[$i][0].'</a></li>';
                }
            }
    }
    return $breadcrumb;
}

function getLang(){
    $lang = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
    return $lang;
}

function datatableLang(){
    $lang = \Lang::getLocale();
    if($lang == 'ar')
        return '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json';
    else
        return '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json';
}

function menuActive($name,$arrange){
    if(request()->segment($arrange) == $name){
        return "active";
    }
}

function getUserRole($userId){
    $user = \App\User::findOrfail($userId);
    $roles = [];
    foreach ($user->getRoleNames() as $role) {
        array_push($roles,$role);
    }
    return $roles;
}

function getDataFromJson($json){
    $data = json_decode($json, true);
    return $data;
}

function getDataFromJsonByLanguage($json){
    $lang = \Lang::getLocale();
    $data = json_decode($json, true)[$lang];
    return $data;
}

function changeLanguageMenu(){
    $menu = '';
    foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
        $menu .= '<a class="dropdown-item pt-2 pb-2" href="'.LaravelLocalization::getLocalizedURL($localeCode, null, [], true).'">'.$properties["native"].'</a>';
    }
    return $menu;
}

function socialMediaInputs($data){
    $socials = getDataFromJson($data);
    $socialsOutput = '';
    foreach($socials as $key => $value){
        $socialsOutput .= '<div class="col-lg-6" style="margin-bottom:10px;">';
        $socialsOutput .= '<label for="'.$key.'">'.ucfirst($key).'</label>';
        $socialsOutput .= '<input id="'.$key.'" type="url" name="soicalmedia['.$key.']" class="form-control" value="'.$value.'" placeholder="'.__("tr.".ucfirst($key)).'">';
        $socialsOutput .= '</div>';
    }
    return $socialsOutput;
}

function socialMediaFront($data)
{
    $socials = getDataFromJson($data);
    $socialsOutput = '';
    foreach($socials as $key => $value){
        if ($value != '') {
            $socialsOutput .= '<li>';
            $socialsOutput .= '<a target="_blank" href="'.$value.'">';
            $socialsOutput .= '<i class="bx bxl-'.$key.'"></i>';
            $socialsOutput .= '</a>';
            $socialsOutput .= '</li>';
        }
    }
    return $socialsOutput;
}

function checkHasValue($data){
    if (isset($data)) {
        if ($data != null) {
            return $data;
        }
    }
}

function translateWords($word){
    $lang = \Lang::getLocale();
    return GoogleTranslate::trans($word, $lang, 'en');
}

function mainSettingsData(){
    if(\MainSettings\Models\MainSetting::count() > 0)
    {
        $settings = \MainSettings\Models\MainSetting::findOrfail(1);
        $main_settings = [];
        $main_settings['title'] = getDataFromJsonByLanguage($settings->title);
        $main_settings['content'] = getDataFromJsonByLanguage($settings->content);
        $main_settings['address'] = getDataFromJsonByLanguage($settings->address);
        $main_settings['meta_title'] = getDataFromJsonByLanguage($settings->meta_title);
        $main_settings['meta_desc'] = getDataFromJsonByLanguage($settings->meta_desc);
        $main_settings['meta_keywords'] = getDataFromJsonByLanguage($settings->meta_keywords);
        $main_settings['logo'] = getDataFromJsonByLanguage($settings->logo);
        $main_settings['mobile'] = $settings->mobile;
        $main_settings['email'] = $settings->email;
        $main_settings['banner_title'] = getDataFromJsonByLanguage($settings->banner_title);
        $main_settings['banner_content'] = getDataFromJsonByLanguage($settings->banner_content);
        $main_settings['banner_button_name'] = getDataFromJsonByLanguage($settings->banner_button_name);
        $main_settings['banner_button_link'] = $settings->banner_button_link;
        $main_settings['socialmedia'] = $settings->socialmedia;
        return $main_settings;
    }else{
        return null;
    }
}

function transWord($word){
    $lang = \Lang::getLocale();
    if(\Translates\Models\Translate::where('word',$word)->where('key',$lang)->count() > 0){
        $transData = \Translates\Models\Translate::where('word',$word)->where('key',$lang)->get()->first();
        return $transData->translation;
    }else{
        return $word;
    }
}

function convertToTags($text){
    if(strpos($text,",") != null){
        $tags = explode(',',$text);
        $tags_html = '';
        foreach ($tags as $tag) {
            $tags_html .= '<span class="badge badge-success" style="font-weight: bold;">'.$tag.'</span>';
        }
        return $tags_html;
    }else{
        return $text;
    }
}

function hasPermissions($permission){
    $getPermission = Permission::where('name',$permission)->limit(1)->count();
    if ($getPermission > 0) {
        if(!Auth::user()->hasPermissionTo($permission))
            abort(403);
    }else{
        abort(404);
    }
}

function hasPermissionsStatistics($permission){
    $getPermission = Permission::where('name',$permission)->limit(1)->count();
    if ($getPermission > 0) {
        if(!Auth::user()->hasPermissionTo($permission))
            return 'hasnot';
    }else{
        return 'notfound';
    }
}

function menuHasChildren($rows,$id) {
    foreach ($rows as $row) {
        if ($row['parent'] == $id)
            return true;
    }
    return false;
}
function buildMainMenu($rows,$parent=0)
{
    $result = "<li class='nav-item'>";
    foreach ($rows as $row)
    {
        $page = Page::where('menu_id',$row['id'])->where('publish',1)->get()->first();
        if ($row['parent'] == $parent){
            $slug = isset($page->slug) ? route('website_page',getDataFromJsonByLanguage($page->slug)) : '#';
            $title = isset($page->title) ? getDataFromJsonByLanguage($page->title) : getDataFromJsonByLanguage($row['title']);
            $result.= "<a href='".$slug."' class='nav-link'>".$title."</a>";
            if (menuHasChildren($rows,$row['id'])){
                $result.= "<ul class='dropdown-menu'>".buildMainMenu($rows,$row['id']);
                $result.= "</ul>";

            }
        }
    }
    $result.= "</li>";
    return $result;
}

function checkDataisNull($data,$alternative){
    if ($data != null)
        return $data;
    else
        return $alternative;
}

function getGender(){
    return [
        'Male' => transWord('Male'),
        'Female' => transWord('Female'),
    ];
}


function checkAttachment($attachment,$type){
    if($type == 'link'){
        if (strpos($attachment, 'https://www.youtube.com') !== false) {
            $attachment = str_replace("watch?v=","embed/",$attachment);
            return '<iframe src="'.$attachment.'"></iframe>';
        }else{
            return '<iframe src="'.$attachment.'"></iframe>';
        }
    }else{
        return '<iframe src="'.asset("uploads/backend/attachments/$attachment").'"></iframe>';
    }
}

function openAttachmentFrontend($attachment,$type){
    if($type == 'link'){
        if (strpos($attachment, 'https://www.youtube.com') !== false) {
            $attachment = str_replace("watch?v=","embed/",$attachment);
            return $attachment;
        }else{
            return $attachment;
        }
    }else{
        return asset("uploads/backend/attachments/$attachment");
    }
}

function convertYoutubeLinkEmbed($link)
{
    return str_replace("watch?v=","embed/",$link);
}

function getAttachment($id,$type)
{
    return ModelAttachment::where('model',$id)->where('type',$type)->get();
}


function changeLanguage()
{
    $lang = \DB::select('select lang from main_settings where id = 1')[0]->lang;
    App::setLocale($lang);
}

function showImgUpdateForm($path,$img)
{
    $image = $path.'/'.$img;
    return '<img src="'.asset($image).'" style="width:300px;display:block;margin-left:auto;margin-right:auto;" class="img-responsive img-thumbnail" alt="" srcset="">';
}

function getProjectUtility($id)
{
    return ProjectUtilities::findOrfail($id);
}

function getProjectUtilityMedia($id)
{
    return \DB::select('select * from studio where model_name = "projecttype" and model_id = '.$id.' and type = "image"');
}

function setPublic()
{
    if($_SERVER['REMOTE_ADDR'] != '127.0.0.1')
    {
        return "public/";
    }
}

function getSocialMediaFromWebSite($url)
{
    $pattern = '~[a-z]+://\S+~';
    $socialMedia = [];
    $options = array(
        CURLOPT_RETURNTRANSFER => true, // return web page
        CURLOPT_HEADER => false, // don’t return headers
        CURLOPT_FOLLOWLOCATION => true, // follow redirects
        CURLOPT_ENCODING => "", // handle all encodings
        CURLOPT_USERAGENT => "spider", // who am i
        CURLOPT_AUTOREFERER => true, // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
        CURLOPT_TIMEOUT => 120, // timeout on response
        CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
    );
    $ch = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    curl_close( $ch );
    if($num_found = preg_match_all($pattern, $content, $out))
    {
        foreach ($out[0] as $link) {
            if (strpos($link, 'facebook') !== false) {
                $socialMedia['facebook'] = $link;
            }
            if (strpos($link, 'twitter') !== false) {
                $socialMedia['twitter'] = $link;
            }
            if (strpos($link, 'linkedin') !== false) {
                $socialMedia['linkedin'] = $link;
            }
            if (strpos($link, 'youtube') !== false) {
                $socialMedia['youtube'] = $link;
            }
            if (strpos($link, 'whatsapp') !== false) {
                $socialMedia['whatsapp'] = $link;
            }
        }
    }

    return $socialMedia;
}

function getTitleFromWebSite($url){
    $str = file_get_contents($url);
    if(strlen($str)>0){
        $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
        preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
        return (count($title) > 0) ? $title[1] : $title;
    }
}


function getDepartmentManagersIds($id)
{
    return DepartmentManager::where('department_id',$id)->get()->pluck('user_id')->toArray();
}

function getDepartmentManagers($id)
{
    return DepartmentManager::where('department_id',$id)->get();
}

function getLeadContact($type,$data)
{
    $result = [];
    if ($type == 'tel') {
        foreach ($data as $tel) {
            $result[] = '<a href="tel:'.$tel.'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-phone"></i>&nbsp;Call Me</a>';
        }
    }
    if ($type == 'mail') {
        foreach ($data as $mail) {
            $result[] = '<a href="mailto:'.$mail.'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-phone"></i>&nbsp;Send Me</a>';
        }
    }
    if ($type == 'social') {
        foreach ($data as $key => $social) {
            $result[] = '<a style="text-transform: capitalize;" target="_blank" href="'.$social.'" class="btn btn-primary btn-block btn-sm">'.$key.'</a>';
        }
    }
    return $result;
}

function getLeadFollow($leadId)
{
    return LeadFollow::where('lead_id',$leadId)->get();
}
