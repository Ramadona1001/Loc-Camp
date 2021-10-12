@extends('layouts.master')

@section('title',transWord('Main Settings'))

@section('stylesheet')

@endsection

@section('content')

    @include('components.errors')

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>{{ transWord('Main Settings') }}</h2>
                </div>
                <div class="body">
                    <h3>{{ transWord('Main Settings') }}</h3>
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link show active" data-toggle="tab" href="#Main">{{ transWord('Main Settings') }}</a></li>
                                <li class="nav-item"><a class="nav-link show" data-toggle="tab" href="#Logo">{{ transWord('Logo') }}</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Meta">{{ transWord('Meta Tags') }}</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Social">{{ transWord('Social Media') }}</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Banner">{{ transWord('Banner') }}</a></li> --}}
                            </ul>
                            <form action="{{ route('save_mainsettings') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content">
                                        <div class="tab-pane show vivify fadeIn active" id="Main">
                                            <h6>{{ transWord('Main Settings') }}</h6><hr>
                                            <div class="row">
                                                {!! BuildFields('title' , getDataFromJson($settings->title) , 'text' ,['required' => 'required']) !!}
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="email">{{ transWord('Email') }}</label>
                                                    <input type="email" name="email" id="email" value="{{ checkHasValue($settings->email) }}" class="form-control" placeholder="{{ transWord('Email') }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="mobile">{{ transWord('Mobile') }}</label>
                                                    <input type="text" name="mobile" id="mobile" value="{{ checkHasValue($settings->mobile) }}" class="form-control" placeholder="{{ transWord('Mobile') }}">
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                {!! BuildFields('address' , getDataFromJson($settings->address) , 'text') !!}
                                            </div>
                                            <hr>
                                            <div class="row">
                                                {!! BuildFields('content' , getDataFromJson($settings->content) , 'textarea' , ['required' => 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="tab-pane vivify fadeIn" id="Logo">
                                            <h6>{{ transWord('Logo') }}</h6><hr>
                                            <div class="row">
                                                @foreach (getDataFromJson($settings->logo) as $key => $value)
                                                    <div class="col-lg-6">
                                                        <img src="{{ asset('uploads/backend/settings/'.$value) }}" style="width:70px;height70px;display:block;margin-left:auto;margin-right:auto;" class="img-thumbnail img-responsive" alt="">
                                                        <p style="display:block;margin-left:auto;margin-right:auto;width:15%;margin-top:10px;" class="badge badge-primary">{{ $key.' '.transWord('Logo') }}</p>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="row">
                                                {!! BuildFields('logo' , null , 'file' ) !!}
                                            </div>
                                        </div>
                                        <div class="tab-pane vivify fadeIn" id="Meta">
                                            <h6>{{ transWord('Meta Tags') }}</h6><hr>
                                            <div class="row">
                                                {!! BuildFields('meta_title' , getDataFromJson($settings->meta_title) , 'text') !!}
                                            </div>

                                            <hr>
                                            <div class="row">
                                                {!! BuildFields('meta_desc' , getDataFromJson($settings->meta_desc) , 'text') !!}
                                            </div>

                                            <hr>
                                            <div class="row">
                                                {!! BuildFields('meta_keywords' , getDataFromJson($settings->meta_keywords) , 'text') !!}
                                            </div>
                                        </div>
                                        <div class="tab-pane vivify fadeIn" id="Social">
                                            <h6>{{ transWord('Social Media') }}</h6><hr>
                                            <div class="row">
                                                {!! socialMediaInputs($settings->socialmedia) !!}
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane vivify fadeIn" id="Banner">
                                            <h6>{{ transWord('Banner') }}</h6><hr>
                                            <div class="row">
                                                {!! BuildFields('banner_title' , getDataFromJson($settings->banner_title) , 'text') !!}
                                            </div>

                                            <hr>
                                            <div class="row">
                                                {!! BuildFields('banner_content' , getDataFromJson($settings->banner_content) , 'textarea') !!}
                                            </div>

                                            <hr>
                                            <div class="row">
                                                {!! BuildFields('banner_button_name' , getDataFromJson($settings->banner_button_name) , 'text') !!}
                                            </div>

                                            <hr>
                                            <label for="banner_button_link">{{ transWord('Button Link') }}</label>
                                            <input type="text" class="form-control" value="{{ $settings->banner_button_link }}" id="banner_button_link" name="banner_button_link">
                                        </div> --}}
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;{{ transWord('Save') }}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        var languages = [];

        <?php foreach(getLang() as $key => $val){ ?>
        languages.push('<?php echo $val; ?>');
        <?php } ?>

        var i = 0;
        for (i; i < languages.length; i++) {
            CKEDITOR.replace( 'content['+languages[i]+']', {
                height: 300,
                filebrowserUploadUrl: "{{route('upload_pages', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        }

    </script>
@endsection
