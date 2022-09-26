@extends('admin.layout.master')
@section('title','Teacher')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Teacher')}}</h4>
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
                                    <th>{{__('Qualifications')}}</th>
                                    <th>{{__('Teach')}}</th>
                                    <th>{{__('Balance')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>

                                            <tbody>
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->country}}</td>
                                                <td>{{$user->phone}}</td>
                                                <td>{{$user->qualifications}}</td>
                                                <td>{{$user->teachCourses()->pluck('name')}}</td>
                                                <td>{{$user->remaining}}</td>
                                                <td>
                                                    <a href="{{route('admin.teacher.edit',$user->id)}}" class="btn btn-info btn-xs">
                                                        <i class='fa fa-edit'></i>{{__('Edit')}}
                                                    </a>
                                                    @if($user->approved ==0)
                                                        <a class="btn btn-success btn-xs"  href="{{route('admin.approve.review',$user)}}">{{__('Active')}}</a>
                                                    @endif
                                                    @if($user->showHome ==0)
                                                        <a class="btn btn-info btn-xs"  href="{{route('admin.showHome.show',$user)}}">{{__('show home')}}</a>
                                                    @endif
                                                    @if($user->remaining > 0)
                                                        <a class="btn btn-primary btn-xs"  href="{{route('admin.teacher.paid',$user)}}">{{__('Paid')}}</a>
                                                    @endif
                                                </td>
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
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Appointment')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        @if($appointment)
                        <div class="col-md-12">

                                <h3>{{__('Sunday')}} <small></small></h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small></small></label>
                                            <input readonly name="sun_start" type="time"  value="{{$appointment->sun_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small></small></label>
                                            <input readonly name="sun_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment->sun_end}}">
                                        </div>
                                    </div>
                                </div>
                                <h3>{{__('Monday')}} <small></small></h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small></small></label>
                                            <input readonly name="mon_start" type="time"   value="{{$appointment->mon_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small></small></label>
                                            <input readonly name="mon_end" class="form-control" type="time" placeholder="Enter wednesday"   value="{{$appointment->mon_end}}">
                                        </div>
                                    </div>
                                </div>
                                <h3>{{__('Tuesday')}} <small></small></h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small>*</small></label>
                                            <input readonly name="tue_start" type="time"   value="{{$appointment->tue_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small>*</small></label>
                                            <input readonly name="tue_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment->tue_end}}">
                                        </div>
                                    </div>
                                </div>
                                <h3>{{__('Wednesday')}} <small></small></h3>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small>*</small></label>
                                            <input readonly name="wed_start" type="time"   value="{{$appointment->wed_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small>*</small></label>
                                            <input readonly name="wed_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment->wed_end}}">
                                        </div>
                                    </div>
                                </div>
                                <h3>{{__('Thursday')}} <small></small></h3>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small>*</small></label>
                                            <input readonly name="thu_start" type="time"   value="{{$appointment->thu_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small>*</small></label>
                                            <input readonly name="thu_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment->thu_end}}">
                                        </div>
                                    </div>
                                </div>
                                <h3>{{__('Friday')}} <small></small></h3>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small>*</small></label>
                                            <input readonly name="fri_start" type="time"   value="{{$appointment->fri_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small>*</small></label>
                                            <input readonly name="fri_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment->fri_end}}">
                                        </div>
                                    </div>
                                </div>
                                <h3>{{__('Saturday')}} <small></small></h3>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Start From')}} <small>*</small></label>
                                            <input readonly name="sat_start" type="time"   value="{{$appointment->sat_start}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('To')}}  <small>*</small></label>
                                            <input readonly name="sat_end" class="form-control" type="time" placeholder="Enter Email"   value="{{$appointment->sat_end}}">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Classes')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Student')}}</th>
                                    <th>{{__('Course')}}</th>
                                    <th>{{__('Start From')}}</th>
                                    <th>{{__('Weeks')}}</th>
                                    <th>{{__('Application')}}</th>
                                    <th>{{__('Free Trail')}}</th>

                                    <th>{{__('Action')}}</th>

                                    </thead>
                                    @if($courses->count() > 0)
                                        @foreach($courses as $course)
                                            <tbody>
                                            <tr>
                                                <td>{{$course->student->name}}</td>
                                                <td>{{$course->product->name}}</td>
                                                <td>{{$course->start_from}}</td>
                                                <td>{{$course->weeks}}</td>
                                                <td>{{$course->application}}</td>
                                                <td>{{$course->free ? 'Yes' : 'No'}}</td>
                                                <td>
                                                    @role('admin|Supervisor')
                                                    <a href="{{route('admin.classes.show',$course->id)}}" class="btn btn-info btn-xs">
                                                        <i class='fa fa-edit'></i>{{__('Show')}}
                                                    </a>

                                                    @endrole
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
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Accounting')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table  id="table" class="table ">
                                    <thead>
                                    <tr>
                                        <th >{{ __('#') }}</th>
                                        <th >{{ __('Amount') }}</th>
                                        <th>{{__('To')}}</th>
                                        <th >{{ __('Paid For') }}</th>
                                        <th>{{__('Date')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>${{ $voucher->amount }}</td>
                                            @if($voucher->user_id)
                                                <td>{{ $voucher->user->name }}</td>
                                            @endif
                                            <td>{{ $voucher->paid_for }}</td>
                                            <td>{{ $voucher->created_at }}</td>
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

@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#table').dataTable();
        });
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
