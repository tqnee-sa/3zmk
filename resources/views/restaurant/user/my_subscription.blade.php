@extends('restaurant.lteLayout.master')
@section('title')
    @lang('messages.profile')
@endsection
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        input[type=radio]{
            margin-right: 15px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('messages.profile')</h1>
                </div>
                <!--<div class="col-sm-6">-->
                <!--    <ol class="breadcrumb float-sm-right">-->
                <!--        <li class="breadcrumb-item"><a-->
                <!--                    href="{{ url('/restaurant/home') }}">@lang('messages.control_panel')</a></li>-->
                <!--        <li class="breadcrumb-item active"> @lang('messages.profile') </li>-->
                <!--    </ol>-->
                <!--</div>-->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#subscription"
                                        data-toggle="tab">@lang('messages.my_subscription')</a></li>
                                <li class="nav-item"><a class="nav-link " href="#main_data"
                                        data-toggle="tab">@lang('messages.main_data')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#change_password"
                                        data-toggle="tab">@lang('messages.change_password')</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#external_data"
                                        data-toggle="tab">@lang('messages.external_data')</a></li> --}}
                                <li class="nav-item"><a class="nav-link" href="#colors"
                                        data-toggle="tab">@lang('messages.site_colors')</a></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#bio_colors" data-toggle="tab">
                                        {{ app()->getLocale() == 'ar' ? 'التحكم بألوان البايو' : 'Boi Colors Control' }}
                                    </a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#barcode"
                                        data-toggle="tab">@lang('messages.my_barcode')</a></li>


                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="barcode">
                                    <form action="{{ route('RestaurantUpdateBarcode') }}" class="form-horizontal"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name_ar" class="col-sm-3 control-label">@lang('messages.name_ar')</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name_ar"
                                                    value="{{ $user->name_ar }}" id="name_ar"
                                                    placeholder="@lang('messages.name_ar')">
                                            </div>
                                            @if ($errors->has('name_ar'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('name_ar') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="name_en" class="col-sm-3 control-label">@lang('messages.name_en')</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name_en"
                                                    value="{{ $user->name_en }}" id="name_en"
                                                    placeholder="@lang('messages.name_en')">
                                            </div>
                                            {{--                                            <h6 style="color: red">@lang('messages.whenChangeName')</h6> --}}
                                            @if ($errors->has('name_en'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('name_en') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="name_en" class="col-sm-3 control-label">@lang('messages.name_barcode')</label>

                                            <div class="col-sm-9">
                                                <input disabled type="text" class="form-control" name="name_barcode"
                                                    value="{{ $user->name_barcode }}" id="name_en"
                                                    placeholder="@lang('messages.name_barcode')">
                                            </div>
                                            <h6 style="color: red">@lang('messages.whenChangeName')</h6>
                                            <a target="_blank" href="https://api.whatsapp.com/send?phone=966590136653"
                                                style="color: green">
                                                <i style="font-size:24px" class="fa">&#xf232;</i>
                                                <span class="hidemob">
                                                    @lang('messages.technical_support')
                                                </span>
                                            </a>
                                            @if ($errors->has('name_barcode'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('name_barcode') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="active tab-pane" id="subscription">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">

                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    @lang('messages.welcomeRestaurant')
                                                    <a href="#">
                                                        {{ app()->getLocale() == 'ar' ? $user->name_ar : $user->name_en }}
                                                    </a>
                                                    @lang('messages.at')
                                                    @lang('messages.appName')
                                                </h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-money-bill-alt bg-gray"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    @lang('messages.package_price')
                                                    <a href="#">
                                                    </a>
                                                    @lang('messages.including_tax')
                                                </h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-money-bill-alt bg-gray"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    @lang('messages.next_subscription_price')

                                                    @lang('messages.including_tax')
                                                </h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    @lang('messages.state')


                                                </h3>
                                            </div>
                                        </div>


                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    @lang('messages.subscribe_end_at')
                                                    <a href="#">
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-money-bill-alt bg-gray"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    @lang('messages.menu_total_views')
                                                    <a href="#">
                                                        {{ $user->views }}
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-money-bill-alt bg-gray"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header border-0">
                                                    {{ app()->getLocale() == 'ar' ? 'الزيارات اليومية' : 'Daily Views' }}
                                                    <a href="#">

                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                        @if ($user->admin_activation == 'false')
                                            @php
                                                $url = 'https://api.whatsapp.com/send?phone=' . \App\Models\Setting::find(1)->active_whatsapp_number . '&text=';
                                                $content = 'لقد قمت بتسجيل حساب جديد لديكم وأريد اكمال الاجراءات المطلوبه لتفعيل الحساب';
                                            @endphp
                                            <a href="{{ $url . $content }}" class="btn btn-success" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                                {{ app()->getLocale() == 'ar' ? 'لتفعيل الفترة التجريبية أضغط هنا' : 'To Have The Tentative Period Contact the Admin' }}
                                            </a>
                                        @endif
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="main_data">
                                    <form action="{{ route('RestaurantUpdateProfile') }}" class="form-horizontal"
                                        method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label for="email"
                                                class="col-sm-3 control-label">@lang('messages.email')</label>

                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $user->email }}" id="email"
                                                    placeholder="@lang('messages.email')">
                                            </div>
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('email') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number"
                                                class="col-sm-3 control-label">@lang('messages.phone_number')</label>

                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="phone_number"
                                                    value="{{ $user->phone_number }}" id="phone_number"
                                                    placeholder="@lang('messages.phone_number')" disabled>
                                            </div>
                                            @if ($errors->has('phone_number'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('phone_number') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- @if (auth('restaurant')->id() == 1145)
                                            <div class="form-group">
                                                <label for="website_theme"
                                                    class="col-sm-3 control-label">@lang('messages.website_theme')</label>

                                                <div class="col-sm-9">
                                                    <select name="theme_id" id="website_theme"
                                                        class="form-control select2">
                                                        @foreach ($themes as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $user->theme_id ? 'selected' : '' }}>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('theme_id'))
                                                    <div class="alert alert-danger">
                                                        <button class="close" data-close="alert"></button>
                                                        <span> {{ $errors->first('theme_id') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif --}}

                                        <div class="form-group">
                                            <label for="phone_number"
                                                class="col-sm-3 control-label">@lang('messages.ar_activation')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" class="lang" name="ar" value="true"
                                                    {{ $user->ar == 'true' ? 'checked' : '' }}> @lang('messages.yes')
                                                <input type="radio" class="lang" name="ar" value="false"
                                                    {{ $user->ar == 'false' ? 'checked' : '' }}> @lang('messages.no')
                                            </div>
                                            @if ($errors->has('ar'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('ar') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number"
                                                class="col-sm-3 control-label">@lang('messages.en_activation')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" class="lang" name="en" value="true"
                                                    {{ $user->en == 'true' ? 'checked' : '' }}> @lang('messages.yes')
                                                <input type="radio" class="lang" name="en" value="false"
                                                    {{ $user->en == 'false' ? 'checked' : '' }}> @lang('messages.no')
                                            </div>
                                            @if ($errors->has('en'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('en') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- default lang --}}
                                        <div class="form-group default_lang"
                                            style="display: {{ ($user->ar == 'true' and $user->en == 'true') ? 'block' : 'none' }}">
                                            <label for="phone_number"
                                                class="col-sm-3 control-label">@lang('messages.default_lang')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="default_lang" value="ar"
                                                    {{ $user->default_lang == 'ar' ? 'checked' : '' }}> @lang('messages.ar')
                                                <input type="radio" name="default_lang" value="en"
                                                    {{ $user->default_lang == 'en' ? 'checked' : '' }}> @lang('messages.en')
                                            </div>
                                            @if ($errors->has('ar'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('ar') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number"
                                                class="col-sm-3 control-label">@lang('messages.fixed_categories')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" id="noCheck" onclick="javascript:yesnoCheck();"
                                                    name="enable_fixed_category" value="true"
                                                    {{ $user->enable_fixed_category == 'true' ? 'checked' : '' }}>
                                                @lang('messages.yes')
                                                <input type="radio" onclick="javascript:yesnoCheck();" id="yesCheck"
                                                    name="enable_fixed_category" value="false"
                                                    {{ $user->enable_fixed_category == 'false' ? 'checked' : '' }}>
                                                @lang('messages.no')
                                            </div>
                                            @if ($errors->has('enable_fixed_category'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('enable_fixed_category') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="cart"
                                                class="col-sm-12 control-label">@lang('dashboard.product_menu_view')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="product_menu_view" value="theme-1"
                                                    {{ $user->product_menu_view == 'theme-1' ? 'checked' : '' }}>
                                                    <i class=" fas fa-list"></i>
                                                @lang('dashboard._product_menu_view.theme-1')
                                                <input type="radio" name="product_menu_view" value="theme-2"
                                                    {{ $user->product_menu_view == 'theme-2' ? 'checked' : '' }}>
                                                    <i class="far fa-image"></i>
                                                @lang('dashboard._product_menu_view.theme-2')
                                                <input type="radio" name="product_menu_view" value="theme-3"
                                                    {{ $user->product_menu_view == 'theme-3' ? 'checked' : '' }}>
                                                    <i class="fas fa-th-large "></i>
                                                @lang('dashboard._product_menu_view.theme-3')
                                            </div>
                                            @if ($errors->has('product_menu_view'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('product_menu_view') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="cart"
                                                class="col-sm-3 control-label">@lang('messages.categories_menu')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="menu" value="vertical"
                                                    {{ $user->menu == 'vertical' ? 'checked' : '' }}> @lang('messages.vertical')
                                                <input type="radio" name="menu" value="horizontal"
                                                    {{ $user->menu == 'horizontal' ? 'checked' : '' }}> @lang('messages.horizontal')
                                            </div>
                                            @if ($errors->has('menu'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('menu') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="cart" class="col-sm-3 control-label">
                                                {{ app()->getLocale() == 'ar' ? 'عرض قائمه الفروع بالموقع' : 'show branches list at website' }}
                                            </label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="show_branches_list" value="true"
                                                    {{ $user->show_branches_list == 'true' ? 'checked' : '' }}>
                                                @lang('messages.yes')
                                                <input type="radio" name="show_branches_list" value="false"
                                                    {{ $user->show_branches_list == 'false' ? 'checked' : '' }}>
                                                @lang('messages.no')
                                            </div>
                                            @if ($errors->has('show_branches_list'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('show_branches_list') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- logo --}}
                                        {{-- image editor --}}
                                        <div class="form-group image-editor-preview">
                                            <label for="">{{ trans('messages.photo') }}</label>
                                            <label class="custom-label" data-toggle="tooltip"
                                                title="{{ trans('dashboard.change_image') }}">
                                                <img class="rounded" id="avatar"
                                                    src="{{ asset(isset($user->image_path) ? $user->image_path : null) }}"
                                                    alt="avatar">
                                                <input type="file" class="sr-only" id="image-uploader"
                                                    data-product_id="" name="image" accept="image/*">
                                            </label>

                                            @error('image_name')
                                                <p class="text-center text-danger">{{ $message }}</p>
                                            @enderror
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                    role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                    aria-valuemax="100">0%
                                                </div>
                                            </div>
                                            <div class="alert text-center" role="alert"></div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="change_password">
                                    <form action="{{ route('RestaurantChangePassword') }}" class="form-horizontal"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="password"
                                                class="col-sm-3 control-label">@lang('messages.password')</label>

                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="@lang('messages.password')">
                                            </div>
                                            @if ($errors->has('password'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('password') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation"
                                                class="col-sm-3 control-label">@lang('messages.password_confirmation')</label>

                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    id="password_confirmation" placeholder="@lang('messages.password_confirmation')">
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('password_confirmation') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="external_data">
                                    <form action="{{ route('RestaurantChangeExternal') }}" class="form-horizontal"
                                        method="post" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-group">
                                            <label for="cart"
                                                class="col-sm-12 control-label">@lang('dashboard.product_menu_view')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="product_menu_view" value="theme-1"
                                                    {{ $user->product_menu_view == 'theme-1' ? 'checked' : '' }}>
                                                    <i class=" fas fa-list"></i>
                                                @lang('dashboard._product_menu_view.theme-1')
                                                <input type="radio" name="product_menu_view" value="theme-2"
                                                    {{ $user->product_menu_view == 'theme-2' ? 'checked' : '' }}>
                                                    <i class="far fa-image"></i>
                                                @lang('dashboard._product_menu_view.theme-2')
                                                <input type="radio" name="product_menu_view" value="theme-3"
                                                    {{ $user->product_menu_view == 'theme-3' ? 'checked' : '' }}>
                                                    <i class="fas fa-th-large "></i>
                                                @lang('dashboard._product_menu_view.theme-3')
                                            </div>
                                            @if ($errors->has('product_menu_view'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('product_menu_view') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="cart"
                                                class="col-sm-3 control-label">@lang('messages.categories_menu')</label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="menu" value="vertical"
                                                    {{ $user->menu == 'vertical' ? 'checked' : '' }}> @lang('messages.vertical')
                                                <input type="radio" name="menu" value="horizontal"
                                                    {{ $user->menu == 'horizontal' ? 'checked' : '' }}> @lang('messages.horizontal')
                                            </div>
                                            @if ($errors->has('menu'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('menu') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="cart" class="col-sm-3 control-label">
                                                {{ app()->getLocale() == 'ar' ? 'عرض قائمه الفروع بالموقع' : 'show branches list at website' }}
                                            </label>

                                            <div class="col-sm-9">
                                                <input type="radio" name="show_branches_list" value="true"
                                                    {{ $user->show_branches_list == 'true' ? 'checked' : '' }}>
                                                @lang('messages.yes')
                                                <input type="radio" name="show_branches_list" value="false"
                                                    {{ $user->show_branches_list == 'false' ? 'checked' : '' }}>
                                                @lang('messages.no')
                                            </div>
                                            @if ($errors->has('show_branches_list'))
                                                <div class="alert alert-danger">
                                                    <button class="close" data-close="alert"></button>
                                                    <span> {{ $errors->first('show_branches_list') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- @if ($user->ar == 'true')
                                            <div class="form-group">
                                                <label class="control-label"> @lang('messages.description_ar') </label>
                                                <textarea class="textarea" name="description_ar" placeholder="@lang('messages.description_ar')"
                                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; pediting: 10px;">{{ $user->description_ar }}</textarea>
                                                @if ($errors->has('description_ar'))
                                                    <span class="help-block">
                                                        <strong
                                                            style="color: red;">{{ $errors->first('description_ar') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        @if ($user->en == 'true')
                                            <div class="form-group">
                                                <label class="control-label"> @lang('messages.description_en') </label>
                                                <textarea class="textarea" name="description_en" placeholder="@lang('messages.description_en')"
                                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; pediting: 10px;">{{ $user->description_en }}</textarea>
                                                @if ($errors->has('description_en'))
                                                    <span class="help-block">
                                                        <strong
                                                            style="color: red;">{{ $errors->first('description_en') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif --}}
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="colors">
                                    <div class="rest-logo-center">
                                        <div>
                                            <img src="{{ asset($user->image_path) }}" alt="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a href="{{ route('Reset_to_main', $user->id) }}"
                                                class="btn btn-primary">@lang('messages.reset_to_main')
                                            </a>
                                        </div>
                                    </div>
                                    <form action="{{ route('RestaurantChangeColors', $user->id) }}"
                                        class="form-horizontal" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.main_heads') </label>
                                            <input name="main_heads" type="color" class="form-control"
                                                value="{{ $user->color == null ? null : $user->color->main_heads }}">
                                            @if ($errors->has('main_heads'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('main_heads') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.icons') </label>
                                            <input name="icons" type="color" class="form-control"
                                                value="{{ $user->color == null ? null : $user->color->icons }}">
                                            @if ($errors->has('icons'))
                                                <span class="help-block">
                                                    <strong style="color: red;">{{ $errors->first('icons') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.options_description') </label>
                                            <input name="options_description" type="color" class="form-control"
                                                value="{{ $user->color == null ? null : $user->color->options_description }}">
                                            @if ($errors->has('options_description'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('options_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.background') </label>
                                            <input name="background" type="color" class="form-control"
                                                value="{{ $user->color == null ? null : $user->color->background }}">
                                            @if ($errors->has('background'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('background') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.product_background') </label>
                                            <input name="product_background" type="color" class="form-control"
                                                value="{{ $user->color == null ? null : $user->color->product_background }}">
                                            @if ($errors->has('product_background'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('product_background') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.category_background') </label>
                                            <input name="category_background" type="color" class="form-control"
                                                value="{{ $user->color == null ? null : $user->color->category_background }}">
                                            @if ($errors->has('category_background'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('category_background') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane" id="bio_colors">
                                    <div class="rest-logo-center">
                                        <div>
                                            <img src="{{ asset($user->image_path) }}" alt="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a href="{{ route('Reset_to_bio_main', $user->id) }}"
                                                class="btn btn-primary">@lang('messages.reset_to_main')
                                            </a>
                                        </div>
                                    </div>
                                    <form action="{{ route('RestaurantChangeBioColors', $user->id) }}"
                                        class="form-horizontal" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.background') </label>
                                            <input name="background" type="color" class="form-control"
                                                value="{{ $user->bio_color == null ? null : $user->bio_color->background }}">
                                            @if ($errors->has('background'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('background') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"> @lang('messages.main_heads') </label>
                                            <input name="main_line" type="color" class="form-control"
                                                value="{{ $user->bio_color == null ? null : $user->bio_color->main_line }}">
                                            @if ($errors->has('main_line'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('main_line') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ app()->getLocale() == 'ar' ? 'الأقسام الرئيسية' : 'Main Categories' }}
                                            </label>
                                            <input name="main_cats" type="color" class="form-control"
                                                value="{{ $user->bio_color == null ? null : $user->bio_color->main_cats }}">
                                            @if ($errors->has('main_cats'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('main_cats') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ app()->getLocale() == 'ar' ? 'الأقسام الفرعية' : 'Sub Categories' }}
                                            </label>
                                            <input name="sub_cats" type="color" class="form-control"
                                                value="{{ $user->bio_color == null ? null : $user->bio_color->sub_cats }}">
                                            @if ($errors->has('sub_cats'))
                                                <span class="help-block">
                                                    <strong style="color: red;">{{ $errors->first('sub_cats') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ app()->getLocale() == 'ar' ? 'خلفية الأقسام الفرعية' : 'Sub Categories Background' }}
                                            </label>
                                            <input name="sub_background" type="color" class="form-control"
                                                value="{{ $user->bio_color == null ? null : $user->bio_color->sub_background }}">
                                            @if ($errors->has('sub_background'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('sub_background') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                {{ app()->getLocale() == 'ar' ? 'لون خط الأقسام الفرعية' : 'Sub Categories Line Color' }}
                                            </label>
                                            <input name="sub_cats_line" type="color" class="form-control"
                                                value="{{ $user->bio_color == null ? null : $user->bio_color->sub_cats_line }}">
                                            @if ($errors->has('sub_cats_line'))
                                                <span class="help-block">
                                                    <strong
                                                        style="color: red;">{{ $errors->first('sub_cats_line') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group ">
                                            <label class="control-label col-md-3">
                                                {{ app()->getLocale() == 'ar' ? 'صورة الخلفية' : 'Background Image' }}
                                            </label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                        style="width: 200px; height: 150px; border: 1px solid black;">
                                                        @if ($user->bio_color and $user->bio_color->background_image != null)
                                                            <img
                                                                src="{{ asset('/uploads/bio_backgrounds/' . $user->bio_color->background_image) }}">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new btn btn-info"> @lang('messages.choose_photo')
                                                            </span>
                                                            <span class="fileinput-exists btn btn-primary">
                                                                @lang('messages.change') </span>
                                                            <input type="file" name="background_image"> </span>
                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists"
                                                            data-dismiss="fileinput"> @lang('messages.remove') </a>
                                                    </div>
                                                </div>
                                                @if ($errors->has('background_image'))
                                                    <span class="help-block">
                                                        <strong
                                                            style="color: red;">{{ $errors->first('background_image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">@lang('messages.save')</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName2" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills"
                                                    placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and
                                                            conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    @php
        $itemId = $user->id;
        $imageUploaderUrl = route('restaurant.profile.update_image');
    @endphp
    @include('restaurant.products.product_image_modal')
@endsection
@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>


    <script type="text/javascript">
        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('ifYes').style.display = 'none';
            } else {
                document.getElementById('ifYes').style.display = 'block';
            }
        }

        $(function() {
            $('input.lang').on('change', function() {
                console.log($(this));
                if ($('input[name=ar]:checked').val() == 'true' && $('input[name=en]:checked').val() ==
                    'true') {
                    $('.form-group.default_lang').fadeIn(300);
                } else {
                    $('.form-group.default_lang').fadeOut(300);
                }
            });
        });
    </script>
@endsection
