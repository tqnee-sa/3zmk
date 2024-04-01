@extends('website.orders.cart_layout.master')
@section('title')
    @lang('messages.my_orders')
@endsection
<style>
    .nav-item{
        margin-left:5px;
    }
</style>
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
                <li class="nav-item" role="presentation">
                    <a href="{{route('AZUserOrders' , [$branch->id , 'active'])}}"
                       class="btn btn-success"
                       role="tab"
                       aria-controls="pills-profile"
                       aria-selected="false">
                        @lang('messages.active')
                        <span>
                            ({{ \App\Models\Restaurant\Azmak\AZOrder::whereUserId(auth()->guard('web')->user()->id)->whereStatus('active')->whereBranchId($branch->id)->count() }})
                        </span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{route('AZUserOrders' , [$branch->id , 'completed'])}}"
                       class="btn btn-info"
                       role="tab"
                       aria-controls="pills-profile"
                       aria-selected="false">
                        @lang('messages.completed')
                        <span>
                            ({{ \App\Models\Restaurant\Azmak\AZOrder::whereUserId(auth()->guard('web')->user()->id)->whereStatus('completed')->whereBranchId($branch->id)->count() }})
                        </span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{route('AZUserOrders' , [$branch->id , 'canceled'])}}"
                       class=" btn btn-danger"
                       role="tab"
                       aria-controls="pills-profile"
                       aria-selected="false">
                        @lang('messages.canceled')
                        <span>
                            ({{ \App\Models\Restaurant\Azmak\AZOrder::whereUserId(auth()->guard('web')->user()->id)->whereStatus('canceled')->whereBranchId($branch->id)->count() }})
                        </span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{route('AZUserOrders' , [$branch->id , 'finished'])}}"
                       class=" btn btn-danger"
                       role="tab"
                       aria-controls="pills-profile"
                       aria-selected="false">
                        @lang('messages.finished')
                        <span>
                            ({{ \App\Models\Restaurant\Azmak\AZOrder::whereUserId(auth()->guard('web')->user()->id)->whereStatus('finished')->whereBranchId($branch->id)->count() }})
                        </span>
                    </a>
                </li>
            </ul>
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="tab-content" id="pills-tabContent">
                        <div
                            class="tab-pane fade show active {{$restaurant->az_color == null ? 'bg-white' : ''}}"
                            id="pills-home"
                            role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <!-- <div id="cartItemsContainer" class="p-5 m-auto">
                          </div> -->
                            <div class="m-auto">
                                <div class="main_wrap"
                                     style="background-color: {{$restaurant->az_color?->product_background}} !important;">
                                    <div
                                        style="margin: 10px; color: {{$restaurant->az_color?->main_heads}} !important;">
                                        <br>
                                        <h6> @lang('messages.order_no') : {{$order->order_id}} </h6>
                                        <h6>
                                            @lang('messages.status') :
                                            @switch($order->status)
                                                @case('active')
                                                <a href="#" class="btn btn-success"> @lang('messages.active') </a>
                                                @break
                                                @case('completed')
                                                <a href="#" class="btn btn-info">@lang('messages.completed')</a>
                                                @break
                                                @case('finished')
                                                <a href="#" class="btn btn-danger">@lang('messages.finished')</a>
                                                @break
                                                @case('canceled')
                                                <a href="#" class="btn btn-danger">@lang('messages.canceled')</a>
                                                <span>{{$order->cancel_reason}}</span>
                                                @break
                                                @default
                                                <a href="#" class="btn btn-danger">@lang('messages.not_paid')</a>
                                            @endswitch
                                        </h6>
                                        <h6> @lang('messages.client') : {{$order->person_name}} </h6>
                                    </div>
                                    @if($order->items->count() > 0)
                                        <h6 class="text-center"> @lang('messages.order_items') </h6>
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
                                                    <p style="color: {{$restaurant->az_color?->options_description}} !important;"
                                                       class="my-1">
                                                        {{app()->getLocale() == 'ar' ? strip_tags(str_replace('&nbsp;', ' ', $item->product->description_ar)) : strip_tags(str_replace('&nbsp;', ' ', $item->product->description_en))}}
                                                    </p>
                                                    <div
                                                        class="action d-flex align-items-center justify-content-between">
                                                        <div>
                                                        <span
                                                            style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                            {{$item->price}}
                                                        </span>
                                                            <small
                                                                style="color: {{$restaurant->az_color?->options_description}} !important;">
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
                                                            <span
                                                                style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                @php
                                                                    if($item->product->restaurant->az_info and $item->product->restaurant->az_info->commission_payment == 'user'):
                                                                          $size_price = (($item->product->restaurant->az_commission * $item->size->price) / 100) + $item->size->price;
                                                                    else:
                                                                          $size_price = $item->size->price;
                                                                    endif;
                                                                @endphp
                                                                {{$size_price}}
                                                            </span>
                                                                <small
                                                                    style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                    {{app()->getLocale() == 'ar' ? $item->product->restaurant->country->currency_ar : $item->product->restaurant->country->currency_en}}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if($item->options->count() > 0)
                                                {{--item options--}}
                                                <div>
                                                    <h6>@lang('messages.options')</h6>
                                                    <div class="details">
                                                        @foreach($item->options as $option)
                                                            <div class="row">
                                                                <h6 style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                                                    {{app()->getLocale() == 'ar' ? $option->option->name_ar : $option->option->name_en }}
                                                                    {{$option->option_count}} x
                                                                </h6>
                                                                <div
                                                                    class="action d-flex align-items-center justify-content-between"
                                                                    style="padding-right: 400px;">
                                                                    <div>
                                                                        @php
                                                                            if($item->product->restaurant->az_info and $item->product->restaurant->az_info->commission_payment == 'user'):
                                                                                  $option_price = (($item->product->restaurant->az_commission * $option->option->price) / 100) + $option->option->price;
                                                                            else:
                                                                                  $option_price = $option->option->price;
                                                                            endif;
                                                                        @endphp
                                                                        <span
                                                                            style="color: {{$restaurant->az_color?->options_description}} !important;">
                                                                        {{$option_price * $option->option_count}}
                                                                    </span>
                                                                        <small
                                                                            style="color: {{$restaurant->az_color?->options_description}} !important;">
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
                                    @endif
                                    <div class="total_price">
                                        <p style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                            @lang('messages.total_price')
                                            <span style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                                {{$order->total_price}}
                                            </span>
                                            {{app()->getLocale() == 'ar' ? $order->restaurant->country->currency_ar : $order->restaurant->country->currency_en}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
                {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
            @else
                <br>
                <h4 class="text-center">@lang('messages.noOrdersYet')</h4>
            @endif
        </div>
    </main>
@endsection
