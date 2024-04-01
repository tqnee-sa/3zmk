<header style="background-color: {{$restaurant->az_color ? $restaurant->az_color->background : ''}} !important;"
        class="bg-white p-3 d-flex align-items-center justify-content-between"
>
    <!-- show mobile -->
    <div class="mobile_screen">
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
                        <img src="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}" alt="3azmak_title"/>
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
                        <li class="my-2">
                            <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}"
                               style="color: {{$restaurant->az_color?->main_heads}} !important;">
                                <i class="fa fa-home mx-1"
                                   style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                @lang('messages.home')
                            </a>
                        </li>
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
                        <li class="my-2">
                            <a style="color: {{$restaurant->az_color?->main_heads}} !important;"
                               href="{{route('restaurantTerms' , [$restaurant->name_barcode , $branch->name_en])}}">
                                <i class="fa-solid fa-file-contract mx-2"
                                   style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                @lang('messages.terms_conditions')
                            </a>
                        </li>
                        <hr/>
                        <li class="my-2">
                            <a style="color: {{$restaurant->az_color?->main_heads}} !important;"
                               href="{{route('restaurantVisitorContactUs' , [$restaurant->name_barcode , $branch->name_en])}}">
                                <i class="fa-solid fa-envelope mx-2"
                                   style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                @lang('messages.contact_us')
                            </a>
                        </li>
                        <hr/>
                        <li class="my-2">
                            <a style="color: {{$restaurant->az_color?->main_heads}} !important;"
                               href="{{route('restaurantAboutAzmak' , [$restaurant->name_barcode , $branch->name_en])}}">
                                <i class="fa-solid fa-circle-exclamation mx-2"
                                   style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                                @lang('messages.about_app')
                            </a>
                        </li>
                        <hr/>
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
    <img src="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}" alt=""/>
    @if($restaurant->az_info and $restaurant->az_info->lang == 'both')
        <div class="icons">
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
