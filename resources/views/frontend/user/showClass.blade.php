@extends('layouts.app')
@section('content')
    <section id="home" style="min-height: 200px">
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
                            @if($user->type == 'student')
                                <th>{{__('Free Trail')}}</th>
                            @else
                                <th>{{__('Action')}}</th>
                            @endif


                            </thead>

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
                                <td>{{$course->session_time}} {{__('Minute')}}</td>
                                <td>{{$course->application}}</td>
                                @if($user->type == 'student')
                                    <td>{{$course->free ? 'Yes' : 'No'}}</td>
                                @else
                                    <td>
                                        @if($course->teacher_approve == null)
                                            <a href="{{route('class.approve',[$course->id,1])}}"
                                               class="btn btn-primary btn-xs">
                                                {{__('Approve')}}
                                            </a>
                                            <a href="{{route('class.approve',[$course->id,0])}}"
                                               class="btn btn-danger btn-xs">
                                                {{__('Cancel')}}
                                            </a>
                                        @else
                                            {{$course->teacher_approve ? 'Approved' :'Canceled'}}
                                        @endif
                                    </td>
                                @endif


                            </tr>

                            </tbody>

                        </table>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                            <th>{{__('Day')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Time')}}</th>
                            <th>{{__('Status')}}</th>


                            <th>{{__('Action')}}</th>
                            @if($user->type == 'teacher')
                                <th>{{__('Complete')}}</th>
                                <th>{{__('Student Absent')}}</th>
                            @endif

                            </thead>

                            <tbody>
                            @foreach($course->lessons as $lesson)
                                <tr style="{{$lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first() != null ? "background-color: #e2e6ea" : ""}}">
                                    <td>{{$lesson->day}}</td>
                                    <td>{{$lesson->date}}</td>
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
                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(1) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                    <a href="{{route('lesson.date.change',[$lesson->id])}}"
                                                       class="btn btn-success btn-xs">
                                                        {{__('Change Date')}}
                                                    </a>
                                                @endif
                                            @else
                                                @if($lesson->lessonChangeDate()->where('status','changeDateOfLesson')->first() != null)
                                                    @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(1) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                        <form method="post" action="{{route('lesson.date.approve',[$lesson->id])}}">
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

                                                <textarea name= "comment" class="form-control" required placeholder="Teacher Must Add Note "></textarea>
                                                {{--                                                @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
                                                {{--                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}

                                                <button type="submit" class="btn btn-success btn-xs">{{__('Complete')}}</button>
                                                {{--                                                @endif--}}
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->type == 'teacher' && $lesson->status == 'expected')
                                            <form method="post" action="{{route('class.absent',$lesson->id)}}">
                                                @csrf

                                                <textarea name= "comment" class="form-control" required placeholder="Teacher Must Add Note "></textarea>
                                                {{--                                                @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
                                                {{--                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}

                                                <button type="submit" class="btn btn-danger btn-xs">{{__('Student Absent')}}</button>
                                                {{--                                                @endif--}}
                                            </form>
                                        @endif
                                    </td>
                                    @endif
{{--                                    <td>--}}
{{--                                    @if($user->type == 'teacher' && $lesson->status == 'expected')--}}
{{--                                        --}}{{--                                                <form method="post" action="{{route('class.complete',$lesson->id)}}">--}}
{{--                                        --}}{{--                                                @csrf--}}

{{--                                        --}}{{--                                                <textarea name= "comment" class="form-control" required placeholder="Teacher Must Add Note "></textarea>--}}
{{--                                        --}}{{--                                                @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
{{--                                        --}}{{--                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}

{{--                                        --}}{{--                                                <button type="submit" class="btn btn-success btn-xs">{{__('Student Absent')}}</button>--}}
{{--                                        --}}{{--                                                    <button type="submit" class="btn btn-success btn-xs">{{__('Complete')}}</button>--}}
{{--                                        --}}{{--                                                @endif--}}
{{--                                        --}}{{--                                            </form>--}}
{{--                                        <!-- Trigger/Open The Modal -->--}}
{{--                                            <button id="complete"--}}
{{--                                                    class="btn btn-success btn-xs">{{__('Complete')}}</button>--}}
{{--                                            <button id="absent"--}}
{{--                                                    class="btn btn-danger btn-xs">{{__('Student Absent')}}</button>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{--    <div id="myModal2" class="modal2">--}}

{{--        <!-- Modal content -->--}}
{{--        <div class="modal-content2">--}}
{{--            <span class="close2">&times;</span>--}}
{{--            <form method="post" action="{{route('class.complete',$lesson->id)}}" style="text-align: center;">--}}
{{--                @csrf--}}

{{--                <textarea name="comment" class="form-control" required placeholder="Teacher Must Add Note "></textarea>--}}
{{--                --}}{{--                                                            @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
{{--                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}


{{--                    <button type="submit" class="btn btn-success btn-xs">{{__('Complete')}}</button>--}}
{{--                @endif--}}
{{--            </form>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <div id="myModal1" class="modal1">--}}

{{--        <!-- Modal content -->--}}
{{--        <div class="modal-content1">--}}
{{--            <span class="close1">&times;</span>--}}
{{--            <form method="post" action="{{route('class.absent',$lesson->id)}}" style="text-align: center;">--}}
{{--                @csrf--}}

{{--                <textarea name="comment" class="form-control" required placeholder="Teacher Must Add Note "></textarea>--}}
{{--                --}}{{--                                                            @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
{{--                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}


{{--                    <button type="submit" class="btn btn-danger btn-xs">{{__('Student Absent')}}</button>--}}
{{--                @endif--}}
{{--            </form>--}}
{{--        </div>--}}

{{--    </div>--}}
@endsection
@section('scripts')
    <script>
        // Get the modal
        var modal = document.getElementById("myModal2");

        // Get the button that opens the modal
        var btn = document.getElementById("complete");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close2")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        // Get the modal
        var modal1 = document.getElementById("myModal1");

        // Get the button that opens the modal
        var btn1 = document.getElementById("absent");

        // Get the <span> element that closes the modal
        var span1 = document.getElementsByClassName("close1")[0];

        // When the user clicks on the button, open the modal
        btn1.onclick = function () {
            modal1.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span1.onclick = function () {
            modal1.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }
    </script>
@endsection
