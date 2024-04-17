<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        {{app()->getLocale() == 'ar' ? $restaurant->name_ar : $restaurant->name_en}}
    </title>
    <!-- //font -->

    <link type="text/css" rel="icon" href="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}"
          type="image/x-icon">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{asset('site/assets/css/swiper-bundle.min.css')}}"/>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{asset('site/assets/css/styles.css')}}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('site/css/bootstrap-grid.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}"/>
    <!-- fontawsome -->
    <link rel="stylesheet" href="{{asset('site/css/all.min.css')}}"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="{{asset('site/splide/dist/css/splide.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/home.css')}}"/>
    <script src="{{asset('site/splide/dist/js/splide.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        .active_category {
            border: 3px solid var(--main_color);
            border-radius: 8px;
        }
    </style>
</head>
<body style="background-color: #ebebeb">
<div class="mycontainer" style="background-color: {{$restaurant->az_color?->background}} !important;">
@include('website.layout.header')

<!-- <main class="py-1"> -->
    <div class="show_main_info px-1 py-3"
         style="background-color: {{$restaurant->az_color ? $restaurant->az_color->background : '#FFF'}} !important;">
    @include('website.accessories.slider')
    <!-- end  main slider  -->
        <div
            class="location_branch my-4 d-flex align-items-center justify-content-between"
        >
{{--            <span class="showBranch px-2" style="color: {{$restaurant->az_color?->main_heads}} !important;">--}}
{{--                <i class="fa fa-map-marker-alt" style="color: #e74343"></i>--}}
{{--                {{app()->getLocale() == 'ar' ? $branch->city->name_ar : $branch->city->name_en}} ,--}}
{{--                {{app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en}}--}}
{{--            </span>--}}
            <img src="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}" alt="" width="70" height="60" style="margin-top: -20px"/>
            <span class="showBranch px-2" style="color: {{$restaurant->az_color?->main_heads}} !important; margin-left: 250px">{{app()->getLocale() == 'ar' ? $branch->restaurant->name_ar : $branch->restaurant->name_en}}</span>
            @if($branches->count() > 1)
                @include('website.accessories.branch')
            @endif
        </div>
        <!-- end location branch -->
        @if($restaurant->az_info)
            <h6 class="description p-2" style="color: {{$restaurant->az_color?->options_description}} !important; margin-right: 65px; margin-top: -30px;font-size: 11px">
                {!! app()->getLocale() == 'ar' ? $restaurant->az_info->description_ar : $restaurant->az_info->description_en !!}
            </h6>
        @endif
        <div class="row">
            <div class="col-sm-3 btn text-center" style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : '#dbd6db'}} !important; margin: 15px;">
                <a style="color: {{$restaurant->az_color?->options_description}} !important; font-size: 13px"
                   href="{{route('restaurantTerms' , [$restaurant->name_barcode , $branch->name_en])}}">
                    @lang('messages.terms_conditions')
                </a>
            </div>
            <div class="col-sm-3 btn" style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : '#dbd6db'}} !important; margin: 15px;">
                <a style="color: {{$restaurant->az_color?->options_description}} !important; font-size: 13px"
                   href="{{route('restaurantVisitorContactUs' , [$restaurant->name_barcode , $branch->name_en])}}">
                    @lang('messages.contact_us')
                </a>
            </div>
            <div class="col-sm-3 btn" style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : '#dbd6db'}} !important; margin: 15px;">
                <a style="color: {{$restaurant->az_color?->options_description}} !important; font-size: 13px"
                   href="{{route('restaurantAboutAzmak' , [$restaurant->name_barcode , $branch->name_en])}}">
                    @lang('messages.about_app')
                </a>
            </div>
        </div>
        @include('website.accessories.categories')
    </div>

    <!-- end slider show main dishes -->
    <div id="restaurant-products">
        @include('website.accessories.products')
    </div>
    <!-- </main> -->
    @include('website.layout.footer')
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cardArticles = document.querySelectorAll(".card__image");

        cardArticles.forEach(function (card) {
            card.addEventListener("click", function () {
                // Remove "active" class from all cards
                cardArticles.forEach(function (card) {
                    card.classList.remove("active_category");
                });

                // Add "active" class to the clicked card
                this.classList.add("active_category");
            });
        });
    });
</script>

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
<script src="{{asset('site/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('site/js/cart.js')}}"></script>
<script src="{{asset('site/assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('site/assets/js/main.js')}}"></script>
</body>
</html>
