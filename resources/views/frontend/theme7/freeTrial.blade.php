@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title',__('Free Trial'))
@section('content')

    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('frontend/theme7/images/bg/bg6.jpg')}}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="font-28 text-white">{{__('Free Trial')}}</h3>
                            <ol class="breadcrumb text-center text-black mt-10">
                                <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                <li><a href="#">{{__('Student')}}</a></li>
                                <li><a href="#">{{__('Request')}}</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <form method="POST" name="reg-form" action="
                        {{route('freeTrial.request')}}" class="register-form" onsubmit="gtag_report_conversion()">
                            @csrf
                            <input type="hidden" name="type" value="student">
                            <input type="hidden" name="user_id" value="@auth{{auth()->user()->id }}@endauth">


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class=" col-form-label text-md-right">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>

                                    <select name="country" class="form-control" id="country">
                                        @foreach(\App\Country::all() as $country)
                                            <option value="{{$country->name}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone" class=" col-form-label text-md-right">{{ __('Phone') }}</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required >
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                 <div class="form-group col-md-4">
                                    <label for="whatsApp" class=" col-form-label text-md-right">{{ __('WhatsApp Number') }}</label>

                                    <input type="text" class="form-control @error('age') is-invalid @enderror" name="whatsApp" id="whatsApp" value="{{ old('whatsApp') }}">
                                    @error('whatsApp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="age" class=" col-form-label text-md-right">{{ __('Age') }}</label>
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required >
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>{{__('Gender')}} <small>*</small></label>
                                    <select name="gender" class="form-control required valid" aria-required="true" aria-invalid="false">
                                        <option value="male">{{__('Male')}}</option>
                                        <option value="female">{{__('Female')}}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nationality" class=" col-form-label text-md-right">{{ __('Nationality') }}</label>
                                    <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality') }}" required autocomplete="nationality" autofocus>
                                    @error('nationality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="readArabic" class=" col-form-label text-md-right">{{ __('Can you read Arabic?') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="canArab" id="okArabic"  value=""   >
                                        <label class="form-check-label" >
                                            {{__("Yes")}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="canArab" id="noArabic"  value="{{__("No")}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{__("No")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="readArabic" class=" col-form-label text-md-right">{{ __('If you answered yes:') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input readArabic" type="radio" name="readArabic" disabled value="{{__("Good")}}" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{__("Good")}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input readArabic" type="radio" name="readArabic" disabled value="{{__("Beginner")}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{__("Beginner")}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input readArabic" type="radio" name="readArabic" disabled value="{{__("Only letters")}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{__("Only letters")}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- </div>  --}}
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>{{__('You would like to learn')}}</label>
                                    <select name="course" class="form-control " id="country" >
                                        @foreach(\App\CategoryProduct::all() as $category)
                                            <option value="{{$category->name}}">{{$category->name}}</option>
                                        @endforeach
                                        <option value="{{__("All of them")}}">{{__("All of them")}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="knowUs" class=" col-form-label text-md-right">{{ __('How did you get to know us Through ') }}</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="knowUs" id="exampleRadios1" value="{{__("Friend")}}" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{__("Friend")}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="knowUs" id="exampleRadios2" value="{{__("Facebook")}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{__("Facebook")}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="knowUs" id="exampleRadios2" value="{{__("Google")}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{__("Google")}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="knowUs" id="exampleRadios2" value="{{__("Other")}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{__("Other")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">{{__('Request Now')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}
<link href="{{asset('frontend/theme7/intTelInput/css/intlTelInput.css')}}" rel="stylesheet" type="text/css">
{{-- <link href="{{asset('frontend/theme7/intTelInput/css/demo.css')}}" rel="stylesheet" type="text/css"> --}}
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
    $('#okArabic').click(function(){
        $('.readArabic').prop('disabled', false);
    });

    $('#noArabic').click(function(){
        $('.readArabic').prop('disabled', true);
    });
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-304755963"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-304755963');
</script>

<script>
    function gtag_report_conversion(url) {
      var callback = function () {
        if (typeof(url) != 'undefined') {
          window.location = url;
        }
      };
      gtag('event', 'conversion', {
          'send_to': 'AW-304755963/jvLNCMfMtI4DEPvpqJEB',
          'event_callback': callback
      });
      return false;
    }
</script>
@endsection
