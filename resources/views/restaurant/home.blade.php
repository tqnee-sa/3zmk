@extends('restaurant.lteLayout.master')

@section('title')
    @lang('messages.control_panel')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('messages.control_panel')}}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @include('flash::message')
    <!-- /.content-header -->
    @php
        $user = Auth::guard('restaurant')->user();
        $subscription = App\Models\AzSubscription::whereRestaurantId($user->id)->first();
    @endphp
    @if(auth('restaurant')->check())
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <h3>
                    @lang('messages.welcome') {{app()->getLocale() == 'ar' ? $user->name_ar : $user->name_en}}
                </h3>
                <!-- /.row (main row) -->
                @if($subscription == null)
                    <a href="{{route('AzmakSubscription' , $user->id)}}" class="btn btn-success">
                        {{trans('messages.activeAzmak')}}
                    </a>
                @elseif($subscription and $subscription->status == 'finished')
                    <br>
                    <h4 style="color: red"> @lang('messages.finished_subscription') </h4>
                    <br>
                    <a href="{{route('AzmakSubscription' , $user->id)}}" class="btn btn-success">
                        {{trans('messages.renewAzmakSubscription')}}
                    </a>
                @elseif($subscription and $subscription->status == 'active' )
                    <h4 >@lang('messages.subscription_price') :
                        <span style="color: red">
                            {{App\Models\AzmakSetting::first()->subscription_amount}}
                            {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                        </span>
                    </h4>
                    <h4 >@lang('messages.tax_value') :
                        <span style="color: red">
                            {{$subscription->tax_value}}
                            {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                        </span>
                    </h4>
                    @if($subscription->discount_value)
                        <h4 >@lang('messages.discount_value') :
                            <span style="color: red">
                            {{$subscription->discount_value}}
                                {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                        </span>
                        </h4>
                    @endif
                    @if($subscription->seller_code)
                        <h4 >@lang('messages.seller_code') :
                            <span style="color: red">
                            {{$subscription->seller_code->seller_name}}
                        </span>
                        </h4>
                    @endif
                    <h4 >@lang('messages.total_price') :
                        <span style="color: red">
                            {{$subscription->price}}
                            {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                        </span>
                    </h4>
                    <h4 >@lang('messages.subscription_end_at') :
                        <span style="color: red">
                            {{$subscription->end_at->format('Y-m-d')}}
                        </span>
                    </h4>
                    <h4 class="text-center"></h4>
                @elseif($subscription and $subscription->status == 'free' )
                    <h4>
                        @lang('messages.subscription_type') :
                        <span style="color: red">@lang('messages.free_subscription')</span>
                    </h4>
                @endif
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    @endif
@endsection
@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection

