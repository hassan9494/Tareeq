@extends('layouts.master')
@section('content')


    <!--===================================================-->
    <div class="invoice-wrapper">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="{{asset('images/logo.png')}}" style="width:50%">
                    </div>
                    <div class="col-xs-6 text-right">
                        <h3 class="ltr" style="font-size: 20px"> {{$voucher->number}} #{{__(' ايصال استلام نقديه رقم')}} </h3>

                    </div>
                </div>

                <hr/>

                <div class="row">
                    <div  class="col-xs-12 text-right">
                        <span style="font-size:30px">  {{__('استلمنا نحن شركه:')}}  </span>
                        <span style="font-size: 20px">  {{__('Art Design')}}  </span>

                        <span style="float: left;font-size:20px;text-align:right;">{{__('بتاريخ:')}} {{$voucher->created_at->format('d/m/Y')}} </span>

                    </div>
                </div>

                <div class="purchers">
                    <div class="item2 text-right">
                        <h3>
                            {{__('من السيد:')}}
                            @if($voucher->customer_id)
                                {{ $voucher->customer->name }}
                            @elseif($voucher->supplier_id)
                             {{ $voucher->supplier->name }}
                            @endif

                        </h3>
                        <h3> {{__('مقابل:')}} {{$voucher->paid_for}} </h3>


                    </div>
                    <div  class="item2">
                        <h3> {{__('مبلغ وقدره:')}} {{ $voucher->amount }}   </h3>
                        <h2 style="position: absolute;left:40px">
                            المستلم
                        </h2>
                    </div>

                </div>

                <div class="clr"></div>

                <div class="text-center no-print">
                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    </div>
    <!--===================================================-->



@stop

@section('scripts')

    <script>

        $('#table').footable() ;
        $('#table').dataTable( {
            "responsive": false,
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            }
        } );


    </script>

@stop

