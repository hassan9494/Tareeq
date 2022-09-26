@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','Courses')
@section('content')



<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{$catProduct->hasMedia('about') ?$catProduct->lastMedia('about')->getUrl():asset('frontend/theme7/images/bg/bg6.jpg') }}">
    <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-white text-center">{{$catProduct->name}}</h2>
                    <ol class="breadcrumb text-left text-black mt-10">
                        <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                        <li class="active text-gray-silver">{{$catProduct->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>





<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 blog-pull-right">
                <div class="row">
                    @foreach($categoriesProduct as $product)
                        <div class="col-sm-6 col-md-4">
                            <div class="project mb-30 border-2px">
                                <a href="{{route('products',$product->slug)}}">
                                    @if($product->hasMedia('catproduct'))
                                        <div class="thumb" >
                                            <img class="img-fullwidth" style="height: 300px" alt="" src="{{ $product->lastMedia('catproduct')->getUrl() }}">
                                        </div>
                                    @endif
                                </a>
                                <div class="project-details p-15 pt-10 pb-10">
                                    <h4 class="font-weight-700 text-uppercase mt-0"><a href="{{route('products',$product->slug)}}">{{$product->name}}</a></h4>
                                    <h5 class="font-14 font-weight-500 mb-5">{{$product->desc}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <nav>
                    <ul class="pagination xs-pull-center m-0">
                        <!-- {{ $products->links() }} -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
@stop

