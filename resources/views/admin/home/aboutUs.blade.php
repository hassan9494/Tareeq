@extends('admin.layout.master')

@section('title', 'AboutUs')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"
                              action="{{ route('admin.section.setting.update') }}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="type" value="about">
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                    <input type="text" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter title" value="{{$aboutUs->getTranslation('name',$locale)}}">
                                </div>
                            @endforeach
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                    <textarea  class="form-control" name="sh_desc_{{$locale}}" id="sh_desc_" >{{$aboutUs->getTranslation('sh_desc',$locale)}}</textarea>
                                </div>
                            @endforeach
                          <div class="row">
                              <div class="col-md-10">
                                  @foreach(config('locales') as $locale)
                                      <div class="form-group">
                                          <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                          <textarea   name="description_{{$locale}}" class="form-control summernote" id="summernote">{{$aboutUs->getTranslation('description',$locale)}}</textarea>
                                      </div>
                                  @endforeach
                              </div>
                            <div class="col-md-2 mt-4">
                                <a class="btn btn-primary" href="{{url('admin/media')}}" target="_blank">{{__('media')}}</a>

                            </div>
                          </div>
                            <div class="form-group">
                                <label for="">{{__('Upload Home Image')}}</label>
                                <input type="file" name="img"  id="img" multiple >
                            </div>
                            <div class="form-row">
                                <div class="col-md-2   text-center">
                                    <div class="form-group" id="imgPreview">
                                        @if($aboutUs->hasMedia('about'))
                                            <img src="{{$aboutUs->firstMedia('about')->getUrl()}}" class="img-fluid"
                                                 alt="">
                                        @else
                                            <img src="" class="img-fluid"
                                                 alt="no image">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('Upload bannerImage')}}</label>
                                <input type="file" name="backgroundImage"  id="backgroundImage">
                            </div>
                            <div class="form-row">
                                <div class="col-md-2   text-center">
                                    <div class="form-group"id="imgPreview2" >
                                        @if($aboutUs->hasMedia('backgroundImage'))
                                            <img src="{{$aboutUs->firstMedia('backgroundImage')->getUrl()}}" class="img-fluid"
                                                 alt="">
                                        @else
                                            <img src="" class="img-fluid"
                                                 alt="no image">
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary float-right">{{ __('Edit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
                lang: '{{ config("app.locale") }}',
                toolbar: [
                    // [groupName, [list of button]]
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['style', 'ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['insert', [ 'table','hr','video','link']],
                    ['custom', ['picture']],
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['misc', ['fullscreen', 'undo', 'redo', 'help', 'codeview']]
                ],
            });
        });

        $('input[type="file"][name="img"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            // $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });
        $('input[type="file"][name="backgroundImage"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            // $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview2 img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview2').show();
        });

        $('.tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });
    </script>
@stop

