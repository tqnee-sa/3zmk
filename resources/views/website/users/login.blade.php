@extends('website.users.master')
@section('content')
    <main>
        @if (session('An_error_occurred'))
            <div class="alert alert-success">
                {{ session('An_error_occurred') }}
            </div>
        @endif
        @if (session('warning_login'))
            <div class="alert alert-danger">
                {{ session('warning_login') }}
            </div>
        @endif
        <div class="join_us d-flex flex-column align-items-center px-1 m-3 justify-content-center bg-white">
            <br><br><br>
            <img src="{{ asset('/uploads/restaurants/logo/' . $restaurant->az_logo) }}" width="75" height="75"
                alt="logo" />
            <br><br><br>
            <form method="post" action="{{ route('AZUserLoginSubmit', [$restaurant->name_barcode, $branch->name_en]) }}">
                <input type='hidden' name='_token' value='{{ Session::token() }}'>

                <div class="m-2 px-1 container_form">
                    <div class="row">
                        <div class="phone">
                            <label for="type_company"> @lang('messages.phone_number') :</label>
                            <input style="direction: rtl" type="tel" class="form-control" id="phone_number"
                                name="phone_number" value="{{ old('phone_number') }}" placeholder="05xxxxxxxx" required />
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="country">
                            <select name="country_id" class="form-control" id="country-select" required>

                            </select>

                            @if ($errors->has('country_id'))
                                <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('country_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="submit" value="@lang('messages.login')" class="my-5" />
            </form>
        </div>
    </main>
@endsection
