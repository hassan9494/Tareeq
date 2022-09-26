@if(count($testmonials)> 0)

<section class="divider parallax layer-overlay overlay-dark-4" data-background-ratio="0.5" data-bg-img="{{$testmonialSection->hasMedia('about') ? $testmonialSection->firstMedia('about')->getUrl() : asset('frontend/theme7/images/bg/bg2.jpg') }}">
    <div class="container pt-60 pb-60">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="text-uppercase mt-0 pb-0  text-center text-white">{{$testmonialSection->name}}</h2>
                <div class="owl-carousel-1col" data-dots="true">
                    @foreach($testmonials as $testmonial)

                        <div class="item">
                            <div class="testimonial">
                                <p class="description">
                                    {{$testmonial->desc}}
                                </p>
                                <div class="testimonial-content">
                                    <div class="pic">
                                        @if($testmonial->hasMedia('testmonial'))
                                            <img class="" alt="" src="{{ $testmonial->lastMedia('testmonial')->getUrl() }}">
                                            {{--                                    <img src="{{ $testmonial->lastMedia('testmonial')->getUrl() }}" style="width: 85px;height:85px;border-radius: 50%;margin: auto"><br>--}}
                                        @endif
                                    </div>
                                    <h3 class="title">{{$testmonial->name}}</h3>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endif

