@extends('frontend.'.setting('theme.site').'.layout.master')
@section('content')
    @if($aboutUs->hasMedia('backgroundImage'))

        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{$aboutUs->firstMedia('backgroundImage')->getUrl()}}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white text-center">{{$aboutUs->name}}</h2>
                            <ol class="breadcrumb text-left text-black mt-10">
                                <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                <li class="active text-gray-silver">{{$aboutUs->name}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif

<!-- Section: About -->
<section id="about">
    <div class="container mt-50 pb-70 pt-0">
        <div class="section-content">
            <div class="row mt-10">
                <div class="col-sm-12 col-md-12 mb-sm-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h3 class="text-uppercase mt-15">{{$aboutUs->name}} </h3>
                    <p>
                        {!! nl2br($aboutUs->description)!!}
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
@if($partnersLogo )
    <section class="clients bg-theme-colored">
        <div class="container pt-10 pb-0 pt-sm-0 pb-sm-0">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section: Clients -->
                    <div class="owl-carousel-6col transparent text-center owl-nav-top">
                        @foreach($partnersLogo as $logo)

                            <div class="item"> <a href="{{$logo->url}}"><img src="{{$logo->firstMedia('partnersLogo')->getUrl() }}" alt=""></a></div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@stop
