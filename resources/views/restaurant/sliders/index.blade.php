@extends('restaurant.lteLayout.master')

@section('title')
    @lang('messages.sliders')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <!-- Theme style -->
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('messages.sliders')</h1>
                </div>
                <!--<div class="col-sm-6">-->
                <!--    <ol class="breadcrumb float-sm-right">-->
                <!--        <li class="breadcrumb-item">-->
            <!--            <a href="{{ url('/restaurant/home') }}">-->
            <!--                @lang('messages.control_panel')-->
                <!--            </a>-->
                <!--        </li>-->
                <!--        <li class="breadcrumb-item active">-->
            <!--            <a href="{{ route('sliders.index') }}"></a>-->
            <!--            @lang('messages.sliders')-->
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
                <h3>
                    <a href="{{ route('sliders.create') }}?type={{ request('type') }}" class="btn">
                        <i class="fa fa-plus"></i>
                        @lang('messages.add_new')
                    </a>
                </h3>
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(request('type') == 'contact_us_client')
                            <form action="{{route('sliders.title')}}" method="post" style="margin:10px 0 40px;">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">{{ trans('dashboard.slider_down_client_title') }}</label>
                                        <input type="text" class="form-control" name="slider_down_contact_us_title"
                                               value="{{$restaurant->slider_down_contact_us_title}}">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary"
                                                style="margin-top:30px;">{{ trans('dashboard.save') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        <table id="example1" class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable"
                                               data-set="#sample_1 .checkboxes"/>
                                        <span></span>
                                    </label>
                                </th>
                                <th></th>
                                <th> @lang('messages.slider_type') </th>
                                <th> @lang('messages.photo') </th>
                                @if (in_array(request('type'), ['contact_us']))
                                    <th> @lang('dashboard.entry.description_ar') </th>
                                    <th> @lang('dashboard.entry.description_en') </th>
                                @endif
                                <th> @lang('messages.activity') </th>
                                <th> @lang('messages.operations') </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($sliders as $slider)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1"/>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><?php echo ++$i; ?></td>
                                    <td>{{ trans('messages.' . $slider->type) }}</td>
                                    <td>
                                        @if ($slider->type == 'youtube')
                                            <iframe style="width:200px;" class="close-menu"
                                                    src="https://www.youtube.com/embed/{{ $slider->youtube }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        @elseif($slider->type == 'local_video')
                                            <video src="{{ asset($slider->photo) }}" controls style="width: 200px;">
                                                <source src="{{ asset($slider->photo) }}" type="video/*">
                                            </video>
                                        @else
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#modal-info-{{ $slider->id }}">
                                                <i class="fa fa-eye"></i>
                                                <img src="{{ asset('/uploads/sliders/' . $slider->photo) }}"
                                                     width="70" height="70">
                                            </button>
                                            <div class="modal fade" id="modal-info-{{ $slider->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-info">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">
                                                                @lang('messages.photo')
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ asset('/uploads/sliders/' . $slider->photo) }}"
                                                                 width="475" height="400">
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-light"
                                                                    data-dismiss="modal">
                                                                @lang('messages.close')
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @endif
                                    </td>
                                    @if (in_array(request('type'), ['contact_us']))
                                        <td>{{ $slider->description_ar }}</td>
                                        <td>{{ $slider->description_en }}</td>
                                    @endif
                                    <td>
                                        <span class="custom-switch {{$slider->stop == 'false' ? 'on' : 'off'}}"
                                              data-url_on="{{route('stopSlider' , [$slider->id , 'true'])}}"
                                              data-url_off="{{route('stopSlider' , [$slider->id , 'false'])}}">
                                            <span class="text">On</span>
                                            <span class="move"></span>
                                        </span>

                                    </td>
                                    <td>

                                        <a class="btn btn-primary"
                                           href="{{ route('sliders.edit', $slider->id) }}?type={{request('type')}}">
                                            <i class="fa fa-user-edit"></i>
                                        </a>

                                        <a class="delete_data btn btn-danger" data="{{ $slider->id }}"
                                           data_name="{{ app()->getLocale() == 'ar' ? ($slider->name_ar == null ? $slider->name_en : $slider->name_ar) : ($slider->name_en == null ? $slider->name_ar : $slider->name_en) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
    {{ $sliders->links() }}
    <!-- /.row -->
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'All'],
                ],
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('body').on('click', '.delete_data', function () {
                var id = $(this).attr('data');
                var swal_text = '{{ trans('messages.delete') }} ' + $(this).attr('data_name');
                var swal_title = "{{ trans('messages.deleteSure') }}";

                swal({
                    title: swal_title,
                    text: swal_text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "{{ trans('messages.sure') }}",
                    cancelButtonText: "{{ trans('messages.close') }}"
                }, function () {

                    window.location.href = "{{ url('/') }}" + "/restaurant/sliders/delete/" +
                        id;

                });

            });
        });
    </script>
@endsection
