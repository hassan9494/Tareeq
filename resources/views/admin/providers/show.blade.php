@extends('admin.layout.master')
@section('content')

   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">
               <h3>{{$provider->name}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table  table-striped" id="table">
                                <thead>
                                <tr>

                                    <th>{{ __('Name') }}</th>
                                    <th >{{ __('Email') }}</th>
                                    <th >{{ __('Phone') }}</th>
                                    <th >{{ __('Address') }}</th>
                                    <th >{{ __('Employee Name') }}</th>
                                    <th >{{ __('Employee Phone') }}</th>
                                    <th >{{ __('Employee Email') }}</th>
                                    <th >{{ __('Employee Job Title') }}</th>

                                    @canany(['update user', 'delete user'])
                                        <th scope="col">{{ __('Actions') }}</th>
                                    @endcanany
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        <td>{{ $provider->name }}</td>
                                        <td>{{ $provider->email }}</td>
                                        <td>{{ $provider->phone }}</td>
                                        <td>{{ $provider->address }}</td>
                                        <td>{{ $provider->employee_name }}</td>
                                        <td>{{ $provider->employee_phone }}</td>
                                        <td>{{ $provider->employee_email }}</td>
                                        <td>{{ $provider->employee_title }}</td>

                                        @role('admin|Supervisor')
                                        <td>
                                            <a href="{{ route('admin.providers.edit', $provider) }}"  class="btn btn-primary fa fa-edit"></a>
                                        </td>
                                        @endrole
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
      </div>
   </div>
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">
               <h3>{{__('Orders')}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                            <table id="table2" class="table">
                                <thead>

                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Phone')}}</th>

                                <th>{{__('Num Of Service')}}</th>
                                <th>{{__('Marketer')}}</th>
                                <th>{{__('Total Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>

                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$order->order->name}}</td>
                                            <td>{{$order->order->phone}}</td>
                                            <td style="max-width: 10px">{{$order->order->products->count()}}</td>
                                            <td>{{$order->order->referred_by ? $order->order->marketer->name :__('None')}}</td>
                                            <td>{{$order->order->total}}</td>
                                            <td>{{__($order->order->status)}}</td>
                                            <td>
                                                <a data-href="{{ route('admin.orders.review', $order->order) }}"
                                                   class="btn btn-success btn-sm text-white" data-toggle="modal"
                                                   data-target="#reviewOrderModal">
                                                    {{__('Show')}}
                                                </a>
                                                @role('admin|Supervisor')
                                                @if($order->order->status == 'new')
                                                    <a href="{{ route('admin.orders.update', [$order->order,'completed']) }}" class="btn btn-primary btn-sm text-default" >
                                                        {{__('Complete')}}
                                                    </a>
                                                    <a href="#" onclick="cancelOrder('{{route('admin.orders.update', [$order->order,'canceled'])}}')" class="btn btn-danger btn-sm text-default" >
                                                        {{__('Cancel')}}
                                                    </a>
                                                @endif
                                                @endrole
                                            </td>
                                        </tr>


                                    @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-muted" style="background-color:rgba(0,0,0,.03);">
                <p class="card-text">
                    @role('Marketer')
                    <button class="btn btn-secondary " aria-label="copied" data-clipboard-text="{{url('product/'.$product->slug.'?ref='.auth()->user()->id)}}">{{__('Copy My Link')}}</button>
                    @endrole
                </p>
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
        var clipboard = new ClipboardJS('.btn');
        clipboard.on('success', function(e) {
            // swal(''e.trigger,'Copied!');
            swal({
                title: "Copied!",
                icon: "success",
                buttons: {
                    confirm : {
                        className: 'btn btn-success'
                    }
                }
            })
        });

        $(document).ready(function() {
            $('#table').dataTable({ "paginate": false});
            $('#table2').dataTable();
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
