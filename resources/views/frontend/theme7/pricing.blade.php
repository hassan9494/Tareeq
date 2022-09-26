
@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title',__('Pricing'))
@section('content')


    <section class="inner-header divider parallax layer-overlay overlay-brown-light" data-bg-img="{{asset('frontend/theme7/images/bg/bg6.jpg')}}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white text-center">{{__('Package Pricing')}}</h2>
                       {{-- <p class=" text-white text-center">{{$category->desc}}</p> --}}
                        <ol class="breadcrumb text-left text-black mt-10">
                            <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                            <li class="active text-gray-silver">{{__('Pricing')}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="gallery" class="newpricing">
        <img class="flower-top" src="{{asset('frontend/theme7/images/flower.png')}}">
        <img class="flower-bottom" src="{{asset('frontend/theme7/images/flower.png')}}">
        <div class="container pt-70 pb-70">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Portfolio Filter -->
                        <div class="portfolio-filter font-alt align-center text-center mb-6 0">

                            <div class="clock">
                                @foreach($packageTimes as $packageTime)
                                    <div class="{{$loop->first ? 'clockmain':'clockt' }}">
                                        <a href="#{{$packageTime->id}}minute" class="" data-filter=".{{$packageTime->id}}"> <i class="far fa-clock"></i><span>  {{$packageTime->time}}</span>  {{__('Min')}}</a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <!-- End Portfolio Filter -->
                     <div class="gallery-isotope grid-1 gutter clearfix">
                        <!-- Portfolio Item Start -->
                        @foreach($packageTimes as $packageTime)
                            <div class="owl-carousel-4col owl-nav-top gallery-item {{$packageTime->id}}" data-dots="true">
                                @foreach($packageTime->packages as $package )
                                    <div class="mycol item ">
                                        <img class="top" src="{{asset('frontend/theme7/images/top.png')}}">
                                        <h3><span>{{$package->days}}</span> {{__(' Day / Week')}}</h3>
                                        <div class="details">
                                            <p><span>${{$package->total_price}}</span>/{{__('Month')}} </p>
                                            <p class="per">{{$package->days}} {{__(' Day / Week')}}</p>
                                            <p class="per">{{$package->classes}} {{__('Classes')}} / {{__('Month')}}</p>
                                            <p class="per">{{$package->packageTime->time}} {{__('Min')}}/{{__('Day')}}</p>
                                            @if($package->Months6)
                                                @php($monthPrice_6 = $package->total_price *6 - (($package->total_price*6)*($package->Months6 /100)) )
                                                @php($monthPrice_12 = $package->total_price *12 - (($package->total_price*12)*($package->Months12 /100)) )
                                                <p><span>${{ (int)$monthPrice_6 }}</span>/6 mo <button class="table1-but1 btn btn-danger">{{__('Save')}} {{$package->Months6}}%</button></p>
                                                <p><span>${{ (int)$monthPrice_12 }}</span>/12 mo <button class="table1-but1 btn btn-danger">{{__('Save')}} {{$package->Months12}}%</button></p>
                                            @endif
                                            <a href="{{route('freeTrial')}}" class="capsule1"><span>{{__('Free Demo')}}</span></a>
                                            <a class="capsule2" data-toggle="modal" data-target="#order"
                                               onclick="getPackage('{{$package->id }}','{{$package->total_price }}')"
                                               href="#"><span>{{__('Get Now')}}</span></a>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                        <!-- Portfolio Gallery Grid -->

                        <!-- End Portfolio Gallery Grid -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Course gird -->
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="order" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >$<span id="title"></span> {{__('Per Month')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('package.payment')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="package_id" value="" >
                        <div class="form-group">
                            <label for="name">{{ __('Months') }}</label>
                            <input type="number" name="months" class="form-control" value="1" min="1" required>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">{{__('Payment Now')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        function getPackage(package,price) {
            // alert(href);
            let modal = $('#order');
            modal.find('.modal-body input[name="package_id"]').val(package);
            modal.find('#title').html(price);
        };
    </script>
@endsection
