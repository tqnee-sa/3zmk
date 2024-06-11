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
                    <a href="{{url()->previous()}}"
                       style="background-color: {{$restaurant->az_color ?->icons}} !important;"
                       class="nav-link"
                       role="tab"
                       aria-controls="pills-profile"
                       aria-selected="false">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </li>
            </ul>

            <div class="{{$restaurant->az_color == null ? 'bg-white' : ''}} main_wrap">

                <div class="inf_3azema">
                    <div class="image d-inline-block">
                        <img src="{{asset('/site/image/letter.jpg')}}" alt=""/>
                    </div>
                    <!-- <img src="./image//letter.jpg" alt="" /> -->
                    <h5 class="d-inline-block">@lang('messages.order_info')</h5>
                    <form method="post" action="{{route('AZOrderInfoSubmit' , $order->id)}}">
                        @csrf
                        @if($order->user->name == null)
                            <h5 class="text-center"
                                style="color: {{$restaurant->az_color ? $restaurant->az_color->main_heads : ''}} !important;">
                                @lang('messages.your_data')
                            </h5>
                            <div class="inner_form">
                                <div class="name">
                                    <div class="container_input">
                                        <i class="fa fa-user"
                                           style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                        <input
                                            type="text"
                                            id="name"
                                            style="background-color: {{$restaurant->az_color?->background}} !important;"
                                            name="name"
                                            value="{{old('name')}}"
                                            placeholder="@lang('messages.yourName')"
                                        />
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="phone_number">
                                    <div class="container_input">
                                        <i class="fa fa-envelope"
                                           style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                        <input
                                            type="email"
                                            name="email"
                                            style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"
                                            id="email"
                                            value="{{old('email')}}"
                                            placeholder="@lang('messages.yourEmail')"
                                        />
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                        @endif
                        <h5 class="text-center">
                            @lang('messages.invited_person_data')
                        </h5>
                        <div class="inner_form">
                            <div class="name">
                                <div class="container_input">
                                    <i class="fa fa-user"
                                       style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    <input
                                        type="text"
                                        id="name"
                                        style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"
                                        name="person_name"
                                        value="{{old('person_name')}}"
                                        placeholder="@lang('messages.personName')"
                                    />
                                </div>
                                @if ($errors->has('person_name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('person_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="phone_number">
                                <div class="container_input">
                                    <i class="fa fa-phone"
                                       style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    <input
                                        style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"
                                        type="tel"
                                        name="person_phone"
                                        id="phone_number"
                                        value="{{old('person_phone')}}"
                                        placeholder="@lang('messages.personPhone')"
                                    />
                                </div>
                                @if ($errors->has('person_phone'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('person_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="suitable">
                                <div class="container_input">
                                    <button
                                        class="btn btn_custom"
                                        type="button"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasBottom"
                                        aria-controls="offcanvasBottom"
                                    >
                                        <div>
                                            <input
                                                style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"
                                                id="occasion_value"
                                                name="occasion" placeholder="@lang('messages.personOccasion')">
                                        </div>
                                        <i class="fa-solid fa-angle-left"
                                           style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    </button>

                                    <div
                                        class="offcanvas offcanvas-bottom"
                                        tabindex="-1"
                                        id="offcanvasBottom"
                                        aria-labelledby="offcanvasBottomLabel"
                                    >
                                        <div class="offcanvas-header">
                                            <h5
                                                class="offcanvas-title"
                                                id="offcanvasBottomLabel"
                                            >
                                                @lang('messages.choose_occasion')
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="offcanvas-body small">
                                            <div class="row">
                                                @foreach($occasions as $occasion)
                                                    <div class="col-sm-2 choose_input xxxxx text-center"   data-bs-dismiss="offcanvas" onclick="clickHandler(this);"
                                                         id="{{$occasion->id}}">
                                                        <img src="{{asset('/uploads/occasions/' . $occasion->icon)}}"
                                                             height="25" width="35"
                                                             class="choose_img">
                                                        <span style="display: block" class="text-center" id="span-{{$occasion->id}}">{{app()->getLocale() == 'ar' ? $occasion->name_ar : $occasion->name_en}}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <select></select> -->
                                </div>
                            </div>
                            <div class="suitable" id="occasion_other" style="display: none">
                                <div class="container_input">
                                    <i class="fa-solid fa-heart"
                                       style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    <input
                                        style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"
                                        type="text"
                                        id="occasion"
                                        name="occasion_text"
                                        value="{{old('occasion')}}"
                                        placeholder="@lang('messages.personOccasionText')"
                                    />
                                </div>
                                @if ($errors->has('occasion'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('occasion') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="message">
                                <div class="container_input">
                                    <!-- <i class="fa fa-phone"></i> -->
                                    <textarea
                                        id="message"
                                        placeholder="@lang('messages.message')"
                                        rows="5"
                                        style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"
                                        name="message"
                                    ></textarea>
                                </div>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if($order->restaurant->a_z_orders_payment_type == 'myFatoourah')
                            <hr>
                            <div class="container_input">
                                <!-- <i class="fa fa-phone"></i> -->
                                <label
                                    style="color: {{$restaurant->az_color ?->main_heads}} !important;"> @lang('messages.payment_by') </label>
                                <select style="background-color: {{$restaurant->az_color ?->background}} !important;"
                                        name="online_type" class="form-control" required>
                                    <option disabled selected> @lang('messages.choose_one') </option>
                                    <option value="2"> @lang('messages.visa') </option>
                                    <option value="6"> @lang('messages.mada') </option>
                                    <option value="11"> @lang('messages.apple_pay') </option>
                                </select>
                            </div>
                            @if ($errors->has('online_type'))
                                <span class="help-block">
                                <strong style="color: red;">{{ $errors->first('online_type') }}</strong>
                            </span>
                            @endif
                        @endif

{{--                        <a onclick="payment(this);">pay</a>--}}
                        <button style="background-color: {{$restaurant->az_color ?->icons}} !important;"
                                class="global_btn btn d-block m-auto" type="submit" onclick="payment()">
                            @lang('messages.pay')
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @php
        $token = payLinkToken('test' , 'APP_ID_1123453311' , '0662abb5-13c7-38ab-cd12-236e58f43766');
    @endphp
    <style>
        .choose_input {
            background: #f4f4f4;
            border: none;
            border-radius: 8px;
            width: 90px;
            height: 90px;
            margin: 15px;
        }

        .choose_img {
            vertical-align: middle;
            margin-bottom: 2px;
            margin-top: 10px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("input[name=occasion]").change(function () {

                if ($("#occasion").is(':checked')) {
                    $("#occasion_other").show();
                } else {
                    $("#occasion_other").hide();
                }
            });
        });
    </script>
    <script type="text/javascript">
        function clickHandler(object) {
            $(".xxxxx").css('border', '');
            document.getElementById(object.id).style.border = "1px solid #0000FF";
            var spantext = $("#span-"+object.id).text();
            document.getElementById("occasion_value").value = spantext;
            if (object.id == 7) {
                $("#occasion_other").show();
            } else {
                $("#occasion_other").hide();
            }
        }
    </script>

{{--    <script src="https://paylink.sa/assets/js/paylink.js"></script>--}}
{{--    <script>--}}
{{--        function payment(){--}}
{{--            let token = '{{$token}}';--}}
{{--            let payment = new PaylinkPayments({mode: 'test', defaultLang: 'ar', backgroundColor: '#EEE'});--}}
{{--            let order = new Order({--}}
{{--                callBackUrl: 'http://127.0.0.1:8000/payLinkSuccess', // callback page URL (for example http://localhost:6655 processPayment.php) in your site to be called after payment is processed. (mandatory)--}}
{{--                clientName: 'John Smith', // the name of the buyer. (mandatory)--}}
{{--                clientMobile: '0509200900', // the mobile of the buyer. (mandatory)--}}
{{--                amount: 50, // the total amount of the order (including VAT or discount). (mandatory). NOTE: This amount is used regardless of total amount of products listed below.--}}
{{--                orderNumber: 'ANY_UNIQUE_ORDER', // the order number in your system. (mandatory)--}}
{{--                clientEmail: 'myemail@example.com', // the email of the buyer (optional)--}}
{{--                products: [ // list of products (optional)--}}
{{--                    {title: 'Dress 1', price: 120, qty: 2},--}}
{{--                    {title: 'Dress 2', price: 120, qty: 2},--}}
{{--                    {title: 'Dress 3', price: 70, qty: 2}--}}
{{--                ],--}}
{{--            });--}}
{{--            payment.openPayment(token, order, 'http://127.0.0.1:8000/payLinkSuccess');--}}
{{--        }--}}
{{--    </script>--}}
@endsection

