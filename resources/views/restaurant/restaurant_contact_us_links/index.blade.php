@extends('restaurant.lteLayout.master')

@section('title')
    @lang('dashboard.link_contact_us')
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <!-- Theme style -->
    <style>
        .image-preview {
            width: 100px;
            padding: 5px;
            box-shadow: 1px 1px 10px #CCC;
            border-radius: 10px;
        }

        .image-preview img {
            width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.link_contact_us')</h1>
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
                <h3>
                    <a href="{{route('restaurant.link_contact_us.create')}}" class="btn ">
                        <i class="fa fa-plus"></i>
                        @lang('messages.add_new')
                    </a>
                </h3>
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table  table-striped">
                            <thead>
                            <tr>
                                
                                <th> @lang('dashboard.entry.name_ar') </th>
                                <th> @lang('dashboard.entry.name_en') </th>
                                <th> @lang('dashboard.entry.barcode') </th>
                                <th> @lang('dashboard.entry.status') </th>
                                <th> @lang('dashboard.entry.created_at') </th>
                                <th> @lang('messages.operations') </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($contactUs as $index => $item)
                                
                                    <td>{{$item->name_ar}}</td>
                                    <td>{{$item->name_en}}</td>
                                    <td>
                                        <a href="{{route('restaurant.link_contact_us.show' , $item->id)}}">{{$item->barcode}}</a>
                                    </td>
                                    <td>
                                        @if($item->status == 'true') <a href="{{route('restaurant.link_contact_us.changeStatus' , $item->id)}}?status=false"
                                            class="badge badge-success">{{ trans('dashboard.true') }}</a>
                                        @else  <a href="{{route('restaurant.link_contact_us.changeStatus' , $item->id)}}?status=true" class="badge badge-secondary">{{ trans('dashboard.false') }}</a>
                                        @endif
                                    </td>
                                    
                                    {{-- <td>{{ trans('dashboard.entry.sort') }}</td> --}}
                                    <td>{{date('Y-m-d h:i A' , strtotime($item->created_at))}}</td>

                                    <td>
                                        <a class="btn btn-primary"
                                           href="{{route('restaurant.link_contact_us.edit' , $item->id)}}">
                                            <i class="fa fa-user-edit"></i>
                                        </a>
                                        @php
                                            $user = Auth::guard('restaurant')->user();
                                            $deletePermission = \App\Models\RestaurantPermission::whereRestaurantId($user->id)
                                            ->wherePermissionId(7)
                                            ->first();
                                        @endphp
                                        @if($user->type == 'restaurant' or $deletePermission)
                                            <a class="delete_data btn btn-danger" data="{{ $item->id }}"
                                               data_name="{{$item->name}}">
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
    {{$contactUs->links()}}

    <!-- /.row -->
    </section>
@endsection

@section('scripts')

    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
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
                var swal_text = '{{trans('messages.delete')}} ' + $(this).attr('data_name');
                var swal_title = "{{trans('messages.deleteSure')}}";

                swal({
                    title: swal_title,
                    text: swal_text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "{{trans('messages.sure')}}",
                    cancelButtonText: "{{trans('messages.close')}}"
                }, function () {

                    window.location.href = "{{ url('/') }}" + "/restaurant/link_contact_us/delete/" + id;

                });

            });
        });
    </script>
@endsection

