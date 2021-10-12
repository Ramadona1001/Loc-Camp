<script src="{{ URL('/').'/'.setPublic() }}assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/bootstrap.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/wow.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/jquery-price-slider.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/owl.carousel.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/jquery.scrollUp.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/meanmenu/jquery.meanmenu.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/counterup/jquery.counterup.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/counterup/waypoints.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/counterup/counterup-active.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/jvectormap/jvectormap-active.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/sparkline/jquery.sparkline.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/sparkline/sparkline-active.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/jquery.flot.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/jquery.flot.resize.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/jquery.flot.pie.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/jquery.flot.tooltip.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/jquery.flot.orderBars.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/curvedLines.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/flot/flot-active.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/knob/jquery.knob.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/knob/jquery.appear.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/knob/knob-active.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/wave/waves.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/wave/wave-active.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/chat/moment.min.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/chat/jquery.chat.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/todo/jquery.todo.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/plugins.js"></script>
<script src="{{ URL('/').'/'.setPublic() }}assets/js/main.js"></script>
{{-- <script src="{{ URL('/').'/'.setPublic() }}assets/js/tawk-chat.js"></script> --}}
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

