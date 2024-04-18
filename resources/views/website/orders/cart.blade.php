@extends('website.orders.cart_layout.master')
@section('title')
    @lang('messages.cart')
@endsection
@section('header_title')
    @lang('messages.cart')
@endsection
@section('content')
    <main>
        <div class="teeeeest my-1 mx-2">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}"
                       class="nav-link"
                       role="tab"
                       style="background-color: {{$restaurant->az_color?->icons}} !important;"
                       aria-controls="pills-profile"
                       aria-selected="false">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </li>
                @if($order)
                    <li class="nav-item" role="presentation">
                        <a href="{{route('emptyCart' , $order->id)}}"
                           class="nav-link"
                           role="tab"
                           style="background-color: {{$restaurant->az_color?->icons}} !important;"
                           aria-controls="pills-profile"
                           aria-selected="false"
                           style="color: red"
                        >
                            <i class="fa fa-trash"></i>
                            @lang('messages.deleteCart')
                        </a>
                    </li>
                @endif
            </ul>
            @if($order)
                <div class="tab-content" id="pills-tabContent">
                    <div
                        class="tab-pane fade show active {{$restaurant->az_color == null ? 'bg-white' : ''}}"
                        id="pills-home"
                        role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <!-- <div id="cartItemsContainer" class="p-5 m-auto">
                      </div> -->
                        <div calss="cartItemsContainer" class="m-auto">
                            <div class="main_wrap" style="background-color: {{$restaurant->az_color?->product_background}} !important;">
                                @if($order->items->count() > 0)
                                    @foreach($order->items as $item)
                                        <div class="cart-item">
                                            <div class="image">
                                                <img src="{{asset('/uploads/products/' . $item->product->photo)}}"
                                                     alt=""/>
                                            </div>
                                            <div class="details">
                                                <h6 style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                                    {{app()->getLocale() == 'ar' ?  $item->product->name_ar : $item->product->name_en}}
                                                    {{$item->product_count}} x
                                                </h6>
                                                <p style="color: {{$restaurant->az_color?->options_description}} !important;" class="my-1">
                                                    {{app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $item->product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $item->product->description_en))}}
                                                </p>
                                                <div class="action d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <span style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                            {{$item->price}}
                                                        </span>
                                                        <small style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                            {{app()->getLocale() == 'ar' ? $item->product->restaurant->country->currency_ar : $item->product->restaurant->country->currency_en}}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($item->size)
                                                <div class="details">
                                                    <h6 style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                                        @lang('messages.sizes')</h6>
                                                    <div
                                                        class="action d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <span style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                @php
                                                                    if($item->product->restaurant->az_info and $item->product->restaurant->az_info->commission_payment == 'user'):
                                                                          $size_price = (($item->product->restaurant->az_commission * $item->size->price) / 100) + $item->size->price;
                                                                    else:
                                                                          $size_price = $item->size->price;
                                                                    endif;
                                                                @endphp
                                                                {{$size_price}}
                                                            </span>
                                                            <small style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                {{app()->getLocale() == 'ar' ? $item->product->restaurant->country->currency_ar : $item->product->restaurant->country->currency_en}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="details">
                                                <div class="action d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <a href="{{route('deleteCartItem' , $item->id)}}" style="color: red">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($item->options->count() > 0)
                                            {{--item options--}}
                                            <div class="container">
                                                <h6>@lang('messages.options')</h6>
                                                <div class="details">
                                                    @foreach($item->options as $option)
                                                            <div  style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                                                {{app()->getLocale() == 'ar' ? $option->option->name_ar : $option->option->name_en }}
                                                                {{$option->option_count}} x
                                                                <div
                                                                    class="action d-flex align-items-center justify-content-between"
                                                                    style="padding-right: 300px;">
                                                                    <div>
                                                                        @php
                                                                            if($item->product->restaurant->az_info and $item->product->restaurant->az_info->commission_payment == 'user'):
                                                                                  $option_price = (($item->product->restaurant->az_commission * $option->option->price) / 100) + $option->option->price;
                                                                            else:
                                                                                  $option_price = $option->option->price;
                                                                            endif;
                                                                        @endphp
                                                                        <span style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                            {{$option_price * $option->option_count}}
                                                                        </span>
                                                                        <small style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                            {{app()->getLocale() == 'ar' ? $item->product->restaurant->country->currency_ar : $item->product->restaurant->country->currency_en}}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <hr>
                                    @endforeach
                                @else
                                    @lang('messages.emptyCart')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="total px-4 {{$restaurant->az_color == null ? 'bg-white' : ''}} py-2" id="total_followPayment">
                    <div class="d-flex align-items-center justify-content-between w-100 ">
                        <div class="total_price">
                            <p style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                @lang('messages.total_price')
                            </p>
                            <p>
                                <span style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                    {{$order->total_price}}
                                </span>
                                {{app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en}}
                            </p>
                        </div>
                        <div class="payment" style="background-color: {{$restaurant->az_color?->icons}} !important;">
                            <a href="{{route('AZOrderInfo' , $order->id)}}">
                                @lang('messages.next')
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <br>
                <h4 class="text-center">@lang('messages.emptyCart')</h4>
            @endif
        </div>
    </main>
@endsection
