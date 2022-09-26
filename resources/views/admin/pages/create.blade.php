@extends('admin.layout.master')
@section('title', 'Pages | Create')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('admin.pages.store') }}" id="pageForm">
                            @csrf
                            <input type="hidden" name="widgets" value="">

                                <div class="form-row">
                                    <div class="col-md-8">
                                        @foreach(config('locales') as $locale)
                                            <div class="form-group">
                                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                                <input type="text"  id="name" name="name_{{$locale}}"
                                                       class="form-control {{ !$errors->has('slug') ?: 'is-invalid' }} {{ !$errors->has('name') ?: 'is-invalid' }}"
                                                       placeholder="{{ __('Enter Name') }}_{{$locale}}" value="{{ old('name') }}" >
                                                <small id="slug" class="form-text text-muted"></small>
                                                @if($errors->has('name') || $errors->has('slug'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                        {{ $errors->first('slug') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                            <div class="form-row" id="content">
                                                @foreach(config('locales') as $locale)
                                                <div class="col-12">
                                                    <label for="content_{{$locale}}">{{ $locale == 'en'? __('English content') : __('Arabic content') }}</label>
                                                      <textarea name="content_{{$locale}}" class="summernote"></textarea>
                                                </div>
                                                @endforeach
                                            </div>


                                </div>
                                <div class="col-md-4">

                                    <div class="form-group mb-2">
                                        <label for="inNav">{{ __('show in navbar') }}</label>
                                        <div class="custom-control-cms float-right custom-switch">
                                            <input type="checkbox" name="inNav" class="custom-control-input"
                                                   id="inNav" {{ old('inNav') != 'on' ?: 'checked' }}>
                                            <label class="custom-control-label" for="inNav"></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="inFooter">{{ __('show in footer') }}</label>
                                        <div class="custom-control-cms float-right custom-switch">
                                            <input type="checkbox" name="inFooter" class="custom-control-input"
                                                   id="inFooter" {{ old('inFooter') != 'on' ?: 'checked' }}>
                                            <label class="custom-control-label" for="inFooter"></label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="published">{{ __('Published') }}</label>
                                        <div class="custom-control-cms float-right custom-switch">
                                            <input type="checkbox" name="published" class="custom-control-input"
                                                   id="published" {{ old('published') != 'on' ?: 'checked' }}>
                                            <label class="custom-control-label" for="published"></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="hasForm">{{ __('Has Form') }}</label>
                                        <div class="custom-control-cms float-right custom-switch">
                                            <input type="checkbox" name="hasForm" class="custom-control-input"
                                                   id="hasForm" {{ old('hasForm') != 'on' ?: 'checked' }}>
                                            <label class="custom-control-label" for="hasForm"></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="hasLink">{{ __('Link Without Page') }}</label>
                                        <div class="custom-control-cms float-right custom-switch">
                                            <input type="checkbox" name="hasLink" class="custom-control-input"
                                                   id="hasLink" {{ old('hasLink') != 'on' ?: 'checked' }}>
                                            <label class="custom-control-label" for="hasLink"></label>
                                        </div>
                                    </div>
                                    <!-- sub page -->
                                    <div class="form-group">
                                        <label for="parentPage">{{ __('parent Page') }}</label>
                                        <select class="form-control" name="parentPage">
                                            <option value="">{{__('parent page')}}</option>
                                            @foreach($pages as $page)
                                                <option value="{{$page->id}}" name="parentPage" >{{$page->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                        <a class="btn btn-primary" href="{{url('admin/media')}}" target="_blank">{{__('media')}}</a>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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

        $('#hasLink').change(function () {
            let status = $(this).prop('checked');
            if(status){
                $('#content').hide();

            }else{
                $('#content').show();
            }
        });
    </script>

@stop
