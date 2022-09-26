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
                                    <th>{{__('Course Preferred Days & Times')}}</th>
                                    <th>{{__('Timezone')}}</th>
                                    <th>{{__('Balance')}}</th>
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
                                        <td>{{$user->qualifications}}</td>
                                        <td>{{$user->course_days}}</td>
                                        <td>{{$user->timezone}}</td>
                                        <td>{{$user->remaining}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.teacher.edit',$user->id)}}" class="btn btn-info btn-xs">
                                                <i class='fa fa-edit'></i>{{__('Edit')}}
                                            </a>
                                            <a class="btn btn-success btn-xs"  href="{{route('admin.teacher.show',$user)}}">{{__('Profile')}}</a>
                                            @if($user->approved ==0)
                                                <a class="btn btn-success btn-xs"  href="{{route('admin.approve.review',$user)}}">{{__('Active')}}</a>
                                            @endif
                                            @if($user->showHome ==0)
                                                <a class="btn btn-info btn-xs"  href="{{route('admin.showHome.show',$user)}}">{{__('show home')}}</a>
                                            @else
                                                <a class="btn btn-danger btn-xs"  href="{{route('admin.showHome.show',$user)}}">{{__('Hide')}}</a>
                                            @endif
                                            @if($user->remaining > 0)
                                                <a class="btn btn-primary btn-xs"  href="{{route('admin.teacher.paid',$user)}}">{{__('Paid')}}</a>
                                            @endif
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
