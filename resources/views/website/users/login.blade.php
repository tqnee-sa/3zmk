<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@lang('messages.login')</title>
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
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
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

        #country-select + .select2-container .select2-selection__rendered img, .img-flag {
            width: 35px;
            height: 35px;
            margin-right: 50px;
            vertical-align: middle;
        }

        #country-select + .select2-container .select2-dropdown {
            display: none;
        }

        .select2-container--default .select2-selection--single {
            background-color: #ECF2FF;
            /*border: 1px solid #aaa;*/
            width:110px;
            height: 40px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 30px;
        }

        .select2-container--default .select2-results>.select2-results__options {
            max-height: 200px;
            overflow-y: auto;
            width: 100px;
        }
        select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 0px;
        }

    </style>


</head>
<body>

<div class="container">
    <div class="mycontainer">
        <header
            class="d-flex align-items-center justify-content-between bg-white p-3"
        >
            <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}" style='color: black'>
                <i class="fa-solid fa-angle-right"></i>
            </a>
            <h5>@lang('messages.login')</h5>
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
        <main>
            @if (session('An_error_occurred'))
                <div class="alert alert-success">
                    {{ session('An_error_occurred') }}
                </div>
            @endif
            @if (session('warning_login'))
                <div class="alert alert-danger">
                    {{ session('warning_login') }}
                </div>
            @endif
            <div
                class="join_us d-flex flex-column align-items-center px-1 m-3 justify-content-center bg-white"
            >
                <br><br><br>
                <img src="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}" width="75" height="75"
                     alt="logo"/>
                <br><br><br>
                <form method="post"
                      action="{{route('AZUserLoginSubmit' , [$restaurant->name_barcode , $branch->name_en])}}">
                    <input type='hidden' name='_token' value='{{Session::token()}}'>

                    <div class="m-2 px-1 container_form">
                        <div class="phone_number">
                            <label for="type_company"> @lang('messages.phone_number') :</label>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-9">
                                    <input
                                        style="direction: rtl"
                                        type="tel"
                                        class="form-control"
                                        id="phone_number"
                                        name="phone_number"
                                        value="{{old('phone_number')}}"
                                        placeholder="05xxxxxxxx"
                                        required
                                    />
                                </div>
                                <div class="col-sm-3">
                                    <select name="country_id" class="form-control" id="country-select" required>

                                    </select>

                                    @if ($errors->has('country_id'))
                                        <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('country_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('phone_number') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <input type="submit" value="@lang('messages.login')" class="my-5"/>
                </form>
            </div>
        </main>

        @include('website.layout.footer')
    </div>
</div>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
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
    $(function(){
        $("#country-select").change(function(){
            var selectedVal = $(this).find(":selected").val();
            if(selectedVal == 2)
            {
                $("#phone_number").attr("placeholder", "05xxxxxxxx");
            }else if(selectedVal == 1)
            {
                $("#phone_number").attr("placeholder", "01xxxxxxxxx");
            }else if(selectedVal == 8)
            {
                $("#phone_number").attr("placeholder", "3xxxxxxx");
            }else{
                $("#phone_number").attr("placeholder", "05xxxxxxxx");
            }
        });
    });
</script>
</body>
</html>
