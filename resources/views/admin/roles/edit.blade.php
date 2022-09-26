@extends('admin.layout.master')
@section('title',__('Roles'))

@section('content')

    <div class="panel">
        <div class="panel-heading">

            <h3 class="panel-title">{{__('Edit role')}}</h3>
        </div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="{{ route('admin.role.update',$role) }}">

            @csrf
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                                   id="name" name="name" value="{{$role->name}}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="roles">{{ __('Permissions') }}</label>
                            <select name="permissions[]" multiple class="form-control roles"  id="roles">
                                @foreach($permissions as $permission)
                                    <option @if($role->hasPermissionTo($permission->name)) selected  @endif value="{{ $permission->id }}"> {{__($permission->name)  }}</option>
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
@stop
@section('script')
    <script>
        $('.roles').selectize({});
    </script>

@stop
