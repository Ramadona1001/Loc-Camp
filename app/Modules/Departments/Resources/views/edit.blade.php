@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

    @include('components.errors')


    <div class="col-xxl-12">
        <form action="{{ route('update_departments',Crypt::encrypt($department->id)) }}" method="post">
            @csrf
            <div class="row">
                {!! BuildFields('title' , getDataFromJson($department->title) , "text" ,['required']) !!}
            </div>
            <div class="row">
                {!! BuildFields('content' , getDataFromJson($department->content) , "textarea" ,['required']) !!}
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>


@endsection

@section('javascript')

@endsection
