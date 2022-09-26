@extends('admin.layout.master')
@section('title','Classes')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Show Class')}}</h4>
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
                                        <th>{{__('Course')}}</th>
                                        <th>{{__('Start From')}}</th>
                                        <th>{{__('Weeks')}}</th>
                                        <th>{{__('Application')}}</th>
                                        <th>{{__('Free Trail')}}</th>

{{--                                        <th>{{__('Action')}}</th>--}}

                                        </thead>

                                                <tbody>
                                                <tr>

                                                    <td>{{$course->student->name}}</td>
                                                    <td>{{$course->teacher->name}}</td>
                                                    <td>{{$course->product->name}}</td>
                                                    <td>{{$course->start_from}}</td>
                                                    <td>{{$course->weeks}}</td>
                                                    <td>{{$course->application}}</td>
                                                    <td>{{$course->free ? 'Yes' : 'No'}}</td>

{{--                                                    <td>--}}
{{--                                                        @role('admin|Supervisor')--}}
{{--                                                        <a href="{{route('admin.classes.show',$course->id)}}" class="btn btn-info btn-xs">--}}
{{--                                                            <i class='fa fa-edit'></i>{{__('Show')}}--}}
{{--                                                        </a>--}}

{{--                                                        @endrole--}}
{{--                                                    </td>--}}
                                                </tr>

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
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Lessons')}}</h4>
                        </div>
                        <button type="button" class="btn float-right btn-outline-primary" data-toggle="modal" data-target="#AddLesson"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table" id="table">
                                        <thead>
                                        <th>{{__('Day')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Time')}}</th>
                                        <th>{{__('Status')}}</th>


                                        <th>{{__('Action')}}</th>

                                        </thead>

                                                <tbody>
                                                @foreach($course->lessons as $lesson)
                                                <form method="post" action="{{route('admin.lesson.update',$lesson)}}">
                                                    @csrf
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="day" value="{{$lesson->day}}" required></td>
                                                        <td><input type="date" class="form-control" name="date" value="{{$lesson->date}}"required></td>
                                                        <td><input type="time" class="form-control" name="time" value="{{$lesson->time}}" required></td>
                                                        <td>{{$lesson->status}}</td>

                                                        <td>
                                                        {{-- @role('admin|Supervisor') --}}
                                                            <button type="submit" class="btn btn-info btn-xs"> <i class='fa fa-edit'></i>{{__('Update')}}</button>
                                                        @if($lesson->status == 'expected')
                                                            <a href="{{route('admin.lesson.status.change',[$lesson->id,'canceled'])}}" class="btn btn-danger btn-xs">
                                                                <i class='fa fa-remove'></i>{{__('Cancel')}}
                                                            </a>
                                                        @endif

                                                            {{-- @endrole --}}
                                                        </td>
                                                    </tr>
                                                </form>
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
    <div class="modal fade" id="AddLesson" tabindex="-1" role="dialog" aria-labelledby="AddLesson" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >{{__('Add lessons')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.lesson.AddLesson')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                        @csrf
                        <input class="form-control" hidden value="{{$course->id}}" type="text" name="course_id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weeks">{{__('Start From') }}*</label>
                                        <input type="date" name="start_from" class="form-control" id="weeks" placeholder="Enter "  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weeks">{{__('Num Of Week') }}*</label>
                                        <input type="number" name="weeks" class="form-control" id="weeks" placeholder="Enter " value="1" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weeks">{{__('Session Time / Minute') }}*</label>
                                        <input type="number" name="session_time" class="form-control" id="weeks"  required>
                                    </div>
                                </div>

                            </div><hr>


                            <h3>{{__('Days')}} <small></small></h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Sunday')}} <small></small></label>
                                        <input name="days[sunday]" type="time"  value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Monday')}} <small></small></label>
                                        <input name="days[monday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Tuesday')}} <small></small></label>
                                        <input name="days[tuesday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Wednesday')}} <small>*</small></label>
                                        <input name="days[wednesday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Thursday')}} <small></small></label>
                                        <input name="days[thursday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Friday')}} <small></small></label>
                                        <input name="days[friday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Saturday')}} <small></small></label>
                                        <input name="days[saturday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>
                        </div>
                    </form>
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
