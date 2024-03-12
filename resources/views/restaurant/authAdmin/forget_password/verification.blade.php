@extends('restaurant.authAdmin.master')

@section('title')
    @lang('messages.forgetPassword')
@endsection
@section('content')
    <!-- BEGIN FORGOT PASSWORD FORM -->

    <div class="login-box">
        <div class="login-logo">
            {{--            <a href="{{route('restaurant.login')}}"><b>@lang('messages.forgetPassword')</b></a>--}}
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password_verification_post' , $user->id) }}">
                    @csrf

                    <h3 class="font-green text-center">@lang('messages.enterCode')</h3>
                    <br>
{{--                    <p> @lang('messages.phonePasswordReset')</p>--}}
                    <div class="form-group{{ $errors->has('code') ? ' is-invalid' : '' }}">
                        <input class="form-control placeholder-no-fix" type="number"  placeholder="@lang('messages.enterCode')" name="code" value="{{ old('code') }}" required  />
                        @if ($errors->has('code'))
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span> {{ $errors->first('code') }}</span>
                            </div>
                        @endif
                    </div>


                    <div class="form-actions">
                        <button type="submit" class="btn btn-success uppercase pull-right">@lang('messages.send')</button>
                    </div>
                </form>

            </div>

        </div>
        <p class="footer-copyright pb-3 mb-1 pt-0 mt-0 font-13 font-600" style="    text-align: center;">{{trans('messages.made_love')}}    </p>

    </div>

@endsection
