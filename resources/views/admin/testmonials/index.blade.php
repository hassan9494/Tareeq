@extends('admin.layout.master')
@section('title','Testimonial')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Testimonial')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <thead>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                   @if($testmonials->count() > 0)
                                       @foreach($testmonials as $testmonial)
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($testmonial->hasMedia('testmonial'))
                                            <div class="flag">
                                                <img width="80" height="80" src="{{ $testmonial->lastMedia('testmonial')->getUrl() }}">
                                            </div>
                                                @endif
                                        </td>
                                        <td>{{$testmonial->name}}</td>
                                        <td>
                                          {{$testmonial->desc}}
                                        </td>
                                        <td>
{{--                                            <form action="{{route('admin.events.destroy',$event->id)}}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
                                                <a href="{{route('admin.testmonials.edit',$testmonial->id)}}" class="btn btn-info btn-xs">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>

                                                <button class="btn btn-danger btn-xs" type="submit" onclick="removeTestmonial('{{ $testmonial->name }}', '{{route('admin.testmonial.destroy',$testmonial->id)}}')">
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
        function removeTestmonial(name, url, e) {
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
