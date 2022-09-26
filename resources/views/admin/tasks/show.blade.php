@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">
                <h5 class="card-title">{{$task->name}}</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{__('DeadLine') .':' .$task->deadLine->format('Y-m-d')}}</h5>
                <p>{!! $task->description !!}}</p>
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
                       <h4 class="card-title">{{__('Users')}}</h4>
                   </div>
               </div>
               <!--Data Table-->
               <!--===================================================-->
               <div class="card-body">

                   <div class="table-responsive">
                       <table class="table  table-striped" id="table">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>{{ __('Name') }}</th>
                               <th >{{ __('Show Task') }}</th>
                               <th >{{ __('Status') }}</th>
{{--                               @canany(['update user', 'delete user'])--}}
                                   <th scope="col">{{ __('Actions') }}</th>
{{--                               @endcanany--}}
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($task->users as $user)
                               <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $user->name }}</td>
                                   <td>{{ $user->pivot->show ? __('Yes'): __('No') }}</td>
                                   <td>{{ $user->pivot->status }}</td>


                                   @hasanyrole('admin|Supervisor')
                                   <td>
                                       <a href="{{ route('admin.tasks.user.show',[$task,$user]) }}"  class="btn btn-success fa fa-comment"> {{__('Comments')}}</a>
                                   </td>
                                   @endhasanyrole
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
       <!--===================================================-->
       <!--End Data Table-->
   </div>
   </div>
@stop
