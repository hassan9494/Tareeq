@extends('admin.layout.master')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Requests')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table id="table" class="table">
                                    <thead>

                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Address')}}</th>
                                    <th>{{__('Note')}}</th>
                                    <th>{{__('total')}}</th>
                                    <th>{{__('status')}}</th>
                                    <th>{{__('Action')}}</th>

                                    </thead>
                                    @if($requests->count() > 0)
                                        <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$request->name}}</td>
                                                <td>{{$request->email}}</td>
                                                <td>{{$request->phone}}</td>
                                                <td>{{$request->address}}</td>
                                                <td>{{$request->note}}</td>
                                                <td>{{$request->items->sum('pivot.price')}}</td>
                                                <td>{{$request->status}}</td>
                                                <td>
                                                    <a data-href="{{ route('admin.request.review', $request) }}" data-name="{{ $request->name }}"
                                                       class="btn btn-success btn-sm text-white" data-toggle="modal"
                                                       data-target="#reviewOrderModal">
                                                        {{__('Show')}}
                                                    </a>
                                                    @role('admin|Supervisor')
                                                    @if($request->status == 'new')
                                                        <a href="{{ route('admin.request.update', [$request,'completed']) }}" class="btn btn-primary btn-sm text-default" >
                                                            {{__('Complete')}}
                                                        </a>
                                                        <a href="#" onclick="cancelOrder('{{route('admin.request.update', [$request,'canceled'])}}')" class="btn btn-danger btn-sm text-default" >
                                                            {{__('Cancel')}}
                                                        </a>
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
    <div class="modal fade" id="reviewOrderModal" tabindex="-1" role="dialog"
         aria-labelledby="reviewProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewProductModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

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

        $(document).ready(function() {
            $('#reviewOrderModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget),

                    href = button.data('href'),
                    reject = button.data('reject'),
                    name = button.data('name'),
                    modal = $(this);
                $.ajax({
                    url: href,
                    method: 'get',
                    success: function (data) {
                        modal.find('.modal-title').text("Review Order");
                        modal.find('.modal-footer form').attr("action", reject);
                        modal.find('.modal-body').html(data);
                    }
                });
            });
        });
        function cancelOrder( url, e) {
            swal({
                title: "Are you sure?",
                text: " cancel this order",
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
