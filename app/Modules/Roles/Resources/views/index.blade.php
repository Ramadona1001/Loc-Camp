@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')
<div class="row">
    @foreach ($roles as $role)
    <div class="col-md-2">
        <form action="{{ route('update_roles',Crypt::encrypt($role->id)) }}" method="post">
            @csrf
            <div class="card card-flush" >
                <div class="card-header card-header w-100 text-center justify-content-center">
                    <div class="card-title">
                        <h4 style="font-weight: bold;">
                            <input type="text" name="name" id="" value="{{ $role->name }}" value="Role Name" class="form-control text-center form-control-solid">
                        </h4>
                    </div>
                </div>
                <div class="card-body pt-1">
                    <img src="{{ URL::asset('/').setPublic() }}svgs/shield.png" alt="" class="mw-100 mh-150px mb-7 rounded mx-auto d-block" />
                </div>
                <div class="card-footer flexwrap pt-0 px-3 justify-content-between d-flex" style="margin-top: 15px">
                    <a href="{{ route('permissions_roles',Crypt::encrypt($role->id)) }}" title="Permissions" class="btn btn-primary btn-sm">
                        <i class="fa fa-lock"></i>
                    </a>
                    @if ($role->name != 'Admin')
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Delete" class="btn btn-primary btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
                    @endif
                    <button type="submit" class="btn btn-primary btn-sm" title="Edit Role">
                        <i class="fa fa-edit"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @endforeach
    <div class="col-md-2">
        <form action="{{ route('update_roles',Crypt::encrypt($role->id)) }}" method="post">
            @csrf
            <div class="card card-flush" >
                <div class="card-header card-header w-100 text-center justify-content-center">
                    <div class="card-title">
                        <h4 style="font-weight: bold;margin-top: 14px;">
                            Add New Role
                        </h4>
                    </div>
                </div>
                <div class="card-body pt-1">
                    <img src="{{ URL::asset('/').setPublic() }}svgs/user-role.png" alt="" class="mw-100 mh-150px mb-7 rounded mx-auto d-block" style="height: 153px; display: block; margin-left: auto; margin-right: auto;"/>
                </div>
                <div class="card-footer flexwrap pt-0 px-3 justify-content-between d-flex">
                    <a href="#" title="New Role" class="btn btn-primary btn-sm btn-active-info my-1 btn-block" data-toggle="modal" data-target="#myModalfour">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
        </form>
    </div>

</div>

@include('Roles::create')

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ transWord('Delete Item') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container text-center">
                <i class="fa fa-trash" style="font-size: 51px; background: #f1416c; border: 1px solid; padding: 20px; border-radius: 50%; color: white; width: 100px; height: 100px; line-height: 55px;"></i>
                <h3 class="mt-10">{{ transWord('Are You Sure ?') }}</h3>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ transWord('Close') }}</button>
        <a href="{{ route('delete_roles',Crypt::encrypt($role->id)) }}" class="btn btn-danger">{{ transWord('Delete') }}</a>
        </div>
    </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
