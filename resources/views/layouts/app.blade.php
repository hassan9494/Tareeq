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
</head>
<!--/head-->
<body class="{{App::isLocale('ar') ? 'rtl' :'' }}">
<body>
    <div id="app">
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav mr-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ml-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" style="height: 100px"  href="{{url('/')}}">
                        @if(setting('general.logo'))
                            <img src="{{asset('logo/'.setting('general.logo'))}}" width="100px" height="100%" alt="logo">
                        @endif
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <ul class="collapse navbar-collapse"  id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="margin: 30px">
                        <li class="active"><a href="{{url('/home')}}#">{{__('Next Lessons')}} <span class="sr-only">(current)</span></a></li>
                        <li class=""><a href="{{route('myClasses')}}">{{__('My Classes')}} </a></li>
                        <li class=""><a href="{{route('accounting')}}">{{__('Accounting')}} </a></li>

                        @if(auth()->user()->type == 'teacher')
                            <li><a href="{{route('teacher.appointments')}}">{{__('Work Appointments')}}</a></li>
                        @endif
{{--                        <li class="dropdown">--}}
{{--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><a href="#">Action</a></li>--}}
{{--                                <li><a href="#">Another action</a></li>--}}
{{--                                <li><a href="#">Something else here</a></li>--}}
{{--                                <li role="separator" class="divider"></li>--}}
{{--                                <li><a href="#">Separated link</a></li>--}}
{{--                                <li role="separator" class="divider"></li>--}}
{{--                                <li><a href="#">One more separated link</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                    </ul>

                    <ul class="nav navbar-nav navbar-right" style="margin: 30px">


                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                            <li><a  href="{{ route('myAccount') }}"> {{ __('My Account') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>




                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </ul>
{{--                </div><!-- /.navbar-collapse -->--}}
            </div><!-- /.container-fluid -->
        </nav>

        <div class="main-content">
            @if (Session::has('success'))
                <div class="alert alert-success mt-10 text-center">
                    {{ Session::get('success')}}
                </div>
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
                @if (!auth()->user()->approved)
                    <div class="alert alert-danger mt-10 text-center">
                        {{ __('Your data will be reviewed by admin soon')}}
                    </div>
                @endif
            @yield('content')
        </div>
        @include('frontend.theme7.layout.footer')
    </div>

    <!-- JS | Custom script for all pages -->
    <script src="{{asset('frontend/theme7/js/custom.js')}}"></script>

    @yield('scripts')
    <!--Start of Tawk.to Script-->
   <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ed3b5a5c75cbf1769f1006f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    <!--End of Tawk.to Script-->
</body>
