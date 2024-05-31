<style>
    .poster_image {
        position: absolute;
        top: 5px;
        width: 20px !important;
        height: 20px !important;
        left: 5px;
    }
</style>
@php
    $selectedCategory = null;
@endphp
<div id="main-categories">
    <div class="splide">
        <div class="splide__slider">
            <div class="splide__track">
                <div class="splide__list">
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            @php
                                if ($category_id == $category->id) {
                                    $selectedCategory = $category;
                                }
                            @endphp
                            @if ($category->time == 'false')
                                <div class="splide__slide">
                                    <div class="main-category">
                                        <div
                                            class="card__image {{ $category->id == $category_id ? 'active_category' : '' }}">
                                            <a href="javascript:;" id="{{ $category->id }}" class="category_item" data-url="{{ route('homeBranchIndex', [$restaurant->name_barcode, $branch->name_en, $category->id]) }}">
                                                <img src="{{ asset('/uploads/menu_categories/' . $category->photo) }}"
                                                    alt="image" width="200" height="200" class="card__img" />
                                                @if ($category->poster != null)
                                                    <img style="text-align: right"
                                                        src="{{ asset('/uploads/posters/' . $category->poster->poster) }}"
                                                        height="10" width="10" class="poster_image">
                                                @endif
                                            </a>
                                        </div>

                                        <div class="card__data">
                                            <h5 class="card__name">
                                                <a href="javascript:;" id="{{ $category->id }}" class="category_item"
                                                    data-url="{{ route('homeBranchIndex', [$restaurant->name_barcode, $branch->name_en, $category->id]) }}"
                                                    style="color: {{ $restaurant->az_color ? $restaurant->az_color->main_heads : '' }} !important;">
                                                    {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @elseif($category->time == 'true' and check_time_between($category->start_at, $category->end_at))
                                <div class="splide__slide">
                                    <div class="main-category ">
                                        <div
                                            class="card__image {{ $category->id == $category_id ? 'active_category' : '' }}">
                                            <a href="javascript:;" id="{{ $category->id }}" class="category_item" data-url="{{ route('homeBranchIndex', [$restaurant->name_barcode, $branch->name_en, $category->id]) }}">
                                                <img src="{{ asset('/uploads/menu_categories/' . $category->photo) }}"
                                                    alt="image" class="card__img" />
                                                @if ($category->poster != null)
                                                    <img style="text-align: right"
                                                        src="{{ asset('/uploads/posters/' . $category->poster->poster) }}"
                                                        height="10" width="10" class="poster_image">
                                                @endif
                                            </a>
                                        </div>

                                        <div class="card__data">
                                            <h5 class="card__name">
                                                <a href="javascript:;" id="{{ $category->id }}" class="category_item" data-url="{{ route('homeBranchIndex', [$restaurant->name_barcode, $branch->name_en, $category->id]) }}">
                                                    {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div id="subcategories-content">

        @include('website.accessories.sub_categories', ['menu_category' => $category, 'subCat' => 0])

    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

    });
</script>
