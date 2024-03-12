@extends('restaurant.lteLayout.master')

@section('title')
    @lang('dashboard.restaurant_contact_us')
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <!-- Theme style -->
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.restaurant_contact_us')</h1>
                </div>
                <!--<div class="col-sm-6">-->
                <!--    <ol class="breadcrumb float-sm-right">-->
                <!--        <li class="breadcrumb-item">-->
                <!--            <a href="{{url('/restaurant/home')}}">-->
                <!--                @lang('messages.control_panel')-->
                <!--            </a>-->
                <!--        </li>-->

                <!--    </ol>-->
                <!--</div>-->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')

    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form" id="post-form" action="{{route('restaurant.contact_us.setting')}}" method="post"
                            enctype="multipart/form-data">
                          <input type='hidden' name='_token' value='{{Session::token()}}'>

                          <div class="card-body">

                            <div class="form-group" style="margin-bottom:30px;">

                                <div id="barcode-svg" style="width: 240px;
                                height: 274px;
                                margin: auto;
                                padding: 20px;">
                                    <?php $name = $restaurant->name_barcode == null ? $restaurant->name_en : $restaurant->name_barcode ?>
                                    {!! QrCode::size(200)->generate(url('/restaurants/' . $name . '/contact_us')) !!}
                                    <div  class="description" style="margin-top:10px;">
                                        <img width="20px" height="20px" src="{{asset('uploads/img/logo.png')}}" >

                                        <p class="footer-copyright pb-3 mb-1 pt-0 mt-0 font-13 font-600" style="    text-align: center;font-size:12px;display:inline; margin-right:5px;">
                                            {{trans('messages.made_love')}}

                                        </p>
                                    </div>
                                </div>

                                <h3 class="text-center" style="margin-top:10px;">
                                    <a href="#" id="printPage" class="printPage btn">@lang('messages.downloadQr')</a>
                                    <a href="{{route('contactUs' , $restaurant->name_barcode)}}" target="__blank" id="" class=" btn">@lang('messages.view_barcode')</a>
                                    {{--                            <a class="btn btn-primary" href="{{ URL::to('/hotel/create_pdf') }}"> @lang('messages.saveAsPdf')</a>--}}
                                </h3>


                            </div>
                            <div class="form-group">
                                <label class="control-label"> @lang('dashboard.entry.enable_contact_us') </label>
                                <select name="enable_contact_us" id="" class="form-control">
                                    <option value=""></option>
                                    <option value="true" {{$restaurant->enable_contact_us == 'true' ? 'selected' : ''}}>{{trans('dashboard.yes')}}</option>

                                    <option value="false"{{$restaurant->enable_contact_us == 'false' ? 'selected' : ''}}>{{trans('dashboard.no')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label"> @lang('dashboard.enable_contact_us_links') </label>
                                <select name="enable_contact_us_links" id="" class="form-control">
                                    <option value=""></option>
                                    <option value="true" {{$restaurant->enable_contact_us_links == 'true' ? 'selected' : ''}}>{{trans('dashboard.yes')}}</option>

                                    <option value="false"{{$restaurant->enable_contact_us_links == 'false' ? 'selected' : ''}}>{{trans('dashboard.no')}}</option>
                                </select>
                            </div>

                            @if (Auth::guard('restaurant')->user()->ar == 'true')
                            <div class="form-group">
                                <label class="control-label"> @lang('messages.description_ar') </label>
                                <textarea class="textarea" name="bio_description_ar" placeholder="@lang('messages.description_ar')"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$restaurant->bio_description_ar }}</textarea>
                                @if ($errors->has('bio_description_ar'))
                                    <span class="help-block">
                                        <strong
                                            style="color: red;">{{ $errors->first('bio_description_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (Auth::guard('restaurant')->user()->en == 'true')
                            <div class="form-group">
                                <label class="control-label"> @lang('messages.description_en') </label>
                                <textarea class="textarea" name="bio_description_en" placeholder="@lang('messages.description_en')"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$restaurant->bio_description_en }}</textarea>
                                @if ($errors->has('bio_description_en'))
                                    <span class="help-block">
                                        <strong
                                            style="color: red;">{{ $errors->first('bio_description_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                          <!-- /.card-body -->

                          <div class="card-footer">
                              <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
                          </div>

                      </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>


    <!-- /.row -->
    </section>
@endsection

@section('scripts')

    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script src="{{asset('dist/js/html2canvas.min.js')}}"></script>

    <script>
        $( document ).ready(function () {
            document.getElementById("printPage").addEventListener("click", function() {
                    html2canvas(document.getElementById("barcode-svg")).then(function (canvas) {			var anchorTag = document.createElement("a");
                            document.body.appendChild(anchorTag);
                            // document.getElementById("previewImg").appendChild(canvas);
                            anchorTag.download = "{{$name}} Contact Us Page.jpg";
                            anchorTag.href = canvas.toDataURL();
                            anchorTag.target = '_blank';
                            anchorTag.click();
                        });
                });

        });
    </script>
@endsection

