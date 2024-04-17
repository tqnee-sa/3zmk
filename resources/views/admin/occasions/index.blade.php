@extends('admin.lteLayout.master')

@section('title')
    @lang('messages.occasions')
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
                    <h1>@lang('messages.occasions')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <h3>
                    <a href="{{ route('occasions.create') }}" class="btn btn-secondary">
                        <i class="fa fa-plus"></i>
                        @lang('messages.add_new')
                    </a>
                </h3>
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
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
                                <th> @lang('messages.name') </th>
                                <th> @lang('messages.photo') </th>
                                <th> @lang('messages.operations') </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($occasions as $occasion)
                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1"/>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><?php echo ++$i; ?></td>
                                    <td>
                                        {{app()->getLocale() == 'ar' ? $occasion->name_ar : $occasion->name_en}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-info-{{ $occasion->id }}">
                                            <i class="fa fa-eye"></i>
                                            <img src="{{ asset('/uploads/occasions/' . $occasion->icon) }}"
                                                 width="70" height="70">
                                        </button>
                                        <div class="modal fade" id="modal-info-{{ $occasion->id }}">
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
                                                        <img src="{{ asset('/uploads/occasions/' . $occasion->icon) }}"
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
                                    </td>
                                    <td>
                                        @if($occasion->id != 7)
                                            <a class="btn btn-primary"
                                               href="{{ route('occasions.edit', $occasion->id)}}">
                                                <i class="fa fa-user-edit"></i>
                                            </a>
                                            <a class="delete_data btn btn-danger" data="{{ $occasion->id }}"
                                               data_name="{{ app()->getLocale() == 'ar' ? ($occasion->name_ar == null ? $occasion->name_en : $occasion->name_ar) : ($occasion->name_en == null ? $occasion->name_ar : $occasion->name_en) }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        @endif
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
    {!! $occasions->withQueryString()->links('pagination::bootstrap-5') !!}
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

                    window.location.href = "{{ url('/') }}" + "/admin/occasions/delete/" +
                        id;

                });

            });
        });
    </script>
@endsection
