@if(count($service) > 0 )
    <section id="services" class="service-item" style="background-color:{{$mainServiceDesc->backgroundColor}}; ">
    <div class="container">
        <div class="center fadeInDown">
            <h2>{{$mainServiceDesc->name}}</h2>
            <p class="lead">
                {{$mainServiceDesc->description}}
            </p>
        </div>

        <div class="row">

            @foreach($service as $servicee)
                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap fadeInDown">
                        @if($servicee->hasMedia('post'))
                            <div class="pull-left">
                                <img class="img-responsive" src="{{ $servicee->firstMedia('post')->getUrl() }}" style="width:100px; height:100px ">
                            </div>
                        @endif
                        <div class="media-body">
                            <a class="media-heading" href="{{route('service',$servicee->id)}}">{{$servicee->subject}}</a>
                            <p style="overflow: hidden;font-size: 14px">{{$servicee->sh_desc}}</p>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
@endif
    <!--/#services-->
