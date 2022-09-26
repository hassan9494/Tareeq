@extends('admin.layout.master')
@section('title','Pricing')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Packages')}}</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6 table-toolbar-left">
                                <div class="btn-group">
                                    <a href="{{route('admin.package.create')}}" class="btn btn-primary" ><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Time')}}</th>
                                    <th>{{__('Days / Week')}}</th>
                                    <th>{{__('Classes / Month')}}</th>
                                    <th>{{__('Class Price')}}</th>
                                    <th>{{__('Total Price')}}</th>
                                    <th>{{__('Action')}}</th>

                                    </thead>
                                   @if($packages->count() > 0)
                                       @foreach($packages as $package)
                                    <tbody>
                                    <tr>
                                        <td>{{$package->packageTime->time}} {{__('Minute')}}</td>
                                        <td>{{$package->days}} </td>
                                        <td>{{$package->classes}} </td>
                                        <td>{{$package->class_price}} </td>
                                        <td>{{$package->total_price}} </td>
                                        <td>
{{--                                        @role('admin|Supervisor')--}}
                                            <a href="{{route('admin.package.edit',$package->id)}}"  class="btn btn-info btn-xs" >
                                                <i class='fa fa-edit'></i>{{__('Edit')}}
                                            </a>

{{--                                        @endrole--}}
{{--                                        @role('admin')--}}

                                            <button class="btn btn-danger btn-xs" type="submit" onclick="removePackage('{{route('admin.package.destroy',$package->id)}}')">
                                                <i class="fas fa-trash"></i> {{__('Delete')}}
                                            </button>

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
    </div>

@stop
@section('script')
    <script>
        function removePackage( url, e) {
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
        $(document).ready(function() {
            $('#table').dataTable({
                "responsive": false,
                "paginate": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order': [['0', 'desc']]
            });
        });
        function editCategory(name_en,name_ar,href,img) {
            // alert(href);
            let modal = $('#updateProductCategory');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);

            modal.find('.modal-body img').attr('src', img);

            modal.find('.modal-body form').attr("action",href);

        };
    </script>
@stop
