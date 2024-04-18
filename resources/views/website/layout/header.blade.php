<header class=" p-3 d-flex align-items-center justify-content-between"
        id="header"
>
    <!-- show mobile -->
    <div class="mobile_screen bars_class">
        <button
            class="btn"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"
        >
            <i class="fa-solid fa-bars"></i>
        </button>

        <div
            class="offcanvas offcanvas-end offcanvas_mobile"
            style="background-color: {{$restaurant->az_color ? $restaurant->az_color->background : ''}} !important;"
            tabindex="-1"
            id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel"
        >
            <div class="offcanvas-header">
                <button
                    type="button"
                    class="btn-close text-reset"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"
                ></button>
            </div>
            <div class="offcanvas-body">
                <div class="container_ifno">
                    <div class="image">
                        <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}">
                            <img src="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}"
                                 alt="3azmak_title"/>
                        </a>
                    </div>
                    @if(auth()->guard('web')->check())
                        <h2 class="name" style="color: {{$restaurant->az_color?->main_heads}} !important;">
                            {{auth()->guard('web')->user()->name}}
                        </h2>
                    @else
                        <button class="{{$restaurant->az_color == null ? 'joinUs_btn' : 'btn'}}"
                                style="background-color: {{$restaurant->az_color?->icons}} !important; width: 135px">
                            <a href="{{route('AZUserLogin' , [$restaurant->name_barcode , $branch->name_en])}}">
                                @lang('messages.login')
                            </a>
                        </button>
                    @endif
                    <ul class="p-0">
                        <hr/>
                        @if(auth()->guard('web')->check())
                            <li class="my-2">
                                <a style="color: {{$restaurant->az_color ? $restaurant->az_color->main_heads : ''}} !important;"
                                   href="{{route('AZUserOrders',$branch->id)}}">
                                    <i class="fa fa-shopping-cart mx-1"
                                       style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    @lang('messages.my_orders')
                                    <span style="color: red">
                                       ({{ \App\Models\Restaurant\Azmak\AZOrder::whereUserId(auth()->guard('web')->user()->id)->where('status' , '!=' , 'new')->whereBranchId($branch->id)->count() }})
                                    </span>
                                </a>
                            </li>
                            <hr>
                            <li class="my-2">
                                <a style="color: {{$restaurant->az_color ? $restaurant->az_color->main_heads : ''}} !important;"
                                   href="{{route('AZUserProfile' , [$restaurant->name_barcode , $branch->name_en])}}">
                                    <i class="fa-regular fa-user mx-1"
                                       style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                    @lang('messages.my_account')
                                </a>
                            </li>
                            <hr/>
                        @endif
                    </ul>
                    @if(auth()->guard('web')->check())
                        {{--                        <a href="#" class="joinUs_btn">--}}
                        {{--                            @lang('messages.logout')--}}
                        {{--                        </a>--}}
                        <a style="color: {{$restaurant->az_color?->main_heads}} !important;"
                           onclick="document.getElementById('logout_form').submit()" class="dropdown-item">
                            <i class="fas fa-key"
                               style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                            @lang('messages.logout')
                        </a>
                        <form style="display: none;" id="logout_form"
                              action="{{ route('azUser.logout' , [$restaurant->name_barcode , $branch->name_en]) }}"
                              method="post">
                            {!! csrf_field() !!}
                        </form>
                    @else
                        {{--                        <button class="joinUs_btn">--}}
                        {{--                            <a href="{{route('AZUserRegister' , [$restaurant->name_barcode , $branch->name_en])}}">--}}
                        {{--                                <i class="fa-regular fa-star mx-1"></i>--}}
                        {{--                                @lang('messages.join_us')--}}
                        {{--                            </a>--}}
                        {{--                        </button>--}}
                    @endif
                </div>
            </div>
        </div>
    </div>
        <button
            style="background-color: {{$restaurant->az_color?->icons}} !important;"
            class="btn btn_custom branch_class"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom"
        >
            <i class="fa fa-map-marker-alt"></i>
            {{app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en}}
        </button>
    @if($restaurant->az_info and $restaurant->az_info->lang == 'both')
        <div class="d-flex align-items-center justify-content-between  p-3 lang">
            @if(app()->getLocale() == 'ar')
                <a href="{{route('language' , 'en')}}">
                    En
                </a>
            @else
                <a href="{{route('language' , 'ar')}}">
                    ع
                </a>
            @endif
        </div>
    @endif
</header>
<style>
    .mobile_screen .container_ifno .image img {
        width: 100px;
        height: 90px;
        margin-right: 30px;
        margin-top: 50px;
    }

    #header {
        position: absolute;
        z-index: 100;
        box-shadow: none;
        margin-top: -15px;
    }

    .lang {
        position: absolute;
        top: 19px;
        right: 430px;
        padding: 5px;
        height: 25px;
        font-size: 12px;
        border-radius: 7px;
        box-shadow: 1px 1px 1px 1px lightblue;
        background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : '#ebebeb'}}  !important;
    }

    .branch_class {
        position: absolute;
        top: 19px;
        right: 195px;
        padding: 5px;
        width: 96px;
        height: 35px;
        border-radius: 7px;
        box-shadow: 1px 1px 1px 1px lightblue;
        background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : '#ebebeb'}}  !important;
    }

    .bars_class {
        position: absolute;
        top: 15px;
        right: 4px;
        font-size: 15px;
        border-radius: 7px;
        box-shadow: 1px 1px 1px 1px lightblue;
        background-color: {{$restaurant->az_color ? $restaurant->az_color->icons : '#ebebeb'}}  !important;
    }

    @media only screen and (max-width: 768px) {
        /* For mobile phones: */
        .branch_class {
            right: 150px;
        }

        .lang {
            right: 350px;
        }
    }
</style>
