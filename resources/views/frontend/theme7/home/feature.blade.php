@if(count($features) > 0)

<section id="mission">
    <div class="container-fluid pt-0 pb-0">
        <div class="row equal-height">
            @if($featureSetting->hasMedia('about'))
                <div class="col-sm-6 col-md-6 xs-pull-none bg-theme-colored wow fadeInLeft"  style="background-color:{{$featureSetting->backgroundColor}} !important; " data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="pt-60 pb-40 pl-90 pr-160 p-md-30">
                        <h2 class="title text-black text-uppercase line-bottom mt-0 mb-30">  {{$featureSetting->name}}</h2>
                        <p class="title text-black mt-0 mb-30">{{$featureSetting->description}}</p>
                        @foreach($features->take(3) as $feature)
                            <div class="icon-box clearfix m-0 p-0 pb-10">
                                <a href="#" class="icon icon-circled  icon-lg pull-left flip sm-pull-none">
                                    @if($feature->hasMedia('feature'))
                                        <img class="img-responsive icon icon-circled" src="{{ $feature->lastMedia('feature')->getUrl() }}" style="width:90px; height:90px ">
                                    @endif
                                </a>
                                <div class="ml-120 ml-sm-0">
                                    <h4 class="icon-box-title text-black mt-5 mb-10 letter-space-1"> {{$feature->title}}</h4>
                                    <p class="text-black">{{$feature->desc}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 p-0 bg-img-cover wow fadeInRight hidden-xs" data-bg-img="{{$featureSetting->lastMedia('about')->getUrl()}}" data-wow-duration="1s" data-wow-delay="0.3s">
            @else
                <div class="col-sm-12 col-md-12 xs-pull-none bg-theme-colored wow fadeInLeft"  style="background-color:{{$featureSetting->backgroundColor}} !important; " data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="pt-60 pb-40 pl-90 pr-160 p-md-30">
                        <h2 class="title text-black text-uppercase line-bottom mt-0 mb-30">  {{$featureSetting->name}}</h2>
                        <p class="title text-black mt-0 mb-30">{{$featureSetting->description}}</p>
                        @foreach($features->take(3) as $feature)
                            <div class="icon-box clearfix m-0 p-0 pb-10">
                                <a href="#" class="icon icon-circled  icon-lg pull-left flip sm-pull-none">
                                    @if($feature->hasMedia('feature'))
                                        <img class="img-responsive icon icon-circled" src="{{ $feature->lastMedia('feature')->getUrl() }}" style="width:90px; height:90px ">
                                    @endif
                                </a>
                                <div class="ml-120 ml-sm-0">
                                    <h4 class="icon-box-title text-black mt-5 mb-10 letter-space-1"> {{$feature->title}}</h4>
                                    <p class="text-black">{{$feature->desc}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</section>
@endif

