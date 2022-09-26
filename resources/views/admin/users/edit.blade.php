@extends('admin.layout.master')
@section('title' , __('Edit User'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{__('Create User')}}</div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form method="post" action="{{ route('admin.users.update',$user) }}">

                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                                               id="name" name="name" value="{{ $user->name }}" required>
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
                                               id="email" name="email" value="{{$user->email}}" required>
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
                                               id="password" name="password" value="" >
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
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" >
                                    </div>

                                </div>

                                <div class="col-sm-9">
                                    <div class="form-group">

                                        <label for="roles">{{ __('Roles') }}</label>
                                        <select name="roles"  class="form-control"  id="roles" required>
                                            @foreach($roles as $role)
                                                <option  @if($user->hasRole($role->name)) selected  @endif  value="{{ $role->id }}"> {{ $role->name }}</option>
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
@stop
