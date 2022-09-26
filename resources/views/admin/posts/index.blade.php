@extends('admin.layout.master')
@section('title','Service')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Posts')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <thead>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Subject')}}</th>
                                    <th>{{__('Short Description')}}</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                   @if($posts->count() > 0)
                                       @foreach($posts as $post)
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($post->hasMedia('post'))
                                            <div class="flag">
                                                <img width="80" height="80" src="{{ $post->firstMedia('post')->getUrl() }}">
                                            </div>
                                                @endif
                                        </td>
                                        <td>{{$post->subject}}</td>
                                        <td>
                                          {{$post->sh_desc}}
                                        </td>
                                        <td>
                                          @if($post->post_cat_id)
                                             {{$post->categoryBlog->name}}
                                          @endif
                                        </td>
                                        <td>
{{--                                            <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
                                                <a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-info btn-xs">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>
                                                <a href="{{route('admin.posts.show',$post->id)}}" class="btn btn-primary btn-xs">{{__('Show')}}</a>
                                                <button class="btn btn-danger btn-xs" type="submit" onclick="removePost('{{$post->name}}','{{route('admin.post.destroy',$post->id)}}')">
                                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                                </button>
{{--                                            </form>--}}
                                        </td>
                                    </tr>

                                    </tbody>
                                     @endforeach
                                   @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        function removePost(name, url, e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = url;
                    }
                });
        };
    </script>
@stop
