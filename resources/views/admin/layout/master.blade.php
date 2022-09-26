<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ setting('general.name') . ' | Admin Area | ' }} @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<link rel="icon" href="{{asset('logo/'.setting('general.logo'))}}" type="image/x-icon"/>
    <meta name="keywords" content="{{ setting('general.tags') }}">
    <!-- text editor -->
{{--    <link href="{{asset('backend/build/keditor.min.css')}}" rel="stylesheet">--}}
    <link href="{{asset('backend/build/css/keditor.min.css')}}" rel="stylesheet">


    <!-- Fonts and icons -->
	<script src="{{asset('backend/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('backend/css/fonts.min.css')}}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

	<!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/atlantis.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('backend/css/demo.css')}}">
    <style >
        .social-share .lang:hover::before{
            background-color: #EC5538;
            width: 80px;
            height: 20px;
            color: #fff;
            content: '{{__('English')}}';

        }

    </style>

</head>
<body>
<div class="wrapper">

    @include('admin.layout.navbar')
    @include('admin.layout.sidebar')

    <div class="main-panel">
        <div class="content">
            @include('admin.elements.flash')
            @include('sweetalert::alert')
            @yield('content')
        </div>
            @include('admin.layout.footer')
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('backend/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('backend/js/core/popper.min.js')}}"></script>
<script src="{{asset('backend/js/core/bootstrap.min.js')}}"></script>
<!-- jQuery UI -->
<script src="{{asset('backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('backend/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{asset('backend/js/atlantis.min.js')}}"></script>
<script src="{{asset('backend/js/setting-demo2.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

<script src="{{asset('backend/build/keditor.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('backend/js/plugin/datatables/datatables.min.js')}}"></script>

<script src="{{asset('backend/src/lang/index.js')}}"></script>
<script src="{{asset('backend/js/selectize.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>



<link href="{{asset('frontend/theme7/intTelInput/css/intlTelInput.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('frontend/theme7/intTelInput/js/intlTelInput.js')}}"></script>
<script src="{{asset('frontend/theme7/intTelInput/js/intlTelInput-jquery.min.js')}}"></script>
<script>
    var initCountry = function(callback) {
        $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "us";
                callback(countryCode);
            });
        };
    var utils = "{{asset('frontend/theme7/intTelInput/js/utils.js')}}" ;
    $("#whatsApp").intlTelInput({
        hiddenInput: "whatsApp",
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: initCountry,
        utilsScript: utils
    });
    $("#phone").intlTelInput({
        hiddenInput: "phone",
        separateDialCode: true,
        initialCountry: "auto",
        geoIpLookup: initCountry,
        utilsScript: utils
    });
</script>


@yield('script')
</body>
</html>
