


@if($aboutUs->hasMedia('about'))

    <section class="aboutus bg-lightest">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>{{__('About Tareeq Ul Arabia')}}</h2>
                <div class="iconh"><i class="fas fa-mosque fa-1x"></i></div>
                <p class="abouttext">{!! nl2br($aboutUs->sh_desc)!!}</p>

                <a class="btn btn-colored btn-theme-colored btn-lg text-uppercase font-13 mt-0" href="{{route('about-us')}}">{{__('See More')}}</a>

            </div>
            <div class="col-lg-6">
                <div class="row counter">
                    <div class="col-lg-4">
                        <div class="icon"><i class="fa fa-graduation-cap fa-2x"></i></div>
                        <p>{{__('Student')}}</p>
                        <p class="pr">1577</p>
                    </div>

                    <div class="col-lg-4">
                        <div class="icon"><i class="fas fa-chalkboard-teacher fa-2x"></i></div>
                        <p>{{__('Teacher')}}</p>
                        <p class="pr">21</p>
                    </div>

                    <div class="col-lg-4">
                        <div class="icon"><i class="fas fa-quran fa-2x"></i></div>
                        <p>{{__('Course')}}</p>
                        <p class="pr">126</p>
                    </div>
                </div>
                <img src="{{$aboutUs->firstMedia('about')->getUrl()}}" >

            </div>
        </div>
    </div>
</section>
@endif

