@extends('admin.layout.master')
@section('title','Students')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Students')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('phone')}}</th>
                                    <th>{{__('age')}}</th>
                                    <th>{{__('gender')}}</th>
                                    <th>{{__('Timezone')}}</th>
                                    <th>{{__('Academic Year')}}</th>
                                    <th>{{__('Remaining Lessons')}}</th>
                                    <th>{{__('Facebook')}}</th>
                                    <th>{{__('WhatsApp')}}</th>
                                    <th>{{__('Teacher')}}</th>
                                    <th>{{__('Course')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('Days & Times')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                   @if($users->count() > 0)
                                    <tbody>
                                       @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->country}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->age}}</td>
                                        <td>{{$user->gender}}</td>
                                        <td>{{$user->timezone}}</td>
                                        <td>{{$user->academic_year}}</td>
                                        <td>{{$user->classes}}</td>
                                        <td>
                                            <a href="{{$user->facebook}}"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
                                        </td>
                                        <td>{{$user->whatsApp}}</td>
                                        <td>{{$user->teacher ? $user->teacher->name :'None'}}</td>
                                        <td>
                                            {{-- {{$user->course? $user->course->name  :'None'}} --}}
                                            @if ($user->teachCourses)
                                                @foreach ($user->teachCourses as $item)
                                                    - {{$item->name}}
                                                @endforeach
                                            @else
                                                None
                                            @endif

                                        </td>
                                        <td>{{$user->course_start_date}}</td>
                                        <td>{{$user->course_days}}</td>
                                          <td>{{$user->created_at}}</td>
                                        <td>

                                            @if($user->approved ==0)
                                                <a class="btn btn-success btn-xs"  href="{{route('admin.approve.review',$user)}}">{{__('Active')}}</a>
                                            @endif
                                            <a class="btn btn-info btn-xs"  href="{{route('admin.student.show',$user)}}">{{__('Show')}}</a>
                                            @role('admin')
                                            @if($user->deleted_at)
                                                <button class="btn btn-dark btn-xs" type="submit" onclick="removeUser('{{$user->id}}','{{route('admin.site.user.delete',$user->id)}}')">
                                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                                </button>
                                                <a class="btn btn-primary btn-xs"  href="{{route('admin.site.user.recover',$user)}}">{{__('Recover')}}</a>
                                            @else
                                            <button class="btn btn-danger btn-xs" type="submit" onclick="removeUser('{{$user->id}}','{{route('admin.site.user.delete',$user->id)}}')">
                                                <i class="fas fa-trash"></i> {{__('Delete')}}
                                            </button>
                                            @endif
                                            @endrole
                                        </td>
                                    </tr>

                                     @endforeach
                                    </tbody>
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
        $(document).ready(function() {
            $('#table').dataTable();
        });
        function removeUser(name, url, e) {
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
