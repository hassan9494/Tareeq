
@extends('layouts.app')

@section('content')

    <!-- Section: home -->
    <section id="home" class="" >
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="text-center mb-60"><a href="#" class=""><img alt="" src="images/logo-wide-white.png"></a>
                            </div>
                            <div class="bg-lightest border-1px p-30 mb-0">
                                <h3 class="text-theme-colored mt-0 pt-5">{{__('Work Appointments')}} </h3>
                                <hr>
                                <form id="job_apply_form" action="{{route('teacher.appointments.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <h3>{{__('Sunday')}} <small></small></h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small></small></label>
                                                <input name="sun_start" type="time"  value="{{$appointment == null  ? '': $appointment->sun_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small></small></label>
                                                <input name="sun_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment == null  ? '': $appointment->sun_end}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{__('Monday')}} <small></small></h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small></small></label>
                                                <input name="mon_start" type="time"   value="{{$appointment == null  ? '': $appointment->mon_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small></small></label>
                                                <input name="mon_end" class="form-control" type="time" placeholder="Enter wednesday"   value="{{$appointment == null  ? '': $appointment->mon_end}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{__('Tuesday')}} <small></small></h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small>*</small></label>
                                                <input name="tue_start" type="time"   value="{{$appointment == null  ? '': $appointment->tue_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small>*</small></label>
                                                <input name="tue_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment == null  ? '': $appointment->tue_end}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{__('Wednesday')}} <small></small></h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small>*</small></label>
                                                <input name="wed_start" type="time"   value="{{$appointment == null  ? '': $appointment->wed_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small>*</small></label>
                                                <input name="wed_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment == null  ? '': $appointment->wed_end}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{__('Thursday')}} <small></small></h3>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small>*</small></label>
                                                <input name="thu_start" type="time"   value="{{$appointment == null  ? '': $appointment->thu_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small>*</small></label>
                                                <input name="thu_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment == null  ? '': $appointment->thu_end}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{__('Friday')}} <small></small></h3>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small>*</small></label>
                                                <input name="fri_start" type="time"   value="{{$appointment == null  ? '': $appointment->fri_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small>*</small></label>
                                                <input name="fri_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment == null  ? '': $appointment->fri_end}}">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>{{__('Saturday')}} <small></small></h3>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Start From')}} <small>*</small></label>
                                                <input name="sat_start" type="time"   value="{{$appointment == null  ? '': $appointment->sat_start}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('To')}}  <small>*</small></label>
                                                <input name="sat_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment == null  ? '': $appointment->sat_end}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{--                                        <input name="form_botcheck" class="form-control" type="hidden" value="" />--}}
                                        <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Update Now</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end main-content -->



@endsection
