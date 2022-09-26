@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title',__('Home'))
@section('content')

    @if(count($slider)>0)
        <section id="home">

        <!-- Slider Revolution Start -->
        <div class="rev_slider_wrapper">
            <div class="rev_slider" data-version="5.0">
                <ul>

                     @foreach($slider as $slide)
                    <!-- SLIDE 2 -->
                        <li data-index="rs-{{$loop->iteration}}" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ $slide->firstMedia('slider')->getUrl() }}" data-rotate="0" data-saveperformance="off" data-title="Slide 2" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{ $slide->firstMedia('slider')->getUrl() }}"  alt=""  data-bgposition="center 40%" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
                            <!-- LAYERS -->
                            <!-- LAYER NR. 2 -->
                                <div class="bluebg"></div>
                            <div class="tp-caption tp-resizeme text-uppercase bg-theme-colored-transparent text-white font-raleway pl-30 pr-30"
                                id="rs-2-layer-2"

                                data-x="['center']"
                                data-hoffset="['0']"
                                data-y="['middle']"
                                data-voffset="['-20']"
                                data-fontsize="['48']"
                                data-lineheight="['60']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_idle="o:1;s:500"
                                data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                data-start="1000"
                                data-splitin="none"
                                data-splitout="none"
                                data-responsive_offset="on"
                                style="z-index: 7; white-space: nowrap; font-weight:700; border-radius: 30px;">{{ $slide->header }}
                            </div>


                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption tp-resizeme text-white text-center"
                                id="rs-2-layer-3"

                                data-x="['center']"
                                data-hoffset="['0']"
                                data-y="['middle']"
                                data-voffset="['50']"
                                data-fontsize="['16']"
                                data-lineheight="['28']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_idle="o:1;s:500"
                                data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                data-start="1400"
                                data-splitin="none"
                                data-splitout="none"
                                data-responsive_offset="on"
                                style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">{!!  wordwrap($slide->paragraph, 80, "<br />\n")!!}
                            </div>

                            <!-- LAYER NR. 4 -->
                            @if($slide->url !== null)
                                <div class="tp-caption tp-resizeme"
                                id="rs-2-layer-4"

                                data-x="['center']"
                                data-hoffset="['0']"
                                data-y="['middle']"
                                data-voffset="['115']"
                                data-width="none"
                                data-height="none"
                                data-whitespace="nowrap"
                                data-transform_idle="o:1;"
                                data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                data-start="1400"
                                data-splitin="none"
                                data-splitout="none"
                                data-responsive_offset="on"
                                style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-circled  pl-20 pr-20" style="background-color:#315352f2 ;color:white; padding:15px 20px" href="{{$slide->url}}">{{$slide->btn_name}}</a>
                            </div>
                            @endif
                        </li>
                     @endforeach
                </ul>
            </div>
            <!-- end .rev_slider -->
        </div>
        <!-- end .rev_slider_wrapper -->
        <script>
            $(document).ready(function(e) {
                $(".rev_slider").revolution({
                    sliderType:"standard",
                    sliderLayout: "auto",
                    dottedOverlay: "none",
                    delay: 5000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        onHoverStop: "off",
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        arrows: {
                            style:"zeus",
                            enable:true,
                            hide_onmobile:true,
                            hide_under:600,
                            hide_onleave:true,
                            hide_delay:200,
                            hide_delay_mobile:1200,
                            tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                            left: {
                                h_align:"left",
                                v_align:"center",
                                h_offset:30,
                                v_offset:0
                            },
                            right: {
                                h_align:"right",
                                v_align:"center",
                                h_offset:30,
                                v_offset:0
                            }
                        },
                        bullets: {
                            enable:true,
                            hide_onmobile:true,
                            hide_under:600,
                            style:"metis",
                            hide_onleave:true,
                            hide_delay:200,
                            hide_delay_mobile:1200,
                            direction:"horizontal",
                            h_align:"center",
                            v_align:"bottom",
                            h_offset:0,
                            v_offset:30,
                            space:5,
                            tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title"></span>'
                        }
                    },
                    responsiveLevels: [1240, 1024, 778],
                    visibilityLevels: [1240, 1024, 778],
                    gridwidth: [1170, 1024, 778, 480],
                    gridheight: [650, 768, 960, 720],
                    lazyType: "none",
                    parallax: {
                        origo: "slidercenter",
                        speed: 1000,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                        type: "scroll"
                    },
                    shadow: 0,
                    spinner: "off",
                    stopLoop: "on",
                    stopAfterLoops: 0,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    fullScreenAutoWidth: "off",
                    fullScreenAlignForce: "off",
                    fullScreenOffsetContainer: "",
                    fullScreenOffset: "0",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            });
        </script>
        <!-- Slider Revolution Ends -->

    </section>
    {{-- <section class="whyus">
        <div class="container pt-30 pb-30" style="width: 80%;">
            <div class="section-content">
                <div class="row equal-height-inner home-boxes">
                    <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay1">
                        <div class="sm-height-auto bg-theme-colored">
                            <div class="text-center pt-30 pb-30">
                                <i class="far fa-clock text-white fa-5x "></i>
                                <h4 class="text-uppercase mt-20"><a href="#" class="text-white">{{__('24 Hours Service')}}</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay2">
                        <div class="sm-height-auto bg-theme-colored-darker2">
                            <div class="text-center pt-30 pb-30">
                                <i class="far fa-question-circle text-white fa-5x "></i>
                                <h4 class="text-uppercase mt-20"><a href="#" class="text-white">{{__('Online Help')}}</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay3">
                        <div class="sm-height-auto bg-theme-colored-darker3">
                            <div class="text-center pt-30 pb-30  ">
                                <i class="fab fa-paypal text-white fa-5x"></i>
                                <h4 class="text-uppercase mt-20"><a href="#" class="text-white">{{__('Online Payment')}}</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay4">
                        <div class="sm-height-auto bg-theme-colored-darker4">
                            <div class="text-center pt-30 pb-30">
                                <i class="fab fa-whatsapp text-white fa-5x "></i>
                                <h4 class="text-uppercase mt-20"><a target="blank" href="tel:{{setting('general.phone_number')}}" class="text-white">{{__('Call')}} +{{setting('general.phone_number')}}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    @endif
    @foreach($activeSection as $active)
        @include('frontend.'.setting('theme.site').'.home.'.$active->type)
    @endforeach

@stop


