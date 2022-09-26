@extends('admin.layout.master')
@section('title' , __('Providers'))

@section('content')

    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Providers Table')}}</h4>
                    </div>
                </div>
    <!--Data Table-->
    <!--===================================================-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6 table-toolbar-left">
                            <div class="btn-group">
                                <a href="{{ route('admin.providers.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
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
                                <th >{{ __('Phone') }}</th>

                                @canany(['update user', 'delete user'])
                                    <th scope="col">{{ __('Actions') }}</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($providers as $provider)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $provider->name }}</td>
                                        <td>{{ $provider->email }}</td>
                                        <td>{{ $provider->phone }}</td>

                                        @role('admin|Supervisor')
                                            <td>
                                                <a href="{{ route('admin.providers.edit', $provider) }}"  class="btn btn-primary fa fa-edit"></a>
                                                <a href="{{ route('admin.providers.show', $provider) }}"  class="btn btn-success fa fa-eye"></a>
                                            </td>
                                        @endrole
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
