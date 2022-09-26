@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title',__('Login'))
@section('style')

<style>
    .field-icon {
        float: right;
        margin-right: 8px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
</style>

@stop
@section('content')

<div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('frontend/theme7/images/bg/bg6.jpg')}}">
            <div class="container pt-70 pb-20">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="font-28 text-white">{{__('Login/Register')}}</h3>
                            <ol class="breadcrumb text-center text-black mt-10">
                                <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                                <li><a href="#">{{__('Teacher')}}</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-40" style="background-color: #bef1ec;padding: 29px;">
                        <h4 class="text-gray mt-0 pt-5"> {{__('Login')}}</h4>
                        <hr>
                        {{--                        <p>Lorem ipsum dolor sit amet, consectetur elit.</p>--}}
                        <form name="login-form" class="clearfix" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email" class=" col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span toggle="#password1"  onclick="showPassword()" class="fa fa-eye field-icon toggle-password"></span>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="checkbox pull-left mt-15">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="form-group pull-right mt-10">
                                <button type="submit" class="btn btn-dark btn-sm">{{__('Login')}}</button>
                            </div>
                            <div class="clear text-center pt-10">
                                @if (Route::has('password.request'))
                                    <a class="text-theme-colored font-weight-600 font-12"  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>

                        </form>
                    </div>
                    <div class="col-md-7 col-md-offset-1">
                        <form method="POST" name="reg-form" class="register-form" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" name="type" value="teacher">
                            <div class="icon-box mb-0 p-0">
                                <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                    <i class="pe-7s-users"></i>
                                </a>
                                <h4 class="text-gray pt-10 mt-0 mb-30">{{__('Don\'t have an Account? Register Now.')}}</h4>
                            </div>
                            <hr>
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
                                <div class="form-group col-md-6">
                                    <label for="phone" class=" col-form-label text-md-right">{{ __('Phone') }}</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value=""  required >
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country" class="col-form-label text-md-right ">{{ __('Country') }}</label>

                                    <select name="country" class="form-control  " id="country">
                                        @foreach(\App\Country::all() as $country)
                                            <option value="{{$country->name}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{__('Gender')}} <small>*</small></label>
                                    <select name="gender" class="form-control required valid" aria-required="true" aria-invalid="false">
                                        <option value="male">{{__('Male')}}</option>
                                        <option value="female">{{__('Female')}}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="country" class="col-form-label text-md-right ">{{ __('ability to teach') }}</label>
                                    <select name="courses[]" class="form-control select2 " id="country" multiple="multiple">
                                        @foreach(\App\CategoryProduct::all() as $category)
                                            <optgroup label="{{$category->name}}">
                                            @foreach($category->products->where('status',1) as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="qualifications" class=" col-form-label text-md-right">{{ __('Qualifications') }}</label>
                                    <textarea id="qualifications" rows="4"  class="form-control @error('qualifications') is-invalid @enderror" name="qualifications"  required ></textarea>
                                </div>

                            </div>
                            <div class="col-12">
                                <label>{{__('Course Preferred Days & Times')}}</label>
                                <textarea class="form-control" rows="4" name="course_days" placeholder="Course Preferred Days &amp; Times"></textarea><br>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label> {{__('Timezone')}}  </label>
                                    <!-- <input type="text" class="form-control" name="timezone" value=""> -->
                                    <select name="timezone" class="my form-control">

                                        <option value="Africa/Abidjan">
                                            Africa/Abidjan - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Accra">
                                            Africa/Accra - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Addis_Ababa">
                                            Africa/Addis_Ababa - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Algiers">
                                            Africa/Algiers - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Asmara">
                                            Africa/Asmara - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Bamako">
                                            Africa/Bamako - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Bangui">
                                            Africa/Bangui - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Banjul">
                                            Africa/Banjul - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Bissau">
                                            Africa/Bissau - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Blantyre">
                                            Africa/Blantyre - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Brazzaville">
                                            Africa/Brazzaville - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Bujumbura">
                                            Africa/Bujumbura - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Cairo">
                                            Africa/Cairo - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Casablanca">
                                            Africa/Casablanca - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Ceuta">
                                            Africa/Ceuta - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Conakry">
                                            Africa/Conakry - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Dakar">
                                            Africa/Dakar - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Dar_es_Salaam">
                                            Africa/Dar_es_Salaam - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Djibouti">
                                            Africa/Djibouti - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Douala">
                                            Africa/Douala - UTC/GMT +01:00                    </option>
                                        <option value="Africa/El_Aaiun">
                                            Africa/El_Aaiun - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Freetown">
                                            Africa/Freetown - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Gaborone">
                                            Africa/Gaborone - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Harare">
                                            Africa/Harare - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Johannesburg">
                                            Africa/Johannesburg - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Juba">
                                            Africa/Juba - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Kampala">
                                            Africa/Kampala - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Khartoum">
                                            Africa/Khartoum - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Kigali">
                                            Africa/Kigali - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Kinshasa">
                                            Africa/Kinshasa - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Lagos">
                                            Africa/Lagos - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Libreville">
                                            Africa/Libreville - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Lome">
                                            Africa/Lome - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Luanda">
                                            Africa/Luanda - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Lubumbashi">
                                            Africa/Lubumbashi - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Lusaka">
                                            Africa/Lusaka - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Malabo">
                                            Africa/Malabo - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Maputo">
                                            Africa/Maputo - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Maseru">
                                            Africa/Maseru - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Mbabane">
                                            Africa/Mbabane - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Mogadishu">
                                            Africa/Mogadishu - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Monrovia">
                                            Africa/Monrovia - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Nairobi">
                                            Africa/Nairobi - UTC/GMT +03:00                    </option>
                                        <option value="Africa/Ndjamena">
                                            Africa/Ndjamena - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Niamey">
                                            Africa/Niamey - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Nouakchott">
                                            Africa/Nouakchott - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Ouagadougou">
                                            Africa/Ouagadougou - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Porto-Novo">
                                            Africa/Porto-Novo - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Sao_Tome">
                                            Africa/Sao_Tome - UTC/GMT +00:00                    </option>
                                        <option value="Africa/Tripoli">
                                            Africa/Tripoli - UTC/GMT +02:00                    </option>
                                        <option value="Africa/Tunis">
                                            Africa/Tunis - UTC/GMT +01:00                    </option>
                                        <option value="Africa/Windhoek">
                                            Africa/Windhoek - UTC/GMT +02:00                    </option>
                                        <option value="America/Adak">
                                            America/Adak - UTC/GMT -09:00                    </option>
                                        <option value="America/Anchorage">
                                            America/Anchorage - UTC/GMT -08:00                    </option>
                                        <option value="America/Anguilla">
                                            America/Anguilla - UTC/GMT -04:00                    </option>
                                        <option value="America/Antigua">
                                            America/Antigua - UTC/GMT -04:00                    </option>
                                        <option value="America/Araguaina">
                                            America/Araguaina - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Buenos_Aires">
                                            America/Argentina/Buenos_Aires - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Catamarca">
                                            America/Argentina/Catamarca - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Cordoba">
                                            America/Argentina/Cordoba - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Jujuy">
                                            America/Argentina/Jujuy - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/La_Rioja">
                                            America/Argentina/La_Rioja - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Mendoza">
                                            America/Argentina/Mendoza - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Rio_Gallegos">
                                            America/Argentina/Rio_Gallegos - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Salta">
                                            America/Argentina/Salta - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/San_Juan">
                                            America/Argentina/San_Juan - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/San_Luis">
                                            America/Argentina/San_Luis - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Tucuman">
                                            America/Argentina/Tucuman - UTC/GMT -03:00                    </option>
                                        <option value="America/Argentina/Ushuaia">
                                            America/Argentina/Ushuaia - UTC/GMT -03:00                    </option>
                                        <option value="America/Aruba">
                                            America/Aruba - UTC/GMT -04:00                    </option>
                                        <option value="America/Asuncion">
                                            America/Asuncion - UTC/GMT -04:00                    </option>
                                        <option value="America/Atikokan">
                                            America/Atikokan - UTC/GMT -05:00                    </option>
                                        <option value="America/Bahia">
                                            America/Bahia - UTC/GMT -03:00                    </option>
                                        <option value="America/Bahia_Banderas">
                                            America/Bahia_Banderas - UTC/GMT -05:00                    </option>
                                        <option value="America/Barbados">
                                            America/Barbados - UTC/GMT -04:00                    </option>
                                        <option value="America/Belem">
                                            America/Belem - UTC/GMT -03:00                    </option>
                                        <option value="America/Belize">
                                            America/Belize - UTC/GMT -06:00                    </option>
                                        <option value="America/Blanc-Sablon">
                                            America/Blanc-Sablon - UTC/GMT -04:00                    </option>
                                        <option value="America/Boa_Vista">
                                            America/Boa_Vista - UTC/GMT -04:00                    </option>
                                        <option value="America/Bogota">
                                            America/Bogota - UTC/GMT -05:00                    </option>
                                        <option value="America/Boise">
                                            America/Boise - UTC/GMT -06:00                    </option>
                                        <option value="America/Cambridge_Bay">
                                            America/Cambridge_Bay - UTC/GMT -06:00                    </option>
                                        <option value="America/Campo_Grande">
                                            America/Campo_Grande - UTC/GMT -04:00                    </option>
                                        <option value="America/Cancun">
                                            America/Cancun - UTC/GMT -05:00                    </option>
                                        <option value="America/Caracas">
                                            America/Caracas - UTC/GMT -04:00                    </option>
                                        <option value="America/Cayenne">
                                            America/Cayenne - UTC/GMT -03:00                    </option>
                                        <option value="America/Cayman">
                                            America/Cayman - UTC/GMT -05:00                    </option>
                                        <option value="America/Chicago">
                                            America/Chicago - UTC/GMT -05:00                    </option>
                                        <option value="America/Chihuahua">
                                            America/Chihuahua - UTC/GMT -06:00                    </option>
                                        <option value="America/Costa_Rica">
                                            America/Costa_Rica - UTC/GMT -06:00                    </option>
                                        <option value="America/Creston">
                                            America/Creston - UTC/GMT -07:00                    </option>
                                        <option value="America/Cuiaba">
                                            America/Cuiaba - UTC/GMT -04:00                    </option>
                                        <option value="America/Curacao">
                                            America/Curacao - UTC/GMT -04:00                    </option>
                                        <option value="America/Danmarkshavn">
                                            America/Danmarkshavn - UTC/GMT +00:00                    </option>
                                        <option value="America/Dawson">
                                            America/Dawson - UTC/GMT -07:00                    </option>
                                        <option value="America/Dawson_Creek">
                                            America/Dawson_Creek - UTC/GMT -07:00                    </option>
                                        <option value="America/Denver">
                                            America/Denver - UTC/GMT -06:00                    </option>
                                        <option value="America/Detroit">
                                            America/Detroit - UTC/GMT -04:00                    </option>
                                        <option value="America/Dominica">
                                            America/Dominica - UTC/GMT -04:00                    </option>
                                        <option value="America/Edmonton">
                                            America/Edmonton - UTC/GMT -06:00                    </option>
                                        <option value="America/Eirunepe">
                                            America/Eirunepe - UTC/GMT -05:00                    </option>
                                        <option value="America/El_Salvador">
                                            America/El_Salvador - UTC/GMT -06:00                    </option>
                                        <option value="America/Fort_Nelson">
                                            America/Fort_Nelson - UTC/GMT -07:00                    </option>
                                        <option value="America/Fortaleza">
                                            America/Fortaleza - UTC/GMT -03:00                    </option>
                                        <option value="America/Glace_Bay">
                                            America/Glace_Bay - UTC/GMT -03:00                    </option>
                                        <option value="America/Goose_Bay">
                                            America/Goose_Bay - UTC/GMT -03:00                    </option>
                                        <option value="America/Grand_Turk">
                                            America/Grand_Turk - UTC/GMT -04:00                    </option>
                                        <option value="America/Grenada">
                                            America/Grenada - UTC/GMT -04:00                    </option>
                                        <option value="America/Guadeloupe">
                                            America/Guadeloupe - UTC/GMT -04:00                    </option>
                                        <option value="America/Guatemala">
                                            America/Guatemala - UTC/GMT -06:00                    </option>
                                        <option value="America/Guayaquil">
                                            America/Guayaquil - UTC/GMT -05:00                    </option>
                                        <option value="America/Guyana">
                                            America/Guyana - UTC/GMT -04:00                    </option>
                                        <option value="America/Halifax">
                                            America/Halifax - UTC/GMT -03:00                    </option>
                                        <option value="America/Havana">
                                            America/Havana - UTC/GMT -04:00                    </option>
                                        <option value="America/Hermosillo">
                                            America/Hermosillo - UTC/GMT -07:00                    </option>
                                        <option value="America/Indiana/Indianapolis">
                                            America/Indiana/Indianapolis - UTC/GMT -04:00                    </option>
                                        <option value="America/Indiana/Knox">
                                            America/Indiana/Knox - UTC/GMT -05:00                    </option>
                                        <option value="America/Indiana/Marengo">
                                            America/Indiana/Marengo - UTC/GMT -04:00                    </option>
                                        <option value="America/Indiana/Petersburg">
                                            America/Indiana/Petersburg - UTC/GMT -04:00                    </option>
                                        <option value="America/Indiana/Tell_City">
                                            America/Indiana/Tell_City - UTC/GMT -05:00                    </option>
                                        <option value="America/Indiana/Vevay">
                                            America/Indiana/Vevay - UTC/GMT -04:00                    </option>
                                        <option value="America/Indiana/Vincennes">
                                            America/Indiana/Vincennes - UTC/GMT -04:00                    </option>
                                        <option value="America/Indiana/Winamac">
                                            America/Indiana/Winamac - UTC/GMT -04:00                    </option>
                                        <option value="America/Inuvik">
                                            America/Inuvik - UTC/GMT -06:00                    </option>
                                        <option value="America/Iqaluit">
                                            America/Iqaluit - UTC/GMT -04:00                    </option>
                                        <option value="America/Jamaica">
                                            America/Jamaica - UTC/GMT -05:00                    </option>
                                        <option value="America/Juneau">
                                            America/Juneau - UTC/GMT -08:00                    </option>
                                        <option value="America/Kentucky/Louisville">
                                            America/Kentucky/Louisville - UTC/GMT -04:00                    </option>
                                        <option value="America/Kentucky/Monticello">
                                            America/Kentucky/Monticello - UTC/GMT -04:00                    </option>
                                        <option value="America/Kralendijk">
                                            America/Kralendijk - UTC/GMT -04:00                    </option>
                                        <option value="America/La_Paz">
                                            America/La_Paz - UTC/GMT -04:00                    </option>
                                        <option value="America/Lima">
                                            America/Lima - UTC/GMT -05:00                    </option>
                                        <option value="America/Los_Angeles">
                                            America/Los_Angeles - UTC/GMT -07:00                    </option>
                                        <option value="America/Lower_Princes">
                                            America/Lower_Princes - UTC/GMT -04:00                    </option>
                                        <option value="America/Maceio">
                                            America/Maceio - UTC/GMT -03:00                    </option>
                                        <option value="America/Managua">
                                            America/Managua - UTC/GMT -06:00                    </option>
                                        <option value="America/Manaus">
                                            America/Manaus - UTC/GMT -04:00                    </option>
                                        <option value="America/Marigot">
                                            America/Marigot - UTC/GMT -04:00                    </option>
                                        <option value="America/Martinique">
                                            America/Martinique - UTC/GMT -04:00                    </option>
                                        <option value="America/Matamoros">
                                            America/Matamoros - UTC/GMT -05:00                    </option>
                                        <option value="America/Mazatlan">
                                            America/Mazatlan - UTC/GMT -06:00                    </option>
                                        <option value="America/Menominee">
                                            America/Menominee - UTC/GMT -05:00                    </option>
                                        <option value="America/Merida">
                                            America/Merida - UTC/GMT -05:00                    </option>
                                        <option value="America/Metlakatla">
                                            America/Metlakatla - UTC/GMT -08:00                    </option>
                                        <option value="America/Mexico_City">
                                            America/Mexico_City - UTC/GMT -05:00                    </option>
                                        <option value="America/Miquelon">
                                            America/Miquelon - UTC/GMT -02:00                    </option>
                                        <option value="America/Moncton">
                                            America/Moncton - UTC/GMT -03:00                    </option>
                                        <option value="America/Monterrey">
                                            America/Monterrey - UTC/GMT -05:00                    </option>
                                        <option value="America/Montevideo">
                                            America/Montevideo - UTC/GMT -03:00                    </option>
                                        <option value="America/Montserrat">
                                            America/Montserrat - UTC/GMT -04:00                    </option>
                                        <option value="America/Nassau">
                                            America/Nassau - UTC/GMT -04:00                    </option>
                                        <option value="America/New_York">
                                            America/New_York - UTC/GMT -04:00                    </option>
                                        <option value="America/Nipigon">
                                            America/Nipigon - UTC/GMT -04:00                    </option>
                                        <option value="America/Nome">
                                            America/Nome - UTC/GMT -08:00                    </option>
                                        <option value="America/Noronha">
                                            America/Noronha - UTC/GMT -02:00                    </option>
                                        <option value="America/North_Dakota/Beulah">
                                            America/North_Dakota/Beulah - UTC/GMT -05:00                    </option>
                                        <option value="America/North_Dakota/Center">
                                            America/North_Dakota/Center - UTC/GMT -05:00                    </option>
                                        <option value="America/North_Dakota/New_Salem">
                                            America/North_Dakota/New_Salem - UTC/GMT -05:00                    </option>
                                        <option value="America/Nuuk">
                                            America/Nuuk - UTC/GMT -02:00                    </option>
                                        <option value="America/Ojinaga">
                                            America/Ojinaga - UTC/GMT -06:00                    </option>
                                        <option value="America/Panama">
                                            America/Panama - UTC/GMT -05:00                    </option>
                                        <option value="America/Pangnirtung">
                                            America/Pangnirtung - UTC/GMT -04:00                    </option>
                                        <option value="America/Paramaribo">
                                            America/Paramaribo - UTC/GMT -03:00                    </option>
                                        <option value="America/Phoenix">
                                            America/Phoenix - UTC/GMT -07:00                    </option>
                                        <option value="America/Port-au-Prince">
                                            America/Port-au-Prince - UTC/GMT -04:00                    </option>
                                        <option value="America/Port_of_Spain">
                                            America/Port_of_Spain - UTC/GMT -04:00                    </option>
                                        <option value="America/Porto_Velho">
                                            America/Porto_Velho - UTC/GMT -04:00                    </option>
                                        <option value="America/Puerto_Rico">
                                            America/Puerto_Rico - UTC/GMT -04:00                    </option>
                                        <option value="America/Punta_Arenas">
                                            America/Punta_Arenas - UTC/GMT -03:00                    </option>
                                        <option value="America/Rainy_River">
                                            America/Rainy_River - UTC/GMT -05:00                    </option>
                                        <option value="America/Rankin_Inlet">
                                            America/Rankin_Inlet - UTC/GMT -05:00                    </option>
                                        <option value="America/Recife">
                                            America/Recife - UTC/GMT -03:00                    </option>
                                        <option value="America/Regina">
                                            America/Regina - UTC/GMT -06:00                    </option>
                                        <option value="America/Resolute">
                                            America/Resolute - UTC/GMT -05:00                    </option>
                                        <option value="America/Rio_Branco">
                                            America/Rio_Branco - UTC/GMT -05:00                    </option>
                                        <option value="America/Santarem">
                                            America/Santarem - UTC/GMT -03:00                    </option>
                                        <option value="America/Santiago">
                                            America/Santiago - UTC/GMT -04:00                    </option>
                                        <option value="America/Santo_Domingo">
                                            America/Santo_Domingo - UTC/GMT -04:00                    </option>
                                        <option value="America/Sao_Paulo">
                                            America/Sao_Paulo - UTC/GMT -03:00                    </option>
                                        <option value="America/Scoresbysund">
                                            America/Scoresbysund - UTC/GMT +00:00                    </option>
                                        <option value="America/Sitka">
                                            America/Sitka - UTC/GMT -08:00                    </option>
                                        <option value="America/St_Barthelemy">
                                            America/St_Barthelemy - UTC/GMT -04:00                    </option>
                                        <option value="America/St_Johns">
                                            America/St_Johns - UTC/GMT -02:30                    </option>
                                        <option value="America/St_Kitts">
                                            America/St_Kitts - UTC/GMT -04:00                    </option>
                                        <option value="America/St_Lucia">
                                            America/St_Lucia - UTC/GMT -04:00                    </option>
                                        <option value="America/St_Thomas">
                                            America/St_Thomas - UTC/GMT -04:00                    </option>
                                        <option value="America/St_Vincent">
                                            America/St_Vincent - UTC/GMT -04:00                    </option>
                                        <option value="America/Swift_Current">
                                            America/Swift_Current - UTC/GMT -06:00                    </option>
                                        <option value="America/Tegucigalpa">
                                            America/Tegucigalpa - UTC/GMT -06:00                    </option>
                                        <option value="America/Thule">
                                            America/Thule - UTC/GMT -03:00                    </option>
                                        <option value="America/Thunder_Bay">
                                            America/Thunder_Bay - UTC/GMT -04:00                    </option>
                                        <option value="America/Tijuana">
                                            America/Tijuana - UTC/GMT -07:00                    </option>
                                        <option value="America/Toronto">
                                            America/Toronto - UTC/GMT -04:00                    </option>
                                        <option value="America/Tortola">
                                            America/Tortola - UTC/GMT -04:00                    </option>
                                        <option value="America/Vancouver">
                                            America/Vancouver - UTC/GMT -07:00                    </option>
                                        <option value="America/Whitehorse">
                                            America/Whitehorse - UTC/GMT -07:00                    </option>
                                        <option value="America/Winnipeg">
                                            America/Winnipeg - UTC/GMT -05:00                    </option>
                                        <option value="America/Yakutat">
                                            America/Yakutat - UTC/GMT -08:00                    </option>
                                        <option value="America/Yellowknife">
                                            America/Yellowknife - UTC/GMT -06:00                    </option>
                                        <option value="Antarctica/Casey">
                                            Antarctica/Casey - UTC/GMT +08:00                    </option>
                                        <option value="Antarctica/Davis">
                                            Antarctica/Davis - UTC/GMT +07:00                    </option>
                                        <option value="Antarctica/DumontDUrville">
                                            Antarctica/DumontDUrville - UTC/GMT +10:00                    </option>
                                        <option value="Antarctica/Macquarie">
                                            Antarctica/Macquarie - UTC/GMT +11:00                    </option>
                                        <option value="Antarctica/Mawson">
                                            Antarctica/Mawson - UTC/GMT +05:00                    </option>
                                        <option value="Antarctica/McMurdo">
                                            Antarctica/McMurdo - UTC/GMT +12:00                    </option>
                                        <option value="Antarctica/Palmer">
                                            Antarctica/Palmer - UTC/GMT -03:00                    </option>
                                        <option value="Antarctica/Rothera">
                                            Antarctica/Rothera - UTC/GMT -03:00                    </option>
                                        <option value="Antarctica/Syowa">
                                            Antarctica/Syowa - UTC/GMT +03:00                    </option>
                                        <option value="Antarctica/Troll">
                                            Antarctica/Troll - UTC/GMT +02:00                    </option>
                                        <option value="Antarctica/Vostok">
                                            Antarctica/Vostok - UTC/GMT +06:00                    </option>
                                        <option value="Arctic/Longyearbyen">
                                            Arctic/Longyearbyen - UTC/GMT +02:00                    </option>
                                        <option value="Asia/Aden">
                                            Asia/Aden - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Almaty">
                                            Asia/Almaty - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Amman">
                                            Asia/Amman - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Anadyr">
                                            Asia/Anadyr - UTC/GMT +12:00                    </option>
                                        <option value="Asia/Aqtau">
                                            Asia/Aqtau - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Aqtobe">
                                            Asia/Aqtobe - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Ashgabat">
                                            Asia/Ashgabat - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Atyrau">
                                            Asia/Atyrau - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Baghdad">
                                            Asia/Baghdad - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Bahrain">
                                            Asia/Bahrain - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Baku">
                                            Asia/Baku - UTC/GMT +04:00                    </option>
                                        <option value="Asia/Bangkok">
                                            Asia/Bangkok - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Barnaul">
                                            Asia/Barnaul - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Beirut">
                                            Asia/Beirut - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Bishkek">
                                            Asia/Bishkek - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Brunei">
                                            Asia/Brunei - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Chita">
                                            Asia/Chita - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Choibalsan">
                                            Asia/Choibalsan - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Colombo">
                                            Asia/Colombo - UTC/GMT +05:30                    </option>
                                        <option value="Asia/Damascus">
                                            Asia/Damascus - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Dhaka">
                                            Asia/Dhaka - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Dili">
                                            Asia/Dili - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Dubai">
                                            Asia/Dubai - UTC/GMT +04:00                    </option>
                                        <option value="Asia/Dushanbe">
                                            Asia/Dushanbe - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Famagusta">
                                            Asia/Famagusta - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Gaza">
                                            Asia/Gaza - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Hebron">
                                            Asia/Hebron - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Ho_Chi_Minh">
                                            Asia/Ho_Chi_Minh - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Hong_Kong">
                                            Asia/Hong_Kong - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Hovd">
                                            Asia/Hovd - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Irkutsk">
                                            Asia/Irkutsk - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Jakarta">
                                            Asia/Jakarta - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Jayapura">
                                            Asia/Jayapura - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Jerusalem">
                                            Asia/Jerusalem - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Kabul">
                                            Asia/Kabul - UTC/GMT +04:30                    </option>
                                        <option value="Asia/Kamchatka">
                                            Asia/Kamchatka - UTC/GMT +12:00                    </option>
                                        <option value="Asia/Karachi">
                                            Asia/Karachi - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Kathmandu">
                                            Asia/Kathmandu - UTC/GMT +05:45                    </option>
                                        <option value="Asia/Khandyga">
                                            Asia/Khandyga - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Kolkata">
                                            Asia/Kolkata - UTC/GMT +05:30                    </option>
                                        <option value="Asia/Krasnoyarsk">
                                            Asia/Krasnoyarsk - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Kuala_Lumpur">
                                            Asia/Kuala_Lumpur - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Kuching">
                                            Asia/Kuching - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Kuwait">
                                            Asia/Kuwait - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Macau">
                                            Asia/Macau - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Magadan">
                                            Asia/Magadan - UTC/GMT +11:00                    </option>
                                        <option value="Asia/Makassar">
                                            Asia/Makassar - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Manila">
                                            Asia/Manila - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Muscat">
                                            Asia/Muscat - UTC/GMT +04:00                    </option>
                                        <option value="Asia/Nicosia">
                                            Asia/Nicosia - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Novokuznetsk">
                                            Asia/Novokuznetsk - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Novosibirsk">
                                            Asia/Novosibirsk - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Omsk">
                                            Asia/Omsk - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Oral">
                                            Asia/Oral - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Phnom_Penh">
                                            Asia/Phnom_Penh - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Pontianak">
                                            Asia/Pontianak - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Pyongyang">
                                            Asia/Pyongyang - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Qatar">
                                            Asia/Qatar - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Qostanay">
                                            Asia/Qostanay - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Qyzylorda">
                                            Asia/Qyzylorda - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Riyadh">
                                            Asia/Riyadh - UTC/GMT +03:00                    </option>
                                        <option value="Asia/Sakhalin">
                                            Asia/Sakhalin - UTC/GMT +11:00                    </option>
                                        <option value="Asia/Samarkand">
                                            Asia/Samarkand - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Seoul">
                                            Asia/Seoul - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Shanghai">
                                            Asia/Shanghai - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Singapore">
                                            Asia/Singapore - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Srednekolymsk">
                                            Asia/Srednekolymsk - UTC/GMT +11:00                    </option>
                                        <option value="Asia/Taipei">
                                            Asia/Taipei - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Tashkent">
                                            Asia/Tashkent - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Tbilisi">
                                            Asia/Tbilisi - UTC/GMT +04:00                    </option>
                                        <option value="Asia/Tehran">
                                            Asia/Tehran - UTC/GMT +04:30                    </option>
                                        <option value="Asia/Thimphu">
                                            Asia/Thimphu - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Tokyo">
                                            Asia/Tokyo - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Tomsk">
                                            Asia/Tomsk - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Ulaanbaatar">
                                            Asia/Ulaanbaatar - UTC/GMT +08:00                    </option>
                                        <option value="Asia/Urumqi">
                                            Asia/Urumqi - UTC/GMT +06:00                    </option>
                                        <option value="Asia/Ust-Nera">
                                            Asia/Ust-Nera - UTC/GMT +10:00                    </option>
                                        <option value="Asia/Vientiane">
                                            Asia/Vientiane - UTC/GMT +07:00                    </option>
                                        <option value="Asia/Vladivostok">
                                            Asia/Vladivostok - UTC/GMT +10:00                    </option>
                                        <option value="Asia/Yakutsk">
                                            Asia/Yakutsk - UTC/GMT +09:00                    </option>
                                        <option value="Asia/Yangon">
                                            Asia/Yangon - UTC/GMT +06:30                    </option>
                                        <option value="Asia/Yekaterinburg">
                                            Asia/Yekaterinburg - UTC/GMT +05:00                    </option>
                                        <option value="Asia/Yerevan">
                                            Asia/Yerevan - UTC/GMT +04:00                    </option>
                                        <option value="Atlantic/Azores">
                                            Atlantic/Azores - UTC/GMT +00:00                    </option>
                                        <option value="Atlantic/Bermuda">
                                            Atlantic/Bermuda - UTC/GMT -03:00                    </option>
                                        <option value="Atlantic/Canary">
                                            Atlantic/Canary - UTC/GMT +01:00                    </option>
                                        <option value="Atlantic/Cape_Verde">
                                            Atlantic/Cape_Verde - UTC/GMT -01:00                    </option>
                                        <option value="Atlantic/Faroe">
                                            Atlantic/Faroe - UTC/GMT +01:00                    </option>
                                        <option value="Atlantic/Madeira">
                                            Atlantic/Madeira - UTC/GMT +01:00                    </option>
                                        <option value="Atlantic/Reykjavik">
                                            Atlantic/Reykjavik - UTC/GMT +00:00                    </option>
                                        <option value="Atlantic/South_Georgia">
                                            Atlantic/South_Georgia - UTC/GMT -02:00                    </option>
                                        <option value="Atlantic/St_Helena">
                                            Atlantic/St_Helena - UTC/GMT +00:00                    </option>
                                        <option value="Atlantic/Stanley">
                                            Atlantic/Stanley - UTC/GMT -03:00                    </option>
                                        <option value="Australia/Adelaide">
                                            Australia/Adelaide - UTC/GMT +09:30                    </option>
                                        <option value="Australia/Brisbane">
                                            Australia/Brisbane - UTC/GMT +10:00                    </option>
                                        <option value="Australia/Broken_Hill">
                                            Australia/Broken_Hill - UTC/GMT +09:30                    </option>
                                        <option value="Australia/Currie">
                                            Australia/Currie - UTC/GMT +10:00                    </option>
                                        <option value="Australia/Darwin">
                                            Australia/Darwin - UTC/GMT +09:30                    </option>
                                        <option value="Australia/Eucla">
                                            Australia/Eucla - UTC/GMT +08:45                    </option>
                                        <option value="Australia/Hobart">
                                            Australia/Hobart - UTC/GMT +10:00                    </option>
                                        <option value="Australia/Lindeman">
                                            Australia/Lindeman - UTC/GMT +10:00                    </option>
                                        <option value="Australia/Lord_Howe">
                                            Australia/Lord_Howe - UTC/GMT +10:30                    </option>
                                        <option value="Australia/Melbourne">
                                            Australia/Melbourne - UTC/GMT +10:00                    </option>
                                        <option value="Australia/Perth">
                                            Australia/Perth - UTC/GMT +08:00                    </option>
                                        <option value="Australia/Sydney">
                                            Australia/Sydney - UTC/GMT +10:00                    </option>
                                        <option value="Europe/Amsterdam">
                                            Europe/Amsterdam - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Andorra">
                                            Europe/Andorra - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Astrakhan">
                                            Europe/Astrakhan - UTC/GMT +04:00                    </option>
                                        <option value="Europe/Athens">
                                            Europe/Athens - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Belgrade">
                                            Europe/Belgrade - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Berlin">
                                            Europe/Berlin - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Bratislava">
                                            Europe/Bratislava - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Brussels">
                                            Europe/Brussels - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Bucharest">
                                            Europe/Bucharest - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Budapest">
                                            Europe/Budapest - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Busingen">
                                            Europe/Busingen - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Chisinau">
                                            Europe/Chisinau - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Copenhagen">
                                            Europe/Copenhagen - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Dublin">
                                            Europe/Dublin - UTC/GMT +01:00                    </option>
                                        <option value="Europe/Gibraltar">
                                            Europe/Gibraltar - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Guernsey">
                                            Europe/Guernsey - UTC/GMT +01:00                    </option>
                                        <option value="Europe/Helsinki">
                                            Europe/Helsinki - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Isle_of_Man">
                                            Europe/Isle_of_Man - UTC/GMT +01:00                    </option>
                                        <option value="Europe/Istanbul">
                                            Europe/Istanbul - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Jersey">
                                            Europe/Jersey - UTC/GMT +01:00                    </option>
                                        <option value="Europe/Kaliningrad">
                                            Europe/Kaliningrad - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Kiev">
                                            Europe/Kiev - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Kirov">
                                            Europe/Kirov - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Lisbon">
                                            Europe/Lisbon - UTC/GMT +01:00                    </option>
                                        <option value="Europe/Ljubljana">
                                            Europe/Ljubljana - UTC/GMT +02:00                    </option>
                                        <option value="Europe/London">
                                            Europe/London - UTC/GMT +01:00                    </option>
                                        <option value="Europe/Luxembourg">
                                            Europe/Luxembourg - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Madrid">
                                            Europe/Madrid - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Malta">
                                            Europe/Malta - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Mariehamn">
                                            Europe/Mariehamn - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Minsk">
                                            Europe/Minsk - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Monaco">
                                            Europe/Monaco - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Moscow">
                                            Europe/Moscow - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Oslo">
                                            Europe/Oslo - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Paris">
                                            Europe/Paris - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Podgorica">
                                            Europe/Podgorica - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Prague">
                                            Europe/Prague - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Riga">
                                            Europe/Riga - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Rome">
                                            Europe/Rome - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Samara">
                                            Europe/Samara - UTC/GMT +04:00                    </option>
                                        <option value="Europe/San_Marino">
                                            Europe/San_Marino - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Sarajevo">
                                            Europe/Sarajevo - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Saratov">
                                            Europe/Saratov - UTC/GMT +04:00                    </option>
                                        <option value="Europe/Simferopol">
                                            Europe/Simferopol - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Skopje">
                                            Europe/Skopje - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Sofia">
                                            Europe/Sofia - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Stockholm">
                                            Europe/Stockholm - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Tallinn">
                                            Europe/Tallinn - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Tirane">
                                            Europe/Tirane - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Ulyanovsk">
                                            Europe/Ulyanovsk - UTC/GMT +04:00                    </option>
                                        <option value="Europe/Uzhgorod">
                                            Europe/Uzhgorod - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Vaduz">
                                            Europe/Vaduz - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Vatican">
                                            Europe/Vatican - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Vienna">
                                            Europe/Vienna - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Vilnius">
                                            Europe/Vilnius - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Volgograd">
                                            Europe/Volgograd - UTC/GMT +04:00                    </option>
                                        <option value="Europe/Warsaw">
                                            Europe/Warsaw - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Zagreb">
                                            Europe/Zagreb - UTC/GMT +02:00                    </option>
                                        <option value="Europe/Zaporozhye">
                                            Europe/Zaporozhye - UTC/GMT +03:00                    </option>
                                        <option value="Europe/Zurich">
                                            Europe/Zurich - UTC/GMT +02:00                    </option>
                                        <option value="Indian/Antananarivo">
                                            Indian/Antananarivo - UTC/GMT +03:00                    </option>
                                        <option value="Indian/Chagos">
                                            Indian/Chagos - UTC/GMT +06:00                    </option>
                                        <option value="Indian/Christmas">
                                            Indian/Christmas - UTC/GMT +07:00                    </option>
                                        <option value="Indian/Cocos">
                                            Indian/Cocos - UTC/GMT +06:30                    </option>
                                        <option value="Indian/Comoro">
                                            Indian/Comoro - UTC/GMT +03:00                    </option>
                                        <option value="Indian/Kerguelen">
                                            Indian/Kerguelen - UTC/GMT +05:00                    </option>
                                        <option value="Indian/Mahe">
                                            Indian/Mahe - UTC/GMT +04:00                    </option>
                                        <option value="Indian/Maldives">
                                            Indian/Maldives - UTC/GMT +05:00                    </option>
                                        <option value="Indian/Mauritius">
                                            Indian/Mauritius - UTC/GMT +04:00                    </option>
                                        <option value="Indian/Mayotte">
                                            Indian/Mayotte - UTC/GMT +03:00                    </option>
                                        <option value="Indian/Reunion">
                                            Indian/Reunion - UTC/GMT +04:00                    </option>
                                        <option value="Pacific/Apia">
                                            Pacific/Apia - UTC/GMT +13:00                    </option>
                                        <option value="Pacific/Auckland">
                                            Pacific/Auckland - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Bougainville">
                                            Pacific/Bougainville - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Chatham">
                                            Pacific/Chatham - UTC/GMT +12:45                    </option>
                                        <option value="Pacific/Chuuk">
                                            Pacific/Chuuk - UTC/GMT +10:00                    </option>
                                        <option value="Pacific/Easter">
                                            Pacific/Easter - UTC/GMT -06:00                    </option>
                                        <option value="Pacific/Efate">
                                            Pacific/Efate - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Enderbury">
                                            Pacific/Enderbury - UTC/GMT +13:00                    </option>
                                        <option value="Pacific/Fakaofo">
                                            Pacific/Fakaofo - UTC/GMT +13:00                    </option>
                                        <option value="Pacific/Fiji">
                                            Pacific/Fiji - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Funafuti">
                                            Pacific/Funafuti - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Galapagos">
                                            Pacific/Galapagos - UTC/GMT -06:00                    </option>
                                        <option value="Pacific/Gambier">
                                            Pacific/Gambier - UTC/GMT -09:00                    </option>
                                        <option value="Pacific/Guadalcanal">
                                            Pacific/Guadalcanal - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Guam">
                                            Pacific/Guam - UTC/GMT +10:00                    </option>
                                        <option value="Pacific/Honolulu">
                                            Pacific/Honolulu - UTC/GMT -10:00                    </option>
                                        <option value="Pacific/Kiritimati">
                                            Pacific/Kiritimati - UTC/GMT +14:00                    </option>
                                        <option value="Pacific/Kosrae">
                                            Pacific/Kosrae - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Kwajalein">
                                            Pacific/Kwajalein - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Majuro">
                                            Pacific/Majuro - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Marquesas">
                                            Pacific/Marquesas - UTC/GMT -09:30                    </option>
                                        <option value="Pacific/Midway">
                                            Pacific/Midway - UTC/GMT -11:00                    </option>
                                        <option value="Pacific/Nauru">
                                            Pacific/Nauru - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Niue">
                                            Pacific/Niue - UTC/GMT -11:00                    </option>
                                        <option value="Pacific/Norfolk">
                                            Pacific/Norfolk - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Noumea">
                                            Pacific/Noumea - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Pago_Pago">
                                            Pacific/Pago_Pago - UTC/GMT -11:00                    </option>
                                        <option value="Pacific/Palau">
                                            Pacific/Palau - UTC/GMT +09:00                    </option>
                                        <option value="Pacific/Pitcairn">
                                            Pacific/Pitcairn - UTC/GMT -08:00                    </option>
                                        <option value="Pacific/Pohnpei">
                                            Pacific/Pohnpei - UTC/GMT +11:00                    </option>
                                        <option value="Pacific/Port_Moresby">
                                            Pacific/Port_Moresby - UTC/GMT +10:00                    </option>
                                        <option value="Pacific/Rarotonga">
                                            Pacific/Rarotonga - UTC/GMT -10:00                    </option>
                                        <option value="Pacific/Saipan">
                                            Pacific/Saipan - UTC/GMT +10:00                    </option>
                                        <option value="Pacific/Tahiti">
                                            Pacific/Tahiti - UTC/GMT -10:00                    </option>
                                        <option value="Pacific/Tarawa">
                                            Pacific/Tarawa - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Tongatapu">
                                            Pacific/Tongatapu - UTC/GMT +13:00                    </option>
                                        <option value="Pacific/Wake">
                                            Pacific/Wake - UTC/GMT +12:00                    </option>
                                        <option value="Pacific/Wallis">
                                            Pacific/Wallis - UTC/GMT +12:00                    </option>
                                        <option value="UTC">
                                            UTC - UTC/GMT +00:00                    </option>
                                        <!-- $t['diff_from_GMT'] . ' - ' . $t['zone']  -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">{{__('Register Now')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        function showPassword(){
            // console.log(this);
            // $(this).toggleClass("fa-eye fa-eye-slash");
            let input = $('#password');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        }
    </script>


@endsection
