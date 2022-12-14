@extends('admin.layout.master')
@section('title','Update Team Member')
@section('content')
    <div class="page-inner">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.teams.update',$team->id)}}" enctype="multipart/form-data" file="true">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Updata Team Member')}}</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                                <input type="text" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter {{ $locale == 'en'? __('English Name') : __('Arabic Name') }}" value="{{$team->getTranslation('name',$locale)}}">
                                            </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Description ') : __('Arabic Description ') }}</label>
                                                <textarea class="form-control" name="desc_{{$locale}}" id="desc" >{{$team->getTranslation('desc',$locale)}}</textarea>
                                            </div>
                                        </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">{{ __('Facebook Link') }}</label>
                                        <input  class="form-control" name="facebook" id="facebook" value="{{$team->facebook}}"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="twitter">{{ __('twitter Link') }}</label>
                                        <input  class="form-control" name="twitter" id="twitter" value="{{$team->twitter}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkedIn">{{ __('linkedIn Link') }}</label>
                                        <input  class="form-control" name="linkedIn" id="linkedIn" value="{{$team->linkedIn}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="img">{{__('Upload Image')}}</label>
                                    <input type="file" name="img"  id="img" multiple >
                                </div>
                                <div class="form-group">

                                    @if($team->hasMedia('team'))
                                        <div class="form-group" id="imgPreview">
                                            <img src="{{$team->lastMedia('team')->getUrl()}}" width="100px" height="100px">
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

