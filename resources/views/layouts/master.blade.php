<!doctype html>
<html lang="en">
@include('components.head')
<body>
    @include('components.topnav')
    @include('components.mobile')
    @include('components.menu')
    @include('components.breadcrumb')
    <div class="notika-status-area">
        <div class="container">
            @yield('content')
        </div>
    </div>
    @include('components.footer')
    @include('components.scripts')
</body>
</html>
