@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('components.errors')
<div class="row">
    <div class="col-lg-12">
        <label for="name">{{ transWord('Name') }}</label>
        <div class="input-group mb-3">
            <input type="text" id="name" readonly value="{{ $user->name }}" required class="form-control input-lg" placeholder="{{ transWord('Name') }}" aria-label="{{ transWord('Name') }}" name="name" aria-describedby="basic-addon1">
        </div>

        <label for="email">{{ transWord('Email Address') }}</label>
        <div class="input-group mb-3">
            <input type="email" name="email" readonly value="{{ $user->email }}" required id="email" class="form-control input-lg" placeholder="Ex: example@example.com">
        </div>

        <div class="row">
            <div class="col-lg-12">
                <label for="multiselect2">{{ transWord('Roles') }}</label><br>
                @foreach (getUserRole($user->id) as $item)
                <span class="badge badge-primary" style="font-weight: bold;font-size:13px;padding:10px;">{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
