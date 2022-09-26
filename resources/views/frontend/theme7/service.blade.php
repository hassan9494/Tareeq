@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','Services')
@section('content')
    @if($mainServiceDesc->hasMedia('service'))

        <div class="page-title" style="background-image:url({{$mainServiceDesc->lastMedia('service')->getUrl() }}); background-size: 100% 100%;background-repeat: no-repeat;">
            <h1>{{$mainServiceDesc->name}}</h1>
        </div>

    @endif

<section id="services" class="service-item">
    <div class="container">
        <div class="center fadeInDown">
            <h2>{{$mainServiceDesc->name}}</h2>
            <p class="lead">
                {{$mainServiceDesc->description}}
            </p>

        </div>

        <div class="row">
            @foreach($service as $servicee)
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        @if($servicee->hasMedia('post'))
                            <div class="pull-left">
                                <img class="img-responsive" src="{{ $servicee->firstMedia('post')->getUrl() }}" style="width:80px; height:80px ">
                            </div>
                        @endif
                        <div class="media-body">
                            <a class="media-heading" href="{{route('service',$servicee->id)}}">{{$servicee->subject}}</a>
                            <p>{{$servicee->sh_desc}}</p>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/#services-->
@stop
