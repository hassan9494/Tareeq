@extends('admin.layout.master')
@section('title' , __('Create User'))
@section('content')

    <div class="panel">

        <div class="card">
            <div class="card-header">
                <div class="card-title">{{__('Create User')}}</div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
        <!--Block Styled Form -->
        <!--===================================================-->
                    <form method="post" action="{{ route('admin.users.store') }}">

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
                                   id="email" name="email" value="" required>
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
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} "
                                   id="password" name="password" value="" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" required>
                        </div>

                    </div>

                    <div class="col-sm-9">
                        <div class="form-group">

                            <label for="roles">{{ __('Roles') }}</label>
                            <select name="role"  class="form-control"   required>
                                @foreach($roles as $role)
                                    <option  value="{{ $role->id }}"> {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary my-2" type="submit">Save</button>
            </div>

        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@stop
@section('script')
    <script>

        $('.categories').selectize();
        $('.roles').selectize({

        });
    </script>

@stop
