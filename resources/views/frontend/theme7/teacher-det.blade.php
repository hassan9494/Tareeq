@extends('frontend.'.setting('theme.site').'.layout.master')
@section('content')


    <!-- Start main-content -->
    <div class="main-content bg-lighter">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('frontend/theme7/images/bg/bg6.jpg')}}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="title text-white text-center">{{__('Teachers Details')}}</h2>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Experts Details -->
        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="text-center">
                            <div class="team-thumb">
                                @if($teacher->firstMedia('userAvatar'))
                                    <img class="img-avatar" alt="" src="{{ $teacher->firstMedia('userAvatar')->getUrl() }}">
                                @elseif($teacher->gender == 'male')
                                    <img class="img-avatar" alt="" src="{{asset('frontend/theme7/images/male.jpg')}}">
                                @else
                                    <img class="img-avatar" alt="" src="{{asset('frontend/theme7/images/female.png')}}">
                                @endif
                                <div class="team-overlay"></div>
                            </div>
                            <div class="row">
                                <h4 class="name font-24 mt-0 mb-0">{{$teacher->name}}</h4>
                                <p>{{$teacher->qualifications}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($teacher->video !=null)
                        <div class="col-4">
                            <div class="fluid-video-wrapper">
                                <iframe width="230" height="157" src="{{$teacher->video}}"  allowfullscreen></iframe>
                            </div>
                        </div>
                        @endif
                        @foreach ($videoUrl as $vUrl)
                            <div class="col-4">
                                <div class="fluid-video-wrapper">
                                    <iframe width="230" height="157" src="{{$vUrl->video}}"  allowfullscreen></iframe>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- end main-content -->

@stop
