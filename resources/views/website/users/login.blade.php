@extends('website.users.master')
@push('styles')
    <style>
        .login-content,
        body,
        footer,
        .mycontainer {
            background: #FFF;
            background-color: #FFF;

        }

        .select2-container--open .select2-dropdown {
            width: 70px !important;
        }
        .select2-results__option--selectable img.img-flag{
            width: 40px !important;
            height: 40px !important;
        }
    </style>
@endpush
@section('content')
    <main class="login-content">
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
            
            <div class="text-center">
                <img class="logo" src="{{ asset('/uploads/restaurants/logo/' . $restaurant->az_logo) }}" width="90"
                    height="90" alt="logo" />
            </div>
            <h3 class="text-center res-title">{{ $restaurant->name }}</h3>
            <div class="text-center" style="height: 0">
                <img src="{{ asset('site/image/line.png') }}" alt="">
            </div>
            <h1 class="text-center ">{{ trans('messages.login') }}</h1>
            <form method="post" action="{{ route('AZUserLoginSubmit', [$restaurant->name_barcode, $branch->name_en]) }}">
                <input type='hidden' name='_token' value='{{ Session::token() }}'>

                <div class="m-2 px-1 container_form">
                    <div class="login-form">
                        <div class="form-group phone-number">
                            <label for="type_company"> @lang('messages.phone_number') :</label>
                            <input style="direction: rtl" type="tel" class="form-control" id="phone_number"
                                name="phone_number" value="{{ old('phone_number') }}" placeholder="05xxxxxxxx" required />
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="country-flag">
                            <select name="country_id" class="form-control " id="country-select2" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ (isset($restaurant) and $restaurant->country_id == $country->id) ? 'selected' : '' }}
                                        title="{{ $country->flag == null ? null : asset($country->flag_path) }}"
                                        data_flag="@php
if($country->id == 1) echo '01xxxxxxxx';
                                    elseif($country->code == 973) echo '3xxxxxxx';
                                    elseif($country->id == 2) echo '05xxxxxxxx';
                                    else echo $country->code . 'xxxxxxxx'; @endphp">
                                        {{ $country->code }} +
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('country_id'))
                                <span class="help-block">
                                    <strong style="color: red;">{{ $errors->first('country_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="submit" value="@lang('messages.login')" class="btn btn-m btn-full btn-black rounded-s text-uppercase font-900 shadow-s bg-dark2-dark send-sms step-1 " />
            </form>
        </div>
    </main>
    <easy-footer>
        {{ trans('messages.easy_footer') }}
    </easy-footer>
@endsection
@push('scripts')
    <script>
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            // console.log(state);
            // console.log(state.element.attributes.data_flag.value);
            if (state.title.length > 10) {
                var image = '<img width="30" height="30" src="' + state.title + '" class="img-flag" />';
            } else var image = '<span>' + state.text + '</span>';
            var $state = $(
                image
            );
            console.log($state);
            return $state;
        };

        function formatState2(state) {
            if (!state.id) {
                return state.text;
            }
            // console.log(state);
            // console.log(state.element.attributes.data_flag.value);
            if (state.title.length > 10) {
                var image = '<img width="30" height="30" src="' + state.title + '" class="img-flag" />';
            } else var image = '<span>' + state.text + '</span>';
            var $state = $(
                image
            );

            console.log(state.element.attributes.data_flag.value);
            $(' input[name=phone_number]').prop('placeholder', state.element.attributes.data_flag.value);

            return $state;
        };
        var options = [
            @foreach ($countries as $country)
                {
                    value: '{{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}',
                    id: '{{ $country->id }}',
                    title: "url"
                    {{-- text: '{{$country->name_ar}}', --}}
                },
            @endforeach
        ];
        $(function() {
            console.log('here login');
            $("#country-select2").select2({
                templateResult: formatState,
                templateSelection: formatState2,
                // // dir: "rtl",
                // // data: options,
                dropdownAutoWidth: true,
                // dropdownParent: $('#country-select2')

            });
        });
    </script>
@endpush
