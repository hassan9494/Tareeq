@if(count($teachers) > 0)
<!-- Section: Teachers -->

<section id="teachers" class="bg-lightest">
    <div class="container">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="mt-0 line-height-1 text-center text-uppercase mb-10 text-black-333">{{__('Our')}}<span class="text-theme-color-2">{{__('Teachers')}}</span></h2>
{{--                    <div class="iconh"><i class="fas fa-mosque fa-1x"></i></div>--}}
                </div>
            </div>
        </div>
        <div class="row mtli-row-clearfix">
            <div class="col-md-12">
                <div class="owl-carousel-4col">
                    @foreach($teachers as $teacher)
{{--                        @dd($teacher);--}}
                       <div class="item">
                        <div class="team-members border-bottom-theme-color-2px text-center maxwidth400">
                            <div class="team-thumb">
                                @if($teacher->hasMedia('userAvatar'))
                                    <img class="img-fullwidth" alt="" src="{{ $teacher->firstMedia('userAvatar')->getUrl() }}">
                                @else
                                    @if($teacher->gender == 'male')
                                    <img class="img-fullwidth" alt="" src="{{asset('frontend/theme7/images/male.jpg')}}">
                                    @else
                                    <img class="img-fullwidth" alt="" src="{{asset('frontend/theme7/images/female.png')}}">
                                    @endif
                                @endif
                                <div class="team-overlay"></div>
                            </div>
                            <div class="team-details bg-silver-light pt-10 pb-10">
                                <h4 class="text-uppercase font-weight-600 m-5"><a href="{{route('teacherDetails',$teacher->id)}}">{{$teacher->name}}</a></h4>
{{--                                <ul class="styled-icons icon-theme-colored icon-dark icon-circled icon-sm">--}}
{{--                                    <li><a href="{{$teacher->facebook}}"><i class="fa fa-facebook"></i></a></li>--}}
{{--                                    <li><a href="{{$teacher->whatsapp}}"><i class="fa fa-whatsapp"></i></a></li>--}}
{{--                                    <li><a href="{{$teacher->video}}"><i class="fa fa-video"></i></a></li>--}}
{{--                                    <li><a href="#"><i class="fa fa-skype"></i></a></li>--}}
{{--                                </ul>--}}
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
<section class="jobapply" id="jops" style="background-color: #4e7574;">
    <div class="container pt-0 pb-0">
        <div class="row">
            <div class="col-md-7">
                <div class="p-40 pl-0">
                    <!-- Reservation Form Start-->
                    <form id="reservation_form" name="reservation_form" class="reservation-form" method="post" action="{{route('jopApply')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        <h3 class="mt-0  mb-40">{{__('Join With Us AS a Teacher & Be Part of Our Team')}}</h3>
                        <div class="iconh"><i class="fas fa-mosque fa-1x"></i></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-30">
                                    <input placeholder="Enter Your Name" type="text"  name="name" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-30">
                                    <input placeholder="Enter Your Email" type="email"  name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-30">
                                    <input placeholder="Enter Your Phone" type="text"  name="phone" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-30">
                                    <input placeholder="Enter Job Field" type="text"  name="job_field" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group mb-30">
                                    <lable>{{__('Attach Your Cv')}}</lable>
                                    <input  type="file"  name="cv" class="form-control" required style="height: 36px;" >
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group mb-0 mt-0">
                                    {{--                                    <input name="form_botcheck" class="form-control" type="hidden" value="">--}}
                                    <button type="submit" class="btn jobbtn" data-loading-text="Please wait...">{{__('Apply Now')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            <div class="col-md-5 mt-40">
                <img src="{{asset('frontend/theme7/jop.jpg')}}" height="100%" alt="">
            </div>
        </div>
    </div>
</section>
