@extends('admin.layout.master')

@section('title',__('Roles'))
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card-heading">
                <h3 class="card-title">{{__('Roles Table')}}</h3>
            </div>
            <!--Data Table-->
            <!--===================================================-->
            <div class="card-body">
                <div class="pad-btm form-inline">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="btn-group">
                                <a href="{{ route('admin.role.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                    <table  id="demo-foo-row-toggler" class="table toggle-arrow-small">
                        <thead>
                        <tr>
                            <th data-toggle="true">#</th>
                            <th >{{ __('Name') }}</th>

                            <th >{{ __('Created') }}</th>
                            <th data-hide="all">{{ __('Permissions') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at->format('d/M/Y') }}</td>

                                    <td>
                                        @foreach($role->getAllPermissions() as $permeation)
                                            <span class="label label-table label-success">{{__($permeation->name)}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('delete role')
                                            <button onclick="removeRole('{{ $role->name }}', '{{ route('admin.role.destroy', $role) }}', event)" class="btn btn-danger fa fa-trash"></button>
                                        @endcan
                                        @can('update role')
                                            <a href="{{ route('admin.role.edit', $role) }}"  class="btn btn-primary fa fa-edit"></a>
                                        @endcan
                                    </td>

                                    {{--                            <td>{{ $user->roles->pluck('name') }}</td>--}}

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
            <!--===================================================-->
            <!--End Data Table-->
        </div>
</div>


@stop

@section('script')
    <script>
        function removeRole(name, url, e) {
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
