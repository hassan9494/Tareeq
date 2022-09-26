@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','Contact Us')
@section('content')


    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('frontend/theme7/images/bg/bg6.jpg')}}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white text-center">{{__('Contact')}}</h2>
                        <ol class="breadcrumb text-left text-black mt-10">
                            <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                            <li class="active text-gray-silver">{{__('Contact')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider: Contact -->
    <section class="divider layer-overlay overlay-white-9" data-bg-img="images/bg/bg15.html">
        <div class="container">
            <div class="row pt-30">
                <div class="col-md-8">
                    <h3 class="line-bottom mt-0 mb-20">{{__('Interested in discussing?')}}</h3>
                    <!-- Contact Form -->
                    <form id="contact_form" name="contact_form"  action="{{route('message')}}"  method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_name">{{__('Name')}} <small>*</small></label>
                                    <input name="name" class="form-control" type="text" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_email">{{__('Email')}} <small>*</small></label>
                                    <input name="email" class="form-control required email" type="email" placeholder="Enter Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_phone">{{__('Phone')}}</label>
                                    <input name="phone" class="form-control" type="text" placeholder="Enter Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form_name">{{__('Message')}}</label>
                            <textarea name="note" class="form-control required" rows="5" placeholder="Enter Message" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-loading-text="Please wait...">{{__('Send your message')}}</button>
                            <button type="reset" class="btn btn-default btn-flat btn-theme-colored">{{__('Reset')}}</button>
                        </div>
                    </form>
                    <!-- Contact Form Validation-->

                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-color-2"></i></a>
                                <div class="media-body"> <strong class="text-white">{{__('OUR OFFICE LOCATION')}}</strong>
                                    @if(setting('general.address'))
                                        <p class="text-white">{{setting('general.address')}} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-12 text-white">
                            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-call text-theme-color-2"></i></a>
                                <div class="media-body"> <strong class="text-white">{{__('OUR CONTACT NUMBER')}}</strong>
                                    @if(setting('general.phone'))
                                        <a href="tel:{{setting('general.phone')}}">{{setting('general.phone')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-12 text-white">
                            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-mail text-theme-color-2"></i></a>
                                <div class="media-body"> <strong class="text-white">{{__('OUR CONTACT E-MAIL')}}</strong>
                                    @if(setting('general.contact_email'))
                                        <a href="mailto:{{setting('general.contact_email')}}?Subject=email">{{setting('general.contact_email')}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-12 text-white">
                            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="#"> <i class="fa fa-whatsapp text-theme-color-2"></i></a>
                                <div class="media-body"> <strong class="text-white">{{__('OUR WHATSAPP NUMBER')}}</strong>
                                    <P ><a target="_blank" href="https://wa.me/message/JOXLVY63O7IRD1" class="text-white"> {{setting('general.whatsapp_number')}}</a></P>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('scripts')
<style>
     iframe{
        width: 100%;
        height: 500px;
    }

</style>
@stop
