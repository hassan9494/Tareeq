@extends('layouts.app')

@section('content')
    <section id="home" style="min-height: 200px">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    @if ($user->type == 'student')
                        <h2 text-center>Remaining Lessons {{$user->classes}}</h2>
                            @else
                                <h2 text-center>Your Balance $ {{$user->remaining ?$user->remaining : '0'  }} </h2>
                                    @endif
                                    <div class="table-responsive">
                                        @if($user->type == 'student')
                                            <table class="table table-hover table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Amount') }}</th>
                                                    <th>{{__('To')}}</th>
                                                    <th>{{ __('Paid For') }}</th>
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
                                        @else
                                            <table class="table table-hover table-bordered">

                                                <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Amount') }}</th>
                                                    <th>{{__('To')}}</th>
                                                    <th>{{ __('Paid For') }}</th>
                                                    <th>{{__('Date')}}</th>
                                                    <th>{{__('Note')}}</th>

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

                                                        <td>{{ $voucher->note }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        @endif
                                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')

@endsection
