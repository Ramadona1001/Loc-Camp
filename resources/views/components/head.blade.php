<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/owl.theme.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/owl.transitions.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/meanmenu/meanmenu.min.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/animate.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/normalize.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/jvectormap/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/notika-custom-icon.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/wave/waves.min.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/wave/button.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/main.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/style.css">
    <link rel="stylesheet" href="{{ URL('/').'/'.setPublic() }}assets/css/responsive.css">
    <script src="{{ URL('/').'/'.setPublic() }}assetsjs/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .container{
            width: 1400px;
        }
        #loader {
            position: absolute;
            left: 50%;
            top: 70%;
            z-index: 1;
            width: 120px;
            height: 120px;
            margin: -76px 0 0 -76px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #leadTable_info{
            color: white !important;
        }

    </style>
    @yield('stylesheet')
</head>
