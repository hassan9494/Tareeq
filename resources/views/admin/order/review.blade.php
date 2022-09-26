<div class="card-body">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive table-hover table-sales">
                <table id="table" class="table">
                    <thead>

                    <th>{{__('Name')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Address')}}</th>
                    <th>{{__('Note')}}</th>

                    </thead>
                        <tbody>

                            <tr>
                                <td>{{$order->name}}</td>
                                <td>
                                    {{$order->email}}
                                </td>
                                <td>
                                    {{$order->phone}}
                                </td>
                                <td>
                                    {{$order->address}}
                                </td>
                                <td>
                                    {{$order->note}}
                                </td>


                            </tr>





                        </tbody>

                </table>

            </div>
        </div>

    </div><div class="row">
        <div class="col-md-12">
            <div class="table-responsive table-hover table-sales">
                <table id="table" class="table">
                    <thead>

                    <th>{{__('Product')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Price')}}</th>

                    </thead>
                        <tbody>
                        @foreach($order->products as $product)
                            <tr>
                                <td>{{$product->name}} ({{$product->variations()->where('id',$product->pivot->product_variation_id)->first()->name}})
                                </td>
                                <td>
                                    {{$product->pivot->quantity}}
                                </td>
                                <td>
                                    {{$product->pivot->price}}
                                </td>


                            </tr>


                        @endforeach
                        <tr>
                            <td></td>
                            <td ><h3>{{__('Total')}}</h3></td>
                            <td>
                                {{$order->total}}
                            </td>
                        </tr>

                        </tbody>

                </table>

            </div>
        </div>

    </div>
</div>
