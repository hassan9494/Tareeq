@extends('layouts.app')

@section('content')
    <section id="home" style="min-height: 200px" >
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">

                            <thead>
                            @if($user->type == 'teacher')
                                <th>{{__('Student')}}</th>
                            @else
                                <th>{{__('Teacher')}}</th>
                            @endif
                            <th>{{__('Course')}}</th>
                            <th>{{__('Start From')}}</th>
                            <th>{{__('Weeks')}}</th>
                            <th>{{__('Lessons')}}</th>
                            <th>{{__('Lesson Time')}}</th>
                            <th>{{__('Application')}}</th>
                            <th>{{__('Free Trail')}}</th>

                            <th>{{__('Action')}}</th>

                            </thead>
                            @if($courses->count() > 0)
                                @foreach($courses as $course)
                                    <tbody>
                                    <tr>
                                        @if($user->type == 'teacher')
                                            <td>{{$course->student->name}}</td>
                                        @else
                                            <td>{{$course->teacher->name}}</td>
                                        @endif
                                        <td>{{$course->product->name}}</td>
                                        <td>{{$course->start_from}}</td>
                                        <td>{{$course->weeks}}</td>
                                        <td>{{$course->lessons->count()}}</td>
                                        <td>{{$course->session_time}}  {{__('Minute')}}</td>
                                        <td>{{$course->application}}</td>
                                        <td>{{$course->free ? 'Yes' : 'No'}}</td>

                                        <td>
                {{--                            @role('admin|Supervisor')--}}
                                            <a href="{{route('class.show',$course->id)}}" class="btn btn-info btn-xs">
                                                <i class='fa fa-edit'></i>{{__('Show')}}
                                            </a>

                {{--                            @endrole--}}
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
    </section>

@endsection
@section('scripts')

@endsection
