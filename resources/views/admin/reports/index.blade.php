@extends('admin.lteLayout.master')

@section('title')
    @lang('messages.control_panel')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('messages.control_panel')</h1>
                </div><!-- /.col -->
                <!--<div class="col-sm-6">-->
                <!--    <ol class="breadcrumb float-sm-right">-->
            <!--        <li class="breadcrumb-item"><a href="#">@lang('messages.control_panel')</a></li>-->
            <!--        {{--                        <li class="breadcrumb-item active">Dashboard v1</li>--}}-->
                <!--    </ol>-->
                <!--</div>-->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form role="form" action="{{route('reports.index')}}" method="get" enctype="multipart/form-data">
                    <input type='hidden' name='_token' value='{{Session::token()}}'>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.month') </label>
                                    <select name="month" class="form-control" required>
                                        @for($i = 1; $i <= 12 ; $i++)
                                            <option value="{{$i}}" {{$i == $month ? 'selected' : ''}}> {{$i}} </option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('month'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('month') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.year') </label>
                                    <select name="year" class="form-control" required>
                                        @for($i = 2022; $i <= \Carbon\Carbon::now()->format('Y') ; $i++)
                                            <option value="{{$i}}" {{$i == $year ? 'selected' : ''}}> {{$i}} </option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <br>
                                <button type="submit" class="btn btn-primary">@lang('messages.show')</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <h3 class="text-center"> @lang('messages.show_restaurants_reports') {{$month}}/{{$year}} </h3>
            <br>
            {{--            @if(auth()->guard('admin')->user()->role == 'admin')--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-lg-1"></div>--}}
            {{--                    <div class="col-lg-5 col-5">--}}
            {{--                        <!-- small box -->--}}
            {{--                        <div class="small-box bg-danger">--}}
            {{--                            <div class="inner">--}}
            {{--                                <h3>--}}
            {{--                                    {{number_format((float)($month_total_amount - $month_total_taxes), 0, '.', '')}} @lang('messages.SR')--}}
            {{--                                </h3>--}}

            {{--                                <p>--}}
            {{--                                    @lang('messages.month_total_amount')--}}
            {{--                                </p>--}}
            {{--                            </div>--}}
            {{--                            <div class="icon">--}}
            {{--                                <i class="ion ion-person-add"></i>--}}
            {{--                            </div>--}}
            {{--                            <a href="{{url('/admin/histories')}}" class="small-box-footer">@lang('messages.details')--}}
            {{--                                <i class="fas fa-arrow-circle-right"></i></a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-5 col-5">--}}
            {{--                        <!-- small box -->--}}
            {{--                        <div class="small-box bg-green">--}}
            {{--                            <div class="inner">--}}
            {{--                                <h3>--}}
            {{--                                    {{number_format((float)$month_total_taxes, 0, '.', '')}} @lang('messages.SR')--}}
            {{--                                </h3>--}}

            {{--                                <p>@lang('messages.month_total_taxes')</p>--}}
            {{--                            </div>--}}
            {{--                            <div class="icon">--}}
            {{--                                <i class="nav-icon fa fa-history"></i>--}}
            {{--                            </div>--}}
            {{--                            <a href="{{url('/admin/histories')}}" class="small-box-footer">@lang('messages.details') <i--}}
            {{--                                        class="fas fa-arrow-circle-right"></i></a>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-1"></div>--}}
            {{--                </div>--}}
            {{--            @endif--}}
            <hr>
            <h4 class="text-center" style="color: red">
                @lang('messages.restaurants')
            </h4>
            <br>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <a href="{{route('reports.restaurants' , [$year , $month , 'registered'])}}"
                    >
                        <div class="small-box">
                            <div class="inner">
                                <p>
                                    @lang('messages.registered_restaurant')
                                </p>
                                <h3 class="text-center">
                                    {{$registered_restaurants}}
                                </h3>

                            </div>

                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'subscribed'])}}"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">

                                <p>
                                    @lang('messages.subscribed_restaurant')
                                </p>
                                <h3 class="text-center">
                                    {{$month_subscription + $pre_month_subscription}}
                                </h3>
                            </div>

                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'subscribed'])}}"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>
                                    {{app()->getLocale() == 'ar' ? 'المطاعم المشتركة الشهر الحالي' : 'Current Subscribed Restaurants'}}
                                </p>
                                <h3 class="text-center">
                                    {{$month_subscription}}
                                </h3>
                            </div>


                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'pre_month_subscribed'])}}"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>
                                    {{app()->getLocale() == 'ar' ? 'مطاعم مشتركه مسجلة سابقا' : 'Restaurants Subscribed From Previous Month'}}
                                </p>
                                <h3 class="text-center">
                                    {{$pre_month_subscription}}
                                </h3>
                            </div>


                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'notSubscribed'])}}"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">

                                <p>
                                    {{app()->getLocale() == 'ar' ? 'المطاعم الغير مشتركة':'Restaurants Not Subscribed'}}
                                </p>
                                <h3 class="text-center">
                                    {{$restaurants_not_subscribed}}
                                </h3>
                            </div>

                        </div>

                    </a>

                </div>
                @if(auth()->guard('admin')->user()->role != 'customer_services')
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.subscription_amount')</p>

                                <h3 class="text-center">
                                    {{number_format((float)$subscription, 0, '.', '')}} @lang('messages.SR')
                                </h3>
                            </div>

                            <form role="form" action="{{route('admin.month_histories')}}" method="get"
                                  enctype="multipart/form-data">
                                <input type='hidden' name='_token' value='{{Session::token()}}'>
                                <input type="hidden" name="year" value="{{$year}}">
                                <input type="hidden" name="month" value="{{$month}}">
                                <input type="hidden" name="type" value="restaurant">
                                <input type="hidden" name="status" value="subscribed">
                                <button type="submit" style="width: 100% ; background: rgba(0,0,0,.1); border: none">
                                    @lang('messages.details')
                                    <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <a href="#" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>{{app()->getLocale() == 'ar' ? 'مطاعم مطلوب تجديدها الشهر الحالي':'Restaurants Renewed At Current Month'}}</p>
                                <h3 class="text-center">
                                    {{$total_renewed_restaurants}}
                                </h3>


                            </div>

                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'renewed'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.renewed_restaurants')</p>

                                <h3 class="text-center">
                                    {{$renewed_restaurants}}
                                </h3>

                            </div>
                        </div>
                    </a>

                </div>

                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'end'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">

                                <p>{{app()->getLocale() == 'ar' ? 'مطاعم لم تجدد':'Restaurants not Renewed'}}</p>
                                <h3 class="text-center">
                                    {{$need_renew_restaurants}}
                                </h3>

                            </div>

                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.restaurants' , [$year , $month , 'finished'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>
                                    {{app()->getLocale() == 'ar' ? 'المطاعم المنتهية' : 'Finished Restaurants'}}
                                </p>
                                <h3 class="text-center">
                                    {{$restaurants_not_renewed}}
                                </h3>


                            </div>

                        </div>
                    </a>

                </div>
                @if(auth()->guard('admin')->user()->role != 'customer_services')
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.renew_amount')</p>

                                <h3 class="text-center">
                                    {{number_format((float)$renew, 0, '.', '')}} @lang('messages.SR')
                                </h3>

                            </div>
                            <form role="form" action="{{route('admin.month_histories')}}" method="get"
                                  enctype="multipart/form-data">
                                <input type='hidden' name='_token' value='{{Session::token()}}'>
                                <input type="hidden" name="year" value="{{$year}}">
                                <input type="hidden" name="month" value="{{$month}}">
                                <input type="hidden" name="type" value="restaurant">
                                <input type="hidden" name="status" value="renewed">
                                <button type="submit" style="width: 100% ; background: rgba(0,0,0,.1); border: none">
                                    @lang('messages.details')
                                    <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <!--end row of restaurants-->

            <hr>
            <h4 class="text-center" style="color: red">
                @lang('messages.branches')
            </h4>
            <br>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <a href="{{route('reports.branches' , [$year , $month , 'subscribed'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.subscribed_branches')</p>

                                <h3 class="text-center">
                                    {{$subscribed_branches}}
                                </h3>

                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box ">
                        <div class="inner">
                            <p>@lang('messages.subscribed_branches_amount')</p>

                            <h3 class="text-center">
                                {{number_format((float)$subscribed_branches_amount, 0, '.', '')}} @lang('messages.SR')
                            </h3>

                        </div>
                        <form role="form" action="{{route('admin.month_histories')}}" method="get"
                              enctype="multipart/form-data">
                            <input type='hidden' name='_token' value='{{Session::token()}}'>
                            <input type="hidden" name="year" value="{{$year}}">
                            <input type="hidden" name="month" value="{{$month}}">
                            <input type="hidden" name="type" value="branch">
                            <input type="hidden" name="status" value="subscribed">
                            <button type="submit" style="width: 100% ; background: rgba(0,0,0,.1); border: none">
                                @lang('messages.details')
                                <i class="fas fa-arrow-circle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.branches' , [$year , $month , 'required_renew'])}}"
                       style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.branches_renew_subscription')</p>

                                <h3 class="text-center">
                                    {{$branches_renew_subscription}}
                                </h3>

                            </div>

                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.branches' , [$year , $month , 'renewed'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.renewed_branches')</p>

                                <h3 class="text-center">
                                    {{$renewed_branches}}
                                </h3>

                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.branches' , [$year , $month , 'not_renew'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>
                                    {{app()->getLocale() == 'ar' ? 'الفروع التي لم تجدد' : 'Branches Not Renewed'}}
                                </p>
                                <h3 class="text-center">
                                    {{$branches_not_renewed}}
                                </h3>


                            </div>
                        </div>
                    </a>

                </div>
                @if(auth()->guard('admin')->user()->role != 'customer_services')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <h3 class="text-center">
                                    {{number_format((float)$renewed_branches_amount, 0, '.', '')}} @lang('messages.SR')
                                </h3>

                                <p>@lang('messages.renewed_branches_amount')</p>
                            </div>
                            <form role="form" action="{{route('admin.month_histories')}}" method="get"
                                  enctype="multipart/form-data">
                                <input type='hidden' name='_token' value='{{Session::token()}}'>
                                <input type="hidden" name="year" value="{{$year}}">
                                <input type="hidden" name="month" value="{{$month}}">
                                <input type="hidden" name="type" value="branch">
                                <input type="hidden" name="status" value="renewed">
                                <button type="submit" style="width: 100% ; background: rgba(0,0,0,.1); border: none">
                                    @lang('messages.details')
                                    <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
            <!--end branch-->
            <hr>
            <h4 class="text-center" style="color: red">
                @lang('messages.services')
            </h4>
            <br>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <a href="{{route('reports.services' , [$year , $month , 'sold'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box ">
                            <div class="inner">
                                <p>@lang('messages.registered_services')</p>

                                <h3 class="text-center">
                                    {{$registered_services}}
                                </h3>

                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box">
                        <div class="inner">
                            <p>@lang('messages.services_amount')</p>

                            <h3 class="text-center">
                                {{number_format((float)$services_amount, 0, '.', '')}} @lang('messages.SR')
                            </h3>

                        </div>

                        <form role="form" action="{{route('admin.month_histories')}}" method="get"
                              enctype="multipart/form-data">
                            <input type='hidden' name='_token' value='{{Session::token()}}'>
                            <input type="hidden" name="year" value="{{$year}}">
                            <input type="hidden" name="month" value="{{$month}}">
                            <input type="hidden" name="type" value="service">
                            <input type="hidden" name="status" value="subscribed">
                            <button type="submit" style="width: 100% ; background: rgba(0,0,0,.1); border: none">
                                @lang('messages.details')
                                <i class="fas fa-arrow-circle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.services' , [$year , $month , 'end'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box ">
                            <div class="inner">
                                <p>@lang('messages.required_renew_services')</p>

                                <h3 class="text-center">
                                    {{$required_renew_services}}
                                </h3>

                            </div>


                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.services' , [$year , $month , 'renew'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box ">
                            <div class="inner">
                                <p>@lang('messages.renew_services')</p>

                                <h3 class="text-center">
                                    {{$renew_services}}
                                </h3>

                            </div>


                        </div>
                    </a>

                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('reports.services' , [$year , $month , 'finished'])}}" style="color: black"
                    >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>
                                    {{app()->getLocale() == 'ar' ? 'الخدمات التي لم تجدد' : 'Services Not Renewed' }}
                                </p>
                                <h3 class="text-center">
                                    {{$services_not_renewed}}
                                </h3>


                            </div>

                        </div>
                    </a>

                </div>
                @if(auth()->guard('admin')->user()->role != 'customer_services')
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <p>@lang('messages.services_renew')</p>

                                <h3 class="text-center">
                                    {{number_format((float)$services_renew_amount, 0, '.', '')}} @lang('messages.SR')
                                </h3>

                            </div>
                            <form role="form" action="{{route('admin.month_histories')}}" method="get"
                                  enctype="multipart/form-data">
                                <input type='hidden' name='_token' value='{{Session::token()}}'>
                                <input type="hidden" name="year" value="{{$year}}">
                                <input type="hidden" name="month" value="{{$month}}">
                                <input type="hidden" name="type" value="service">
                                <input type="hidden" name="status" value="renewed">
                                <button type="submit" style="width: 100% ; background: rgba(0,0,0,.1); border: none">
                                    @lang('messages.details')
                                    <i class="fas fa-arrow-circle-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
<style>
    .row, h4, .content-heade, .content {
        font-family: 'cairo' !important;
    }

    .col-lg-3, .col-lg-6 {
        transtion: all 0.3s linear;
    }

    .col-lg-3:hover, .col-lg-6:hover {
        /*background-color:red;*/
        transform: translateY(-0.5rem);
    }

    a {
        color: black !important;
    }

    a:hover {
        text-decoration: none !important;
    }

    .small-box {
        height: 89%;
    }

</style>
