<div class="card-body">
    <div class="row">


    </div><div class="row">
        <div class="col-md-12">
            <div class="table-responsive table-hover table-sales">
                <table id="table" class="table">
                    <thead>

                    <th>{{__('Service')}}</th>
                    <th>{{__('Price')}}</th>

                    </thead>
                        <tbody>
                        @foreach($request->items as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->pivot->price}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td ><h3>{{__('Total')}}</h3></td>
                            <td>{{$request->items->sum('price')}}</td>
                        </tr>
                        </tbody>

                </table>

            </div>
        </div>

    </div>
</div>
