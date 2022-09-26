@extends('admin.layout.master')
@section('title' , __('Users'))

@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Tasks Table')}}</h4>
                    </div>
                </div>
                <!--Data Table-->
                <!--===================================================-->
                <div class="card-body">
                    @role('admin|Supervisor')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6 table-toolbar-left">
                                <div class="btn-group">
                                    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endrole
                    <div class="table-responsive">
                        <table class="table  table-striped" id="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th >{{ __('Deadline') }}</th>
                                <th >{{ __('Created') }}</th>
                                @role('Marketer')
                                    <th >{{ __('Status') }}</th>
                                @endrole
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->deadLine->format('d/M/Y') }}</td>
                                    <td>{{ $task->created_at->format('d/M/Y') }}</td>


                                    @hasanyrole('admin|Supervisor')
                                        <td>
{{--                                            @can('delete user')--}}
                                                <button onclick="removeUser('{{ $task->name }}', '{{ route('admin.tasks.destroy', $task) }}', event)" class="btn btn-danger fa fa-trash"></button>
{{--                                            @endcan--}}
{{--                                            @can('update user')--}}
                                                <a href="{{ route('admin.tasks.edit', $task) }}"  class="btn btn-primary fa fa-edit"></a>
                                                <a href="{{ route('admin.tasks.show', $task) }}"  class="btn btn-success fa fa-eye"> Show</a>
{{--                                            @endcan--}}
                                        </td>
                                    @endhasanyrole
                                    @hasanyrole('Marketer')
                                        <td>
                                            {{$task->pivot->status}}

                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tasks.marketer.show', $task) }}"  class="btn btn-success fa fa-eye btn-sm"> {{__('Show')}}</a>
                                            @if($task->pivot->status == 'new')
                                            <a href="{{ route('admin.tasks.marketer.status', [$task,'inProgress']) }}"  class="btn btn-info btn-sm"> {{__('In Progress')}}</a>
                                            <a href="{{ route('admin.tasks.marketer.status', [$task,'done']) }}"  class="btn btn-primary btn-sm"> {{__('Done')}}</a>
                                            <a href="{{ route('admin.tasks.marketer.status', [$task,'canceled']) }}"  class="btn  btn-danger btn-sm"> {{__('Cancel')}}</a>
                                            @elseif($task->pivot->status == 'inProgress')
                                                <a href="{{ route('admin.tasks.marketer.status', [$task,'done']) }}"  class="btn btn-primary btn-sm"> {{__('Done')}}</a>
                                                <a href="{{ route('admin.tasks.marketer.status', [$task,'canceled']) }}"  class="btn sm btn-danger btn-sm "> {{__('Cancel')}}</a>
                                            @else

                                            @endif
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

@section('script')
    <script>
        function removeUser(name, url, e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = url;
                    }
                });
        }
        $(document).ready(function() {
            $('#table').dataTable({
                "responsive": false,
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order': [['0', 'desc']]
            });
        });
    </script>

@stop
