<!doctype html>
<html lang="en">

@include('components.head')

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">

    @include('components.topnav')
    @include('components.menu')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                @yield('breadcrumb')
            </div>
            <div class="content-body">
                <section id="dashboard-ecommerce">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
   
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    

    @include('components.footer')
    @include('components.scripts')

</body>
</html>
