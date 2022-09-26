@if(count($categoriesProduct) > 0)
<section id="courses" class="bg-lightest">
    <div class="container pt-70 pb-40">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="mt-0 line-height-1 text-center text-uppercase mb-10 text-black-333"> <span class="text-theme-color-2"> {{$catProduct->name}}</span></h2>
{{--                    <div class="iconh"><i class="fas fa-mosque fa-1x"></i></div>--}}
                    <p>{!! $catProduct->description !!}</p>

                </div>
            </div>
        </div>
        <div class="row multi-row-clearfix">
            <div class="col-md-12 ">
                <div class="owl-carousel-3col owl-nav-top" data-dots="true">
                    @foreach($categoriesProduct as $categoryProduct)
                        <div class="item">
                        <div class="project mb-30 border-2px">
                                <a href="{{route('products',$categoryProduct->slug)}}">
                                    @if($categoryProduct->hasMedia('catproduct'))
                                        <div class="thumb">
                                            <img class="img-fullwidth" alt="" src="{{ $categoryProduct->lastMedia('catproduct')->getUrl() }}">
                                        </div>
                                    @endif
                                </a>
                            <div class="project-details p-15 pt-10 pb-10">
                                <h4 class="font-weight-700 text-uppercase mt-0"><a  href="{{route('products',$categoryProduct->slug)}}">{{$categoryProduct->name}}</a></h4>
                                <p>{{$categoryProduct->desc}}</p>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section id="gallery" class="newpricing">
    <img class="flower-top" src="{{asset('frontend/theme7/images/flower.png')}}">
    <img class="flower-bottom" src="{{asset('frontend/theme7/images/flower.png')}}">
    <div class="container pt-70 pb-70">
        <h3 class="mt-0  mb-40"> <span class="text-theme-color-2"> {{__('Our Pricing')}}</span></h3>

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

                    <!-- Portfolio Gallery Grid -->
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
                                                <p><span>${{ $package->total_price *6 - (($package->total_price*6)*($package->Months6 /100))}}</span>/6 mo <button class="table1-but1 btn btn-danger">{{__('Save')}} {{$package->Months6}}%</button></p>
                                                <p><span>${{ $package->total_price *12 - (($package->total_price*12)*($package->Months12 /100))}}</span>/12 mo <button class="table1-but1 btn btn-danger">{{__('Save')}} {{$package->Months12}}%</button></p>
                                            @endif
                                            <a href="{{route('categoryProduct')}}" class="capsule1"><span>{{__('Free Demo')}}</span></a>
                                            <a class="capsule2" data-toggle="modal" data-target="#order"
                                               onclick="getPackage('{{$package->id }}','{{$package->total_price }}')"
                                               href="#"><span>{{__('Get Now')}}</span></a>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <!-- End Portfolio Gallery Grid -->

                </div>
            </div>
        </div>
    </div>
</section> --}}

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

@endif

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
