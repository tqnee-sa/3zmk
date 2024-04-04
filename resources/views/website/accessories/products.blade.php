<link rel="stylesheet" href="{{asset('site/css/products.css')}}">
<div class=" p-3"
     style="background-color: {{$restaurant->az_color ? $restaurant->az_color->background : '#FFF'}} !important;">
    @if($products->count() > 0)
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    style="background-color: {{$restaurant->az_color?->icons}} !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : ''}} !important"
                    class="nav-link {{$restaurant->az_info->menu_show_type == 'style3' ? 'active' : ''}}"
                    id="home-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#home"
                    type="button"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                >
                    <i class="fas fa-th-large"></i>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    style="background-color: {{$restaurant->az_color?->icons}} !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : ''}} !important"
                    class="nav-link {{$restaurant->az_info->menu_show_type == 'style2' ? 'active' : ''}}"
                    id="profile-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#profile"
                    type="button"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                >
                    <i class="fa-solid fa-image"></i>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    style="background-color: {{$restaurant->az_color?->icons}} !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : ''}} !important"
                    class="nav-link {{$restaurant->az_info->menu_show_type == 'style1' ? 'active' : ''}}"
                    id="contact-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#contact"
                    type="button"
                    role="tab"
                    aria-controls="contact"
                    aria-selected="false"
                >
                    <i class="fa-solid fa-list"></i>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade {{$restaurant->az_info->menu_show_type == 'style3' ? 'show active' : ''}}"
                id="home"
                role="tabpanel"
                aria-labelledby="home-tab"
            >
                <div class="row mt-3">
                    @foreach($products as $product)
                        {{--                        @php--}}
                        {{--                            $route = route('product_details' , $product->id);--}}
                        {{--                            $details = (app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en) . ' ' . (app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en)));--}}
                        {{--                            $shareComponent = \Share::page(--}}
                        {{--                                $route,--}}
                        {{--                                $details,--}}
                        {{--                            )--}}
                        {{--                                ->facebook()--}}
                        {{--                                ->twitter()--}}
                        {{--                                ->linkedin()--}}
                        {{--                                ->telegram()--}}
                        {{--                                ->whatsapp()--}}
                        {{--                                ->reddit();--}}
                        {{--                        @endphp--}}
                        <div class="col-6 mt-3">
                            <a href="{{route('product_details' , $product->id)}}">
                                <div class="list_Galler th_large p-2"
                                     style="background-color: {{$restaurant->az_color?->product_background}} !important;"
                                     id="product1">
                                    <div class="image">
                                        <img src="{{asset('/uploads/products/' . $product->photo)}}" alt=""/>
                                    </div>
                                    <div class="content_list p-2">
                                        <h6>
                                            <a href="{{route('product_details' , $product->id)}}">
                                                <h6 style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                                    {{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}
                                                </h6>
                                            </a>
                                            @if ($product->calories === 0.0 or $product->calories > 0 )
                                                <span class="pl-1 calories" style="margin:0 6px;">
                                                    <span style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                        {{ $product->calories == 0 ? trans('messages.no_calories' ): trans('messages.calories_des', ['num' => $product->calories]) }}
                                                    </span>
                                                </span>
                                            @endif
                                            {{--                                        <p class="description_meal">--}}
                                            {{--                                            {{substr(app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en)),0,50)}}--}}
                                            {{--                                        </p>--}}
                                            <div style="text-align: left !important;">
                                                @if ($product->sensitivities and $product->sensitivities->count() > 0)
                                                    @foreach ($product->sensitivities as $product_sensitivity)
                                                        <i>
                                                            <img
                                                                src="{{ asset('/uploads/sensitivities/' . $product_sensitivity->sensitivity->photo) }}"
                                                                height="25" width="25" class="sens-image">
                                                        </i>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </h6>

                                        <div class="more_details d-flex align-items-center justify-content-between">
                                        <span style="text-align: right !important;">
                                                @if ($product->poster != null)
                                                <img style="text-align: right"
                                                     src="{{ asset('/uploads/posters/' . $product->poster->poster) }}"
                                                     height="30" width="30" class="poster-image">
                                            @endif
                                            </span>
                                            <div class="price">
                                            <span
                                                style="font-size: 9px; text-align: left !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : 'black'}}">
                                                @if($product->price_before_discount)
                                                    @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                                        {{--                                                    add the commission to product--}}
                                                        {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                                                    @else
                                                        <del>
                                                            {{$product->price_before_discount}}
                                                            {{app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en}}
                                                        </del>
                                                    @endif
                                                @endif
                                            </span>
                                                <br>
                                                <span
                                                    style="font-size: 11px; text-align: left !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : 'black'}}">
                                                @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                                        {{-- add the commission to product --}}
                                                        {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                                                    @else
                                                        {{$product->price}}
                                                    @endif
                                                 <small>
                                                     {{app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en}}
                                                 </small>
                                            </span>
                                            </div>
                                        </div>
                                        {{--                                    <div class="more_details d-flex align-items-center justify-content-between">--}}
                                        {{--                                        <div class="action">--}}
                                        {{--                                            <button--}}
                                        {{--                                                id="addToCartBtn"--}}
                                        {{--                                                class="cart-btn"--}}
                                        {{--                                                data-product-id="product1"--}}
                                        {{--                                            >--}}
                                        {{--                                                <a href='{{route('product_details' , $product->id)}}'>--}}
                                        {{--                                                    <i style="background-color: {{$restaurant->az_color?->icons}} !important;"--}}
                                        {{--                                                       class="fa-solid fa-cart-plus"></i>--}}
                                        {{--                                                </a>--}}
                                        {{--                                            </button>--}}
                                        {{--                                            <button--}}
                                        {{--                                                class="share_btn" id="{{$product->id}}">--}}
                                        {{--                                                <i style="background-color: {{$restaurant->az_color?->icons}} !important;"--}}
                                        {{--                                                   class="fa-solid fa-share-nodes"></i>--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <div style="display: none" class="shareBtn" id="shareDiv-{{$product->id}}">--}}
                                        {{--                                        {!! $shareComponent !!}--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end home-tab -->
            <div
                class="tab-pane fade {{$restaurant->az_info->menu_show_type == 'style2' ? 'show active' : ''}}"
                id="profile"
                role="tabpanel"
                aria-labelledby="profile-tab">
                @foreach($products as $product)
                    @php
                        $route = route('product_details' , $product->id);
                        $details = (app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en) . ' ' . (app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en)));
                        $shareComponent = \Share::page(
                            $route,
                            $details,
                        )
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->telegram()
                            ->whatsapp()
                            ->reddit();
                    @endphp
                    <div class="list_Gallery mt-3"
                         style="background-color: {{$restaurant->az_color ? $restaurant->az_color->product_background : ''}} !important;">
                        <div class="image">
                            <a href="{{route('product_details' , $product->id)}}">
                                <img src="{{asset('/uploads/products/'.$product->photo)}}" alt=""/>
                            </a>
                        </div>
                        <div class="content_list p-2">
                            <a href='{{route('product_details' , $product->id)}}'>
                                <h5 style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                    {{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}
                                </h5>
                            </a>
                            @if ($product->calories === 0.0 or $product->calories > 0 )
                                <span class="pl-1 calories" style="margin:0 6px;">
                                    <span style="color: {{$restaurant->az_color?->options_description}} !important;">
                                        {{ $product->calories == 0 ? trans('messages.no_calories' ): trans('messages.calories_des', ['num' => $product->calories]) }}
                                    </span>
                                </span>
                                <br>
                            @endif

                            @if ($product->sensitivities and $product->sensitivities->count() > 0)
                                <div style="text-align: left !important;">
                                    @foreach ($product->sensitivities as $product_sensitivity)
                                        <i>
                                            <img
                                                src="{{ asset('/uploads/sensitivities/' . $product_sensitivity->sensitivity->photo) }}"
                                                height="25" width="25" class="sens-image">
                                        </i>
                                    @endforeach
                                </div>
                            @endif
                            @if($product->description_ar or $product->description_en)

                                <a style="color: {{$restaurant->az_color ? $restaurant->az_color->options_description : ''}} !important;"
                                   href='{{route('product_details' , $product->id)}}'>
                                    <p class="description_meal">
                                        {{app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en))}}
                                    </p>
                                </a>
                            @endif
                            <div
                                class="more_details d-flex align-items-center justify-content-between"
                            >
                                <div class="action">
                                    @if ($product->poster != null)
                                        <img style="text-align: right"
                                             src="{{ asset('/uploads/posters/' . $product->poster->poster) }}"
                                             height="30" width="30" class="poster-image">
                                    @endif
                                    {{--                                    <a href='{{route('product_details' , $product->id)}}'>--}}
                                    {{--                                        <i class="fa-solid fa-cart-plus"--}}
                                    {{--                                           style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : ''}} !important;"></i>--}}
                                    {{--                                    </a>--}}
                                    {{--                                    <button class="share2_btn" id="{{$product->id}}">--}}
                                    {{--                                        <i class="fa-solid fa-share-nodes"--}}
                                    {{--                                           style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : ''}} !important;"></i>--}}
                                    {{--                                    </button>--}}
                                </div>
                                <div class="price" style="margin: 8px">
                                    <span
                                        style="font-size: 9px; text-align: left !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : 'black'}}">
                                        @if($product->price_before_discount)
                                            @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                                {{--                                                    add the commission to product--}}
                                                {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                                            @else
                                                <del>
                                                    {{$product->price_before_discount}}
                                                    {{app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en}}
                                                </del>
                                            @endif
                                        @endif
                                    </span>
                                    <br>
                                    <span
                                        style="font-size: 11px; text-align: left !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : 'black'}}">
                                                @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                            {{-- add the commission to product --}}
                                            {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                                        @else
                                            {{$product->price}}
                                        @endif
                                        <small>
                                            {{app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en}}
                                        </small>
                                    </span>
                                </div>
                            </div>
                            {{--                            <div style="display: none" class="shareBtn" id="share2Div-{{$product->id}}">--}}
                            {{--                                {!! $shareComponent !!}--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- profile-tab -->
            <div
                class="tab-pane fade {{$restaurant->az_info->menu_show_type == 'style1' ? 'show active' : ''}}"
                id="contact"
                role="tabpanel"
                aria-labelledby="contact-tab"
            >
                @foreach($products as $product)
                    @php
                        $route = route('product_details' , $product->id);
                        $details = (app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en) . ' ' . (app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en)));
                        $shareComponent = \Share::page(
                            $route,
                            $details,
                        )
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->telegram()
                            ->whatsapp()
                            ->reddit();
                    @endphp
                    <div class="list mt-3 d-flex align-items-center gap-2"
                         style="background-color: {{$restaurant->az_color?->product_background}} !important;"
                    >
                        <div class="image">
                            <a href='{{route('product_details' , $product->id)}}'>
                                <img src="{{asset('/uploads/products/'.$product->photo)}}" alt=""/>
                            </a>
                        </div>
                        <div class="content_list p-2 w-100">
                            <a href='{{route('product_details' , $product->id)}}'>
                                <h6 style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                    {{app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en}}
                                </h6>
                            </a>
                            @if ($product->calories === 0.0 or $product->calories > 0 )
                                <span class="pl-1 calories" style="margin:0 6px;">
                                    <span style="color: {{$restaurant->az_color?->options_description}} !important;">
                                        {{ $product->calories == 0 ? trans('messages.no_calories' ): trans('messages.calories_des', ['num' => $product->calories]) }}
                                    </span>
                                </span>
                                <br>
                            @endif
                            <div style="text-align: left">
                                @if ($product->sensitivities and $product->sensitivities->count() > 0)
                                    @foreach ($product->sensitivities as $product_sensitivity)
                                        <i>
                                            <img
                                                src="{{ asset('/uploads/sensitivities/' . $product_sensitivity->sensitivity->photo) }}"
                                                height="25" width="25" class="sens-image">
                                        </i>
                                    @endforeach
                                @endif
                            </div>
                            <a style="color: {{$restaurant->az_color ? $restaurant->az_color->options_description : ''}} !important;"
                               href='{{route('product_details' , $product->id)}}'>
                                <p class="description_meal">
                                    {{app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $product->description_en))}}
                                </p>
                            </a>

                            <div
                                class="more_details d-flex align-items-center justify-content-between">
                                <div class="action">
                                    @if ($product->poster != null)
                                        <img style="text-align: right"
                                             src="{{ asset('/uploads/posters/' . $product->poster->poster) }}"
                                             height="30" width="30" class="poster-image">
                                    @endif
                                    {{--                                    <a href='{{route('product_details' , $product->id)}}'>--}}
                                    {{--                                        <i style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : ''}} !important;"--}}
                                    {{--                                           class="fa-solid fa-cart-plus"></i>--}}
                                    {{--                                    </a>--}}
                                    {{--                                    <button class="share3_btn" id="{{$product->id}}">--}}
                                    {{--                                        <i style="background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : ''}} !important;"--}}
                                    {{--                                           class="fa-solid fa-share-nodes"></i>--}}
                                    {{--                                    </button>--}}
                                </div>
                                <div class="price"
                                     style="color: {{$restaurant->az_color ? $restaurant->az_color->options_description : ''}} !important;">
                                    <span
                                        style="font-size: 9px; text-align: left !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : 'black'}}">
                                        @if($product->price_before_discount)
                                            @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                                {{--                                                    add the commission to product--}}
                                                {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                                            @else
                                                <del>
                                                    {{$product->price_before_discount}}
                                                    {{app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en}}
                                                </del>
                                            @endif
                                        @endif
                                    </span>
                                    <br>
                                    <span
                                        style="font-size: 11px; text-align: left !important; color: {{$restaurant->az_color ? $restaurant->az_color->options_description : 'black'}}">
                                                @if($product->restaurant->az_info and $product->restaurant->az_info->commission_payment == 'user')
                                            {{-- add the commission to product --}}
                                            {{(($product->restaurant->az_commission * $product->price) / 100) + $product->price}}
                                        @else
                                            {{$product->price}}
                                        @endif
                                        <small>
                                            {{app()->getLocale() == 'ar' ? $product->restaurant->country->currency_ar : $product->restaurant->country->currency_en}}
                                        </small>
                                    </span>
                                </div>
                            </div>
                            {{--                            <div style="display: none" class="shareBtn" id="share3Div-{{$product->id}}">--}}
                            {{--                                {!! $shareComponent !!}--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h6 class="text-center">
            @lang('messages.no_products')
        </h6>
    @endif
</div>
<script>
    $(".share_btn").click(function () {
        var id = this.id;
        document.getElementById('shareDiv-' + id).style.display = 'block';
    });
    $(".share2_btn").click(function () {
        var id = this.id;
        document.getElementById('share2Div-' + id).style.display = 'block';
    });
    $(".share3_btn").click(function () {
        var id = this.id;
        document.getElementById('share3Div-' + id).style.display = 'block';
    });


</script>
