@extends('website.orders.cart_layout.master')
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
                            <h5 class="text-center" style="color: {{$restaurant->az_color ? $restaurant->az_color->main_heads : ''}} !important;">
                                @lang('messages.your_data')
                            </h5>
                            <div class="inner_form">
                                <div class="name">
                                    <div class="container_input">
                                        <i class="fa fa-user" style="color: {{$restaurant->az_color?->icons}} !important;"></i>
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
                                        <i class="fa fa-envelope" style="color: {{$restaurant->az_color?->icons}} !important;"></i>
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
                                    <i class="fa fa-user" style="color: {{$restaurant->az_color?->icons}} !important;"></i>
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
                                    <i class="fa fa-phone" style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    <input
                                        style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"                                        type="tel"
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
                                    <i class="fa-solid fa-heart" style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    <input
                                        style="background-color: {{$restaurant->az_color ?->background}} !important; direction: rtl"                                        type="text"
                                        id="occasion"
                                        name="occasion"
                                        value="{{old('occasion')}}"
                                        placeholder="@lang('messages.personOccasion')"
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
                                <label style="color: {{$restaurant->az_color ?->main_heads}} !important;"> @lang('messages.payment_by') </label>
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


                        <button style="background-color: {{$restaurant->az_color ?->icons}} !important;" class="global_btn d-block m-auto" type="submit">
                            @lang('messages.next')
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

