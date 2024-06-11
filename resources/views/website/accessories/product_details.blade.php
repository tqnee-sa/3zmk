@extends('website.layout.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('site/css/product_details.css') }}">
    <style>
        .header {
            position: absolute;
            top: 1px;
            left: 5px;
            padding: 5px;
            height: 2px;
            border-radius: 7px;
            box-shadow: 1px 1px 1px 1px lightblue;
            background-color: {{ $restaurant->az_color ? $restaurant->az_color->background : '#E6E9ED' }} !important;
        }

        .back {
            position: absolute;
            width: 30px;
            line-height: 30px;
            font-size: 14px;
            margin-right: 8px;
            border-radius: 17px;
            box-shadow: 1px 1px 1px 1px lightblue;
            background-color: {{ $restaurant->az_color ? $restaurant->az_color->background : '#E6E9ED' }} !important;
        }

        body {}
    </style>
@endpush
@section('content')
    <div class="mycontainer bg-white product-detail">

        <!-- end header -->
        <main style="background-color: {{ $restaurant->az_color?->background }}">
            <div class="top-icon">
                <a href="{{ route('homeBranchIndex', [$product->restaurant->name_barcode, $product->branch->name_en, $product->menu_category->id]) }}"
                    style='color: black' class="back icon return">
                    <i class="fa-solid fa-angle-right" style="padding: 8px;"></i>
                </a>
            </div>
            <div class="slider mb-3">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            @if($product->photo)
                                <img src="{{ asset('/uploads/products/' . $product->photo) }}" class="d-block w-100"
                                     alt="..." />
                            @else
                                <img src="{{ asset('/uploads/restaurants/logo/' . $restaurant->az_logo) }}" class="d-block w-100"
                                     alt="..." />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slider -->

            <div class="meals_deatails my-2 p-3"
                style="background-color: {{ $restaurant->az_color?->background }} !important;">
                <h4 class="name_meal" style="color: {{ $restaurant->az_color?->main_heads }}">
                    @if ($product->poster != null)
                        <img style="text-align: right" src="{{ asset('/uploads/posters/' . $product->poster->poster) }}"
                            height="40" width="40" class="poster-image" style="padding: 10px">
                    @endif {{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}
                </h4>
                <div class="share_icon d-flex justify-content-end mx-3" style="padding-bottom: 10px;">
                    <button style="background-color: {{ $restaurant->az_color?->icons }}" class="border-0 text-center"
                        id="share">
                        <i class="fa-solid fa-share-nodes mx-2"></i>
                        @lang('messages.invite_me')
                    </button>
                </div>
                <div style="display: none" id="shareDiv" class="shareBtn">
                    {!! $shareComponent !!}
                </div>

                <p class="description_meal" style="color: {{ $restaurant->az_color?->options_description }}">
                    {!! strip_tags(str_replace('&nbsp;', ' ', $product->description)) !!}
                </p>
                @if ($product->calories === 0.0 or $product->calories > 0)
                    <span class="pl-1 calories" style="margin:0 6px;">
                        <span style="color: {{ $restaurant->az_color?->options_description }} !important;">
                            {{ $product->calories == 0 ? trans('messages.no_calories') : trans('messages.calories_des', ['num' => $product->calories]) }}
                        </span>
                    </span>
                    <br>
                @endif

                <div style="text-align: left !important;">
                    @if ($product->sensitivities and $product->sensitivities->count() > 0)
                        @foreach ($product->sensitivities as $product_sensitivity)
                            <i>
                                <img src="{{ asset('/uploads/sensitivities/' . $product_sensitivity->sensitivity->photo) }}"
                                    height="25" width="25" class="sens-image">
                            </i>
                        @endforeach
                    @endif
                </div>
                <div class="choose_details pt-4 mb-2"
                    style="background-color: {{ $restaurant->az_color ? $restaurant->az_color->product_background : '' }} !important;">

                    <form id="myForm" width="100%" method="post" action="{{ route('addToAZCart') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if ($product->sizes->count() > 0)
                            <p style="color: {{ $restaurant->az_color?->main_heads }}" class="p-title">
                                @lang('messages.sizes') <span class="required">{{ trans('messages.required') }}</span>
                            </p>
                            <div class="options">
                                @foreach ($product->sizes as $size)
                                    @if ($size->status == 'true')
                                        @php
                                            if (
                                                $product->restaurant->az_info and
                                                $product->restaurant->az_info->commission_payment == 'user'
                                            ):
                                                $size_price =
                                                    ($product->restaurant->az_commission * $size->price) / 100 +
                                                    $size->price;
                                            else:
                                                $size_price = $size->price;
                                            endif;
                                        @endphp
                                        <div class="item">
                                            <div class="  d-flex">
                                                <input type="radio" id="size-{{ $size->id }}" class="size_class"
                                                    name="size_id" data="{{ $size_price }}"
                                                    value="{{ $size->id }}" />
                                                <label for="size-{{ $size->id }}"
                                                    style="color: {{ $restaurant->az_color?->options_description }}">
                                                    {{ app()->getLocale() == 'ar' ? $size->name_ar : $size->name_en }}
                                                </label>
                                            </div>
                                            <div style=";color: {{ $restaurant->az_color?->options_description }}"
                                                class="price">
                                                {{ $size_price }}
                                                {{ app()->getLocale() == 'ar' ? $size->product->restaurant->country->currency_ar : $size->product->restaurant->country->currency_en }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if ($product->modifiers->count() > 0 and $product->options->count() > 0)
                            @foreach ($product->modifiers as $modifier)
                                @php
                                    $options = \App\Models\Restaurant\Azmak\AZProductOption::with('option')
                                        ->whereHas('option', function ($q) {
                                            $q->where('is_active', 'true');
                                        })
                                        ->whereProduct_id($product->id)
                                        ->where('modifier_id', $modifier->modifier->id)
                                        ->get();
                                    $check_required_options = \App\Models\Restaurant\Azmak\AZProductOption::whereProductId(
                                        $product->id,
                                    )
                                        ->whereHas('option', function ($query) use ($modifier) {
                                            return $query->where('modifier_id', $modifier->modifier->id);
                                        })
                                        ->where('min', '>=', 1)
                                        ->count();
                                @endphp
                                <div class="p-option">
                                    @if ($options->count() > 0)
                                        <h4 class="p-title mb-1 font-14"
                                            style="color: {{ $product->restaurant->az_color?->main_heads }} !important">
                                            {{ app()->getLocale() == 'ar' ? $modifier->modifier->name_ar : $modifier->modifier->name_en }}
                                            @if ($modifier->modifier->choose == 'one')
                                                ({{ app()->getLocale() == 'ar' ? 'اختيار واحد فقط' : 'choose one only' }})
                                            @elseif ($modifier->modifier->choose == 'custom')
                                                ({{ app()->getLocale() == 'ar' ? 'اختيار ' . $modifier->modifier->custom . '  فقط' : 'choose ' . $modifier->modifier->custom . ' only' }}
                                                )
                                            @endif

                                            @if ($check_required_options > 0)
                                                <span style="color: red; font-size: 10px">
                                                    {{ app()->getLocale() == 'ar' ? 'مطلوب' : 'required' }}
                                                </span>
                                            @endif
                                        </h4>
                                        @foreach ($options as $option)
                                            @if ($option->option->is_active == 'true')
                                                <div
                                                    class="d-flex justify-content-between align-items-center my-3 option-item">
                                                    <div>
                                                        <input type="checkbox" id="option-{{ $option->id }}"
                                                            name="options[]" value="{{ $option->option->id }}"
                                                            class="optionCheckBox" />
                                                        <label for="option-{{ $option->id }}"
                                                            style="color: {{ $restaurant->az_color?->options_description }}">
                                                            {{ app()->getLocale() == 'ar' ? $option->option->name_ar : $option->option->name_en }}
                                                        </label>
                                                    </div>
                                                    <div style="text-align: left" class="quantity-control">
                                                        @php
                                                            if (
                                                                $product->restaurant->az_info and
                                                                $product->restaurant->az_info->commission_payment ==
                                                                    'user'
                                                            ):
                                                                $option_price =
                                                                    ($product->restaurant->az_commission *
                                                                        $option->option->price) /
                                                                        100 +
                                                                    $option->option->price;
                                                            else:
                                                                $option_price = $option->option->price;
                                                            endif;
                                                        @endphp
                                                        <button
                                                            style="background-color: {{ $restaurant->az_color?->icons }}"
                                                            class="btn-c border-0 p-1 optionIncrease"
                                                            data="{{ $option->id }}"
                                                            id="optionIncrease-{{ $option->id }}">+
                                                        </button>
                                                        <input name="option_count-{{ $option->option->id }}" type="text"
                                                            id="option_count-{{ $option->id }}" class="optionCount"
                                                            value="1">
                                                        <button
                                                            style="background-color: {{ $restaurant->az_color?->icons }}"
                                                            class="btn-c border-0 p-1 optionDecrease"
                                                            data="{{ $option->id }}" id="decreaseBtn1">-
                                                        </button>
                                                        <span class="price">
                                                            <span id="option_price-{{ $option->id }}"
                                                                data="{{ $option_price }}">
                                                                {{ $option_price }}
                                                            </span>
                                                            {{ app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en }}
                                                        </span>
                                                        <span id="choose_addValue"> </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        @endif

                        <!-- end choose Add-ons -->
                        <div style="background-color: {{ $restaurant->az_color?->product_background }}"
                            class="addition product-quantity  w-100 py-3 d-flex justify-content-between">
                            <div>
                                <button style="background-color: {{ $restaurant->az_color?->icons }}"
                                    class="border-0 p-1" id="totalIncrease">+
                                </button>
                                <input name="product_count" type="text" id="count" class="totalCount"
                                    value="1" readonly>
                                <button style="background-color: {{ $restaurant->az_color?->icons }}"
                                    class="border-0 p-1" id="totalDecrease">-
                                </button>
                            </div>
                            <div class="pricing">
                                {{ trans('messages.total') }}
                                <span id="totalPrice"
                                    style="color: {{ $restaurant->az_color?->options_description }}">
                                    @if ($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                        {{--                                                    add the commission to product --}}
                                        {{ ($product->restaurant->az_commission * $product->price) / 100 + $product->price }}
                                    @else
                                        {{ $product->price }}
                                    @endif
                                </span>
                                {{ app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en }}
                            </div>
                        </div>
                        <div style="padding-bottom: 3px;">
                            <input
                                style="background-color: {{ $restaurant->az_color?->icons }}; color: {{ $restaurant->az_color?->options_description }}"
                                type="submit" class="btn btn-success" value="@lang('messages.add_to_cart')">
                        </div>

                    </form>
                    <!-- end form -->
                </div>
                <!-- end choose_details -->
            </div>
            <!-- end meals_deatails -->
        </main>
        @include('website.layout.footer')
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var product_price =
                @if ($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                    {{--                                                    add the commission to product --}}
                    {{ ($product->restaurant->az_commission * $product->price) / 100 + $product->price }}
                @else
                    {{ $product->price }}
                @endif ;
            // sizes
            $('input:radio').change(function() {
                var size_prcie = $(this).attr('data');
                $('#totalPrice').html(size_prcie);
                product_price = size_prcie;
            });
            $('#totalIncrease').on('click', function(e) {
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
            $('#totalDecrease').on('click', function(e) {
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
            $('.optionIncrease').on('click', function(e) {
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
            $('.optionDecrease').on('click', function(e) {
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
            $('.optionCheckBox').on('change', function() {
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

            $("#share").click(function() {
                document.getElementById('shareDiv').style.display = 'block';
            });

        });
    </script>
@endpush
