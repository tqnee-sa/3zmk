@extends('employee.lteLayout.master')

@section('title')
    @lang('messages.edit') @lang('messages.profile')
@endsection

@section('styles')

@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> @lang('messages.edit') @lang('messages.profile') </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{url('/employee/home')}}">@lang('messages.control_panel')</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{route('employee.home')}}">
                                @lang('messages.profile')
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
                            <h3 class="card-title">@lang('messages.edit') @lang('messages.profile') </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('employeeUpdateProfile' , $employee->id)}}" method="post" enctype="multipart/form-data">
                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

                            <div class="card-body">
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.name') </label>
                                    <input name="name" type="text" class="form-control" value="{{$employee->name}}" placeholder="@lang('messages.employee_name')">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.email') </label>
                                    <input name="email" type="email" class="form-control" value="{{$employee->email}}" placeholder="@lang('messages.email')">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.password') </label>
                                    <input name="password" type="password" class="form-control"  placeholder="@lang('messages.password')">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> @lang('messages.password_confirmation') </label>
                                    <input name="password_confirmation" type="password" class="form-control"  placeholder="@lang('messages.password_confirmation')">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
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
