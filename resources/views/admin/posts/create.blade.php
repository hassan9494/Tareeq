@extends('admin.layout.master')
@section('title','Create')
@section('content')
    <div class="page-inner">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.posts.store')}}" enctype="multipart/form-data" file="true">
                    @csrf
                    <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{__('Add Post')}}</div>
                        <div class="form-group">
                           <input type="hidden" name="type" value="post">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('Select Category') }}</label>
                                    <select class="form-control" name="catBlog" required>
                                        @foreach($categoriesBlog as $categoryBlog)
                                            <option value="{{$categoryBlog->id}}">{{$categoryBlog->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach(config('locales') as $locale)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                        <input type="text" name="subject_{{$locale}}" class="form-control" id="subject" placeholder="Enter {{ $locale == 'en'? __('English Name') : __('Arabic Name') }}" required>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="row">
                            @foreach(config('locales') as $locale)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                        <textarea rows="4" cols="40" maxlength="40" class="form-control" name="sh_desc_{{$locale}}" id="desc" rows="5" required></textarea>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                               <div class="row">
                                   <div class="col-md-10">
                                        @foreach(config('locales') as $locale)
                                            <div class="form-group">
                                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                                <textarea class="form-control summernote" id="summernote" name="desc_{{$locale}}" required>
                                                </textarea>
                                            </div>
                                        @endforeach
                                   </div>
                                   <div class="col-md-2 mt-4">
                                       <a class="btn btn-primary" href="{{url('admin/media')}}" target="_blank">{{__('media')}}</a>
                                   </div>
                               </div>
                                <div class="form-group">
                                    <label for="img">{{__('Upload Image')}}</label>
                                    <input type="file" name="img" class="form-control-file" id="img" required>
                                </div>
                                <div class="form-group" id="imgPreview" >
                                    <img src="" class="img-fluid" alt="" width="300px" height="300px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success float-right">{{__('Add')}}</button>

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
