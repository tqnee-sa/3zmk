<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        @lang('messages.contact_us')
    </title>
    <!-- //font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400&display=swap"
        rel="stylesheet"
    />
    <link type="text/css" rel="icon" href="{{asset('/uploads/restaurants/logo/' . $restaurant->az_logo)}}"  type="image/x-icon">

    <!-- //bootstrap -->
    <link rel="stylesheet" href="{{asset('site/css/bootstrap-grid.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}"/>
    <!-- fontawsome -->
    <link rel="stylesheet" href="{{asset('site/css/all.min.css')}}"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="{{asset('site/css/global.css')}}"/>
    <style>
        .container_form {
            border-radius: 8px !important;
        }
    </style>
</head>
<body>
<div class="mycontainer contact_us" style="background-color: {{$restaurant->az_color?->background}} !important;">
    <header
        class="d-flex align-items-center justify-content-between p-3 {{$restaurant->az_color == null ? 'bg-white' : ''}}"
    >
        <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}" style='color: black'>
            <i class="fa-solid fa-angle-right"></i>
        </a>
        <h5 style="color: {{$restaurant->az_color?->main_heads}} !important;">
            @lang('messages.contact_us')
        </h5>
        <i class="fa-regular fa-"></i>
    </header>
    @include('flash::message')
    <main>
        <form method="post" action="{{route('restaurantVisitorContactUsSend' , $restaurant->name_barcode)}}">
            @csrf
            <div class=" m-3 py-4 px-3 container_form {{$restaurant->az_color == null ? 'bg-white' : ''}}">
                <div class="name">
                    <label for="name" style="color: {{$restaurant->az_color?->main_heads}} !important;">
                        @lang('messages.name') :
                    </label>
                    <div class="container_input">
                        <i class="fa fa-user" style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                        <input type="text" id="name" name="name" placeholder="@lang('messages.name')" style="background-color: {{$restaurant->az_color?->background}} !important;"/>
                    </div>
                </div>
                <div class="email">
                    <label for="name" style="color: {{$restaurant->az_color?->main_heads}} !important;">
                        @lang('messages.email') :
                    </label>
                    <div class="container_input">
                        <i class="fa-solid fa-envelope"
                           style="color: {{$restaurant->az_color?->icons}} !important;"></i>
                        <input
                            name="email"
                            type="email"
                            id="email"
                            placeholder="@lang('messages.email')"
                            style="background-color: {{$restaurant->az_color?->background}} !important;"
                        />
                    </div>
                </div>
                <div class="message">
                    <label for="message" style="color: {{$restaurant->az_color?->main_heads}} !important;">
                        @lang('messages.message') :
                    </label>
                    <div class="container_input">
                        <textarea
                            id="message"
                            style="background-color: {{$restaurant->az_color?->background}} !important;"
                            name="message"
                            placeholder="@lang('messages.message')"
                            rows="5"></textarea>
                    </div>
                </div>
            </div>
            <input type="submit" value="@lang('messages.send')" style="background-color: {{$restaurant->az_color?->icons}} !important;"/>
        </form>
    </main>
    @include('website.layout.footer')
</div>
</body>
</html>
