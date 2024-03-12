@extends('restaurant.lteLayout.master')

@section('title')
    @lang('messages.sub_categories')
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
                    <h1>@lang('messages.sub_categories') ({{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/restaurant/home') }}">
                                @lang('messages.control_panel')
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('sub_categories.index', $category->id) }}"></a>
                            @lang('messages.sub_categories') ({{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }})
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <h3>
                    <a href="{{ route('sub_categories.create', $category->id) }}" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        @lang('messages.add_new')
                    </a>
                </h3>
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable"
                                                data-set="#sample_1 .checkboxes" />
                                            <span></span>
                                        </label>
                                    </th>
                                    <th></th>
                                    <th>{{ trans('messages.image') }}</th>
                                    <th> @lang('messages.name') </th>
                                    <th> @lang('messages.operations') </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($sub_categories as $sub_category)
                                    <tr class="odd gradeX">
                                        <td>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="checkboxes" value="1" />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td><?php echo ++$i; ?></td>
                                        <td>
                                            @if(!empty($sub_category->image))
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-info-{{ $sub_category->id }}">
                                                <i class="fa fa-eye"></i>
                                                <img src="{{ asset($sub_category->image_path) }}"
                                                    width="100" height="100">
                                            </button>
                                            <div class="modal fade" id="modal-info-{{ $sub_category->id }}">
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
                                                            @if ($sub_category->foodics_image != null)
                                                                <img src="{{ $sub_category->foodics_image }}"
                                                                    width="475" height="400">
                                                            @else
                                                                <img src="{{ asset($sub_category->image_path) }}"
                                                                    width="475" height="400">
                                                            @endif
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

                                        <td>
                                            {{ app()->getLocale() == 'ar' ? ($sub_category->name_ar == null ? $sub_category->name_en : $sub_category->name_ar) : ($sub_category->name_en == null ? $sub_category->name_ar : $sub_category->name_en) }}
                                        </td>
                                        <td>

                                            <a class="btn btn-info"
                                                href="{{ route('sub_categories.edit', $sub_category->id) }}">
                                                <i class="fa fa-user-edit"></i>
                                            </a>
                                            <a class="delete_data btn btn-danger" data="{{ $sub_category->id }}"
                                                data_name="{{ app()->getLocale() == 'ar' ? ($sub_category->name_ar == null ? $sub_category->name_en : $sub_category->name_ar) : ($sub_category->name_en == null ? $sub_category->name_ar : $sub_category->name_en) }}">
                                                <i class="fa fa-key"></i>
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
        {{ $sub_categories->links() }}

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
        $(function() {
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
        $(document).ready(function() {
            $('body').on('click', '.delete_data', function() {
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
                }, function() {

                    window.location.href = "{{ url('/') }}" +
                        "/restaurant/sub_categories/delete/" + id;

                });

            });
        });
    </script>
@endsection
