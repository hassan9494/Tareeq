@extends('admin.layout.master')

@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('Income Table')}}</h3>
                    <h3 class="card-title float-right">{{__('Total')}} :  $ {{ $vouchers->sum('amount') }}</h3>
                </div>
                <!--Data Table-->
                <!--===================================================-->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">


                        <form  method="post" action="{{route('admin.voucher.income.filter')}}">
                            @csrf
                            <div class="row">
                            <div class="col-md-3">
                            <div class=" form-group">
                                <label>{{__('From')}}</label>
                                <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <div class="  form-group">
                                <label>{{__('To')}}</label>
                                <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                            </div>
                            </div>
                                <button type="submit" class="btn btn-active-default btn-sm" style="margin-top: 25px;"> {{__('filter')}}</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    <table  id="table" class="table ">
                        <thead>
                        <tr>
                            <th >{{ __('#') }}</th>
                            <th >{{ __('Amount') }}</th>
                            <th>{{__('From')}}</th>
                            <th >{{ __('Paid For') }}</th>
                            <th>{{__('Date')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vouchers as $voucher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>${{ $voucher->amount }}</td>
                                @if($voucher->user_id)
                                    <td>{{ $voucher->user->name }}</td>
                                @endif
                                <td>{{ $voucher->paid_for }}</td>
                                <td>{{ $voucher->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
        <!--===================================================-->
        <!--End Data Table-->
            </div>
        </div>
    </div>


@stop

@section('script')
    <script>
        $('#table').dataTable( {
            "responsive": false,
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            },
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            'order':[['0','desc']]
        } );
    </script>
@stop
