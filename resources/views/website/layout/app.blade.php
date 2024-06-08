<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{ app()->getLocale() == 'ar' ? $restaurant->name_ar : $restaurant->name_en }}
    </title>
    <!-- //font -->

    <link rel="icon" href="{{ asset('/uploads/restaurants/logo/' . $restaurant->az_logo) }}" type="image/x-icon">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('site/assets/css/swiper-bundle.min.css') }}" />
    <style>
        :root {
            --rest-color-main-head: {{ @$restaurant->color->main_heads ?? 'inherit' }};

            --rest-color-icon: {{ @$restaurant->color->icons ?? '#f7b538' }};

            --rest-color-option-description: {{ @$restaurant->color->options_description ?? 'inherit' }};

            --rest-color-background: {{ @$restaurant->color->background ?? 'inherit' }};

            --rest-color-product-background: {{ @$restaurant->color->product_background ?? 'inherit' }};

            --rest-color-category-background: {{ @$restaurant->color->category_background ?? 'inherit' }};
        }
    </style>
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('site/assets/css/styles.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap-grid.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.css') }}" />
    <!-- fontawsome -->
    <link rel="stylesheet" href="{{ asset('site/css/all.min.css') }}" />
    <!-- style sheet -->
    <link rel="stylesheet" href="{{ asset('site/splide/dist/css/splide.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('site/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/global2.css') }}" />

    @stack('styles')
    <script src="{{ asset('site/splide/dist/js/splide.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        .res_name {
            color: {{ $restaurant->az_color?->main_heads }} !important;
            margin-right: 75px;
            font-size: 17px;
            margin-top: -20px;
        }

        .active_category {
            border: 3px solid var(--main_color);
            border-radius: 8px;
        }
    </style>
</head>

<body style="background-color: #ebebeb">
    @yield('content')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cardArticles = document.querySelectorAll(".card__image");

            cardArticles.forEach(function(card) {
                card.addEventListener("click", function() {
                    // Remove "active" class from all cards
                    cardArticles.forEach(function(card) {
                        card.classList.remove("active_category");
                    });

                    // Add "active" class to the clicked card
                    this.classList.add("active_category");
                });
            });
        });
    </script>

    <script>
        var langDirection = '{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}';
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    {!! Toastr::message() !!}
    <script src="{{ asset('site/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('site/js/cart.js') }}"></script>
    <script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>