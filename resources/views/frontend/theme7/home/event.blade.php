@if(count($events) > 0)
<section id="testimonial" >
    <div class="container">
      <!--   @if($eventSection->hasMedia('about'))
            <div class="center fadeInDown" style="background-image: url({{$eventSection->lastMedia('about')->getUrl() }}); background-size:100% 100%;background-repeat: no-repeat">
                <h1>{{$eventSection->name}}</h1>
                <p class="lead">
                    {{$eventSection->description}}
                </p>
            </div>
        @endif -->
        <div class="center fadeInDown">
                <h2>{{__('Events')}}</h2>
                <p class="lead">{{__('')}}</p>
            </div>
        <div class="testimonial-slider owl-carousel">

                @foreach($events as $event)
                    <div class="single-slide" style="height:500px;background-color:#fff ">
                        @if($event->hasMedia('event'))
                            <div class="slide-img">
                               <a href="{{route('eventDetails',$event->id)}}">
                                   <img src="{{ $event->lastMedia('event')->getUrl() }}" alt="" style="width: 280px;height: 220px">
                               </a>
                            </div>
                        @endif
                        <div class="content">
                            <div class="news-date navy-bg">
                                <div class="blog-meta-2">
                                        <span class="published3">
{{--                                          <i class="fa fa-clock-o"></i>--}}
                                         From: {{$event->start_date}}
                                        </span>
                                </div>
                                <div class="blog-meta for-news">
                                        <span class="published3" style="padding-right: 15px">
                                           To: {{$event->end_date}}
                                        </span>
                                </div>
                            </div>

                            <p style="margin-top: 15px;color:#716d6ddb">{{$event->sh_desc}}</p>
                            <a href="{{route('eventDetails',$event->id)}}"><h4>{{$event->name}}</h4></a>
                        </div>
                    </div>
                @endforeach

        </div>
    </div>
</section>
@endif
