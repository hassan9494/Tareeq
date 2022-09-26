@if($freetrial->hasMedia('backgroundImage'))

    <div class=" slide_medium shop_banner_slider staggered-animation-wrap">
        <div  class="carousel slide carousel-fade light_arrow" >
            <div class="carousel-inner">
                <div class="text-center trading_img">
                    <a href="{{$freetrial->url}}">
                        <img style="max-height:550px;height: auto; width: 100%;" src="{{ $freetrial->firstMedia('backgroundImage')->getUrl()}}" alt="tranding_img">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
