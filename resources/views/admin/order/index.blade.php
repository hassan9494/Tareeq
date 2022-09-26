@extends('admin.layout.master')
@section('content')
    <div class="container">

        <div class="row row-card">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Free Trial')}}</h4>
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
                                        <th>{{__('email')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('WhatsApp')}}</th>
                                        <th>{{__('Course')}}</th>
                                        <th>{{__('age')}}</th>
                                        <th>{{__('gender')}}</th>
                                        <th>{{__('country')}}</th>
                                        <th>{{__('nationality')}}</th>
                                        <th>{{__('readArabic')}}</th>
                                        <th>{{__('know us Through')}}</th>

                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        @if($orders->count() > 0)
                                            <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                    @php($name = $order->user_id ? $order->user->name: 'None' )
                                                    @php($email = $order->user_id ? $order->user->email: 'None' )
                                                    @php($phone = $order->user_id ? $order->user->phone: 'None' )
                                                    @php($whatsApp = $order->user_id ? $order->user->whatsApp: 'None' )
                                                    {{-- @php($course = $order->user_id ? $order->product->name: 'None' ) --}}
                                                    <td>{{$loop->iteration }}</td>
                                                    <td>{{$order->name ?? $name }}</td>
                                                    <td>{{$order->email ?? $email }}</td>
                                                    <td>+{{$order->phone ?? $phone }}</td>
                                                    <td>+{{$order->whatsApp ?? $whatsApp }}</td>
                                                    <td>{{$order->course }}</td>
                                                    <td>{{$order->age  }}</td>
                                                    <td>{{$order->gender  }}</td>
                                                    <td>{{$order->country  }}</td>
                                                    <td>{{$order->nationality}}</td>
                                                    <td>{{$order->readArabic}}</td>
                                                    <td>{{$order->knowUs}}</td>

                                                    <td>{{__($order->status)}}</td>
                                                    <td>

                                                        @role('admin|Supervisor')
                                                        @if($order->status == 'new')
                                                            <a href="{{ route('admin.orders.update', [$order,'completed']) }}" class="btn btn-primary btn-sm text-default" >
                                                                {{__('Complete')}}
                                                            </a>
                                                            <a href="#" onclick="cancelOrder('{{route('admin.orders.update', [$order,'canceled'])}}')" class="btn btn-danger btn-sm text-default" >
                                                            {{__('Cancel')}}
                                                        </a>
                                                        @else
                                                            <a href="{{ route('admin.orders.delete', [$order]) }}" class="btn btn-danger btn-sm text-default" >
                                                                {{__('Delete')}}
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
                            {{$orders->links()}}
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
        $('#table').dataTable({ "paginate": false});
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
