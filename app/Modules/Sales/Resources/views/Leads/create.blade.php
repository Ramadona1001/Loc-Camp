@extends('layouts.master')

@section('title',$title)

@section('stylesheet')
<style>
    .domain_search,.company_email,.company_phone,#removeEmail,#removePhone {
        position: absolute;
        top: 26px;
        right: 15px;
        color: white;
        border: 0;
        -webkit-appearance: none;
    }
    .col-lg-6,.col-lg-12,.col-lg-4,.col-lg-3,#emailData,#phoneData{
        margin-bottom: 10px;
    }
    #emailData,#phoneData{
        margin-top: 10px;
    }

</style>
@endsection

@section('content')

    @include('components.errors')

    <div class="col-xxl-12">
        <form action="{{ route('store_leads') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-lg-12">
                    <label for="url">Company Domain</label>
                    <input type="url" class="form-control input-lg company_domain" name="url" id="url" >
                    <button type="button" class="btn btn-primary btn-lg domain_search"><i class="fa fa-search"></i></button>
                </div>
            </div>

            <div id="loader"></div>

            <div id="leadData">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control input-lg" name="company_name" id="company_name" >
                    </div>


                    <div class="col-lg-12">
                        <label for="industry">Industry</label>
                        <textarea name="industry" id="industry" cols="30" rows="4" class="form-control input-lg"></textarea>
                    </div>

                    <div class="col-lg-4">
                        <label for="company_hq">Company Headquarter</label>
                        <input type="text" class="form-control input-lg" name="company_hq" id="company_hq" >
                    </div>

                    <div class="col-lg-4">
                        <label for="company_head_count">Company Headcount</label>
                        <input type="text" class="form-control input-lg" name="company_head_count" id="company_head_count" >
                    </div>

                    <div class="col-lg-4">
                        <label for="company_zone">Company Zone</label>
                        <input type="text" class="form-control input-lg" name="company_zone" id="company_zone" >
                    </div>

                    <div class="col-lg-4">
                        <label for="contact_name">Contact Name</label>
                        <input type="text" class="form-control input-lg" name="contact_name" id="contact_name" >
                    </div>

                    <div class="col-lg-4">
                        <label for="title">Title</label>
                        <input type="text" class="form-control input-lg" name="title" id="title" >
                    </div>

                    <div class="col-lg-4">
                        <label for="office">Office</label>
                        <input type="text" class="form-control input-lg" name="office" id="office" >
                    </div>

                    <div class="col-lg-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control input-lg" name="email[]" id="email" >
                        <button type="button" class="btn btn-primary btn-lg company_email"><i class="fa fa-plus"></i></button>
                        <div id="emailData"></div>
                    </div>

                    <div class="col-lg-6">
                        <label for="phone_skype">Phone No. / Skype</label>
                        <input type="text" class="form-control input-lg" name="phone_skype[]" id="phone_skype" >
                        <button type="button" class="btn btn-primary btn-lg company_phone"><i class="fa fa-plus"></i></button>
                        <div id="phoneData"></div>
                    </div>
                </div>

                <div class="row">
                    <div style="margin-top: 10px;">
                        <div class="col-lg-9" style="margin-bottom: 20px;">
                            <h3 style="text-align:left;text-decoration:underline;color:white;">Social Media</h3>
                        </div>
                        <div class="col-lg-3" style="margin-bottom: 3px;text-align:right">
                            <button type="button" class="btn btn-primary social_media_btn"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="row" id="social_media"></div>
                <div id="new_social_media"></div>

                <div class="row">
                    <div class="col-lg-12">
                        <label for="comments">Comments</label>
                        <textarea name="comments" id="comments" class="form-control input-lg" cols="30" rows="4"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Save</button>
                    </div>
                </div>
            </div>


        </form>
    </div>


@endsection

@section('javascript')
<script>

function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

$('#loader').hide();
$('#leadData').hide();

jQuery(document).ready(function(){

    jQuery('.domain_search').click(function(e){
        e.preventDefault();
        if ($('.company_domain').val() != '') {
            if (isUrlValid($('.company_domain').val())) {
                $('#loader').fadeIn();
                $('#leadData').hide();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('search_lead_domain') }}",
                    method: 'get',
                    data: {
                        company_domain: jQuery('.company_domain').val()
                    },
                    success: function(result){
                        $('#loader').hide();
                        $('#leadData').fadeIn();
                        console.log(result);
                        $('#industry').val(result['meta_tags']['description']);
                        $('#company_name').val(result['title']);
                        var social_media_html = '';


                        $.each(result['social_media'], function(key,val) {
                            social_media_html += '<div class="col-lg-6">';
                                social_media_html += '<div class="row">';
                                    social_media_html += '<div class="col-lg-3">';
                                        social_media_html += '<input type="text" name="social_media_keys[]" class="form-control input-lg" value="'+key+'">';
                                    social_media_html += '</div>';
                                    social_media_html += '<div class="col-lg-9">';
                                        social_media_html += '<input type="url" name="social_media_values[]" class="form-control input-lg" value="'+val+'">';
                                    social_media_html += '</div>';
                                social_media_html += '</div>';
                            social_media_html += '</div>';
                        });

                        $('#social_media').append(social_media_html);
                }});
            }else{
                alert('Please Enter Valid Company Domain');
            }
        }else{
            alert('Please Enter Company Domain');
        }

    });
});


    var phone_index = 1;
    var email_index = 1;
    var social_index = 1;

    //Add Social Media
    $(".social_media_btn").click(function () {
        var socialHtml = '';
        socialHtml +='<div class="row new_social">';
            socialHtml += '<div class="col-lg-3">';
                socialHtml += '<input type="text" name="social_media_keys[]" class="form-control input-lg" placeholder="Social Media Name">';
            socialHtml += '</div>';
            socialHtml += '<div class="col-lg-8">';
                socialHtml += '<input type="url" name="social_media_values[]" class="form-control input-lg" placeholder="Social Media Url">';
            socialHtml += '</div>';
            socialHtml += '<div class="col-lg-1">';
                socialHtml +='<button id="removeSocial" type="button" class="btn btn-danger btn-lg" style="float:right;text-align:right;"><i class="fa fa-trash"></i></button>';
            socialHtml +='</div>';
        socialHtml +='</div>';

        social_index++;

        $('#new_social_media').append(socialHtml);
    });

    // remove row
    $(document).on('click', '#removeSocial', function () {
        $(this).closest('.new_social').remove();
    });

    /****************************************************/

    //Add Email
    $(".company_email").click(function () {
        var emailHtml = '';
        emailHtml +='<div class="row new_email">';
            emailHtml +='<div class="col-lg-12">';
                emailHtml +='<label for="email'+email_index+'">Email</label>';
                emailHtml +='<input type="email" class="form-control input-lg" name="email[]" id="email'+email_index+'" >';
                emailHtml +='<button id="removeEmail" type="button" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i></button>';
            emailHtml +='</div>';
        emailHtml +='</div>';

        email_index++;

        $('#emailData').append(emailHtml);
    });

    // remove row
    $(document).on('click', '#removeEmail', function () {
        $(this).closest('.new_email').remove();
    });


    /****************************************************/

     //Add Phone
     $(".company_phone").click(function () {
        var phoneHtml = '';
        phoneHtml +='<div class="row new_phone">';
            phoneHtml +='<div class="col-lg-12">';
                phoneHtml +='<label for="phone_skype'+phone_index+'">Phone No. / Skype</label>';
                phoneHtml +='<input type="text" class="form-control input-lg" name="phone_skype[]" id="phone_skype'+phone_index+'" >';
                phoneHtml +='<button id="removePhone" type="button" class="btn btn-danger btn-lg"><i class="fa fa-trash"></i></button>';
            phoneHtml +='</div>';
        phoneHtml +='</div>';

        phone_index++;

        $('#phoneData').append(phoneHtml);
    });

    // remove row
    $(document).on('click', '#removePhone', function () {
        $(this).closest('.new_phone').remove();
    });
</script>
@endsection
