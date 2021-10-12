<?php


namespace MainSettings\Repositories;

use MainSettings\Models\MainSetting;
use File;

class MainSettingRepository implements MainSettingRepositoryInterface
{
    public function allData(){
        return MainSetting::all();
    }

    public function dataWithConditions( $conditions){
        $wheres = '';
        foreach ($conditions as $key => $value){
            $wheres .= '->where("'.$key.'","'.$key.'")';
        }
        $wheres = str_replace("'","",$wheres);
        return MainSetting::$wheres->get();
    }

    public function getDataId($id){
        return MainSetting::findOrfail($id);
    }

    public function saveData($request)
    {
        $title = json_encode($request->title);
        $content = json_encode($request->content);
        $mobile = ($request->mobile) ? $request->mobile :  null;
        $email = ($request->email) ? $request->email :  null;
        $address = ($request->address) ? $request->address :  null;
        $meta_title = ($request->meta_title) ? json_encode($request->meta_title) :  null;
        $meta_desc = ($request->meta_desc) ? json_encode($request->meta_desc) :  null;
        $meta_keywords = ($request->meta_keywords) ? json_encode($request->meta_keywords) :  null;
        $socialmedia = ($request->soicalmedia) ? json_encode($request->soicalmedia) :  null;
        $banner_title = ($request->banner_title) ? json_encode($request->banner_title) :  null;
        $banner_content = ($request->banner_content) ? json_encode($request->banner_content) :  null;
        $banner_button_name = ($request->banner_button_name) ? json_encode($request->banner_button_name) :  null;
        $banner_button_link = ($request->banner_button_link) ? $request->banner_button_link :  null;


        $mainsettings = MainSetting::findOrfail(1);

        $pathImage = public_path().'/uploads/backend/settings/';
        File::makeDirectory($pathImage, $mode = 0777, true, true);

        if ($request->logo) {
            foreach ($request->logo as $key => $value) {
                $imageName = $key.'_logo.'.$value->getClientOriginalExtension();
                $value->move($pathImage, $imageName);
                $logos[$key] = $imageName;
            }
            $logo = json_encode($logos);
            $mainsettings->logo = $logo;
        }


        $mainsettings->title = $title;
        $mainsettings->content = $content;
        $mainsettings->mobile = $mobile;
        $mainsettings->email = $email;
        $mainsettings->address = $address;

        $mainsettings->meta_title = $meta_title;
        $mainsettings->meta_desc = $meta_desc;
        $mainsettings->meta_keywords = $meta_keywords;
        $mainsettings->socialmedia = $socialmedia;
        $mainsettings->banner_title = $banner_title;
        $mainsettings->banner_content = $banner_content;
        $mainsettings->banner_button_name = $banner_button_name;
        $mainsettings->banner_button_link = $banner_button_link;
        $mainsettings->save();
    }
}
