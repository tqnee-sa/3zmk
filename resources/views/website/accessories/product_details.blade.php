<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@lang('messages.product_details')</title>
    <!-- //font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400&display=swap"
        rel="stylesheet"
    />
    <link type="text/css" rel="icon" href="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}"
          type="image/x-icon">

    <!-- //bootstrap -->
    <link rel="stylesheet" href="{{asset('site/css/bootstrap-grid.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}"/>
    <!-- fontawsome -->
    <link rel="stylesheet" href="{{asset('site/css/all.min.css')}}"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="{{asset('site/css/home.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/global.css')}}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        .name_meal {
            font-size: 18px;
            font-weight: 500;
        }

        .description_meal {
            font-size: 12px !important;
            font-weight: 300 !important;
        }

        .choose_details {
            background-color: var(--bg-second);
            border-radius: 8px;
        }

        .choose_details label,
        h4 {
            font-size: 14px;
        }

        .choose_details .main_prcie {
            font-size: 14px !important;
            font-size: 500 !important;
        }

        @media (max-width: 768px) {
            .choose_details h4,
            label {
                font-size: 12px !important;
                font-weight: 500;
            }

            .choose_details,
            .add_cart button,
            .price_addition {
                font-size: 14px;
                font-weight: 500;
            }
        }

        .meals_deatails p {
            font-size: 13px;
            font-weight: 400;
        }

        .choose_details .addition {
            background-color: var(--main_color);
            border-radius: 0px 0 15px 15px;
        }

        .addition button,
        form button {
            background: #fdb96f;
            border-radius: 5px;
            width: 24px;
            height: 24px;
            line-height: 10px;
            color: var(--main_color);
        }

        .addition button:active,
        .addition button:focus {
            background: white;
        }

        form button:active,
        form button:focus {
            color: white;
        }

        .addition button:active,
        .addition button:focus {
            color: var(--main_color);
        }

        .share_icon button {
            width: 154px;
            border-radius: 8px;
            cursor: pointer;
            width: max-content;
            background-color: #f8f8f8;
            font-size: 12px;
            padding: 6px;
        }

        .totalCount {
            background-color: rgba(0, 0, 0, 0);
            border-radius: 3px !important;
            border-color: rgba(0, 0, 0, 0.1);
            /* display: block; */
            width: 10%;
            height: 25px;
            line-height: 47px;
            padding: -52px 78px;
            font-size: 14px;
            /*!* -webkit-appearance: none;*/
        }

        .optionCount {
            background-color: rgba(0, 0, 0, 0);
            border-radius: 3px !important;
            border-color: rgba(0, 0, 0, 0.1);
            /* display: block; */
            width: 10%;
            height: 25px;
            line-height: 47px;
            padding: -52px 78px;
            font-size: 14px;
            /*!* -webkit-appearance: none;*/
        }

        .shareBtn ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /*background-color: #333333;*/
        }

        .shareBtn ul li {
            float: left;
        }

        .shareBtn ul li a {
            display: block;
            /*color: white;*/
            text-align: center;
            padding: 16px;
            text-decoration: none;
        }

        .shareBtn ul li a:hover {
            background-color: #e1ca6c;
        }
    </style>
</head>
<body>
<div class="mycontainer bg-white">
    <header
        style="background-color: {{$restaurant->az_color?->background}} !important;"
        class="d-flex align-items-center justify-content-between bg-white p-3"
    >
        <a href="{{route('homeBranchIndex' , [$product->restaurant->name_barcode , $product->branch->name_en , $product->menu_category->id])}}"
           style='color: black'>
            <i class="fa-solid fa-angle-right"></i>
        </a>
        <h6 style="color: {{$restaurant->az_color?->main_heads}}">
            @lang('messages.product_details')
        </h6>
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
    <!-- end header -->
    <main style="background-color: {{$restaurant->az_color?->background}}">
        <div class="slider mb-3">
            <div
                id="carouselExampleControls"
                class="carousel slide"
                data-bs-ride="carousel"
            >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('/uploads/products/' . $product->photo)}}" class="d-block w-100" alt="..."/>
                    </div>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev"
                >
              <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
              ></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselExampleControls"
                    data-bs-slide="next"
                >
              <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
              ></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- end slider -->
        <div class="meals_deatails my-2 p-3"
             style="background-color: {{$restaurant->az_color?->background}} !important;">
            <h4 class="name_meal" style="color: {{$restaurant->az_color?->main_heads}}">
                {{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}
            </h4>
            @if ($product->poster != null)
                <img style="text-align: right"
                     src="{{ asset('/uploads/posters/' . $product->poster->poster) }}"
                     height="30" width="30" class="poster-image">
            @endif
            @if ($product->sensitivities and $product->sensitivities->count() > 0)
                @foreach ($product->sensitivities as $product_sensitivity)
                    <i>
                        <img
                            src="{{ asset('/uploads/sensitivities/' . $product_sensitivity->sensitivity->photo) }}"
                            height="25" width="25" class="sens-image">
                    </i>
                @endforeach
            @endif
            <p class="description_meal" style="color: {{$restaurant->az_color?->options_description}}">
                {{app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en))}}
            </p>
            <div class="choose_details pt-4 mb-2"
                 style="background-color: {{$restaurant->az_color ? $restaurant->az_color->product_background : ''}} !important;">
                <div class="d-flex justify-content-between px-4">
                    <h4 style="color: {{$restaurant->az_color?->main_heads}}">
                        {{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}
                    </h4>
                    <span class="main_prcie" style="color: {{$restaurant->az_color?->options_description}}">
                        @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                            {{--                                                    add the commission to product--}}
                            {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                        @else
                            {{$product->price}}
                        @endif
                        {{ app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en }}
                    </span>
                </div>
                <hr width="95%" class="m-auto my-3"/>
                <form id="myForm" width="100%" method="post" action="{{route('addToAZCart')}}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="px-4">
                        @if($product->sizes->count() > 0)
                            <p style="color: {{$restaurant->az_color?->main_heads}}">
                                @lang('messages.sizes')
                            </p>
                            @foreach($product->sizes as $size)
                                @if($size->status == 'true')
                                    @php
                                        if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user'):
                                              $size_price = (($product->restaurant->az_commission * $size->price) / 100) + $size->price;
                                        else:
                                              $size_price = $size->price;
                                        endif;
                                    @endphp
                                    <div class="my-3 d-flex">
                                        <input type="radio" id="size-{{$size->id}}" class="size_class" name="size_id"
                                               data="{{$size_price}}" value="{{$size->id}}"/>
                                        <label for="size-{{$size->id}}"
                                               style="color: {{$restaurant->az_color?->options_description}}">
                                            {{app()->getLocale() == 'ar' ? $size->name_ar : $size->name_en}}
                                        </label>
                                        <div
                                            style="margin-right: 150px;color: {{$restaurant->az_color?->options_description}}">
                                            {{$size_price}}
                                            {{ app()->getLocale() == 'ar' ? $size->product->restaurant->country->currency_ar : $size->product->restaurant->country->currency_en }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <hr/>
                        @endif
                        @if($product->modifiers->count() > 0 and $product->options->count() > 0)
                            @foreach($product->modifiers as $modifier)
                                @php
                                    $options = \App\Models\Restaurant\Azmak\AZProductOption::with('option')
                                    ->whereHas('option', function ($q) {
                                        $q->where('is_active', 'true');
                                    })
                                    ->whereProduct_id($product->id)
                                    ->where('modifier_id', $modifier->modifier->id)
                                    ->get();
                                    $check_required_options = \App\Models\Restaurant\Azmak\AZProductOption::whereProductId($product->id)
                                        ->whereHas('option', function ($query) use ($modifier) {
                                            return $query->where('modifier_id', $modifier->modifier->id);
                                        })
                                        ->where('min', '>=', 1)
                                        ->count();
                                @endphp
                                @if($options->count() > 0)
                                    <h4 class="mb-1 font-14"
                                        style="color: {{ $product->restaurant->az_color?->main_heads }} !important">
                                        {{ app()->getLocale() == 'ar' ? $modifier->modifier->name_ar : $modifier->modifier->name_en }}
                                        @if ($modifier->modifier->choose == 'one')
                                            ({{ app()->getLocale() == 'ar' ? 'اختيار واحد فقط' : 'choose one only' }})
                                        @elseif ($modifier->modifier->choose == 'custom')
                                            ({{ app()->getLocale() == 'ar' ? 'اختيار ' . $modifier->modifier->custom . '  فقط' : 'choose ' . $modifier->modifier->custom . ' only' }}
                                            )
                                        @endif

                                        @if ($check_required_options > 0 )
                                            <span style="color: red; font-size: 10px">
                                            {{ app()->getLocale() == 'ar' ? 'مطلوب' : 'required' }}
                                        </span>
                                        @endif
                                    </h4>
                                    @foreach($options as $option)
                                        @if($option->option->is_active == 'true')
                                            <div class="d-flex justify-content-between align-items-center my-3">
                                                <div>
                                                    <input type="checkbox" id="{{$option->id}}" name="options[]"
                                                           value="{{$option->option->id}}" class="optionCheckBox"/>
                                                    <label for="option-{{$option->id}}"
                                                           style="color: {{$restaurant->az_color?->options_description}}">
                                                        {{app()->getLocale() == 'ar' ? $option->option->name_ar : $option->option->name_en }}
                                                    </label>
                                                </div>
                                                <div style="text-align: left">
                                                    @php
                                                        if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user'):
                                                              $option_price = (($product->restaurant->az_commission * $option->option->price) / 100) + $option->option->price;
                                                        else:
                                                              $option_price = $option->option->price;
                                                        endif;
                                                    @endphp
                                                    <button style="background-color: {{$restaurant->az_color?->icons}}"
                                                            class="border-0 p-1 optionIncrease" data="{{$option->id}}"
                                                            id="optionIncrease-{{$option->id}}">+
                                                    </button>
                                                    <input name="option_count-{{$option->option->id}}" type="text"
                                                           id="option_count-{{$option->id}}" class="optionCount"
                                                           value="1">
                                                    <button style="background-color: {{$restaurant->az_color?->icons}}"
                                                            class="border-0 p-1 optionDecrease" data="{{$option->id}}"
                                                            id="decreaseBtn1">-
                                                    </button>
                                                    <span id="option_price-{{$option->id}}"
                                                          data="{{$option_price}}">
                                                        {{$option_price}}
                                                    </span>
                                                    <span id="choose_addValue"> </span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <!-- end choose Add-ons -->
                    <div style="background-color: {{$restaurant->az_color?->product_background}}"
                         class="addition text-white w-100 p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <button style="background-color: {{$restaurant->az_color?->icons}}"
                                    class="border-0 p-1" id="totalIncrease">+
                            </button>
                            <input name="product_count" type="text" id="count" class="totalCount" value="1" readonly>
                            <button style="background-color: {{$restaurant->az_color?->icons}}"
                                    class="border-0 p-1" id="totalDecrease">-
                            </button>
                        </div>
                        <div id="totalPrice" style="padding-right: 100px;color: {{$restaurant->az_color?->options_description}}">
                            @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                {{--                                                    add the commission to product--}}
                                {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                            @else
                                {{$product->price}}
                            @endif
                        </div>
                        <span style="color: {{$restaurant->az_color?->options_description}}">
                            {{ app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en }}
                        </span>
                    </div>
                    <div style="padding-bottom: 3px;">
                        <input style="background-color: {{$restaurant->az_color?->icons}}; color: {{$restaurant->az_color?->options_description}}"
                               type="submit" class="btn btn-success" value="@lang('messages.add_to_cart')">
                    </div>

                </form>
                <!-- end form -->
            </div>
            <!-- end choose_details -->
        </div>
        <!-- end meals_deatails -->
        <div class="share_icon d-flex justify-content-end mx-3" style="padding-bottom: 10px;">
            <button style="background-color: {{$restaurant->az_color?->icons}}"
                    class="border-0 text-center" id="share">
                <i class="fa-solid fa-share-nodes mx-2"></i>
                @lang('messages.invite_me')
            </button>
        </div>
        <div style="display: none" id="shareDiv" class="shareBtn">
            {!! $shareComponent !!}
        </div>
    </main>
    @include('website.layout.footer')
</div>

<script src="{{asset('site/js/bootstrap.bundle.js')}}"></script>
<script>
    $(document).ready(function () {
        var product_price =
            @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                {{--                                                    add the commission to product--}}
                {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                @else
                {{$product->price}}
                @endif;
        // sizes
        $('input:radio').change(function () {
            var size_prcie = $(this).attr('data');
            $('#totalPrice').html(size_prcie);
            product_price = size_prcie;
        });
        $('#totalIncrease').on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('data');
            // get the product count
            var count = $('#count').val();
            count++;
            $('#count').val(count);
            // get total price
            var totalPrice = $('#totalPrice').text();
            var finalPrice = parseInt(totalPrice) + parseInt(product_price);
            $('#totalPrice').html(finalPrice);
        });
        $('#totalDecrease').on('click', function (e) {
            e.preventDefault();
            var id = $(this).attr('data');
            // get the product count
            var count = $('#count').val();
            if (count > 1) {
                count--;
                $('#count').val(count);
                // get total price
                var totalPrice = $('#totalPrice').text();
                $('#totalPrice').html(parseInt(totalPrice) - product_price);
            }
        });
        // options
        $('.optionIncrease').on('click', function (e) {
            e.preventDefault();
            var option_id = $(this).attr('data');
            // get the product count
            var count = $('#option_count-' + option_id).val();
            count++;
            $('#option_count-' + option_id).val(count);
            // get total price
            var optionPrice = $('#option_price-' + option_id).attr('data');
            $('#option_price-' + option_id).html(optionPrice * count);
        });
        $('.optionDecrease').on('click', function (e) {
            e.preventDefault();
            var option_id = $(this).attr('data');
            // get the product count
            var count = $('#option_count-' + option_id).val();
            if (count > 1) {
                count--;
                $('#option_count-' + option_id).val(count);
                // get total price
                var optionPrice = $('#option_price-' + option_id).attr('data');
                $('#option_price-' + option_id).html(optionPrice * count);
            }
        });
        $('.optionCheckBox').on('change', function () {
            var val = this.checked ? this.value : '';
            var option_id = this.id;
            if (val) {
                // get the price op option
                var optionPrice = $('#option_price-' + option_id).text();
                var total = $('#totalPrice').text();
                $('#totalPrice').html(parseInt(total) + parseInt(optionPrice));
            } else {
                var optionPrice = $('#option_price-' + option_id).text();
                var total = $('#totalPrice').text();
                $('#totalPrice').html(parseInt(total) - parseInt(optionPrice));
            }
        });

        $("#share").click(function () {
            document.getElementById('shareDiv').style.display = 'block';
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
</body>
</html>
