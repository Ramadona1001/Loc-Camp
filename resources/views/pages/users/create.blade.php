@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
@endsection

@section('content')

@include('components.errors')

<form action="{{ route('store_users') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" required class="form-control input-lg" placeholder="Name" aria-label="Name" name="name" aria-describedby="basic-addon1">
                </div>

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" required id="email" class="form-control input-lg" placeholder="Ex: example@example.com">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" required name="password" id="password" class="form-control input-lg" placeholder="Password">
                </div>

                <div class="input-group">
                    <label for="confirmpass">Confirm Password</label>
                    <input type="password" required name="password_confirmation" id="confirmpass" class="form-control input-lg" placeholder="Confirm Password">
                </div>

                <div class="input-group">
                    <label for="confirmpass">Select Role</label>
                    <div class="row">
                        @foreach ($roles as $role)
                        <input type="checkbox" class="myinput large custom" name="" id="{{ $role->id }}" value="{{ $role->id }}" name="roles[]" style="margin-left: 20px;margin-right:20px;">
                        <label for="{{ $role->id }}">{{ ucwords(str_replace('_',' ',$role->name)) }}</label>
                        @endforeach
                    </div>
                </div>

        </div>

    </div>

        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i>&nbsp;Save</button>
</form>
@endsection
