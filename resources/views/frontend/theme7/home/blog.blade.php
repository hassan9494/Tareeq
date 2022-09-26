@if(count($categoriesBlog) > 0)
<section id="blog" style="background-color:{{$categoryText->backgroundColor}}; ">
    <div class="container">
        <div class="center fadeInDown">
            <h2>{{$categoryText->name}}</h2>
            <p class="lead">
                {{$categoryText->description}}
            </p>

        </div>

            <div class="row">
                @foreach($categoriesBlog as $categoryBlog)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item"
                             style="background-color:#fff;margin-bottom: 20px;
                              ;width: 100%;height:350px;overflow: hidden;">
                            @if($categoryBlog->hasMedia('catBlog'))
                                <div>
                                    <a  href="{{route('categoryBlog',$categoryBlog->id)}}">
                                        <img src="{{ $categoryBlog->lastMedia('catBlog')->getUrl() }}" alt="" style="width:100%;height: 200px">
                                    </a>
                                </div>
                            @endif
                            <div class="content text-center" style="padding-top:20px;">
                               <h2>
                                   <a  href="{{route('categoryBlog',$categoryBlog->id)}}" >{{$categoryBlog->name}}</a>
                               </h2>
                                <p style="font-size:16px">{{$categoryBlog->desc}}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

    </div>
</section>

@endif
