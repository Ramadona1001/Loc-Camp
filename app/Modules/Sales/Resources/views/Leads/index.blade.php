@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
<style>
    th,td,a{
        color: #ffffffa9 !important;
    }
    table,th,td{
        border-color: #ffffff2e !important;
        border-radius: 8px !important;
    }
    a:hover{
        color: white;
    }
    div#leadTable_wrapper {
        position: relative;
    }
</style>

@endsection

@section('content')

<div class="row clearfix">

    <div class="container">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>{{ $title }}</h2>
            </div>

            {{-- <div id="loader"></div> --}}

            <div class="table-responsive">
                <table id="leadTable" class="table table-rounded table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>Sales Person</th>
                            <th>Industry</th>
                            <th>Company Head Count</th>
                            <th>URL</th>
                            <th>HQ</th>
                            <th>Zone</th>
                            <th>Contact Name</th>
                            <th>Title</th>
                            <th>Office</th>
                            <th>Email</th>
                            <th>Phone/Skype</th>
                            <th>Social Media</th>
                            <th>Date</th>
                            <th>Customer Status</th>
                            <th>Follow up</th>
                            <th>Comments</th>
                            <th>Campaign</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalAddFollow" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5 style="text-align: center;text-decoration:underline;font-weight:bold;">Add New Follow (<span class="lead_name"></span>)</h5>
                <form action="{{ route('add_follow_lead') }}" method="post" style="border:1px solid gray;padding:10px;border-radius:8px;">
                    @csrf
                    <input type="hidden" name="lead_id" class="lead_id">
                    <label style="color:black">Type of Follow</label>
                    <select name="follow_type" id="" class="form-control" style="margin-bottom: 10px;background:white !important;">
                        <option value="Phone Call">Phone Call</option>
                        <option value="Skype">Skype</option>
                        <option value="Send Mail">Send Mail</option>
                        <option value="Other">Other</option>
                    </select>
                    <textarea name="follow_comment" class="form-control" id="" style="margin-bottom: 10px;background:white !important;" cols="30" rows="3" placeholder="Write Comment"></textarea>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalShowFollow" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5 style="text-align: center;text-decoration:underline;font-weight:bold;">Follow Actions (<span class="lead_name"></span>)</h5>
                <table class="table table-bordered" style="background: #0d111c;">
                    <thead>
                        <th>#</th>
                        <th>Sales Person</th>
                        <th>Lead</th>
                        <th>Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="leadFollows">
                        Follows
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $( document ).ajaxComplete(function() {
        $('button.leadId').click(function(){
            $('.lead_id').val($(this).data('lead_id'));
            $('.lead_name').text($(this).data('lead_name'));

        });
    });
    $(document).ready(function(){

        $('#leadTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('search_lead')}}",
        columns: [
            { data: 'id' },
            { data: 'company_name' },
            { data: 'username' },
            { data: 'industry' },
            { data: 'company_head_count' },
            { data: 'url' },
            { data: 'company_hq' },
            { data: 'company_zone' },
            { data: 'contact_name' },
            { data: 'title' },
            { data: 'office' },
            { data: 'emails' },
            { data: 'phone_skypes' },
            { data: 'social_medias' },
            { data: 'date' },
            { data: 'customer_status' },
            { data: 'follow_up' },
            { data: 'comments' },
            { data: 'campaign' },
        ]
        });



});
</script>
@endsection
