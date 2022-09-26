@extends('admin.layout.master')
@section('title','Update Post')
@section('content')
    <div class="page-inner">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.posts.update',$post->id)}}" enctype="multipart/form-data" file="true">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Updata Service')}}</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="hasForm">{{ __('Has Form') }}</label>
                                        <div class="custom-control-cms float-right custom-switch">
                                            <input type="checkbox" name="hasForm" class="custom-control-input"
                                                   id="hasForm" {{ !$post->hasForm ?: 'checked' }}>
                                            <label class="custom-control-label" for="hasForm"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                            <input type="text" name="subject_{{$locale}}" class="form-control" id="subject" placeholder="Enter Subject" value="{{$post->getTranslation('subject',$locale)}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                            <textarea rows="5" cols="90" maxlength="90" class="form-control" name="sh_desc_{{$locale}}" id="desc" >{{$post->getTranslation('sh_desc',$locale)}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="hidden" name="type" value="service">
                                    </div>
                                    <div class="row">
                                       <div class="col-md-10">
                                            @foreach(config('locales') as $locale)
                                                <div class="form-group">
                                                    <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                                    <textarea class="form-control summernote" id="summernote" name="desc_{{$locale}}">{{$post->getTranslation('desc',$locale)}}</textarea>
                                                </div>
                                            @endforeach
                                       </div>
                                        <div class="col-md-2 mt-4">
                                            <a class="btn btn-primary" href="{{url('admin/media')}}" target="_blank">{{__('media')}}</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="img">{{__('Upload Image')}}</label>
                                            <input type="file" name="img"  id="img" multiple >
                                    </div>
                                    <div class="form-group"  >
                                        @if($post->hasMedia('post'))
                                             <div style="display: inline-block;" id="imgPreview">
                                                    <img name="" src="{{$post->lastMedia('post')->getUrl()}}" width="100px"  id="img" class="img-fluid">
                                                </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success float-right">{{__('Update')}}</button>

                        </div>
                    </div>
                </form>
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
    </script>
@stop

