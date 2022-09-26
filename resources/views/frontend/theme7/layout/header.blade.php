<!--/header-->
<header id="header" class="header">
    <div class="header-top bg-theme-color-2 sm-text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="widget no-border m-0">
                        <ul class="list-inline">
                            @if(setting('general.phone_number_visible'))
                                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-white"></i> <a class="text-white" href="tel:{{setting('general.phone_number')}}">{{setting('general.phone_number')}}</a> </li>
                            @endif
                            @if(setting('general.email_address_visible'))
                                <li class="m-0 pl-10 pr-10"> <i class="far fa-envelope text-white"></i> <a class="text-white" href="mailto:{{setting('general.contact_email')}}">{{setting('general.contact_email')}}</a> </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget no-border m-0">
                        <ul class="list-inline {{App::isLocale('ar') ? 'text-left':'text-right'}} sm-text-center">
                            <li>
                                @if(App::isLocale('ar'))
                                    <a class="text-white" href="{{url('lang/en')}}" >EN</a>
                                @else
                                    <a class="text-white" href="{{url('lang/ar')}}" >AR</a>
                                @endif
                            </li>

                            <li class="text-white">|</li>
                            <li>
                                <a href="#" class="text-white">Support</a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        {{-- <div class="header-nav-wrapper navbar-scrolltofixed bg-white"> --}}
        <div class="header-nav-wrapper navbar-scrolltofixed " style="background: lightcyan;">
            <div class="container" >
                <nav id="menuzord-right" class="menuzord default">
                    <a class="menuzord-brand pull-left flip" href="{{url('/')}}">
                        @if(setting('general.logo'))
                            <img src="{{asset('logo/'.setting('general.logo'))}}" alt="logo">
                        @endif
                    </a>
                    <ul class="menuzord-menu ">
                        @php
                            use App\CategoryProduct;
                              $activeSection= App\Section::Where('active',1)->orderBy('order')->get()->except([2,8,9,10,11]);
                             $categoriesProduct=CategoryProduct::whereNull('parent_id')->get();

                        @endphp
                        <li class="@if(\Request::is('/')){{'current active'}}@endif" ><a style="font-size: large;" href="{{url('/')}}">{{__('Home')}}</a></li>

                        @foreach($activeSection->where('name', '!=' , 'freetrial') as $active)
                            <li class="@if(\Request::is($active->url)){{'current active'}}@endif "><a style="font-size: large;" href="{{url($active->url)}}">{{__($active->name)}}</a>
                            </li>
                        @endforeach
                       {{-- @if(count($categories)>0) --}}
                            <li><a  style="font-size: large;" href="#">{{__("Courses")}}</a>
                                <ul class="dropdown">
                                    @foreach($categoriesProduct as $cat)
                                    <li><a style="font-size: medium;" href="#">{{$cat->name}}</a>
                                            <ul class="dropdown">
                                                @foreach($cat->products->where('status',1) as $product)
                                                    <li><a href="{{route('product',$product->slug)}}">{{$product->name}}</a></li>
                                                @endforeach
                                            </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>

                       {{-- @endif --}}

                        <li class=" @if(\Request::is('pricing')) {{'current active'}}@endif "><a style="font-size: large;" href="{{url('pricing')}}">{{__('Pricing')}}</a></li>
                        <!-- <li class=" @if(\Request::is('contactUs')) {{'current active'}}@endif "><a style="font-size: large;" href="{{url('contactUs')}}">{{__('Contact')}}</a></li> -->
                        <li class=" @if(\Request::is('freeTrial')) {{'current active'}}@endif "><a style="font-size: large; @if(!\Request::is('freeTrial')) {{'background: mediumaquamarine;'}}@endif " href="{{route('freeTrial')}}">{{__('Free Trial')}}</a></li>
                       @auth
                            <li class=""><a style="font-size: large;" href="{{url('/home')}}">{{__('My Account')}}</a></li>
                        @else
                            <li><a style="font-size: large;" href="#">{{__("Login")}}</a>
                            <ul class="dropdown">
                                <li><a style="font-size: large;" href="{{route('login')}}">{{__('Student Login')}}</a></li>
                                <li><a style="font-size: large;" href="{{route('teacher.login')}}">{{__('Teacher Login')}}</a></li>
                            </ul>
                        </li>
                       @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
