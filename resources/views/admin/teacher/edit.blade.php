@extends('admin.layout.master')
@section('title' , __('Edit Teacher'))

@section('content')
    <div class="card">
{{--        <div class="card-header">--}}
{{--            <div class="card-title">{{__('Create User')}}</div>--}}

{{--        </div>--}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form method="post" action="{{ route('admin.teacher.update',$user) }}">

                        @csrf
                        <div class="panel-body">
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
                                    <div class="form-group">
                                        <label>{{__('Name')}} <small>*</small></label>
                                        <input name="name" type="text" placeholder="Enter Name" required="" value="{{$user->name}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Email')}}  <small>*</small></label>
                                        <input name="email" class="form-control required email" type="email" placeholder="Enter Email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Zoom Link') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('zoom') ? 'is-invalid' : '' }} "
                                               id="zoom" name="zoom" value="{{$user->zoom}}" >
                                        @if($errors->has('zoom'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('zoom') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('TeamLink') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('teamLink') ? 'is-invalid' : '' }} "
                                               id="teamLink" name="teamLink" value="{{$user->teamLink}}" >
                                        @if($errors->has('teamLink'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('teamLink') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="form-group" id="div_video_url">
                                        <label for="email">{{ __('Video Links') }}</label>
                                        @if ($user->video !=null)
                                            <div class="row vRow pt-2">
                                                <div class="col-sm-11">
                                                    <input type="text" class="form-control {{ $errors->has('video') ? 'is-invalid' : '' }} " id="video" name="video" value="{{$user->video}}" >
                                                </div>
                                                <div class="col-1">
                                                    <button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button>
                                                </div>
                                            </div>
                                        @endif

                                        @php($i = 0)
                                        @if ($videoUrl->count() > 0)
                                            @foreach ($videoUrl as $vUrl)
                                            <div class="row vRow pt-2">
                                                <div class="col-sm-11">
                                                    <input class="form-control" type="hidden" name="url_count" value="{{++$i}}">
                                                    <input name="video_url_{{$i}}" class="form-control required" type="text" placeholder="Enter video Url" value="{{$vUrl->video}}" aria-required="true">
                                                </div>
                                                <div class="col-1">
                                                    <button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                        <div class="row vRow pt-2">
                                            <div class="col-sm-11">
                                                <input class="form-control" type="hidden" name="url_count" value="{{++$i}}">
                                                <input name="video_url_{{$i}}" class="form-control required" type="text" placeholder="Enter video Url" value="" aria-required="true">
                                            </div>
                                            <div class="col-1">
                                                <button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button>
                                            </div>
                                            <br>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-1 d-flex align-content-center flex-wrap">
                                    <div class="mt-auto p-2">
                                        <a class="btn btn-success" id="addBtn"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Hourly Price') }}</label>
                                        <input type="number" class="form-control {{ $errors->has('teamLink') ? 'is-invalid' : '' }}"
                                               id="hourly_price" name="hourly_price" value="{{$user->hourly_price}}" >
                                        @if($errors->has('hourly_price'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('hourly_price') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-10">
                                        <label>{{__('Phone')}}  <small>*</small></label><br>
                                        <input id="phone" name="phone" class="form-control required" type="text" placeholder="Enter Phone" value="{{$user->phone}}" aria-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="age" class=" col-form-label text-md-right">{{ __('FaceBook Link') }}</label>
                                        <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $user->facebook }}"  >
                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="whatsApp" class=" col-form-label text-md-right">{{ __('WhatsApp Number') }}</label><br>
                                        <input id="whatsApp" type="text" class="form-control @error('age') is-invalid @enderror" name="whatsApp" value="{{ $user->whatsApp }}"  >
                                        @error('whatsApp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class=" col-form-label text-md-right"> {{__('Timezone')}} </label>
                                        <!-- <input type="text" class="form-control" name="timezone" value=""> -->
                                        <select name="timezone" class="my form-control">
                                            @foreach ($countries as $country)
                                                <option value="{{$country->value}}" {{ $user->timezone == $country->value ?'selected': ''}}>{{$country->value}} - {{$country->text}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="canceled_per_month" class=" col-form-label text-md-right">{{ __('Canceled Per Month') }}</label>
                                        <input id="canceled_per_month" type="number" class="form-control @error('canceled_per_month') is-invalid @enderror" name="canceled_per_month" value="{{ $user->canceled_per_month }}"  >
                                        @error('canceled_per_month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="this_month_canceled" class=" col-form-label text-md-right">{{ __('This Month Canceled') }}</label>
                                        <input id="this_month_canceled" type="number" class="form-control @error('this_month_canceled') is-invalid @enderror" name="this_month_canceled" value="{{ $user->this_month_canceled }}"  >
                                        @error('this_month_canceled')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hours_befor_canceled" class=" col-form-label text-md-right">{{ __('Hours Befor Canceled') }}</label>
                                        <input id="hours_befor_canceled" type="number" class="form-control @error('hours_befor_canceled') is-invalid @enderror" name="hours_befor_canceled" value="{{ $user->hours_befor_canceled }}"  >
                                        @error('hours_befor_canceled')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="country" class="col-form-label text-md-right ">{{ __('Country') }}</label>
                                        <select name="country" class="form-control  " id="country">
                                            @foreach(\App\Country::all() as $country)
                                                <option {{$user->country == $country->name ?'selected': ''}} value="{{$country->name}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{__('Gender')}} <small>*</small></label>
                                        <select name="gender" class="form-control required valid" aria-required="true" aria-invalid="false">
                                            <option {{$user->gender =='male' ?'selected': ''}}  value="male">{{__('Male')}}</option>
                                            <option {{$user->gender =='female' ?'selected': ''}}  value="female">{{__('Female')}}</option>
                                        </select>
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
@stop
@section('script')
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
            var rowIdx = {{ $i }};
            $('#addBtn').on('click', function () {
                $('#div_video_url').append(
                    `<div class="row vRow pt-2">
                        <div class="col-sm-11">
                            <input class="form-control" type="hidden" name="url_count" value="${++rowIdx}" >
                            <input name="video_url_${rowIdx}" class="form-control" type="text" placeholder="Enter video Url" value="" >
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-link " onclick="removeAttr(this)">{{ __('Delete') }}</button>
                        </div>
                    </div>
                    `
                );
            });
        });
        function removeAttr(el) { $(el).parents('.vRow').remove(); }
    </script>

@endsection
