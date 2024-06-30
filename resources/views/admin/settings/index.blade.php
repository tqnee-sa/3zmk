@extends('admin.lteLayout.master')

@section('title')
    @lang('messages.azmak_setting')
@endsection

@section('styles')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('messages.azmak_setting') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{url('/admin/home')}}">@lang('messages.control_panel')</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{route('AzmakSetting')}}">
                                @lang('messages.azmak_setting')
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                @include('flash::message')
                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('messages.azmak_setting') </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('AzmakSettingUpdate')}}"
                              method="post" enctype="multipart/form-data">
                            <input type='hidden' name='_token' value='{{Session::token()}}'>

                            <div class="card-body">
                                <h4 class="text-center"> @lang('messages.azmak_subscription_info') </h4>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.az_subscription_type') </label>
                                    <select name="type" class="form-control">
                                        <option disabled selected> @lang('messages.choose_one') </option>
                                        <option value="free" {{$settings->subscription_type == 'free' ? 'selected' : ''}}> @lang('messages.free') </option>
                                        <option value="paid" {{$settings->subscription_type == 'paid' ? 'selected' : ''}}> @lang('messages.paid') </option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.subscription_amount') </label>
                                    <input name="subscription_amount" value="{{$settings->subscription_amount}}" type="number" class="form-control" placeholder="@lang('messages.subscription_amount')">
                                    @if ($errors->has('subscription_amount'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('subscription_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.subscription_tax') </label>

                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input name="tax" type="number" value="{{$settings->tax}}" class="form-control" placeholder="@lang('messages.subscription_tax')">
                                            @if ($errors->has('tax'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('tax') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-2">
                                            %
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-center"> @lang('messages.azmak_payment_info') </h4>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.bank_transfers') </label>
                                    <select name="bank_transfer" class="form-control">
                                        <option disabled selected> @lang('messages.choose_one') </option>
                                        <option value="true" {{$settings->bank_transfer == 'true' ? 'selected' : ''}}> @lang('messages.activate') </option>
                                        <option value="false" {{$settings->bank_transfer == 'false' ? 'selected' : ''}}> @lang('messages.stop') </option>
                                    </select>
                                    @if ($errors->has('bank_transfer'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('bank_transfer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.online_payment_type') </label>
                                    <select name="online_payment" class="form-control" onchange="showDiv(this)">
                                        <option disabled selected> @lang('messages.choose_one') </option>
                                        <option value="myFatoourah" {{$settings->online_payment == 'myFatoourah' ? 'selected' : ''}}> @lang('messages.myFatoourah') </option>
                                        <option value="paylink" {{$settings->online_payment == 'paylink' ? 'selected' : ''}}> @lang('messages.payLink') </option>
                                        <option value="none" {{$settings->online_payment == 'none' ? 'selected' : ''}}> @lang('messages.noOnlinePayment') </option>
                                    </select>
                                    @if ($errors->has('online_payment'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('online_payment') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div id="myFatoourah" style="display: {{$settings->online_payment == 'myFatoourah' ? 'block' : 'none'}}">
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.token_payment_type') </label>
                                        <select name="online_payment_type" class="form-control">
                                            <option disabled selected> @lang('messages.choose_one') </option>
                                            <option value="test" {{$settings->online_payment_type == 'test' ? 'selected' : ''}}> @lang('messages.test') </option>
                                            <option value="online" {{$settings->online_payment_type == 'online' ? 'selected' : ''}}> @lang('messages.online') </option>
                                        </select>
                                        @if ($errors->has('online_payment_type'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('online_payment_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.online_token') </label>
                                        <input name="online_token" value="{{$settings->online_token}}" type="text" class="form-control" placeholder="@lang('messages.online_token')">
                                        @if ($errors->has('online_token'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('online_token') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="payLink" style="display: {{$settings->online_payment == 'paylink' ? 'block' : 'none'}}">
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.token_payment_type') </label>
                                        <select name="pay_link_payment_type" class="form-control" onchange="showTestInfo(this)">
                                            <option disabled selected> @lang('messages.choose_one') </option>
                                            <option value="test" {{$settings->pay_link_payment_type == 'test' ? 'selected' : ''}}> @lang('messages.test') </option>
                                            <option value="online" {{$settings->pay_link_payment_type == 'online' ? 'selected' : ''}}> @lang('messages.online') </option>
                                        </select>
                                        @if ($errors->has('pay_link_payment_type'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('pay_link_payment_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.pay_link_app_id') </label>
                                        <input name="pay_link_app_id" id="pay_link_app_id" value="{{$settings->pay_link_app_id}}" type="text" class="form-control" placeholder="@lang('messages.pay_link_app_id')">
                                        @if ($errors->has('pay_link_app_id'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('pay_link_app_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.pay_link_secret_key') </label>
                                        <input name="pay_link_secret_key" id="pay_link_secret_key" value="{{$settings->pay_link_secret_key}}" type="text" class="form-control" placeholder="@lang('messages.pay_link_secret_key')">
                                        @if ($errors->has('pay_link_secret_key'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('pay_link_secret_key') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-center"> @lang('messages.az_orders') </h4>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.order_finished_days') </label>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input name="order_finished_days" type="number" value="{{$settings->order_finished_days}}" class="form-control" placeholder="@lang('messages.order_finished_days')">
                                            @if ($errors->has('order_finished_days'))
                                                <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('order_finished_days') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-2">
                                            @lang('messages.day')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    <script>
        function showDiv(element) {
            if (element.value == 'myFatoourah') {
                document.getElementById('myFatoourah').style.display = 'block';
                document.getElementById('payLink').style.display = 'none';
            } else if (element.value == 'paylink') {
                document.getElementById('payLink').style.display = 'block';
                document.getElementById('myFatoourah').style.display = 'none';
            }else{
                document.getElementById('myFatoourah').style.display = 'none';
                document.getElementById('payLink').style.display = 'none';
            }
        }
        function showTestInfo(element) {

            if (element.value == 'test') {
                document.getElementById("pay_link_app_id").value = 'APP_ID_1123453311';
                document.getElementById("pay_link_secret_key").value = '0662abb5-13c7-38ab-cd12-236e58f43766';
            }

        }

    </script>
@endsection
