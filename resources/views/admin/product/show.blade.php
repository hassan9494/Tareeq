@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">
                @if($product->hasMedia('product'))
                    <div class="flag">
                        <img  class="card-img-top"  width="200px" height="200px" src="{{ $product->firstMedia('product')->getUrl() }}">
                    </div>
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">{{$product->name}}</h3>
                <h5>{!! $product->sh_desc !!}}</h5>
                <p class="card-text">{!! $product->desc!!}</p>
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
                            <table id="table" class="table">
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
                                    @foreach($product->orders as $order)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$order->name}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td style="max-width: 10px">{{$order->products->count()}}</td>
                                            <td>{{$order->referred_by ? $order->marketer->name :__('None')}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>{{__($order->status)}}</td>
                                            <td>
                                                <a data-href="{{ route('admin.orders.review', $order) }}" data-name="{{ $order->name }}"
                                                   class="btn btn-success btn-sm text-white" data-toggle="modal"
                                                   data-target="#reviewOrderModal">
                                                    {{__('Show')}}
                                                </a>
                                                @role('admin|Supervisor')
                                                @if($order->status == 'new')
                                                    <a href="{{ route('admin.orders.update', [$order,'completed']) }}" class="btn btn-primary btn-sm text-default" >
                                                        {{__('Complete')}}
                                                    </a>
                                                    <a href="#" onclick="cancelOrder('{{route('admin.orders.update', [$order,'canceled'])}}')" class="btn btn-danger btn-sm text-default" >
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
