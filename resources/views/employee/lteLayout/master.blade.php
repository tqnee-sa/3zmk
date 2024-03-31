<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link type="text/css" rel="icon" href="{{auth('employee')->user()->restaurant->az_logo ? asset('/uploads/restaurants/logo/' . auth('employee')->user()->restaurant->az_logo) : asset('/3azmkheader.jpg')}}"
          type="image/x-icon">    <!-- Tell the browser to be responsive to screen width -->
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
          <link rel="stylesheet" type="text/css" href="{{ asset('styles/toastr.css') }}">
    @if(app()->getLocale() == 'ar')
    <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="{{asset('dist/css/bootstrap_rtl.min.css')}}">
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}">
    @endif
    @if(app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{asset('dist/css/style_ltr.css')}}">
    @endif
    @yield('style')

     <style>
        body{
            font-family:'cairo';
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('employee.lteLayout.header')

@include('employee.lteLayout.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <!--<footer class="main-footer">-->
    <!--    <strong>@lang('messages.copyRight')-->
    <!--        <a href="https://tqnee.com.sa"> @lang('messages.tqneeCompany') </a>-->
    <!--        &copy; {{\Carbon\Carbon::now()->format('Y')}}-->
    <!--        .</strong>-->
    <!--    @lang('messages.all_rights_reserved').-->
    <!--    <div class="float-right d-none d-sm-inline-block">-->

    <!--    </div>-->
    <!--</footer>-->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <div id="sidebar-overlay"></div>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
@if(app()->getLocale() == 'ar')
    <!-- Bootstrap 4 rtl -->
    <script src="{{asset('dist/js/bootstrap_rtl.min.js')}}"></script>
@endif
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('scripts/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
    $(function(){
        toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        $('#btn-sidebar-menu').on('click' , function(){

            var tag = $('body.sidebar-mini');
            console.log(tag);
            if(tag.hasClass('sidebar-open')){
                tag.removeClass('sidebar-open').addClass('sidebar-collapse');
                // $('#sidebar-overlay').css('display' , 'none');
            }else if(tag.hasClass('sidebar-collapse')){
                tag.removeClass('sidebar-collapse').addClass('sidebar-open');
                // console.log(tag);
                // $('#sidebar-overlay').css('display' , 'block');
            }
            else{
                if(window.innerWidth > 800)
                    tag.addClass('sidebar-collapse').removeClass('sidebar-open');
                else tag.addClass('sidebar-open').removeClass('sidebar-collapse');
                // console.log(window.innerWidth);
                // $('#sidebar-overlay').css('display' , 'block');
            }
            });
        $('#sidebar-overlay').on('click' , function(){
            console.log('test');
            $('body.sidebar-mini').removeClass('sidebar-open').addClass('sidebar-collapse');
        });
    });
</script>
@yield('scripts')

</body>
</html>
