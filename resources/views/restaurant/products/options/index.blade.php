@extends('restaurant.lteLayout.master')

@section('title')
    @lang('messages.options')
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
                    <h1>@lang('messages.options')
                        ({{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }})</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/restaurant/home') }}">
                                @lang('messages.control_panel')
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('productOption', $product->id) }}">
                                @lang('messages.options')
                            </a>
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
                    <a href="{{ route('createProductOption', $product->id) }}" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        @lang('messages.add_new')
                    </a>

                </h3>
                <form action="{{ route('deleteAllProductOption' , $product->id) }}" method="post"
                      style="margin-bottom: 20px;" class="form-delete-all">
                    @csrf
                    @method('delete')
                    <div class="hidden-input">

                    </div>
                    <button type="submit" class="btn btn-danger delete-all" style="display: none">
                        <i class="fa fa-trash"></i>
                        @lang('messages.delete') <span class="count"></span>
                    </button>
                </form>

                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
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
                                <th> @lang('messages.product') </th>
                                <th> @lang('messages.option') </th>
                                <th> @lang('messages.modifier') </th>
                                <th> @lang('messages.min') </th>
                                <th> @lang('messages.max') </th>

                                <th> @lang('messages.operations') </th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($options as $option)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="{{$option->id}}"/>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        {{ app()->getLocale() == 'ar' ? ($product->name_ar == null ? $product->name_en : $product->name_ar) : ($product->name_en == null ? $product->name_ar : $product->name_en) }}
                                    </td>
                                    <td>
                                        {{ app()->getLocale() == 'ar' ? ($option->option->name_ar == null ? $option->option->name_en : $option->option->name_ar) : ($option->option->name_en == null ? $option->option->name_ar : $option->option->name_en) }}
                                    </td>
                                    <td>
                                        {{ app()->getLocale() == 'ar' ? ($option->option->modifier->name_ar == null ? $option->option->modifier->name_en : $option->option->modifier->name_ar) : ($option->option->modifier->name_en == null ? $option->option->modifier->name_ar : $option->option->modifier->name_en) }}
                                    </td>
                                    <td> {{ $option->min }} </td>
                                    <td> {{ $option->max }} </td>
                                    @if ($product->branch->foodics_status == 'false')
                                        <td>
                                            <a class="btn btn-info"
                                               href="{{ route('editProductOption', $option->id) }}">
                                                <i class="fa fa-user-edit"></i> @lang('messages.edit')
                                            </a>
                                            @php
                                                $user = Auth::guard('restaurant')->user();
                                                $deletePermission = \App\Models\RestaurantPermission::whereRestaurantId($user->id)
                                                    ->wherePermissionId(7)
                                                    ->first();
                                            @endphp
                                            @if ($user->type == 'restaurant' or $deletePermission)
                                                <a class="delete_data btn btn-danger" data="{{ $option->id }}"
                                                   data_name="{{ app()->getLocale() == 'ar' ? ($option->option->name_ar == null ? $option->option->name_en : $option->option->name_ar) : ($option->option->name_en == null ? $option->option->name_ar : $option->option->name_en) }}">
                                                    <i class="fa fa-key"></i> @lang('messages.delete')
                                                </a>
                                            @endif

                                        </td>
                                    @else
                                        <td>

                                            <a class="delete_data btn btn-danger" data="{{ $option->id }}"
                                               data_name="{{ app()->getLocale() == 'ar' ? ($option->option->name_ar == null ? $option->option->name_en : $option->option->name_ar) : ($option->option->name_en == null ? $option->option->name_ar : $option->option->name_en) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    @endif
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

            $('table input[type=checkbox].group-checkable').on('click', function () {
                var tag = $(this);
                var checkboxs = tag.parent().parent().parent().parent().parent().find(
                    'tbody tr td:first-child input.checkboxes');
                // console.log(checkboxs);
                console.log(checkboxs.length);
                $.each(checkboxs, function (k, v) {
                    var item = $(v);
                    item.prop('checked', tag.prop('checked'));
                });
                var checked = tag.parent().parent().parent().parent().parent().find(
                    'tbody tr td:first-child input.checkboxes:checked');
                var content = '';
                $.each(checked, function (k, v) {
                    var item = $(v);
                    content += '<input type="hidden" name="ids[]" value="' + item.val() + '">';
                });
                $('.form-delete-all .hidden-input').html(content);
                if (checked.length > 0) {
                    $('.delete-all span').html('( ' + checked.length + ' )');
                    $('.delete-all').fadeIn(300);
                } else {
                    $('.delete-all').fadeOut(300);
                }
            });
            $('table').on('click', 'tbody tr td:first-child input.checkboxes', function () {
                var tag = $(this);
                var checked = tag.parent().parent().parent().parent().parent().find(
                    'tbody tr td:first-child input.checkboxes:checked');
                var content = '';
                $.each(checked, function (k, v) {
                    var item = $(v);
                    content += '<input type="hidden" name="ids[]" value="' + item.val() + '">';
                });
                $('.form-delete-all .hidden-input').html(content);
                if (checked.length > 0) {
                    $('.delete-all span').html('( ' + checked.length + ' )');
                    $('.delete-all').fadeIn(300);
                } else {
                    $('.delete-all').fadeOut(300);
                }
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

                    window.location.href = "{{ url('/') }}" +
                        "/restaurant/product_options/delete/" + id;

                });

            });
        });
    </script>
@endsection
