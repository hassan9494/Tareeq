@extends('frontend.'.setting('theme.site').'.layout.master')
@section('content')
    <div class="page-title" style="background-image: url({{asset('frontend/images/page-title.png')}})">
        <h1>{{__('Service')}}</h1>
    </div>

    <section id="blog" xmlns="http://www.w3.org/1999/html">

        <div class="blog container">
            <div class="row">
                <div class="col-md-12">

                    <div class="blog-item">

                        <div class="blog-content">

                            <h2><a href="#">{{$service->subject}}</a></h2>
                            <h3>{!! $service->desc !!}</h3>
                        </div>
                    </div>

                    <!--/.blog-item-->
                </div>

            </div>
        </div>

    </section>
    <!--/#blog-->



    @stop
