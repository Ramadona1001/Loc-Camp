@extends('layouts.master')

@section('title',transWord('Roles'))

@section('stylesheet')

@endsection

@section('content')
    <div class="card">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{ transWord('Roles Data') }}</h3>
                <hr />

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('update_roles',Crypt::encrypt($role->id)) }}" method="post" style="width: 100%">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-edit"></i></span>
                    </div>
                    <input type="text" value="{{ $role->name }}" class="form-control" required placeholder="{{ transWord('Role Name') }}" id="role_name" aria-label="{{ transWord('Role Name') }}" name="name" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button type="submit" id="saveBtn" class="btn btn-outline-primary"><i class="fa fa-save"></i>&nbsp;{{ transWord('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('javascript')


@endsection
