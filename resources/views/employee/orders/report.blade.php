@extends('employee.lteLayout.master')
@section('title')
    @lang('dashboard.order_report')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <style>
        form{
            margin-top: 20px;
            margin-bottom: 40px;
        }
        a{
            text-decoration: none !important;
        }
        .small-box ,
        .small-box h3 {
            color : #000;

        }
        .small-box  h3 {
            text-align: center
        }
        .small-box .inner p{
            font-size: 1.5rem;
            color:#000;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>

                        @lang('dashboard.order_report')


                    </h1>
                </div>
                <!--<div class="col-sm-6">-->
                <!--    <ol class="breadcrumb float-sm-right">-->
                <!--        <li class="breadcrumb-item">-->
                <!--            <a href="{{ url('/restaurant/home') }}">-->
                <!--                @lang('messages.control_panel')-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="breadcrumb-item active">-->
                <!--            <a href="{{ route('casher.order.report') }}"></a>-->
                <!--            @lang('dashboard.order_report')-->
                <!--        </li>-->
                <!--    </ol>-->
                <!--</div>-->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')

    <section class="content">
        <form action="{{ url()->current() }}" method="get">

            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <label for="year">{{ trans('dashboard.year') }}</label>
                    <select name="year" id="year" class="form-control">
                        <option value="" >{{ trans('dashboard.all') }}</option>
                        @for ($i = intval(date('Y')); $i > 2015; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 col-sm-4">
                    <label for="month">{{ trans('dashboard.month') }}</label>
                    <select name="month" id="month" class="form-control">
                        <option value="" >{{ trans('dashboard.all') }}</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i > 9 ? $i : '0' . $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 col-sm-4">
                    <button type="submit" class="btn btn-primary"
                        style="margin-top:30px">{{ trans('dashboard.search') }}</button>
                </div>

            </div>
        </form>
        <div class="row">
            <div class="col-md-6 ">
                <a href="#">
                    <!-- small box -->
                    <div class="small-box">
                        <!--bg-success-->
                        <div class="inner">
                            <p>{{ trans('dashboard.total_order_total') }}</p>
                            <h3>
                                {{ $data['order_count']['total'] }}
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 ">
                <a href="#">
                    <!-- small box -->
                    <div class="small-box">
                        <!--bg-success-->
                        <div class="inner">
                            <p>{{ trans('dashboard.income_total') }}</p>
                            <h3>
                                {{ $data['income']['total'] }}
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6 ">
                <a href="#">
                    <!-- small box -->
                    <div class="small-box">
                        <!--bg-success-->
                        <div class="inner">
                            <p>{{ trans('dashboard.total_order_today') }}</p>
                            <h3>
                                {{ $data['order_count']['today'] }}
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 ">
                <a href="#">
                    <!-- small box -->
                    <div class="small-box">
                        <!--bg-success-->
                        <div class="inner">
                            <p>{{ trans('dashboard.total_order_month') }}</p>
                            <h3>
                                {{ $data['order_count']['month'] }}
                            </h3>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 ">
                <a href="#">
                    <!-- small box -->
                    <div class="small-box">
                        <!--bg-success-->
                        <div class="inner">
                            <p>{{ trans('dashboard.income_today') }}</p>
                            <h3>
                                {{ $data['income']['today'] }}
                            </h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 ">
                <a href="#">
                    <!-- small box -->
                    <div class="small-box">
                        <!--bg-success-->
                        <div class="inner">
                            <p>{{ trans('dashboard.income_month') }}</p>
                            <h3>
                                {{ $data['income']['month'] }}
                            </h3>
                        </div>
                    </div>
                </a>
            </div>


            <!-- /.col -->
        </div>


        <!-- /.row -->
    </section>

    <!-- Modal -->
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script src="{{ asset('dist/js/html2canvas.min.js') }}"></script>

@endsection
