
  
 <!-- Start Our Team Area -->
    
         @if(count($teams) > 0)

        <section class="htc__team__area htc__team__page bg__white ptb--120" style="background-color: {{$teamSection->backgroundColor}}">
            <div class="container">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">{{$teamSection->name}}</h2>
                            <nav class="bradcaump-inner">
                              <a class="breadcrumb-item" href="#">{{$teamSection->description}}</a>
                        
                            </nav>
                        </div>
                    </div>
                    <div class="team__wrap clearfix">
                        <!-- Start Single Team -->
                         @foreach($teams as $team)
                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                <div class="team foo">
                                     @if($team->hasMedia('team'))
                                       <div class="team__thumb">
                                            <a href="#">
                                                <img src="{{ $team->lastMedia('team')->getUrl() }}" alt="team images">
                                            </a>
                                       </div>
                                    @endif
                                    <div class="team__bg__color"></div>
                                    <div class="team__hover__info">
                                        <div class="team__hover__action">
                                            <h2><a href="#">{{$team->name}}</a></h2>
                                            <h6 style="color:#fff">{{$team->desc}}</h6>
                                            <ul class="social__icon">
                                                <li><a href="{{$team->twitter}}"><i class="zmdi zmdi-twitter"></i></a></li>
                        
                                                <li><a href="{{$team->facebook}}"><i class="zmdi zmdi-facebook"></i></a></li>
                                                <li><a href="{{$team->linkedIn}}"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         @endforeach   
                        <!-- End Single Team -->
                       
                    </div>
                </div>
            </div>
        </section>
@endif
<!-- End Our Team Area -->
      
