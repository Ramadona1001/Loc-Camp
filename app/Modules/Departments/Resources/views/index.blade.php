@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
<link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="row clearfix">
    <div class="container">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>{{ $title }}</h2>
            </div>
            <div class="table-responsive">
                <table id="data-table-basic" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Manager</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $index => $department)
                            <tr>
                                <td>{{ ($index+1) }}</td>
                                <td>{{ getDataFromJsonByLanguage($department->title) }}</td>
                                <td>
                                    @foreach (getDepartmentManagers($department->id) as $m)
                                        {{ $m->user->name }}
                                    @endforeach
                                </td>
                                <td style="text-align: left !important;">
                                    @can('show_departments')
                                    <div class="menu-item px-3">
                                        <a href="{{ route('show_departments',Crypt::encrypt($department->id)) }}" class="menu-link px-3" style="color: rgb(87, 87, 87)"><i class="fa fa-info-circle"></i>&nbsp;Details</a>
                                    </div>
                                    @endcan

                                    @can('assign_departments_manager')
                                    <div class="menu-item px-3">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#assign_department_manager{{ $department->id }}" class="menu-link px-3" style="color: rgb(87, 87, 87)"><i class="fa fa-user"></i>&nbsp;Managers</a>
                                    </div>
                                    @endcan

                                    @can('update_departments')
                                    <div class="menu-item px-3">
                                        <a href="{{ route('edit_departments',Crypt::encrypt($department->id)) }}" class="menu-link px-3" style="color: rgb(87, 87, 87)"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                    </div>
                                    @endcan

                                    @can('delete_departments')
                                    <div class="menu-item px-3">
                                        <a href="{{ route('delete_departments',Crypt::encrypt($department->id)) }}" onclick="return confirm('Are You Sure?')" class="menu-link px-3" style="color: rgb(87, 87, 87)"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                    </div>
                                    @endcan
                                </td>
                            </tr>

                            @can('assign_departments_manager')
                                <form action="{{ route('assign_departments_managers',Crypt::encrypt($department->id)) }}" method="post">
                                    @csrf
                                    <div class="modal fade" tabindex="-1" id="assign_department_manager{{ $department->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Assign Managers To {{ getDataFromJsonByLanguage($department->title) }}</h5>

                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <span class="svg-icon svg-icon-2x"></span>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row">
                                                        @foreach ($users as $user)
                                                            <div class="col-4">
                                                                <div class="manager-data">
                                                                    <input type="checkbox" name="managers[]" id="manager_{{ $user->id }}" value="{{ $user->id }}" @if(in_array($user->id,getDepartmentManagersIds($department->id))) checked @endif>
                                                                    <label for="manager_{{ $user->id }}">{{ $user->name }}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endcan
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Manager</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ URL('/').'/'.setPublic() }}assets/js/data-table/jquery.dataTables.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/data-table/data-table-act.js"></script>
@endsection
