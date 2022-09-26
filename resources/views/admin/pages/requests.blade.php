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

                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Page Name')}}</th>
                                    <th>{{__('Type Of Business')}}</th>
                                    <th>{{__('Note')}}</th>

                                    </thead>
                                    @if($requests->count() > 0)
                                        <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{$request->name}}</td>
                                                <td>
                                                    {{$request->email}}
                                                </td>
                                                <td>
                                                    {{$request->phone}}
                                                </td>
                                                <td>
                                                    {{$request->page->name}}
                                                </td>

                                                <td>
                                                    {{$request->typeOfBusiness}}
                                                </td>
                                                <td>
                                                    {{$request->note}}
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
@stop

@section('script')

    <script>
        $(document).ready(function() {
            $('#table').dataTable();
        });
    </script>

@stop
