@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','Events')
@section('content')

    <section id="blog">
        <div class="container">
            <div class="center fadeInDown" style="margin-top:50px;">
                <h2>{{__('Events')}}</h2>
                <p class="lead">{{__('')}}</p>
            </div>
            @if(count($events) > 0)
                <div class="row">
                    @foreach($events as $event)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="item" style="background-color:#fff;margin-bottom: 20px;
                              ;width: 100%;height:350px">
                                @if($event->hasMedia('event'))
                                    <div>
                                        <a  href="{{route('eventDetails',$event->id)}}">
                                            <img src="{{ $event->firstMedia('event')->getUrl() }}" alt="" width="100%" height="200px">
                                        </a>
                                    </div>
                                @endif
                                <div class="content text-center" style="padding-top:20px;font-size: 20px" >
                                    <i class="fa fa-clock-o"></i> <a href="#">{{$event->start_date->format('d/m/Y')}}</a>
                                    <span style="color: #0d5da6"> / {{$event->end_date->format('d/m/Y')}}</span><br>

                                    <p style="overflow: hidden">{{$event->sh_desc}}</p>
                                    <a  href="{{route('eventDetails',$event->id)}}">{{$event->name}}</a>

                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                <ul>
                    <li class="pagination">{{ $events->links() }}</li>
                </ul>
            @endif
        </div>
    </section>

@stop

