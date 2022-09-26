@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','Portfolio')
@section('content')

    @if($gallary->hasMedia('about'))

    <div class="page-title" style="background-image: url({{$gallary->lastMedia('about')->getUrl() }}); background-size:100% 100%;background-repeat: no-repeat">
        <h1>{{$gallary->name}}</h1>
    </div>
    @endif
    <!-- Start Header Style -->
    <!-- Start PortFolio Area -->
    <section id="portfolio">
        <div class="container">
            <div class="center">

                <h2>{{$gallary->name}}</h2>
                <p class="lead">
                    {{$gallary->description}}
                </p>
            </div>
            @if(count($categories) > 0 )
                <ul class="portfolio-filter text-center">
                    <li><a class="btn btn-default active" href="#" data-filter="*">{{__('All works')}}</a></li>
                    @foreach($categories as $category)
                        <li><a class="btn btn-default" href="#" data-filter=".{{$category->id}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
        @endif
        <!--/#portfolio-filter-->

            <div class="row">
                @if(count($categories) > 0)
                    <div class="portfolio-items">

                        @foreach($categories as $category)
                            @foreach($category->getMedia('cat') as $image)
                                <div class="portfolio-item   {{$category->id}} col-xs-12 col-sm-4 col-md-3 single-work" id="{{$category->id}}">
                                    <div class="recent-work-wrap" >
                                        <img width="290px" height="290px" src="{{$image->getUrl()}}"  alt="">
                                        <div class="overlay">
                                            <div class="recent-work-inner">
                                                <a class="preview" title="{{$image->description}}" href="{{$image->getUrl()}}" rel="prettyPhoto"><i class="fa fa-plus" ></i></a>
                                                {{--                                            <a class="pp_close" href="#">Close</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endforeach
                    <!--/.portfolio-item-->

                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End PortFolio Area -->


@stop

