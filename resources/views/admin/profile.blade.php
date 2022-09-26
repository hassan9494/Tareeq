@extends('admin.layout.master')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">{{__('Admin')}}</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.profile.update',$admin)}}" enctype="multipart/form-data" file="true">
                    @csrf
{{--                    @method('PUT')--}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Updata Admin Data')}}</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">

                                    <div class="form-group">
                                        <label for="name">{{__('Name')}}</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{$admin->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{__('Email')}}</label>
                                        <input type="email" name="email" class="form-control" id="email"  value="{{$admin->email}}">
                                    </div>

                                    <div class="col-md-12 col-lg-12 mt-3 mb-3">

                                            <p>{{__('Your Password')}}</p>
                                            <div class="form-group text-center">
                                                <input class="form-control email-input {{ $errors->has('oldPassword') ? 'is-invalid' : '' }}" id="password"
                                                       type="password" name="oldPassword">
                                                @if($errors->has('oldPassword'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('oldPassword') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group text-center">
                                                <input class="form-control email-input {{ $errors->has('newPassword') ? 'is-invalid' : '' }}" id="newPassword"
                                                       placeholder="{{ __('New Password') }}"
                                                       type="password" name="newPassword">
                                                @if($errors->has('newPassword'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('newPassword') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group text-center">
                                                <input class="form-control email-input" id="newPassword_confirmation"
                                                       placeholder="{{ __('Password Confirmation') }}"
                                                       type="password" name="newPassword_confirmation">
                                                @if($errors->has('newPassword_confirmation'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('newPassword_confirmation') }}
                                                    </div>
                                                @endif
                                            </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">{{__('Update')}}</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@stop

