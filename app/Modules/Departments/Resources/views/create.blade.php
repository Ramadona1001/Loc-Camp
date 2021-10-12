@extends('layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

    @include('components.errors')


    <div class="col-xxl-12">
        <form action="{{ route('store_departments') }}" method="post">
            @csrf
                <div class="row">
                    {!! BuildFields('title' , null , "text" ,['required']) !!}
                </div>
                <div class="row">
                    {!! BuildFields('content' , null , "textarea" ,['required']) !!}
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
