@if($partnersLogo )
    <section class="clients bg-theme-colored">
        <div class="container pt-10 pb-0 pt-sm-0 pb-sm-0">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section: Clients -->
                    <div class="owl-carousel-6col transparent text-center owl-nav-top">
                        @foreach($partnersLogo as $logo)
                            <div class="item"> <a href="{{$logo->url}}"><img src="{{$logo->firstMedia('partnersLogo')->getUrl() }}" alt=""></a></div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

