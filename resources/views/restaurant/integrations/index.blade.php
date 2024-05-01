@extends('restaurant.lteLayout.master')
@section('title')
    @lang('messages.pullEasymenuMenu')
@endsection
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <style>
        #barcode-svg {
            width: 245px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('messages.pullEasymenuMenu')</h1>
                </div>
                <!--<div class="col-sm-6">-->
                <!--    <ol class="breadcrumb float-sm-right">-->
            <!--        <li class="breadcrumb-item"><a href="{{url('/restaurant/home')}}">@lang('messages.control_panel')</a></li>-->
            <!--        <li class="breadcrumb-item active"> @lang('messages.barcode') </li>-->
                <!--    </ol>-->
                <!--</div>-->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <div class="row">
                <div class="col-lg-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div class="form-group">

                                <div class="card">
                                    <div class="card-header">

                                    </div>
                                    <div class="card-body">
                                        <p> @lang('messages.doYouHaveMenu') </p>
                                        <a href="{{route('copyMenu' , $restaurant->id)}}" class="btn btn-primary">
                                            @lang('messages.pullMenu')
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <p style="color: red">
                                            @lang('messages.pullMenuAlert')
                                        </p>
                                    </div>
                                </div>

                                {{--                                <div class="card">--}}
                                {{--                                    <div class="card-header">--}}
                                {{--                                        <h2>--}}
                                {{--                                            @if(app()->getLocale() == 'ar')--}}
                                {{--                                                {{$model->name}}--}}
                                {{--                                            @else--}}
                                {{--                                                {{$model->en_name}}--}}
                                {{--                                            @endif--}}
                                {{--                                        </h2>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="card-body">--}}
                                {{--                                        {!! QrCode::size(200)->backgroundColor(255,90,0)->generate(url('/' . $model->name_en)) !!}--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <div> <img width="50px" height="50px" src="{{asset('uploads/logo/'.\App\Setting::find(1)->logo)}}" ></div>--}}
                            </div>

                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
