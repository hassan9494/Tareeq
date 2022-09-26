@extends('admin.layout.master')

@section('content')
<div class="container p-4">
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Today Lessons')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Student')}}</th>
                                    <th>{{__('Teacher')}}</th>
                                    <th>{{__('Link Zoom')}}</th>
                                    <th>{{__('Course')}}</th>
                                    {{-- <th>{{__('Application')}}</th> --}}
                                    <th>{{__('Session Time')}}</th>
                                    <th>{{__('Time')}}</th>
                                    <th>{{__('Status')}}</th>


                                    <th>{{__('Action')}}</th>

                                    </thead>

                                            <tbody>
                                            @foreach($lessons as $lesson)
                                                <tr>

                                                <td>{{$lesson->course->student->name??''}}</td>
                                                <td>{{$lesson->course->teacher->name??''}}</td>
                                                <td>
                                                    <a href="{{$lesson->course->teacher->zoom??''}}">
                                                        {{$lesson->course->teacher->zoom??''}}
                                                    </a>
                                                </td>
                                                <td>{{$lesson->course->product->name??''}}</td>
                                                {{-- <td>{{$lesson->course->application??''}}</td> --}}
                                                <td>{{$lesson->course->session_time}} min</td>
                                                <td>{{$lesson->time}}</td>
                                                <td>{{$lesson->status}}</td>

                                                <td>
                                                    @if($lesson->status == 'expected')
                                                        <a href="{{route('admin.lesson.status.change',[$lesson->id,'canceled'])}}" class="btn btn-danger btn-xs">
                                                            <i class='fa fa-remove'></i>{{__('Cancel')}}
                                                        </a>
                                                        @endif
                                                    <a href="{{route('admin.classes.show',$lesson->course->id)}}" class="btn btn-info btn-xs">
                                                        <i class='fa fa-edit'></i>{{__('Show')}}
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                </table>
                            </div>
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

    function removeProduct(name, url, e) {
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
    $(document).ready(function() {
        $('#table').dataTable({
            "responsive": false,
            "paginate": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            'order': [['0', 'desc']]
        });
    });
</script>
@stop
