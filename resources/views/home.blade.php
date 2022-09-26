@extends('layouts.app')

@section('content')
    <section id="home" style="min-height: 200px">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Day')}}</th>
                            @if($user->type == 'teacher')
                                <th>{{__('Student')}}</th>
                            @else
                                <th>{{__('Teacher')}}</th>
                            @endif
                            <th>{{__('Time')}}</th>
                            <th>{{__('Status')}}</th>


                            <th>{{__('Action')}}</th>
                            @if($user->type == 'teacher')
                                <th>{{__('Complete')}}</th>
                                <th>{{__('Student Absent')}}</th>
                            @endif

                            </thead>

                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr style="{{$lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first() != null ? "background-color: #e2e6ea" : ""}}">
                                    <td>{{$lesson->date}}</td>
                                    <td>{{$lesson->day}}</td>
                                    @if($user->type == 'teacher')
                                        <td>{{$lesson->course->student->name}}</td>
                                    @else
                                        <td>{{$lesson->course->teacher->name}}</td>
                                    @endif
                                    <td>{{$lesson->time}}</td>
                                    <td>{{$lesson->status}}</td>

                                    <td>
                                        {{--                                                        @role('admin|Supervisor')--}}
                                        {{--                                            <button type="submit" class="btn btn-info btn-xs"> <i class='fa fa-edit'></i>{{__('Update')}}</button>--}}
                                        @if($lesson->status == 'expected')


                                            @if($user->type == 'teacher')
                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(2) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                    <a href="{{route('lesson.status.change',[$lesson->id,'canceled'])}}"
                                                       class="btn btn-danger btn-xs">
                                                        <i class='fa fa-remove'></i>{{__('Cancel')}}
                                                    </a>
                                                @endif
                                            @else
                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(2) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                    <a href="{{route('student.lesson.status.change',[$lesson->id,'canceled'])}}"
                                                       class="btn btn-danger btn-xs">
                                                        <i class='fa fa-remove'></i>{{__('Cancel')}}
                                                    </a>
                                                @endif                                            @endif
                                            @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(1) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                <a href="{{$lesson->course->application == 'zoom'? $lesson->course->teacher->zoom: $lesson->course->teacher->teamLink }}"
                                                   target="_blank" class="btn btn-primary btn-xs">
                                                    {{__('Go')}}
                                                </a>
                                            @endif
                                            @if($user->type == 'teacher')
                                                @if(count($lesson->lessonChangeDate) == 0)
                                                    @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(1) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                        <a href="{{route('lesson.date.change',[$lesson->id])}}"
                                                           class="btn btn-success btn-xs">
                                                            {{__('Change Date')}}
                                                        </a>
                                                    @endif
                                                @endif
                                            @else
                                                @if($lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first() != null)
                                                    @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(1) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                        <form method="post"
                                                              action="{{route('lesson.date.approve',[$lesson->id])}}">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-success btn-xs">{{__('Approve Change Date to ')}} {{$lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first()->date}} {{$lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first()->time}}</button>
                                                        </form>

                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        {{--                                                        @endrole--}}
                                    </td>
                                    @if($user->type == 'teacher')
                                        <td>
                                            @if($user->type == 'teacher' && $lesson->status == 'expected')
                                                <form method="post" action="{{route('class.complete',$lesson->id)}}">
                                                    @csrf

                                                    <textarea name="comment" class="form-control" required
                                                              placeholder="Teacher Must Add Note "></textarea>
                                                    {{--                                                @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
                                                    {{--                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}

                                                    <button type="submit"
                                                            class="btn btn-success btn-xs">{{__('Complete')}}</button>
                                                    {{--                                                @endif--}}
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->type == 'teacher' && $lesson->status == 'expected')
                                                <form method="post" action="{{route('class.absent',$lesson->id)}}">
                                                    @csrf

                                                    <textarea name="comment" class="form-control" required
                                                              placeholder="Teacher Must Add Note "></textarea>
                                                    {{--                                                @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
                                                    {{--                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}

                                                    <button type="submit"
                                                            class="btn btn-danger btn-xs">{{__('Student Absent')}}</button>
                                                    {{--                                                @endif--}}
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
