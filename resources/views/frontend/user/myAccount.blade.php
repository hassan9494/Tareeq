@extends('layouts.app')

@section('content')

                <!-- Section: home -->
<section id="home" class="" >
    <div class="display-table">
        <div class="display-table-cell">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="text-center mb-60"><a href="#" class=""><img alt="" src="images/logo-wide-white.png"></a>
                        </div>
                        <div class="bg-lightest border-1px p-30 mb-0">
                            <h3 class="text-theme-colored mt-0 pt-5">{{__('Update Profile')}} </h3>
                            <hr>
                            <form id="job_apply_form" action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="img">{{__('Profile Image')}}</label>
                                        <div class="form-group" id="imgPreview" >
                                            <img src="{{$user->hasMedia('userAvatar') ? $user->firstMedia('userAvatar')->getUrl() : ''}}" class="img-fluid" alt="" width="200px" height="200px">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="img" class="form-control-file" id="img" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="form-group">
                                                <label>{{__('Name')}} <small>*</small></label>
                                                <input name="name" type="text" placeholder="Enter Name" required="" value="{{$user->name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label>{{__('Email')}}  <small>*</small></label>
                                                <input name="email" class="form-control required email" type="email" placeholder="Enter Email" readonly value="{{$user->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-10">
                                            <label>{{__('Phone')}}  <small>*</small></label>
                                            <input name="phone" class="form-control required" type="text" placeholder="Enter Phone" value="{{$user->phone}}" aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="country" class="col-form-label text-md-right ">{{ __('Country') }}</label>

                                            <select name="country" class="form-control  " id="country">
                                                @foreach(\App\Country::all() as $country)
                                                    <option {{$user->country == $country->name ? 'selected':''}} value="{{$country->name}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if($user->type == 'teacher')
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <table id="table" class="table">
                                                <thead>
                                                    <th>{{__('Video Links')}}</th>
                                                </thead>
                                                <tbody id='tbody'>
                                                    @php($i = 0)
                                                    @if ($videoUrl->count() > 0)
                                                        @foreach ($videoUrl as $vUrl)
                                                        <tr>
                                                            <input class="form-control" type="hidden" name="url_count" value="{{++$i}}">
                                                            <td><input name="video_url_{{$i}}" class="form-control required" type="text" placeholder="Enter video Url" value="{{$vUrl->video}}" aria-required="true"></td>
                                                            <td><button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button></td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <input class="form-control" type="hidden" name="url_count" value="{{++$i}}">
                                                            <td><input name="video_url_{{$i}}" class="form-control required" type="text" placeholder="Enter video Url" value="" aria-required="true"></td>
                                                            <td><button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button></td>
                                                        </tr>
                                                    @endif
                                                    @if ($user->video !=null)
                                                        <tr>
                                                            <td><input name="video" class="form-control required" type="text" placeholder="Enter video" value="{{$user->video}}" aria-required="true"></td>
                                                            <td><button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-1 d-flex align-content-center flex-wrap">
                                            <div class="mt-auto p-2">
                                                <a class="btn btn-theme-colored" id="addBtn"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group mb-10">
                                                <label>{{__('Zoom Link')}}  <small>*</small></label>
                                                <input name="zoom" class="form-control required" type="text" placeholder="Enter zoom" value="{{$user->zoom}}" aria-required="true">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-10">
                                            <label for="country" class="col-form-label text-md-right ">{{ __('Ability To Teach') }}</label>
                                            <select name="courses[]" class="form-control select2 " id="country" multiple="multiple">

                                                @foreach(\App\CategoryProduct::all() as $category)
                                                    <optgroup label="{{$category->name}}">
                                                        @foreach($category->products->where('status',1) as $product)
                                                            <option {{$user->teachCourses->where('id',$product->id)->count() > 0 ?'selected': ''}} value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>

                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('Qualifications')}}   <small>*</small></label>
                                            <textarea name="qualifications" class="form-control required" rows="5" >{{$user->qualifications}}</textarea>
                                        </div>
                                        </div>
                                    </div>
                                @else
                                   <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-10">
                                            <label for="country" class="col-form-label text-md-right ">{{ __('Ability To Teach') }}</label>
                                            <select name="courses[]" class="form-control select2 " id="country" multiple="multiple">

                                                @foreach(\App\CategoryProduct::all() as $category)
                                                    <optgroup label="{{$category->name}}">
                                                        @foreach($category->products->where('status',1) as $product)
                                                            <option {{$user->teachCourses->where('id',$product->id)->count() > 0 ?'selected': ''}} value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>

                                        </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12 col-lg-12 mt-3 mb-3">
                                    <label>{{__('Change Your Password')}}   </label>

                                    <div class="form-group text-center">
                                        <input class="form-control email-input {{ $errors->has('oldPassword') ? 'is-invalid' : '' }}" id="password"
                                               placeholder="{{__('Your Password')}}" type="password" name="oldPassword">
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
                                <div class="form-group">
                                    <input name="form_botcheck" class="form-control" type="hidden" value="" />
                                    <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Update Now</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

            <!-- end main-content -->



@endsection
@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        // add profile photo
        $('input[type="file"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });

        // function add multi vedio link
        $(document).ready(function() {
            var rowIdx = {{ $i??'' }};
            $('#addBtn').on('click', function () {
                $('#tbody').append(
                    `<tr>
                        <input class="form-control" type="hidden" name="url_count" value="${++rowIdx}" >
                        <td><input name="video_url_${rowIdx}" class="form-control" type="text" placeholder="Enter video Url" value="" ></td>
                        <td><button type="button" class="btn btn-link " onclick="removeAttr(this);">{{ __('Delete') }}</button></td>
                    </tr>`
                );
            });
        });
        function removeAttr(el) { $(el).parents('tr').remove(); }

    </script>
@endsection
