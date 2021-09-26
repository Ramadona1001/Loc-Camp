@extends('layouts.master')

@section('title',transWord('Roles'))

@section('stylesheet')

@endsection

@section('breadcrumb')
    @include('components.breadcrumb')
@endsection

@section('content')

    @can('create_roles')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-info mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
        {{ transWord('Create New Role') }}
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ transWord('Create New Role') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store_roles') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                            </div>
                            <input type="text" class="form-control" required placeholder="{{ transWord('Role Name') }}" id="role_name" aria-label="{{ transWord('Role Name') }}" name="name" aria-describedby="basic-addon1">
                            <div class="input-group-prepend">
                                <button type="submit" id="saveBtn" class="btn btn-outline-primary"><i class="fa fa-save"></i>&nbsp;{{ transWord('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @endcan

    <div class="row clearfix">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>{{ transWord('#') }}</th>
                                <th>{{ transWord('Name') }}</th>
                                <th>{{ transWord('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $index => $role)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-info dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ transWord('Action') }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              @can('update_roles')
                                              <li><a class="dropdown-item" href="{{ route('edit_roles',Crypt::encrypt($role->id)) }}">{{ transWord('Edit') }}</a></li>
                                              @endcan

                                              @can('show_permissions')
                                              <li><a class="dropdown-item" href="{{ route('permissions_roles',Crypt::encrypt($role->id)) }}">{{ transWord('Permissions') }}</a></li>
                                              @endcan
                                              
                                              @if ($role->name != 'Admin')
                                                @can('delete_roles')
                                                <li><a class="dropdown-item" onclick="return confirm('{{ transWord('Are You Sure?') }}')" href="{{ route('delete_roles',Crypt::encrypt($role->id)) }}">{{ transWord('Delete') }}</a></li>
                                                @endcan
                                              @endif
                                            </ul>
                                          </div>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection
