@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__('Setting')}}</h2>
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.section.setting.update')}}" enctype="multipart/form-data" file="true">
                            @csrf
                            @method('Put')
                            <input type="hidden" name="type" value="blog">
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }} </label>
                                    <input type="text" name="name_{{$locale}}" class="form-control" value="{{$category->getTranslation('name',$locale)}}">
                                </div>
                            @endforeach
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                    <input type="text"  name="description_{{$locale}}" class="form-control" value="{{$category->getTranslation('description',$locale)}}">
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="backgroungColor">{{__('Section Color')}}</label>
                                <input type="color" name="backgroungColor" value="{{$category->backgroundColor}}">
                            </div>

                            <div class="form-group">
                                <label for="img">{{__('Upload Image')}}</label>
                                <input type="file" name="img"  id="img" multiple >
                            </div>

                            <div class="form-row">
                                <div class="col-md-2   text-center">
                                    <div class="form-group" id="imgPreview">
                                        @if($category->hasMedia('blog'))
                                            <img src="{{$category->firstMedia('blog')->getUrl()}}" class="img-fluid"
                                                 alt="">
                                        @else
                                            <img src="" class="img-fluid"
                                                 alt="no image">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
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

    </script>
@stop

