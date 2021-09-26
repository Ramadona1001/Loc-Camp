
<script src="{{ URL('/').'/'.setPublic() }}app-assets/vendors/js/vendors.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/vendors/js/extensions/swiper.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/scripts/configs/horizontal-menu.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/core/app-menu.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/core/app.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/scripts/components.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/scripts/footer.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>


@yield('javascript')

@if (Session::has('success'))
    <script>
        Swal.fire(
            'Success',
            'Process Done Successfully',
            'success'
        )
    </script>
@endif

@if (Session::has('failed'))
    <script>
        Swal.fire(
            'Oops !',
            'Process Is Failed',
            'error'
        )
    </script>
@endif

@if (Session::has('failedprocess'))
    <script>
        Swal.fire(
            'Oops !',
            'Process Is Failed',
            'error'
        )
    </script>
@endif

