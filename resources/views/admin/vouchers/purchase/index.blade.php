@extends('admin.layout.master')

@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('Expenses Table')}}</h3>
                    <h3 class="card-title float-right">{{__('Total')}} :  $ {{ $vouchers->sum('amount') }}</h3>
                    <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#productCategory">
                        {{__('Add')}}
                    </button>
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <form  method="post" action="{{route('admin.voucher.filter')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
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
                            <th>{{__('To')}}</th>
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
                                @else
                                <td>{{ $voucher->to }}</td>

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
    <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BlogCategory">{{__('Expense')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.voucher.store')}}" enctype="multipart/form-data" file="true">
                        @csrf

                                <div class="form-group">
                                    <label for="amount">{{ __('amount') }}*</label>
                                    <input type="number"  class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }} "
                                           id="amount" name="amount" value="0" min="1" required>
                                    @if($errors->has('amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('amount') }}
                                        </div>
                                    @endif

                                </div>
                            <div class="form-group">
                                <label for="amount">{{ __('To') }}*</label>
                                <input type="text"  class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }} "
                                       id="for" name="to" value="{{old('to')}}" >
                                @if($errors->has('to'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('to') }}
                                    </div>
                                @endif

                            </div>
                        <div class="form-group">
                                <label for="amount">{{ __('Paid For') }}*</label>
                                <input type="text"  class="form-control {{ $errors->has('for') ? 'is-invalid' : '' }} "
                                       id="for" name="paid_for" value="{{old('paid_for')}}" >
                                @if($errors->has('paid_for'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('paid_for') }}
                                    </div>
                                @endif

                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="address">{{ __('Note') }}</label>--}}
{{--                                <textarea  class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }} "--}}
{{--                                           name="note" value="{{ old('note') }}" ></textarea>--}}
{{--                                @if($errors->has('note'))--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        {{ $errors->first('note') }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            </div>--}}


                        <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                    </form>
                </div>
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
