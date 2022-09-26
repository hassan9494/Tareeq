@extends('admin.layout.master')
@section('title' , __('Create User'))
@section('content')
    <div class="container">
        <div class="panel">

        <div class="card">
            <div class="card-header">
                <div class="card-title">{{__('Create Task')}}</div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
        <!--Block Styled Form -->
        <!--===================================================-->
                    <form method="post" action="{{ route('admin.tasks.store') }}">

            @csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">{{ __('Task Name') }}</label>
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
                            <label for="email">{{ __('Deadline') }}</label>
                            <input type="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }} "
                                   id="date" name="deadline" value="" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="description">{{ __('Task Description') }}</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} "
                                   id="description" name="description" required></textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">

                            <label for="roles">{{ __('Country') }}</label>
                            <select name="country_id"  class="form-control users" id="country" >
                                <option   value=""> {{__('All') }}</option>
                                @foreach($countries as $country)
                                    <option  value="{{ $country->id }}"> {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="categories">{{ __('Marketer Category') }}</label>
                            <select name="category"   class="form-control  users"  id="category" >
                                <option   value=""> {{__('All') }}</option>
                            @foreach($categories as $category)
                                    <option   value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row" id="users">

{{--                    <div class="col-sm-9" >--}}
                        @include('admin.tasks.users')
{{--                    </div>--}}
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
        $(document).ready(function() {

            $('.users').change(function () {

                let href = '{{url('admin/tasks/users')}}';
                let country = $('#country').val();
                let category =  $('#category').val();
                $.ajax({
                    url: href,
                    method: 'post',
                    data:{country:country,category:category,_token:'{{csrf_token()}}'},
                    success: function (data) {
                        $('#users').html(data);
                    }
                });
            });
        });


    </script>

@stop
