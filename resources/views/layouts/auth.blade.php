<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{URL::asset('/')}}{{setPublic()}}assets/login/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('/')}}{{setPublic()}}assets/login/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/colors.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/components.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/authentication.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/')}}{{setPublic()}}assets/login/style.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Login</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                @yield('content')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        @if(mainSettingsData() != null)
                                            <img alt="Logo" src="{{ URL::asset('/').setPublic() }}uploads/backend/settings/{{ mainSettingsData()['logo'] }}" class="img-fluid"/>
                                        @else
                                            <img alt="Logo" src="{{ URL::asset('/').setPublic() }}dashboard/assets/media/logos/logo-1.svg" class="img-fluid"/>
                                        @endif
                                        <h3 class="mt-2">Translation Management System</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>

    <script src="{{URL::asset('/')}}{{setPublic()}}assets/login/vendors.min.js"></script>
    <script src="{{URL::asset('/')}}{{setPublic()}}assets/login/vertical-menu-dark.js"></script>
    <script src="{{URL::asset('/')}}{{setPublic()}}assets/login/app-menu.js"></script>
    <script src="{{URL::asset('/')}}{{setPublic()}}assets/login/app.js"></script>
    <script src="{{URL::asset('/')}}{{setPublic()}}assets/login/components.js"></script>
    <script src="{{URL::asset('/')}}{{setPublic()}}assets/login/footer.js"></script>
</body>
</html>
