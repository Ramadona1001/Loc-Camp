<?php


namespace Sales\Repositories;

use App\User;
use Sales\Models\Leads;
use File;
use Sales\Models\LeadFollow;

class LeadsRepository implements LeadsRepositoryInterface
{
    public $paginate = 5;
    public function allData()
    {
        return Leads::paginate($this->paginate);
    }

    public function getDataId($id)
    {
        return Leads::findOrfail($id);
    }

    public function saveData($id = null,$request)
    {
        if ($id == null) {
            $leads = new Leads();
        }else{
            $leads = $this->getDataId($id);
        }

        $soicalMedia = [];$emails = [];$mobiles = [];

        $leads->user_id = auth()->user()->id;
        $leads->industry = $request->industry;
        $leads->company_head_count = $request->company_head_count;
        $leads->company_name = $request->company_name;
        $leads->url = $request->url;
        $leads->company_hq = $request->company_hq;
        $leads->company_zone = $request->company_zone;
        $leads->contact_name = $request->contact_name;
        $leads->title = $request->title;
        $leads->office = $request->office;
        for ($i=0; $i < count($request->email); $i++) {
            $emails[$i] = $request->email[$i];
        }
        for ($i=0; $i < count($request->phone_skype); $i++) {
            $mobiles[$i] = $request->phone_skype[$i];
        }
        $leads->email = json_encode($emails);
        $leads->phone_skype = json_encode($mobiles);
        $leads->action = $request->action;
        $leads->customer_status = $request->customer_status;
        $leads->follow_up = $request->follow_up;
        $leads->comments = $request->comments;
        $leads->campaign = $request->campaign;



        if ($request->social_media_keys != null) {
            for ($i=0; $i < count($request->social_media_keys); $i++) {
               $soicalMedia[$request->social_media_keys[$i]] = $request->social_media_values[$i];
            }
        }
        $leads->social_media = json_encode($soicalMedia);

        $leads->save();
    }

    public function deleteData($id)
    {
        $leads = $this->getDataId($id);
        $leads->delete();
    }

    public function searchData($search)
    {
        return Leads::where('company_name','like','%'.$search.'%')->orWhere('url','like','%'.$search.'%')->orWhere('phone_skype','like','%'.$search.'%')->paginate($this->paginate);
    }

    public function addFollowLead($request)
    {
        $follow = new LeadFollow();
        $follow->follow_type = $request->follow_type;
        $follow->follow_comment = $request->follow_comment;
        $follow->user_id = auth()->user()->id;
        $follow->lead_id = $request->lead_id;
        $follow->save();
    }

    public function showFollows(){
        return LeadFollow::all();
    }
}
