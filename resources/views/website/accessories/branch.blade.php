<style>
    .collapsible {
        background-color: white;
        color: black;
        /*padding: 13px;*/
        width: 100%;
        border: none;
        text-align: right;
        outline: none;
        font-size: 14px;
        margin: 2px;
    }

    .collapsible:after {
        content: '\003E';
        color: black;
        font-weight: bold;
        float: left;
        margin-left: 10px;
    }

    .branch_cl_active:after {
        content: "\005E";
    }

    .content {
        padding: 0 18px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        background-color: #f1f1f1;
    }
</style>
<div>
    <button
        class="btn btn_custom"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasBottom"
        aria-controls="offcanvasBottom"
    >
        @lang('messages.change_branch')
    </button>

    <div
        class="offcanvas offcanvas-bottom"
        tabindex="-1"
        id="offcanvasBottom"
        aria-labelledby="offcanvasBottomLabel"
    >
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
        @php
            $cities = App\Models\City::with('branches')
                ->whereHas('branches', function ($q) use ($restaurant) {
                    $q->whereRestaurantId($restaurant->id);
                })->get();
        @endphp
        <div class="offcanvas-body small">
            <form method="get" action="{{route('homeBranch' , $restaurant->name_barcode)}}">
                @csrf
                @foreach($cities as $city)
                    <div>
                        <a class="collapsible">
                            {{app()->getLocale() == 'ar' ? $city->name_ar : $city->name_en}}
                        </a>
                        <div class="content">
                            @foreach($city->branches as $zbranch)
                                <input
                                    type="radio"
                                    id="city{{$zbranch->id}}"
                                    name="branch"
                                    value="{{$zbranch->id}}"
                                    required
                                    {{$zbranch->id == $branch->id ? 'checked' : ''}}
                                />
                                <label for="city{{$zbranch->id}}">
                                    {{app()->getLocale() == 'ar' ? $zbranch->name_ar : $zbranch->name_en}}
                                </label>
                                <br>
                            @endforeach
                        </div>
                    </div>
                    <hr/>
                @endforeach
                <input type="submit" value="@lang('messages.change')"/>
            </form>
        </div>
    </div>
</div>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("branch_cl_active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
</script>
