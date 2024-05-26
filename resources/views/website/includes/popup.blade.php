<div style="background-color: {{ $restaurant->az_color?->background }} !important;" class="offcanvas offcanvas-bottom"
    tabindex="-1" id="restaurantDescriptionPop" aria-labelledby="restaurantDescriptionPopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="restaurantDescriptionPopLabel"
            style="color: {{ $restaurant->az_color?->main_heads }} !important;">
            @lang('messages.description')
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body small">
        @if (isset($restaurant->az_info->id))
            {!! str_replace('&nbsp;', ' ', $restaurant->az_info->description) !!}
        @endif
    </div>
</div>
