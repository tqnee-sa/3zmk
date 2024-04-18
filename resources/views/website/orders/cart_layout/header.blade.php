<header
    class="d-flex align-items-center justify-content-between bg-white p-3"
>
    <a href="{{route('homeBranchIndex' , [$restaurant->name_barcode , $branch->name_en])}}" style='color: black'>
        <i class="fa-solid fa-angle-right"></i>
    </a>
    <h5>
        @yield('header_title')
    </h5>
    @if(app()->getLocale() == 'ar')
        <a href="{{route('language' , 'en')}}">
            En
        </a>
    @else
        <a href="{{route('language' , 'ar')}}">
            ع
        </a>
    @endif
</header>
