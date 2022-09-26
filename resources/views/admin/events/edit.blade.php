@extends('admin.layout.master')
@section('title','Update Event')
@section('content')
    <div class="page-inner">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.events.update',$event->id)}}" enctype="multipart/form-data" file="true">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Updata Event')}}</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                                <input type="text" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter {{ $locale == 'en'? __('English Name') : __('Arabic Name') }}" value="{{$event->getTranslation('name',$locale)}}">
                                            </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                                <textarea rows="6" cols="60" maxlength="100" class="form-control" name="sh_desc_{{$locale}}" id="sh_desc" >{{$event->getTranslation('sh_desc',$locale)}}</textarea>
                                            </div>
                                        </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('start_date') }}</label>
                                        <input type="date" name="start_date" class="form-control" id="start" placeholder="Enter start_date" value="{{$event->start_date}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">{{ __('end_date') }}</label>
                                        <input type="date" name="end_date" class="form-control" id="end_date" placeholder="Enter end_date" value="{{$event->end_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-lg-10">
                                    @foreach(config('locales') as $locale)
                                        <div class="form-group">
                                            <label for="desc_{{$locale}}">{{ __('Description_'.$locale) }}</label>
                                            <textarea class="form-control summernote" id="summernote" name="desc_{{$locale}}">
                                                {{$event->getTranslation('desc',$locale)}}
                                            </textarea>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-2 mt-4">
                                    <a class="btn btn-primary" href="{{url('admin/media')}}" target="_blank">{{__('media')}}</a>
                                </div>


                                </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="img">{{__('Upload Image')}}</label>
                                    <input type="file" name="img"  id="img" multiple >
                                </div>
                                <div class="form-group">

                                    @if($event->hasMedia('event'))
                                        <div class="form-group" id="imgPreview">
                                            <img src="{{$event->lastMedia('event')->getUrl()}}" width="100px" height="100px">
                                        </div>
                                    @endif
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

