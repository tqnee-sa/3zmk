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
            <div class="timeline timeline-inverse">

                <div>
                    <i class="fas fa-user bg-info"></i>

                    <div class="timeline-item">
                        <h3 class="timeline-header border-0">
                            @lang('messages.welcome')
                            <a href="#">
                                {{ app()->getLocale() == 'ar' ? $user->name_ar : $user->name_en }}
                            </a>
                            @lang('messages.at')
                            @lang('messages.control_panel')
                        </h3>
                    </div>
                </div>
                @php
                    $subscription = $user->az_subscription;
                @endphp
                @if($subscription == null)
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                <a href="{{route('AzmakSubscription' , $user->id)}}"
                                   class="btn btn-success">
                                    {{trans('messages.activeAzmak')}}
                                </a>
                            </h3>
                        </div>
                    </div>
                @elseif($subscription and $subscription->status == 'finished')
                    <br>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0" style="color: red">
                                @lang('messages.finished_subscription')
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                <a href="{{route('AzmakSubscription' , $user->id)}}"
                                   class="btn btn-success">
                                    {{trans('messages.renewAzmakSubscription')}}
                                </a>
                            </h3>
                        </div>
                    </div>
                @elseif($subscription and $subscription->status == 'active' )
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.subscription_price')
                                <a href="#">
                                    {{App\Models\AzmakSetting::first()->subscription_amount}}
                                    {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.tax_value')
                                <a href="#">
                                    {{$subscription->tax_value}}
                                    {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                                </a>
                            </h3>
                        </div>
                    </div>
                    @if($subscription->discount_value)
                        <div>
                            <i class="fas fa-money-bill bg-info"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header border-0">
                                    @lang('messages.discount_value')
                                    <a href="#">
                                        {{$subscription->discount_value}}
                                        {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endif

                    @if($subscription->seller_code)
                        <div>
                            <i class="fas fa-money-bill bg-info"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header border-0">
                                    @lang('messages.seller_code')
                                    <a href="#">
                                        {{$subscription->seller_code->seller_name}}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endif
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.total_price')
                                <a href="#">
                                    {{$subscription->price}}
                                    {{app()->getLocale() == 'ar' ? $subscription->restaurant->country->currency_ar : $subscription->restaurant->country->currency_en}}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.subscription_end_at')
                                <a href="#">
                                    {{$subscription->end_at->format('Y-m-d')}}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.total_menu_views')
                                <a href="#">
                                    {{$user->az_info?->menu_views}}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.restaurant_az_commission')
                                <a href="#">
                                    {{$user->az_commission}} %
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.orders_commissions') :
                                <a href="#">
                                    {{$user->az_orders->where('status' , '!=' , 'new')->sum('commission')}}
                                    {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.paid_commission_value') :
                                <a href="{{route('RestaurantAzCommissionsHistory' , $user->id)}}">
                                    {{$user->az_commissions()->wherePayment('true')->sum('commission_value')}}
                                    {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                </a>
                                <a class="btn btn-primary" href="{{route('RestaurantAzCommissionsHistory' , $user->id)}}">
                                    @lang('messages.show')
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.commissions_payable') :
                                <a href="#">
                                    {{$user->az_orders->where('status' , '!=' , 'new')->sum('commission') - $user->az_commissions()->wherePayment('true')->sum('commission_value')}}
                                    {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    @if($user->maximum_az_commission_limit)
                        <div>
                            <i class="fas fa-money-bill bg-info"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header border-0">
                                    @lang('messages.maximum_az_commission_limit') :
                                    <a href="#">
                                        {{$user->maximum_az_commission_limit}}
                                        {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endif
                @elseif($subscription and $subscription->status == 'free' )
                    <h4>
                        @lang('messages.subscription_type') :
                        <span style="color: red">@lang('messages.free_subscription')</span>
                    </h4>
                @elseif($subscription and $subscription->status == 'commission_hold')
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                <span style="color: red">@lang('messages.commissions_limit_exceed')</span> :
                                <a href="{{route('RestaurantAzCommissionsHistory' , $user->id)}}" class="btn btn-info">
                                    @lang('messages.pay_commission')
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.orders_commissions') :
                                <a href="#">
                                    {{$user->az_orders->where('status' , '!=' , 'new')->sum('commission')}}
                                    {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.paid_commission_value') :
                                <a href="#">
                                    {{$user->az_commissions()->wherePayment('true')->sum('commission_value')}}
                                    {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-money-bill bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header border-0">
                                @lang('messages.commissions_payable') :
                                <a href="#">
                                    {{$user->az_orders->where('status' , '!=' , 'new')->sum('commission') - $user->az_commissions()->wherePayment('true')->sum('commission_value')}}
                                    {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    @if($user->maximum_az_commission_limit)
                        <div>
                            <i class="fas fa-money-bill bg-info"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header border-0">
                                    @lang('messages.maximum_az_commission_limit') :
                                    <a href="#">
                                        {{$user->maximum_az_commission_limit}}
                                        {{ app()->getLocale() == 'ar' ? $user->country->currency_ar : $user->country->currency_en }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    @endif
                @endif
                <div>
                    <i class="far fa-clock bg-gray"></i>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endif
@endsection
@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection

