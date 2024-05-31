<h3 class="text-center main-category-title">{{$menuCategory->name}}</h3>
<div id="main-subcategories">
    @php
        $subCat = isset($subCategory->id) ? $subCategory->id : 0;
    @endphp
    @if ($menuCategory != null)
        @if ($menuCategory->active == 'true')
            @if ($menuCategory->time == 'true')
                @if (check_time_between($menuCategory->start_at, $menuCategory->end_at))
                    <div>
                        <div class="col-12 mb-2 text-center">
                            <p class="font-14 color-theme mb-1"
                                style="color: {{ $menuCategory->restaurant->color == null ? '' : $menuCategory->restaurant->color->options_description }} !important">
                                @if ($menuCategory->description_ar || $menuCategory->description_en)
                                    <a data-bs-toggle="offcanvas"
                                        aria-controls="menuCategoryDescription{{ $menuCategory->id }}"
                                        data-bs-target="#menuCategoryDescription{{ $menuCategory->id }}">
                                        {!! app()->getLocale() == 'ar'
                                            ? \Illuminate\Support\Str::limit($menuCategory->description_ar, 30)
                                            : \Illuminate\Support\Str::limit($menuCategory->description_en, 30) !!}
                                    </a>
                                    <div style="background-color: {{ $restaurant->az_color?->background }} !important;"
                                        class="offcanvas offcanvas-bottom" tabindex="-1"
                                        id="menuCategoryDescription{{ $menuCategory->id }}"
                                        aria-labelledby="menuCategoryDescription{{ $menuCategory->id }}Label">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title"
                                                id="menuCategoryDescription{{ $menuCategory->id }}Label"
                                                style="color: {{ $restaurant->az_color?->main_heads }} !important;">
                                             {{$menuCategory->name}}
                                            </h5>
                                            <button type="button" class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>

                                        <div class="offcanvas-body small">
                                            {!! $menuCategory->description !!}
                                        </div>
                                    </div>
                                @endif
                            </p>
                        </div>

                        <div>
                            <div class="scroll-container text-center  mb-2">
                                <div class="scroll-box">
                                    @if ($menuCategory != null)
                                        @if ($menuCategory->sub_categories->count() > 0)
                                            @foreach ($menuCategory->sub_categories as $sub)
                                                @php
                                                    if ($subCat == $sub->id) {
                                                        $selectCategory = $sub;
                                                    }
                                                @endphp
                                                <div class="item ">
                                                    <div id="subcat-{{ $sub->id }}" data-card-height="150"
                                                        class=" pr-3 card mb-0 bg-theme rounded-s  bord-all2 subcat-card {{ $subCat == $sub->id ? 'active' : '' }}"
                                                        style="background-color: {{ $restaurant->color == null ? '' : $restaurant->color->product_background }} !important; border-color: {{ $restaurant->color == null ? '#f7b538' : $restaurant->color->icons }}  !important;">
                                                        <a class="{{ $subCat == $sub->id ? 'active' : '' }}"
                                                            href="javascript:;" data-id="{{ $sub->id }}">
                                                            <div class="card-center mb-0 ">
                                                                <div class="sub-category-image">
                                                                    @if (empty($sub->image))
                                                                        <img src="{{ asset($restaurant->image_path) }}"
                                                                            alt="">
                                                                    @else
                                                                        <img src="{{ asset($sub->image_path) }}"
                                                                            alt="">
                                                                    @endif
                                                                </div>
                                                                <label
                                                                    style="cursor: pointer; color: {{ $restaurant->color == null ? '' : $restaurant->color->main_heads }} !important"
                                                                    class="color-dark1-dark ">
                                                                    {{ app()->getLocale() == 'ar' ? $sub->name_ar : $sub->name_en }}

                                                                    {{-- <span
                                                                style="color: {{$restaurant->color == null ? '' : $restaurant->color->main_heads}} !important">
                                                                {{app()->getLocale() == 'ar' ? $sub->name_ar : $sub->name_en}}
                                                            </span> --}}
                                                                </label>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    @endif
                                </div>

                            </div>
                            <br>
                        </div>
                    </div>
                @endif
            @else
                <div>
                    <div class="col-12 mb-2 text-center">
                        <p class="font-14 color-theme mb-1"
                            style="color: {{ $menuCategory->restaurant->color == null ? '' : $menuCategory->restaurant->color->options_description }} !important">
                            @if ($menuCategory->description_ar || $menuCategory->description_en)

                                @if (checkWordsCount($menuCategory->description, 14, true))
                                    {{ getShortDescription($menuCategory->description, 0, 14, true) }} ...
                                    <a href="javascript:;" data-toggle="modal" class="btn-custom-modal"
                                        data-bs-toggle="offcanvas"
                                        aria-controls="menuCategoryDescription{{ $menuCategory->id }}"
                                        data-bs-target="#menuCategoryDescription{{ $menuCategory->id }}">{{ trans('messages.more') }}</a>

                                    <div style="background-color: {{ $restaurant->az_color?->background }} !important;"
                                        class="offcanvas offcanvas-bottom" tabindex="-1"
                                        id="menuCategoryDescription{{ $menuCategory->id }}"
                                        aria-labelledby="menuCategoryDescription{{ $menuCategory->id }}Label">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title"
                                                id="menuCategoryDescription{{ $menuCategory->id }}Label"
                                                style="color: {{ $restaurant->az_color?->main_heads }} !important;">
                                             {{$menuCategory->name}}
                                            </h5>
                                            <button type="button" class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>

                                        <div class="offcanvas-body small">
                                            {!! $menuCategory->description !!}
                                        </div>
                                    </div>
                                @else
                                    {!! $menuCategory->description !!}
                                @endif

                            @endif
                        </p>
                    </div>

                    <div>
                        <div class="scroll-box  mb-2">
                            @if ($menuCategory != null)
                                @if ($menuCategory->sub_categories->count() > 0)
                                    @foreach ($menuCategory->sub_categories as $sub)
                                        @php
                                            if ($subCat == $sub->id) {
                                                $selectCategory = $sub;
                                            }
                                        @endphp
                                        <div class="item">
                                            <div id="subcat-{{ $sub->id }}" data-card-height="150"
                                                class=" pr-3 card mb-0 bg-theme rounded-s subcat-card    {{ $subCat == $sub->id ? 'active' : '' }}"
                                                style="background-color: {{ $restaurant->color == null ? '' : $restaurant->color->product_background }} !important; ">
                                                <a class="{{ $subCat == $sub->id ? 'active' : '' }}"
                                                    href="javascript:;" data-id="{{ $sub->id }}">

                                                    <div class="sub-category-image">
                                                        @if (empty($sub->image))
                                                            <img src="{{ asset($restaurant->image_path) }}"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset($sub->image_path) }}" alt="">
                                                        @endif
                                                    </div>
                                                    <label
                                                        style="cursor: pointer;color: {{ $restaurant->color == null ? '' : $restaurant->color->main_heads }} !important"
                                                        class="color-dark1-dark ">
                                                        {{ app()->getLocale() == 'ar' ? $sub->name_ar : $sub->name_en }}

                                                    </label>

                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            @endif
                        </div>


                    </div>
                </div>
            @endif
        @endif
    @endif

</div>
