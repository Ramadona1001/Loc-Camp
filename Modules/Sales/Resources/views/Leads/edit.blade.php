@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

    @include('components.errors')


    <div class="row gy-5 g-xl-8">
        <div class="col-xxl-12">
            <form action="{{ route('update_departments',Crypt::encrypt($department->id)) }}" method="post">
                @csrf
                {!! BuildFields('title' , getDataFromJson($department->title) , "text" ,['required']) !!}
                {!! BuildFields('content' , getDataFromJson($department->content) , "textarea" ,['required']) !!}
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
            </form>
        </div>
    </div>


@endsection

@section('javascript')

@endsection
