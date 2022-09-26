@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title',$product->name)

@section('content')


    <!--/#blog-->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{asset('frontend/theme7/images/bg/bg6.jpg')}}">
        <div class="container pt-70 pb-20">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title text-white text-center">{{__('Course Details')}}</h2>
                        <ol class="breadcrumb text-left text-black mt-10">
                            <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                            <li><a href="{{route('products',$product->categoryProduct->slug)}}">{{$product->categoryProduct->name}}</a></li>
                            <li class="active text-gray-silver">{{$product->name}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Blog -->
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="order" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order">{{__('Free Demo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <div class="modal-body">
                    <form  method="POST" action="{{route('freeDemo')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{$product->id}}" >
                        <div class="form-group">
                            <label for="name">{{ __('Date') }}</label>
                            <input type="date" name="date" class="form-control" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Time') }}</label>
                            <input type="time" name="time" class="form-control" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="category">{{ __('Select Teacher') }}</label>
                            <select name="teacher_id" id="category"
                                    class="custom-select form-control auto-save" >
                                <option value="">{{ __('Select') }} {{ __('Teacher') }}</option>
                                @foreach($product->teachers->where('approved',1) as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{__('Send')}}</button>

                    </form>
                </div> --}}
            </div>
        </div>
    </div>

    <section>
        <div class="container mt-30 mb-0 pt-30 pb-30">
            <div class="row">
                <div class="col-md-8 blog-pull-right">
                    <div class="single-service">
                        @if($product->hasMedia('product'))
                                <img id="" src="{{ $product->lastMedia('product')->getUrl() }}" alt="" width="750px" height="500px" >
                        @endif

                        <h3 class="text-theme-colored">{{$product->name}}</h3>
                        <p>{!! $product->desc !!}</p>

                        <br>
                        <a class="btn btn-primary" href="{{route('freeTrial')}}"  >{{__('Free Trial')}}</a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="sidebar sidebar-left mt-sm-30">
                        <div class="widget">
                            <h4 class="widget-title line-bottom">{{__('Courses List')}}</h4>
                            <div class="services-list">
                                <ul class="list list-border">
                                    @foreach($products as $list)
                                        <li class="{{$product->id == $list->id ?'active' : ''}}"><a  href="{{route('product',$list->slug)}}">{{$list->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop



