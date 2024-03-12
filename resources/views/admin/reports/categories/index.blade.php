@extends('admin.lteLayout.master')

@section('title')
    @lang('messages.control_panel')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <!--<div class="content-header">-->
    <!--    <div class="container-fluid">-->
    <!--        <div class="row mb-2">-->
    <!--            <div class="col-sm-6">-->
    <!--                <h1 class="m-0 text-dark">@lang('messages.control_panel')</h1>-->
    <!--            </div><!-- /.col 
    <!--            <div class="col-sm-6">-->
    <!--                <ol class="breadcrumb float-sm-right">-->
    <!--                    <li class="breadcrumb-item"><a href="#">@lang('messages.control_panel')</a></li>-->
    <!--                    {{--                        <li class="breadcrumb-item active">Dashboard v1</li>--}}-->
    <!--                </ol>-->
    <!--            </div>-->
                <!-- /.col -->
    <!--        </div><!-- /.row 
    <!--    </div><!-- /.container-fluid 
    <!--</div>-->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h3 class="text-center"> @lang('messages.restaurant_categories_reports') </h3>
            <br>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-6">
                        <a href="{{url('/admin/category_restaurants/'.$category->id)}}" style="color: black"
                               >
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                 <p>
                                    {{app()->getLocale() == 'ar' ? $category->name_ar: $category->name_en }}
                                </p>
                                <h3 class="text-center">
                                    {{$category->restaurant_categories->count()}}
                                    
                                </h3>

                               
                            </div>
{{--                            <div class="icon">--}}
{{--                                <i class="fa fa-calculator" style="color: black"></i>--}}
{{--                            </div>--}}
                            
                        </div>
                                                        </a>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
<style>
   
    .col-lg-3  {
     transtion:all 0.3s linear;
    }
    .col-lg-3:hover {
            /*background-color:red;*/
    transform: translateY(-0.5rem);
    }
     a{
        color:black !important;
    }
    a:hover {
       text-decoration :none  !important;}
        .small-box{
                height:89%;
    }
      
</style>
