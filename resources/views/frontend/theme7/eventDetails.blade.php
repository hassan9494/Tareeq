@extends('frontend.'.setting('theme.site').'.layout.master')
@section('content')

<div class="page-title" style="margin-top: 130px;">
    <h1 style="color: #0A5A97">{{__('Event Details')}}</h1>
</div>

    <section id="blog" >
        <div class="blog container">
            <div class="row">
                <div class="col-md-12">

                    <div class="blog-item">
                        <div class="col-md-6">
                            @if($event->hasMedia('event'))
                                <a href="#">
                                    <img class="img-responsive img-blog" src="{{ $event->lastMedia('event')->getUrl() }}" width="100%" alt="" />
                                </a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="blog-content">
                                <div class="post-meta">

                                    <p>
                                        <i class="fa fa-clock-o"></i> <a href="#">{{$event->start_date}}</a> &nbsp; &nbsp;
                                        <i class="fa fa-clock-o"></i> <a href="#">{{$event->end_date}}</a>

                                    </p>

                                </div>
                                <h2><a href="#">{{$event->name}}</a></h2>
                                <h3>{!! $event->desc !!}</h3>
                            </div>
                        </div>
                    </div>

                </div>

{{--                <!--/.col-md-8-->--}}
{{--                @if(count($events) > 0)--}}
{{--                    <aside class="col-md-4">--}}
{{--                        <div class="widget popular_post">--}}
{{--                            <h3>{{__('Popular Events')}}</h3>--}}
{{--                            <ul>--}}
{{--                                @foreach($events as $event)--}}
{{--                                    <li>--}}
{{--                                        @if($event->hasMedia('event'))--}}
{{--                                            <a href="{{route('eventDetails',$event->id)}}">--}}
{{--                                                <img src="{{ $event->firstMedia('event')->getUrl() }}" alt="" style="width: 100px; height:100px">--}}
{{--                                            </a>--}}
{{--                                            <a  href="{{route('eventDetails',$event->id)}}">{{$event->name}}</a>--}}
{{--                                        @endif--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </aside>--}}
{{--                    <!--/.row-->--}}
{{--                @endif--}}
            </div>
        </div>
        {{--        @endif--}}
    </section>
    <!--/#blog-->

@stop
