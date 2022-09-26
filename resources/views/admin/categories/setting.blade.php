@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__('Gallery Setting')}}</h2>
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.section.setting.update')}}" enctype="multipart/form-data" file="true">
                            @csrf
                            @method('Put')
                            <input type="hidden" name="type" value="portfolio">
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                    <input type="text" name="name_{{$locale}}" class="form-control" value="{{$gallary->getTranslation('name',$locale)}}">
                                </div>
                            @endforeach
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                    <input type="text" name="description_{{$locale}}" class="form-control" value="{{$gallary->getTranslation('description',$locale)}}">
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label for="backgroungColor">{{__('Section Color')}}</label>
                                <input type="color" name="backgroungColor" value="{{$gallary->backgroundColor}}">
                            </div>
                            {{--                        <div class="form-group">--}}
                            {{--                            <label for="backgroundImage">{{__('Section Image')}}</label>--}}
                            {{--                            <input type="file" name="backgroundImage"  id="img" multiple >--}}
                            {{--                        </div>--}}

                            <div class="form-group">
                                <label for="img">{{__('Upload Image')}}</label>
                                <input type="file" name="img"  id="img" multiple >
                            </div>

                            <div class="form-row">
                                <div class="col-md-2 text-center">
                                    <div class="form-group" id="imgPreview">
                                        @if($gallary->hasMedia('gallary'))
                                            <img src="{{$gallary->firstMedia('gallary')->getUrl()}}" class="img-fluid"
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

        $('.tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });

        function editCategory(name_en,name_ar,href) {
            let modal = $('#editCategoryModal');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);
            modal.find('.modal-body form').attr("action", href);

        };
        function removeCategory(name, url, e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = url;
                    }
                });
        };
    </script>
@stop
