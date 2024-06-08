<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@lang('messages.login')</title>
    <link rel="icon" href="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}"
          type="image/x-icon">
    <!-- //font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400&display=swap"
        rel="stylesheet"
    />
    <!-- //bootstrap -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css" /> -->
    <link rel="stylesheet" href="{{asset('site/css/bootstrap-grid.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}"/>
    <!-- fontawsome -->
    <link rel="stylesheet" href="{{asset('site/css/all.min.css')}}"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="{{asset('site/css/global.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/global2.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .join_us {
            border-radius: 10px;
        }

        .join_us img {
            margin-top: -50px;
        }

        .join_us p {
            font-weight: 300;
            font-size: 14px;
            margin-top: -50px;
        }

        ::placeholder {
            font-size: 10px !important;
        }

        .container_form {
            border-radius: 8px !important;
        }

        #country-select {
            width: 85px;
            height: 30px;
            margin-right: 20px;
        }


    </style>

    @stack('styles')
</head>
<body>

<div class="mycontainer">
    <header
        class="d-flex align-items-center justify-content-between bg-white p-3"
    >
        <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}" style='color: black'>
            <i class="fa-solid fa-house-chimney-user"></i>
        </a>
        {{-- <h5>@lang('messages.login')</h5> --}}
        @if(app()->getLocale() == 'ar')
            <a href="{{route('language' , 'en')}}">
                En
            </a>
        @else
            <a href="{{route('language' , 'ar')}}">
                ع
            </a>
        @endif
    </header>
    @yield('content')

    @include('website.layout.footer')
</div>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton": true,
            "progressBar": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
{!! Toastr::message() !!}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            var optionWithImage = $(
                '<span value="' + option.id + '">' + option.value + '</span>'
            );
            return optionWithImage;
        }

        // Add options dynamically
        var options = [
                @foreach($countries as $country)
            {
                value: '{{app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en}}',
                id: '{{$country->id}}',
                {{--text: '{{$country->name_ar}}',--}}
            },
            @endforeach
        ];

        $('#country-select').select2({
            templateResult: formatOption,
            templateSelection: formatOption,
            data: options,
            minimumResultsForSearch: Infinity
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#country-select").change(function () {
            var selectedVal = $(this).find(":selected").val();
            if (selectedVal == 2) {
                $("#phone_number").attr("placeholder", "05xxxxxxxx");
            } else if (selectedVal == 1) {
                $("#phone_number").attr("placeholder", "01xxxxxxxxx");
            } else if (selectedVal == 8) {
                $("#phone_number").attr("placeholder", "3xxxxxxx");
            } else {
                $("#phone_number").attr("placeholder", "05xxxxxxxx");
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
