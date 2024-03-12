<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{$restaurant->name_ar}}</title>
    <!-- //font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400&display=swap"
        rel="stylesheet"
    />
    <link type="text/css" rel="icon" href="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}"  type="image/x-icon">

    <!-- icons -->
    <link rel="stylesheet" href="{{asset('site/css/all.min.css')}}"/>
    <!-- //bootstrap -->
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}"/>
    <!-- //main sytle -->
    <link rel="stylesheet" href="{{asset('site/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/home.css')}}"/>
</head>
<body>
<div class="mycontainer">
    <div class="main_open">
        <div class="image">
            <img src="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}" width="150" height="100"
                 alt="3azmak_title"/>
        </div>
        <div>
            @php
                $checkRestaurantSubscription = App\Models\AzSubscription::whereRestaurantId($restaurant->id)->first();
            @endphp
            @if($checkRestaurantSubscription and ($checkRestaurantSubscription->status == 'active' or $checkRestaurantSubscription->status == 'free'))
                <p>@lang('messages.az_welcome')</p>
                <div>
                    @if($branches->count() == 1)
                        @php
                            $branch = \App\Models\Restaurant\Azmak\AZBranch::whereRestaurantId($restaurant->id)->first();
                        @endphp
                        <a
                            href="{{route('homeBranch' , $branch->id)}}"
                            class="btn btn_custom"
                        >
                            <i class="fa-solid fa-angle-right"></i>
                            <span> @lang('messages.continue') </span>
                        </a>

                    @elseif($branches->count() > 1)
                        <button
                            class="btn btn_custom"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasBottom"
                            aria-controls="offcanvasBottom"
                        >
                            <i class="fa-solid fa-angle-right"></i>
                            <span> @lang('messages.continue') </span>
                        </button>

                    @endif
                    <div class="offcanvas offcanvas-bottom"
                         tabindex="-1"
                         id="offcanvasBottom"
                         aria-labelledby="offcanvasBottomLabel">

                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasBottomLabel">
                                @lang('messages.choose_branch')
                            </h5>
                            <button
                                type="button"
                                class="btn-close text-reset"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="offcanvas-body small">
                            <form method="post" action="{{route('homeBranch')}}">
                                @csrf
                                @if($branches->count() == 1)
                                    @foreach($branches as $branch)
                                        <div>
                                            <input
                                                type="hidden"
                                                id="city{{$branch->id}}"
                                                name="branch"
                                                value="{{$branch->id}}"
                                            />
                                        </div>
                                        <hr/>
                                    @endforeach
                                @elseif($branches->count() > 1)
                                    @foreach($branches as $branch)
                                        <div>
                                            <input
                                                type="radio"
                                                id="city{{$branch->id}}"
                                                name="branch"
                                                value="{{$branch->id}}"
                                                required
                                            />
                                            <label for="city{{$branch->id}}">
                                                {{app()->getLocale() == 'ar' ? $branch->name_ar : $branch->name_en}}
                                                ({{app()->getLocale() == 'ar' ? $branch->city->name_ar : $branch->city->name_en}}
                                                )
                                            </label>
                                        </div>
                                        <hr/>
                                    @endforeach
                                @endif
                                <input type="submit" value="@lang('messages.continue')"/>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif($checkRestaurantSubscription and $checkRestaurantSubscription->status == 'finished')
                <p style="color: red"> @lang('messages.finished_subscription') </p>
                <p style="font-size:50px">&#128546;</p>
            @elseif($checkRestaurantSubscription == null)
                <p style="color: red"> @lang('messages.notSubscribedYet') </p>
                <p style="font-size:50px">&#128522;</p>
            @endif
        </div>
    </div>
</div>

<script src="{{asset('site/js/file.js')}}"></script>
<script src="{{asset('site/js/bootstrap.bundle.js')}}"></script>
</body>
</html>
