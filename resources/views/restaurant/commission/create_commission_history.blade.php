@extends('restaurant.lteLayout.master')

@section('title')
    @lang('messages.add') @lang('messages.restaurant_commissions')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>
                        @lang('messages.add') @lang('messages.restaurant_commissions')
                        ({{app()->getLocale() == 'ar' ? $restaurant->name_ar : $restaurant->name_en}})
                    </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('messages.add') @lang('messages.restaurant_commissions') </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('RestaurantStoreAzCommission' , $restaurant->id)}}" method="post" enctype="multipart/form-data">
                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.commission_value') </label>
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input name="commission_value" type="text" class="form-control" value="{{old('commission_value')}}" placeholder="@lang('messages.commission_value')">
                                            @if ($errors->has('commission_value'))
                                                <span class="help-block">
                                                    <strong style="color: red;">{{ $errors->first('commission_value') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            {{ app()->getLocale() == 'ar' ? $restaurant->country->currency_ar : $restaurant->country->currency_en }}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.payment_method') </label>
                                    <select name="payment_method" class="form-control" onchange="showDiv(this)" required>
                                        <option disabled selected> @lang('messages.choose_one') </option>
                                        <option value="bank"> @lang('messages.bank_transfer') </option>
                                        <option value="online"> @lang('messages.online') </option>
                                    </select>
                                    @if ($errors->has('payment_method'))
                                        <span class="help-block">
                                            <strong
                                                style="color: red;">{{ $errors->first('payment_method') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="bank" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.bank') </label>
                                        <select name="bank_id" class="form-control" required>
                                            <option disabled selected> @lang('messages.choose_one') </option>
                                            @foreach($banks as $bank)
                                                <option value="{{$bank->id}}">
                                                    @if(app()->getLocale() == 'ar')
                                                        @lang('messages.bank') : {{$bank->name_ar}} ,
                                                        @lang('messages.account_number') : {{$bank->account_number}} ,
                                                        @lang('messages.IBAN_number') : {{$bank->IBAN_number}}
                                                    @else
                                                        @lang('messages.bank') : {{$bank->name_en}} ,
                                                        @lang('messages.account_number') : {{$bank->account_number}} ,
                                                        @lang('messages.IBAN_number') : {{$bank->IBAN_number}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('bank_id'))
                                            <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('bank_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label col-md-3"> @lang('messages.transfer_photo') </label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                     style="width: 200px; height: 150px; border: 1px solid black;">
                                                </div>
                                                <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span
                                                        class="fileinput-new btn btn-info"> @lang('messages.choose_photo') </span>
                                                    <span
                                                        class="fileinput-exists btn btn-primary"> @lang('messages.change') </span>
                                                    <input type="file" name="transfer_photo"> </span>
                                                    <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                       data-dismiss="fileinput"> @lang('messages.remove') </a>
                                                </div>
                                            </div>
                                            @if ($errors->has('photo'))
                                                <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div id="online" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label"> @lang('messages.online_payment_type') </label>
                                        <select name="payment_type" class="form-control" required>
                                            <option disabled selected> @lang('messages.choose_one') </option>
                                            {{--                                        <option value="1"> @lang('messages.kent') </option>--}}
                                            <option value="2"> @lang('messages.visa') </option>
                                            {{--                                        <option value="3"> @lang('messages.amex') </option>--}}
                                            {{--                                        <option value="5"> @lang('messages.benefit') </option>--}}
                                            <option value="6"> @lang('messages.mada') </option>
                                            <option value="11"> @lang('messages.apple_pay') </option>
                                            <option value="14"> @lang('messages.stc_pay') </option>
                                        </select>
                                        @if ($errors->has('payment_type'))
                                            <span class="help-block">
                                                <strong
                                                    style="color: red;">{{ $errors->first('payment_type') }}</strong>
                                            </span>
                                        @endif
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
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>


    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form', function() {
                $('button').attr('disabled', 'disabled');
            });
        });
    </script>
    <script>
        function showDiv(element) {
            if (element.value == 'online') {
                document.getElementById('online').style.display = 'block';
                document.getElementById('bank').style.display = 'none';
            } else if (element.value == 'bank') {
                document.getElementById('bank').style.display = 'block';
                document.getElementById('online').style.display = 'none';
            }
        }
    </script>
@endsection
