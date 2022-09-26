<!DOCTYPE html>
<html dir="{{App::isLocale('ar') ? 'rtl' :'ltr' }}" lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ setting('general.website_description') }}">
    <meta name="keywords" content="{{ setting('general.tags') }}">

    <title>{{ setting('general.website_name') . ' | ' }} @yield('title') </title>
    <link href="{{asset('logo/'.setting('general.logo'))}}" rel="shortcut icon" type="image/png">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{asset('frontend/theme7/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('frontend/theme7/css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('frontend/theme7/css/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('frontend/theme7/css/css-plugin-collections.css')}}" rel="stylesheet"/>
    <!-- CSS | menuzord megamenu skins -->

    <link id="menuzord-menu-skins" href="{{asset('frontend/theme7/css/menuzord-skins/menuzord-rounded-boxed.css')}}" rel="stylesheet"/>
    <!-- CSS | Main style file -->
    <link href="{{asset('frontend/theme7/css/style-main.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="{{asset('frontend/theme7/css/preloader.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="{{asset('frontend/theme7/css/custom-bootstrap-margin-padding.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="{{asset('frontend/theme7/css/responsive.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

    <!-- Revolution Slider 5.x CSS settings -->
    <link  href="{{asset('frontend/theme7/js/revolution-slider/css/settings.css')}}" rel="stylesheet" type="text/css"/>
    <link  href="{{asset('frontend/theme7/js/revolution-slider/css/layers.css')}}" rel="stylesheet" type="text/css"/>
    <link  href="{{asset('frontend/theme7/js/revolution-slider/css/navigation.css')}}" rel="stylesheet" type="text/css"/>


    <!-- CSS | Theme Color -->
    <link href="{{asset('frontend/theme7/css/colors/theme-skin-color-set-1.css')}}" rel="stylesheet" type="text/css">

    <!-- external javascripts -->
    <script src="{{asset('frontend/theme7/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('frontend/theme7/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('frontend/theme7/js/bootstrap.min.js')}}"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="{{asset('frontend/theme7/js/jquery-plugin-collection.js')}}"></script>

    <!-- Revolution Slider 5.x SCRIPTS -->
    <script src="{{asset('frontend/theme7/js/revolution-slider/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('frontend/theme7/js/revolution-slider/js/jquery.themepunch.revolution.min.js')}}"></script>

    {{-- <link href="{{asset('frontend/theme7/css/jquery.ccpicker.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('frontend/theme7/js/jquery.ccpicker.js')}}"></script> --}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="frontend/'.setting('theme.site').'/js/html5shiv.js"></script>
        <script src="frontend/'.setting('theme.site').'/js/respond.min.js"></script>
    <![endif]-->
    @yield('head')


    @if(App::isLocale('ar'))
        <link href="{{asset('frontend/theme7/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('frontend/theme7/css/style-main-rtl.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('frontend/theme7/css/style-main-rtl-extra.css')}}" rel="stylesheet" type="text/css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-flipped.css">--}}
{{--    <link rel="stylesheet" href="{{asset('frontend/'.setting('theme.site').'/css/rtl.css')}}">--}}
    @endif

    {!!  setting('general.facebook_pixel')!!}
    {!! setting('general.google_analytic') !!}
    <style>
        .freeTrialBTN{
            position:fixed;
            width:130px;
            height:37px;
            bottom:20px;
            right:71px;
            background-color:#00aa99;
            color:#F4F1F1;
            border-radius:50px;
            text-align:center;
            z-index:100;
            font-size:20px;
        }
        .whatsBTN{
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 20px;
            left: 23px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: rgba(0, 0, 0, 0.4) 2px 2px 6px;;
            z-index: 100;
        }
        .whatsBTN:hover{color: #FFF;box-shadow: rgba(0, 0, 0, 0.7) 2px 2px 11px;}
    </style>
    @yield('style')
</head>
<!--/head-->
<body class="{{App::isLocale('ar') ? 'rtl' :'' }}">
<!-- LOADER -->
<div id="wrapper" class="clearfix">
    <!-- preloader -->
{{--    <div id="preloader">--}}
{{--        <div id="spinner">--}}
{{--            <img alt="" src="{{asset('frontend/theme7/images/preloaders/5.gif')}}">--}}
{{--        </div>--}}
{{--        <div id="disable-preloader" class="btn btn-default btn-sm">{{__('Disable Preloader')}}</div>--}}
{{--    </div>--}}
@include('frontend.theme7.layout.header')
    @if (Session::has('success'))
        <div class="alert alert-success mt-10 text-center">
            {{ Session::get('success')}}
        </div>
        <!-- Event snippet for Tareeq lead conversion page -->
        <script>
          gtag('event', 'conversion', {'send_to': 'AW-394541632/QYvCCPrroeICEMD0kLwB'});
        </script>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger mt-10 text-center">
            {{ Session::get('error')}}
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="https://wa.me/message/JOXLVY63O7IRD1" class="whatsBTN" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a  class="freeTrialBTN"  href="{{route('freeTrial')}}" >
        {{__('Free Trial')}}
    </a>
    <div class="main-content">
        @yield('content')

    </div>
@include('frontend.theme7.layout.footer')
</div>

<!-- JS | Custom script for all pages -->
<script src="{{asset('frontend/theme7/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5f06fe9c67771f3813c0b858/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->
<!-- GetButton.io widget -->
<!-- GetButton.io widget -->
<!-- <script type="text/javascript">
    (function () {
        var options = {
            facebook: "104766531214233", // Facebook page ID
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script> -->

@yield('scripts')

<!-- /GetButton.io widget -->
<!-- /GetButton.io widget -->
</body>

