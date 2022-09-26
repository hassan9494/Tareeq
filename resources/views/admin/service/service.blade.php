@extends('admin.layout.master')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Service')}}</h4>
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
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    @if($service->count() > 0)
                                        @foreach($service as $servicee)
                                            <tbody>
                                            <tr>
                                                <td>
                                                    @if($servicee->hasMedia('post'))
                                                        <div class="flag">
                                                            <img width="80" height="80" src="{{ $servicee->firstMedia('post')->getUrl() }}">
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{$servicee->subject}}</td>
                                                <td>
                                                    {{$servicee->sh_desc}}
                                                </td>
                                                <td>
{{--                                                    <form action="{{route('admin.posts.destroy',$servicee->id)}}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
                                                        <a href="{{route('admin.posts.edit',$servicee->id)}}" class="btn btn-info btn-xs">
                                                            <i class='fa fa-edit'></i> {{__('Edit')}}
                                                        </a>
                                                        <a href="{{route('admin.posts.show',$servicee->id)}}" class="btn btn-primary btn-xs">{{__('Show')}}</a>
                                                        <button class="btn btn-danger btn-xs" type="submit" onclick="removeService('{{$servicee->subject}}','{{route('admin.service.destroy',$servicee->id)}}')">
                                                            <i class="fas fa-trash"></i> {{__('Delete')}}
                                                        </button>
{{--                                                    </form>--}}
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
        $('input[type="file"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });
        function removeService(name, url, e) {
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
