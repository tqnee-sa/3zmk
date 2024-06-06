@extends('website.layout.app')

@section('content')
    <div class="mycontainer" style="background-color: {{ $restaurant->az_color?->background }} !important;">
        @include('website.layout.header')
        <!-- <main class="py-1"> -->
        <div class="show_main_info  py-3"
            style="background-color: {{ $restaurant->az_color ? $restaurant->az_color->background : '#FFF' }} !important;">
            @include('website.accessories.slider')
            <!-- end  main slider  -->
            <div class="restaurant-info">
                <div class="logo">
                    <a href="{{ route('homeBranchIndex', [$restaurant->name_barcode, $branch->name_en]) }}">
                        <img src="{{ asset('/uploads/restaurants/logo/' . $restaurant->az_logo) }}" alt=""
                            width="90" height="90" />
                    </a>
                </div>
                <div class="info">
                    <div class="title">
                        {{ $restaurant->name }}
                    </div>
                    @if ($restaurant->az_info)
                        <div class="description">
                            <span data-bs-toggle="offcanvas" data-bs-target="#restaurantDescriptionPop"
                                aria-controls="restaurantDescriptionPop" class="color-theme font-400 font-14"
                                style="color: {{ $restaurant->color == null ? '' : $restaurant->color->options_description }} !important;">
                                @if (isset($branch->id) and !empty($restaurant->az_info->description))
                                    {!! str_replace(
                                        '&nbsp;',
                                        ' ',
                                        \Illuminate\Support\Str::limit(strip_tags($restaurant->az_info->description), 128),
                                    ) !!}
                                @endif
                            </span>
                        </div>
                    @endif
                </div>
                @if ($branches->count() > 1)
                    @include('website.accessories.branch')
                @endif


            </div>


            <div class="text-center">
                <a style="color: {{ $restaurant->az_color?->options_description }} !important; background-color: {{ $restaurant->az_color ? $restaurant->az_color->icons : '#f3f0f0' }}; font-size: 13px; margin: 10px"
                    class="btn" href="{{ route('restaurantTerms', [$restaurant->name_barcode, $branch->name_en]) }}">
                    @lang('messages.terms_conditions')
                </a>
                <a style="color: {{ $restaurant->az_color?->options_description }} !important; background-color: {{ $restaurant->az_color ? $restaurant->az_color->icons : '#f3f0f0' }}; font-size: 13px; margin: 10px"
                    class="btn"
                    href="{{ route('restaurantVisitorContactUs', [$restaurant->name_barcode, $branch->name_en]) }}">
                    @lang('messages.contact_us')
                </a>
                <a style="color: {{ $restaurant->az_color?->options_description }} !important; background-color: {{ $restaurant->az_color ? $restaurant->az_color->icons : '#f3f0f0' }}; font-size: 13px; margin: 10px"
                    class="btn"
                    href="{{ route('restaurantAboutAzmak', [$restaurant->name_barcode, $branch->name_en]) }}">
                    @lang('messages.about_app')
                </a>
            </div>
            @include('website.accessories.categories')
        </div>

        <!-- end slider show main dishes -->
        <div id="restaurant-products">
            @include('website.accessories.products')
        </div>
        @include('website.includes.popup')
        <!-- </main> -->
        @include('website.layout.footer')
    </div>
@endsection
