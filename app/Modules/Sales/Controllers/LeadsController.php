<?php

namespace Sales\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sales\Repositories\LeadsRepository;
use Crypt;
use Sales\Models\Leads;

class LeadsController extends Controller
{
    public $path;
    private $leadRepository;

    public function __construct(LeadsRepository $leadRepository)
    {
        $this->middleware('auth');
        $this->path = 'Sales::Leads.';
        $this->leadRepository = $leadRepository;
    }

    public function index()
    {
        hasPermissions('show_leads');
        $title = transWord('Leads');
        $pages = [
            [transWord('Leads'),'leads']
        ];
        return view($this->path.'index',compact('pages','title'));
    }

    public function create()
    {
        hasPermissions('create_leads');
        $title = transWord('New Leads');
        $pages = [
            [transWord('Lead'),'leads'],
            [transWord('New Leads'),'create_leads']
        ];
        return view($this->path.'create',compact('pages','title'));
    }

    public function store(Request $request)
    {
        hasPermissions('create_leads');
        $this->leadRepository->saveData(null,$request);
        return redirect()->route('leads')->with('success','');
    }

    public function edit($id)
    {
        hasPermissions('update_leads');
        $title = transWord('Update Sales');
        $pages = [
            [transWord('Sales'),'sales'],
            [transWord('Update Sales'),'#']
        ];
        $id = Crypt::decrypt($id);
        $department = $this->leadRepository->getDataId($id);
        return view($this->path.'edit',compact('pages','title','department'));
    }

    public function update($id,Request $request)
    {
        hasPermissions('update_leads');
        $id = Crypt::decrypt($id);
        $this->leadRepository->saveData($id,$request);
        return redirect()->route('sales')->with('success','');
    }

    public function show($id)
    {
        hasPermissions('show_leads');
        $title = transWord('Show Sales');
        $pages = [
            [transWord('Sales'),'sales'],
            [transWord('Show Sales'),'#']
        ];
        $id = Crypt::decrypt($id);
        $department = $this->leadRepository->getDataId($id);
        return view($this->path.'show',compact('pages','title','department'));
    }

    public function delete($id)
    {
        hasPermissions('delete_leads');
        $id = Crypt::decrypt($id);
        $this->leadRepository->deleteData($id);
        return redirect()->route('sales')->with('success','');
    }

    public function searchDomain(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->company_domain;
            $meta_tags = get_meta_tags($search);
            $title = getTitleFromWebSite($search);
            $social_media = getSocialMediaFromWebSite($search);

            return response()->json([
                'meta_tags' => $meta_tags,
                'title' => $title,
                'social_media' => $social_media,
            ],200);
        }
    }



    public function searchLead(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Leads::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Leads::select('count(*) as allcount')->where('leads.company_name','like','%'.$searchValue.'%')->orWhere('leads.url','like','%'.$searchValue.'%')->orWhere('leads.phone_skype','like','%'.$searchValue.'%')->count();

        // Fetch records
        $records = Leads::orderBy($columnName,$columnSortOrder)
          ->where('leads.company_name','like','%'.$searchValue.'%')->orWhere('leads.url','like','%'.$searchValue.'%')->orWhere('leads.phone_skype','like','%'.$searchValue.'%')
          ->select('leads.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

        $data_arr = array();
        foreach($records as $index => $lead){
          $data_arr[] = array(
             "id" => $index +1,
             "company_name" => htmlspecialchars_decode($lead->company_name),
             'username' => $lead->user->name,
             'url' => '<a href="'.$lead->url.'" class="btn btn-primary btn-block btn-sm"><i class="fa fa-link"></i>&nbsp;Domain</a>',
             'industry' => substr(htmlspecialchars_decode($lead->industry), 0, 30),
             'company_head_count' => $lead->company_head_count,
             'company_hq' => $lead->company_hq,
             'company_zone' => $lead->company_zone,
             'contact_name' => $lead->contact_name,
             'title' => $lead->title,
             'office' => $lead->office,
             'emails' => implode('',getLeadContact('mail',json_decode($lead->email))),
             'phone_skypes' => implode('',getLeadContact('tel',json_decode($lead->phone_skype))),
             'social_medias' => implode('',getLeadContact('social',json_decode($lead->social_media))),
             'date' => $lead->created_at->format('d/m/Y'),
             'customer_status' => $lead->customer_status,
             'follow_up' => '<button data-toggle="modal" data-target="#myModalAddFollow" data-lead_id="'.$lead->id.'" data-lead_name="'.htmlspecialchars_decode($lead->company_name).'" class="btn btn-primary btn-sm btn-block leadId"><i class="fa fa-plus"></i>&nbsp;Follow</button> <button data-toggle="modal" style="margin-top: 5px;" data-target="#myModalShowFollow" data-lead_id="'.$lead->id.'" data-lead_name="'.htmlspecialchars_decode($lead->company_name).'" class="btn btn-primary btn-sm btn-block leadId"><i class="fa fa-eye"></i>&nbsp;Show</button>',
             'comments' => $lead->comments,
             'campaign' => $lead->campaign,
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );
        echo json_encode($response);
        exit;
      }

      public function addFollow(Request $request)
      {
            $this->leadRepository->addFollowLead($request);
            return redirect()->route('leads')->with('success','');
      }

}
