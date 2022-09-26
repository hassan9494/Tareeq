@extends('frontend.'.setting('theme.site').'.layout.master')
@section('content')

    <section id="blog" xmlns="http://www.w3.org/1999/html">
            <div class="blog container">
                <div class="row">
                    <div class="col-md-8">

                            <div class="blog-item">

                                <div class="blog-content">
                                    <h2><a href="#">{{$post->subject}}</a></h2>
                                    <h3>{!! $post->desc !!}</h3>
                                </div>
                             </div>

                            <!--/.blog-item-->
                </div>

                <!--/.col-md-8-->
            @if(count($posts) > 0)
            <aside class="col-md-4">
                <div class="widget popular_post">
                    <h3>{{__('Popular Post')}}</h3>
                    <ul>
                        @foreach($posts as $post)
                        <li>
                            @if($post->hasMedia('post'))
                                <a href="#">
                                    <img src="{{ $post->firstMedia('post')->getUrl() }}" alt="" style="width: 100px; height:100px">
                                    <a  href="{{route('blog',$post->id)}}">{{$post->subject}}</a>
                                </a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
                        <!--/.row-->
            @endif
            </div>
        </div>
{{--        @endif--}}
    </section>
    <!--/#blog-->

@stop
