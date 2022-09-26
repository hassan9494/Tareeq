@extends('admin.layout.master')
@section('title' , __('Users'))

@section('content')

    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Users Table')}}</h4>
                    </div>
                </div>
    <!--Data Table-->
    <!--===================================================-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6 table-toolbar-left">
                            <div class="btn-group">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-striped" id="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th >{{ __('Email') }}</th>
                                <th >{{ __('Created') }}</th>
                                <th >{{ __('Roles') }}</th>

                                @canany(['update user', 'delete user'])
                                    <th scope="col">{{ __('Actions') }}</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d/M/Y') }}</td>
                                        <td>{{ $user->getRoleNames() }}</td>

                                        @canany(['update user', 'delete user'])
                                            <td>
                                                @can('delete user')
                                                <button onclick="removeUser('{{ $user->name }}', '{{ route('admin.users.destroy', $user) }}', event)" class="btn btn-danger fa fa-trash"></button>
                                                @endcan
                                                @can('update user')
                                                    <a href="{{ route('admin.users.edit', $user) }}"  class="btn btn-primary fa fa-edit"></a>
                                                @endcan
                                            </td>
                                        @endcanany
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
