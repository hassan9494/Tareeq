@extends('admin.layout.master')
@section('title','student')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Student')}}</h4>
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
                                        <th>{{__('academic_year')}}</th>
                                        <th>{{__('Facebook')}}</th>
                                        <th>{{__('WhatsApp')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->country}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->age}}</td>
                                            <td>{{$user->academic_year}}</td>
                                            <td>
                                                <a href="{{$user->facebook}}"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
                                            </td>
                                            <td>{{$user->whatsApp}}</td>
                                            <td>
                                                @if($user->approved ==0)
                                                    <a class="btn btn-success btn-xs"  href="{{route('admin.approve.review',$user)}}">{{__('Active')}}</a>
                                                @endif
                                                <a href="{{route('admin.student.edit',$user->id)}}" class="btn btn-info btn-xs">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>
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
                                    <th>{{__('Teacher')}}</th>
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
                                                <td>{{$course->teacher->name}}</td>
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
                        <h4 class="card-title">{{__('Packages')}}</h4>
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
                                        <th>{{__('From')}}</th>
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
