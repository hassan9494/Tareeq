@extends('frontend.'.setting('theme.site').'.layout.master')
@section('title','blog')
@section('content')

    <section id="blog">
        <div class="container">
            <div class="center fadeInDown">
                <h2>{{__('Blog')}}</h2>
                <p class="lead">{{__('')}}</p>
            </div>
            @if(count($category->posts) > 0)
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="item" style="background-color:#fff;margin-bottom: 20px;
                              ;width: 100%;height:350px;overflow: hidden;">
                            @if($post->hasMedia('post'))
                                <div>
                                    <a  href="{{route('blog',$post->id)}}">
                                       <img src="{{ $post->firstMedia('post')->getUrl() }}" alt="" width="100%" height="200px">
                                    </a>
                                </div>
                            @endif
                            <div class="content text-center" style="padding-top:20px;" >
                                <h2>
                                    <a  href="{{route('blog',$post->id)}}">{{$post->subject}}</a>
                                </h2>
                                <p style="font-size: 16px">{{$post->sh_desc}}</p>

                            </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                <ul>
                    <li class="pagination">{{ $posts->links() }}</li>
                </ul>
            @endif
        </div>
    </section>

@stop

