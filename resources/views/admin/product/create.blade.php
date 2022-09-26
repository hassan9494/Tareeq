@extends('admin.layout.master')
@section('title','Create Course')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.courses.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Add Course')}}</div>
                            <div class="form-group">
                                <input type="hidden" name="type" value="post">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Category') }}*</label>
                                        <select name="category" id="category"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                            @foreach($categoriesProduct as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label>{{__('Add Category') }}<span
                                                class="d-inline-block d-sm-none">{{ __('Category') }}</span></label>
                                        <button type="button" class="btn btn-block btn-outline-primary"
                                                data-toggle="modal" data-target="#productCategory"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}*</label>
                                                <input type="text" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter name_{{$locale}}" value="{{old('name_'.$locale)}}" required>
                                            </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                                <textarea rows="6" cols="60" maxlength="60" class="form-control" value="{{old('sh_desc_'.$locale)}}" name="sh_desc_{{$locale}}" id="desc" rows="4" required></textarea>
                                            </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                        <textarea class="form-control summernote" id="summernote" value="{{old('desc_'.$locale)}}" name="desc_{{$locale}}" id="desc" ></textarea>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-4 col-lg-12">
                                    <div class="form-group">
                                        <label for="img">{{__('Upload Image')}}</label>
                                        <input type="file" name="img" class="form-control-file" id="img"  required>
                                    </div>
                                    <div class="form-group" id="imgPreview" >
                                        <img src="" class="img-fluid" alt="" width="300px" height="300px">
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
    <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BlogCategory">{{__('Add Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.categoryProduct.store')}}" enctype="multipart/form-data" file="true">
                        @csrf


                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" >
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" cols="10" rows="5" maxlength="120"  name="desc_{{$locale}}" required class="form-control" >
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img" class="form-control-file" id="img" required>
                        </div>
                        <div class="form-group" id="imgPreview" >
                            <img src="" class="img-fluid" alt="" width="300px" height="300px">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        let  index = 0, indexAttr = 1, values = [], valuesPaired = [];

        $(document).on('change','#img', function (e) {
            let x;
            // console.log($(n));
            for( x = 0 ;x<$(e.target.files).length; x++ ){
                let reader = new FileReader();
                // var name = document.createElement('p');
                let name =e.target.files[x].name;
                // $('#imgPreview').append(name);
                var l = document.getElementsByClassName('img-fluid');
                $(l).remove();
                reader.onload = function (event) {
                    let target = $('#imgPreview');
                    target.append(' <div style="display: inline-block;"><img name='+name+' src='+event.target.result+' width="100px" style="margin: 10px;"  id="image" class="img-fluid">'
                        );
                };
                reader.readAsDataURL(e.target.files[x]);
                $('#imgPreview').show();
            }
        });

        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: false,
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
