@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','categoryBlog')
@section('content')
    @if($categoryText->hasMedia('about'))

        <div class="page-title" style="background-image: url({{$categoryText->lastMedia('about')->getUrl() }}); background-size: 100% 100%;background-repeat: no-repeat;">
            <div class="center">
                <h1>{{$categoryText->name}}</h1>
                <p class="lead"> {{$categoryText->description}}</p>
            </div>
        </div>
    @endif
    <section id="blog">
        <div class="container">


            @if(count($categoriesBlog) > 0)
                <div class="row">
                    @foreach($categoriesBlog as $categoryBlog)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="item"
                                 style="background-color:#fff;margin-bottom: 20px;
                              ;width: 100%;height:350px;overflow:hidden">
                                @if($categoryBlog->hasMedia('catBlog'))
                                    <div class="text-center">
                                        <img src="{{ $categoryBlog->firstMedia('catBlog')->getUrl() }}" alt="" style="width:100%;height: 200px">
                                    </div>
                                @endif
                                <div class="content  text-center" style="padding-top:20px">
                                    <h2>
                                        <a  href="{{route('categoryBlog',$categoryBlog->id)}}">{{$categoryBlog->name}}</a>
                                    </h2>
                                    <p style=";font-size:16px;margin-left:10px;margin-right:10px">{{$categoryBlog->desc}}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    @stop
