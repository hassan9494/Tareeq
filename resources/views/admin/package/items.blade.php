@extends('admin.layout.master')
@section('title','Packages')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('All Items')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-6 table-toolbar-left">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.package.item.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table" id="table">
                                        <thead>
                                        <th>{{__('Icon')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Package')}}</th>
                                        <th>{{__('Price')}}</th>

                                        <th>{{__('Action')}}</th>

                                        </thead>
                                        @if($packageItems->count() > 0)
                                            @foreach($packageItems as $item)
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        @if($item->hasMedia('item'))
                                                            <div class="flag">
                                                                <img width="80" height="80" src="{{ $item->lastMedia('item')->getUrl() }}">
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{$item->name}}</td>
                                                    <td>
                                                        {{$item->package->name}}
                                                    </td>
                                                    <td>
                                                        {{$item->price}}
                                                    </td>

                                                    <td>
                                                        {{--                                        @role('admin|Supervisor')--}}
                                                        <a href="{{route('admin.package.item.edit',$item->id)}}" class="btn btn-info btn-xs">
                                                            <i class='fa fa-edit'></i>{{__('Edit')}}
                                                        </a>

                                                        <button class="btn btn-danger btn-xs" type="submit" onclick="removeProduct('{{$item->id}}','{{route('admin.package.item.destroy',$item->id)}}')">
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
                            {{--                        {{ $products->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
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
