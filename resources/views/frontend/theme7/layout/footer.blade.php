
<footer id="footer" class="footer " data-bg-img="{{('frontend/theme7/images/footer-bg.png')}}">
    <div class="container pt-70 pb-40">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    @if(setting('general.logo'))
                        <img class="mt-10 mb-15" alt="" src="{{asset('logo/'.setting('general.logo'))}}" style="width: 80px">
                    @endif
                    <p class="font-16 mb-10">{{$aboutUs->sh_desc}}</p>
                    <ul class="styled-icons icon-dark mt-20">
                       <!--  @if(setting('general.facebook_page_link'))
                            <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".1s" data-wow-offset="10"><a href="{{setting('general.facebook_page_link')}}" target="_blank" data-bg-color="#3B5998"><i class="fab fa-facebook"></i></a></li>
                        @endif -->
                        @if(setting('general.twitter_page_link'))
                                <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s" data-wow-offset="10"><a href="{{setting('general.twitter_page_link')}}" target="_blank" data-bg-color="#02B0E8"><i class="fab fa-twitter"></i></a></li>
                        @endif
                        @if(setting('general.contact_email'))
                                <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".4s" data-wow-offset="10"><a href="mailto:{{setting('general.contact_email')}}" target="_blank" data-bg-color="#A11312"><i class="fab fa-google"></i></a></li>
                            @endif
                        @if(setting('general.youTube_page_link'))
                                <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s" data-wow-offset="10"><a href="{{setting('general.youTube_page_link')}}" target="_blank" data-bg-color="#C22E2A"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if(setting('general.instagram_page_link'))
                            <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s" data-wow-offset="10"><a href="{{setting('general.instagram_page_link')}}" data-bg-color="#833AB4" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if(setting('general.whatsapp_number'))
                            <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s" data-wow-offset="10"><a href="https://wa.me/message/JOXLVY63O7IRD1"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom">{{__('Useful Links')}}</h5>
                    <ul class="list angle-double-right list-border">
                        <li><a href="{{url('/about')}}">{{__('Why us')}}</a></li>
                        <li><a href="{{url('/categoryProduct')}}">{{__('Courses')}}</a></li>
                        <li><a href="{{url('/#teachers')}}">{{__('Teachers')}}</a></li>
                        <li><a href="{{url('/#jops')}}">{{__('Jobs')}}</a></li>
                        <li><a href="{{url('/pricing')}}">{{__('Pricing')}}</a></li>
                        <li><a href="{{url('/categoryProduct')}}">{{__('Free trail')}}</a></li>
                        <li><a href="{{url('/contactUs')}}">{{__('Contact')}}</a></li>

                    @if(\App\Page::where(['inFooter'=>1,'published'=>1 ,'parent_id'=>null])->get()  )
                            @foreach(\App\Page::where(['inFooter'=>1,'published'=>1,'parent_id'=>null])->get() as $page )
                                <li><a href="{{url('pages/'.$page->slug)}}">{{$page->name}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom">{{__('Quick Contact')}}</h5>
                    <ul class="list-border">
                        @if(setting('general.phone_number'))
                        <li>
                            <a href="#">{{setting('general.phone_number')}}</a>
                        </li>
                        @endif
                        @if(setting('general.email_address_visible'))
                        <li>
                            <a href="#">{{setting('general.contact_email')}}</a>
                        </li>
                        @endif
                        @if(setting('general.address'))
                        <li>
                            <a href="#" class="lineheight-20">{{setting('general.address')}} </a>
                        </li>
                        @endif
                    </ul>
{{--                    <p class="font-16 text-white mb-5 mt-15">Subscribe to our newsletter</p>--}}
{{--                    <form id="footer-mailchimp-subscription-form" class="newsletter-form mt-10">--}}
{{--                        <label class="display-block" for="mce-EMAIL"></label>--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="email" value="" name="EMAIL" placeholder="Your Email"  class="form-control" data-height="37px" id="mce-EMAIL">--}}
{{--                            <span class="input-group-btn">--}}
{{--                    <button type="submit" class="btn btn-colored btn-theme-colored m-0"><i class="fa fa-paper-plane-o text-white"></i></button>--}}
{{--                </span>--}}
{{--                        </div>--}}
{{--                    </form>--}}


                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="widget dark">
                    <h5 class="widget-title line-bottom">{{__('Payments')}}</h5>
                    <p class="font-16 mb-10">{{__('We offer a variety methods of payment')}}</p>
                    <img src="{{asset('frontend/theme7/images/pays.png')}}">
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-md-6">
                    <p class="font-11 text-black-777 m-0"><a target="_blank" href="https://www.facebook.com/AllSafeMHR">All Safe</a></p>
                </div>
                <div class="col-md-6 text-right">
                    <div class="widget no-border m-0">
                        <ul class="list-inline sm-text-center mt-5 font-12">
                            <li>
                                <a href="#">FAQ</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">Help Desk</a>
                            </li>
                            <li>|</li>
                            <li>
                                <a href="#">Support</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
