@extends('admin.layout.master')
@section('title','Classes')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Classes')}}</h4>
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

                                        <td>{{$course->student->name ?? 'HAS DELETED'}}</td>
                                        <td>{{$course->teacher->name ?? 'HAS DELETED'}}</td>
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
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('script')
    <script>
        $('.status').change(function () {
            let status = $(this).prop('checked');
            // console.log(status);
            let href = $(this).next().attr('data-href');
            if(status){status = 1}else{status = 0}
            $.ajax({
                url: href,
                method: 'post',
                data: {'status': status, '_token': "{{ csrf_token() }}"},
                success: function (data) {
                    // window.location.reload();
                }
            });
        });
        function removeProduct(name, url, e) {
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
    </script>
@stop
