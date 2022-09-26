@extends('admin.layout.master')
@section('title' , __('Create Provider'))
@section('content')
    <div class="container">
        <div class="panel">

        <div class="card">
            <div class="card-header">
                <div class="card-title">{{__('Create Provider')}}</div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{ route('admin.providers.store') }}">

            @csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} "
                                   id="email" name="email" value="" >
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">{{ __('Phone') }}</label>
                            <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }} "
                                   id="phone" name="phone" value="" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address" >{{ __('Address') }}</label>
                            <input id="address" type="text" class="form-control" name="address"   required>
                        </div>

                    </div>



                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">{{ __('Employee Name') }}</label>
                            <input type="text" class="form-control {{ $errors->has('employee_name') ? 'is-invalid' : '' }} "
                                   id="phone" name="employee_name" value="" >
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address" >{{ __('Employee Job Title') }}</label>
                            <input id="address" type="text" class="form-control" name="employee_title"   >
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">{{ __('Employee Phone') }}</label>
                            <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }} "
                                   id="phone" name="employee_phone" value="" >
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email" >{{ __('Employee Email') }}</label>
                            <input id="email" type="text" class="form-control" name="employee_email"   >
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary my-2" type="submit">{{__('Save')}}</button>
            </div>

        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@stop
@section('script')
    <script>

    </script>

@stop
