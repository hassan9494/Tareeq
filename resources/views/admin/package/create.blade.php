@extends('admin.layout.master')
@section('title','Create')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.package.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Add Package')}}</div>

                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Package Time') }}*</label>
                                        <select name="package_time_id" class="custom-select form-control auto-save" required >
                                            <option value="">{{ __('Select') }} {{ __('Package') }}</option>
                                            @foreach($packageTimes as $time)
                                                <option value="{{ $time->id }}">{{ $time->time }} {{__('Minute')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label>{{__('Add Package Time') }}<span
                                                class="d-inline-block d-sm-none"></span></label>
                                        <button type="button" class="btn btn-block btn-outline-primary"
                                                data-toggle="modal" data-target="#productCategory"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('Days / Week') }}*</label>
                                        <input type="number" name="days" class="form-control" id="days" placeholder="Enter Number OF Days Per Week" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('Classes / Month') }}*</label>
                                        <input type="number" onkeyup="totalPrice()" name="classes" class="form-control" id="classes" placeholder="Enter Number OF Classes Per Month"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('Class Price') }}*</label>
                                        <input type="text" name="class_price" onkeyup="totalPrice()" class="form-control" id="price" placeholder="Enter price" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('Total Price') }}*</label>
                                        <input type="text" name="total_price" class="form-control" id="total" placeholder=""  readonly>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('6 months subscription (save) ') }}*</label>
                                        <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="number" max="100" min="0" name="Months6" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                            </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('12 months subscription (save) ') }}*</label>
                                        <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="number" name="Months12" max="100" min="0" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                            </div>
                                    </div>

                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">{{ __('3 months subscription (save) ') }}*</label>
                                        <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                                <input type="number" name="3Months"  class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                            </div>
                                    </div>

                                </div> -->
                            </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BlogCategory">{{__('Add New Package Time')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.packageTime.store')}}" enctype="multipart/form-data" file="true">
                        @csrf


                        <div class="form-group">
                            <label for="time">{{'Time Per Minute'}}</label>
                            <input type="number" min="15" name="time" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        function totalPrice(){
           let classes =  parseInt($('input[name=classes]').val());
           let price =  parseFloat($('#price').val());
           // console.log(classes)
             $('#total').val(classes*price);
        }
    </script>
@stop
