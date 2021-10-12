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
                            <th>Email Address</th>
                            <th>Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="permissionTable">
                        @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            @foreach (getUserRole($user->id) as $item)
                            <a class="widgets-mg-sn badge-tag" data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="{{ $item }}">{{ $item }}</a>
                            @endforeach
                            </td>
                            <td style="text-align: left !important;">
                                @can('premissions_users')
                                <div class="menu-item px-3">
                                    <a href="{{ route('premissions_users',$user->id) }}" class="menu-link px-3" ><i class="fa fa-lock"></i>&nbsp;Premissions</a>
                                </div>
                                @endcan

                                @can('show_users')
                                <div class="menu-item px-3">
                                    <a href="{{ route('show_users',$user->id) }}" class="menu-link px-3" ><i class="fa fa-info-circle"></i>&nbsp;Details</a>
                                </div>
                                @endcan

                                @can('update_users')
                                <div class="menu-item px-3">
                                    <a href="{{ route('edit_users',$user->id) }}" class="menu-link px-3" ><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                </div>
                                @endcan

                                @can('delete_users')
                                <div class="menu-item px-3">
                                    <a href="{{ route('destroy_users',$user->id) }}" onclick="return confirm('Are You Sure?')" class="menu-link px-3" ><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                </div>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Roles</th>
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
