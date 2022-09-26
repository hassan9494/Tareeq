@extends('admin.layout.master')
@section('title','Categories')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Categories')}}</h4>
                    </div>

                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">
                        {{__('Add  Category')}}
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <thead>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Name')}}</th>
{{--                                    <th>{{__('Parent')}}</th>--}}
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    @if($categoriesProduct->count() > 0)
                                        @foreach($categoriesProduct as $categoryProduct)
                                            <tbody>
                                            <tr>
                                                <td>
                                                    @if($categoryProduct->hasMedia('catproduct'))
                                                        <div class="flag">
                                                            <img width="80" height="80" src="{{ $categoryProduct->lastMedia('catproduct')->getUrl() }}">
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{$categoryProduct->name}}</td>
{{--                                                <td>--}}
{{--                                                    @if($categoryProduct->parent_id == null)--}}
{{--                                                        {{ __('null') }}--}}
{{--                                                    @else--}}
{{--                                                        {{$categoryProduct->parent->name}}--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}

                                                <td>
                                                    {{$categoryProduct->desc}}
                                                </td>
                                                <td>
                                                    <a href="#" onclick="editCategory('{{$categoryProduct->getTranslation('name','en') }}','{{$categoryProduct->getTranslation('name','ar') }}','{{$categoryProduct->getTranslation('desc','en') }}','{{$categoryProduct->getTranslation('desc','ar') }}','{{route('admin.categoryProduct.update',$categoryProduct->id)}}','{{$categoryProduct->lastMedia('catproduct')->getUrl()}}','{{$categoryProduct->parent_id}}')" class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateProductCategory">
                                                        <i class='fa fa-edit'></i>{{__('Edit')}}
                                                    </a>
{{--                                                    <form action="{{route('admin.categoryProduct.destroy',$categoryProduct->id)}}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}

                                                        <button class="btn btn-danger btn-xs" type="submit" onclick="removeCat('{{$categoryProduct->name}}','{{route('admin.catProduct.destroy',$categoryProduct->id)}}')">
                                                            <i class="fas fa-trash"></i> {{__('Delete')}}
                                                        </button>

{{--                                                    </form>--}}
                                                </td>
                                            </tr>

                                            </tbody>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- model setting-->
    <div class="modal fade" id="catProductSetting" tabindex="-1" role="dialog" aria-labelledby="catProductSetting" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catProductSetting">{{__('Category Setting')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.section.setting.update')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('Put')
                        <input type="hidden" name="type" value="catproduct">
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" value="{{$categorySection->getTranslation('name',$locale)}}">
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" name="description_{{$locale}}" class="form-control" value="{{$categorySection->getTranslation('description',$locale)}}">
                            </div>
                        @endforeach

{{--                        <div class="form-group">--}}
{{--                            <label for="backgroungColor">{{__('Section Color')}}</label>--}}
{{--                            <input type="color" name="backgroungColor" value="{{$categorySection->backgroundColor}}">--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img"  id="img" multiple >
                        </div>

                        <div class="form-row">
                            <div class="col-md-2   text-center">
                                <div class="form-group" id="imgPreview">
                                    @if($categorySection->hasMedia('catProduct'))
                                        <img src="{{$categorySection->firstMedia('catProduct')->getUrl()}}" class="img-fluid"
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
    <!-- end setting -->
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
                                <input type="text" cols="10" rows="5" maxlength="120"  name="desc_{{$locale}}" class="form-control" >
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
    <div class="modal fade" id="updateProductCategory" tabindex="-1" role="dialog" aria-labelledby="updateProductCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateBlogCategory">{{__('Update Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('PUT')


                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" value="">
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" cols="10" rows="5" maxlength="120" name="desc_{{$locale}}" class="form-control" value=""/>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img" class="form-control-file" id="img" >
                        </div>
                        <div class="form-group" id="imgPreview" >
                            <img src="" class="img-fluid" alt="" width="300px" height="300px">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Save</button>

                    </form>
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

        function editCategory(name_en,name_ar,desc_en,desc_ar,href,img,parent) {
            // alert(href);
            let modal = $('#updateProductCategory');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);
            modal.find('.modal-body input[name="desc_en"]').val(desc_en);
            modal.find('.modal-body input[name="desc_ar"]').val(desc_ar);
            modal.find('.modal-body img').attr('src', img);
            modal.find('.modal-body select[name="parentCategory"]').val(parent);

            modal.find('.modal-body form').attr("action",href);

        };
        function removeCat(name, url, e) {
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
