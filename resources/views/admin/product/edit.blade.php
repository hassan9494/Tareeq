@extends('admin.layout.master')
@section('title','Update Course')
@section('content')
    <div class="page-inner">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.courses.update',$product->id)}}" enctype="multipart/form-data" file="true">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Update Course')}}</div>
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
                                                <option {{$product->product_cat_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                                <input type="text" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter {{ $locale == 'en'? __('English Name') : __('Arabic Name') }}" value="{{$product->getTranslation('name',$locale)}}">
                                            </div>
                                    </div>
                                @endforeach

                            </div>

                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                            <textarea class="form-control" name="sh_desc_{{$locale}}" id="sh_desc" >{{$product->getTranslation('sh_desc',$locale)}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                <div class="col-md-5 col-lg-6">
                                        <div class="form-group">
                                            <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                            <textarea class="form-control summernote" id="summernote" name="desc_{{$locale}}" id="desc" >{{$product->getTranslation('desc',$locale)}}</textarea>
                                        </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="img">{{__('Upload Image')}}</label>
                                    <input type="file" name="img"  id="img" >
                                </div>
                                <div class="form-group" id="imgPreview" >

                                </div>
                                <div class="form-group" id="imgPreview2" >
                                    @if($product->hasMedia('product'))

{{--                                        @foreach($product->getMedia('product') as $image)--}}
                                            <div style="display: inline-block;">
                                                <img  src="{{$product->lastMedia('product')->getUrl()}}" width="100px" style="margin: 10px;"  id="image" >
{{--                                                <a href="{{route('admin.product.deleteImage',$image->id)}}"><i class="fa fa-trash "></i></a>--}}
                                            </div>
{{--                                        @endforeach--}}
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

        let  index = 10, indexAttr = 1, values = [], valuesPaired = [];

        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 300,
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
            $('select[name="category"]').on('change', function () {
                var categoryID = $(this).val();
                if (categoryID) {
                    let ur = '{{url('/admin/categories/subCategory')}}';
                    $.ajax({
                        url: ur + '/' + categoryID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subCategory"]').empty();
                            $('select[name="type"]').empty();
                            $('select[name="subCategory"]').append('<option value="">{{__('Select SubCategory')}}</option>');
                            $.each(data, function (key, value) {
                                $('select[name="subCategory"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                    let ur2 = '{{url('/admin/categories/attributes')}}';

                    $.ajax({
                        url: ur2 + '/' + categoryID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="selectAttribute"]').empty();
                            $('select[name="selectAttribute"]').append('<option value="">{{__('Select Attribute')}}</option>');
                            $.each(data, function (key, value) {
                                $('select[name="selectAttribute"]').append('<option value="' + value + '">' + value + '</option>');
                            });
                        }
                    });

                } else {
                    $('select[name="subCategory"]').empty();
                }
            });
            $('.attributes').each( function () {
                $(this).selectize({
                    persist: true,
                    createOnBlur: true,
                    create: true
                });
            });
        });
        function removeItem(item) {
            let parent = $(item.target.parentElement);
            let val =$(item.target.parentElement).children('img').attr('name');

            var input=$('input[type = "file"]')[0];
            for (let i = 0 ; i < $('input[type = "file"]')[0].files.length;i++ ) {
                const dt = new DataTransfer()
                for (let file of input.files)
                {
                    console.log(file['name']);
                    if (file['name'] !== val) {
                        dt.items.add(file);
                    }
                }
                input.files = dt.files;
            }
            // console.log( input.files);
            parent.remove();
        }
        $(document).on('change','#img', function (e) {
            let x;

            // console.log($(n));
            var i = document.getElementsByClassName('delete');
            $(i).remove();
            for( x = 0 ;x<$(e.target.files).length; x++ ){
                let reader = new FileReader();


                // var name = document.createElement('p');
                let name =e.target.files[x].name;
                // $('#imgPreview').append(name);
                var l = document.getElementsByClassName('img-fluid');
                $(l).remove();
                reader.onload = function (event) {

                    let target = $('#imgPreview');

                    target.append(' <div style="display: inline-block;"><img name='+name+' src='+event.target.result+' width="100px" style="margin: 10px;"  id="image" class="img-fluid">' +
                        '<i class="fa fa-trash delete" onclick="removeItem(event);" ></i>');
                };
                reader.readAsDataURL(e.target.files[x]);
                $('#imgPreview').show();
            }
        });
        function checkVal(sel) {
            if (sel.value === "new") {
                $('.addNewAttribute').removeAttr('disabled');
            } else if (sel.value === "select") {
                $('.addNewAttribute').attr('disabled', 'disabled');
            } else {

            }
        }
        $('#selectAttribute').change(function () {

            $('#selectAttribute option:selected').hide();
            let atrrName = $('#selectAttribute').val();
            console.log(atrrName);
            if (atrrName) {
                atrrName = atrrName.replace(' ', '');
                $('#attributes tbody').append('<tr><td><input type="text" class="form-control" name="attributes[' + index + '][key]" value="' + atrrName + '" readonly></td><td><input name="attributes[' + index + '][values]" type="text" class="form-control attributesSelect selectize-' + index + '"></td><td><button type="button" class="btn btn-link" onclick="removeAttr(this);">' + "{{ __('Delete') }}" + '</button></td></tr>');

                $('.selectize-' + index).selectize({
                    persist: false,
                    createOnBlur: true,
                    create: true
                });
                index++;
            }
        });
        function removeAttr(el) {

            if (confirm("Are you sure?")) {
                $(el).parents('tr').remove();
            }
            return false;
        }
        function removeVar(el) {

            if (confirm("Are you sure?")) {
                if (($(el).parents('tr').parents('tbody').children().length) <= 3) {
                    let $quantity = $('#quantity');
                    $quantity.removeAttr("disabled");
                    $quantity.attr("required", true);
                }
                ;
                $(el).parents('tr').remove();
            }
            return false;
        }
        function updateValues() {
            valuesPaired = $('input.attributesSelect').map(function () {
                let str = $(this).val().split(','),
                    parentValue = $(this).parents('tr').children('td:first').find('input').val();
                parentValue = parentValue.replace(' ', '');
                return $.map(str, function (item) {
                    if (item.toString().trim() === "") return true;
                    return {value: parentValue + ":" + item};
                });
            }).toArray();
        }
        function addAttrRow() {
            updateValues();

            $('#varPrice').show();
            $('table#variations tbody').append('<tr><td>' + indexAttr + '</td><td><input name="variations[' + indexAttr + '][\'name\']" type="text" value="" class="form-control selectizeAttr-' + indexAttr + '"></td>' +
                '<td ><input type="number" name="variations[' + indexAttr + '][\'quantity\']" value="" class="form-control" ></td>' +
                '<td><button type="button" class="btn btn-link" onclick="removeVar(this);">' + "{{ __('Delete') }}" + '</button></td><tr>');


            $('.selectizeAttr-' + indexAttr).selectize({
                maxItems: null,
                valueField: 'value',
                labelField: 'value',
                searchField: 'value',
                options: valuesPaired,
                create: false
            });
            indexAttr++;
            let $quantity = $('#quantity');
            $quantity.removeAttr("required");
            $quantity.attr("disabled", true);

        }
        function autoCreateVariation() {
            updateValues();
            let array = new Array(),
                x = 0;

            $('input.attributesSelect').each(function () {
                let str = $(this).val(),
                    parentValue = $(this).parents('tr').children('td:first').find('input').val();
                parentValue = parentValue.replace(' ', '');
                $('table#variations tbody').html('');

                if (str === undefined || str.length == 0) return true;

                str = str.split(',');

                array[x] = $(str).map(function () {
                    return parentValue + ":" + this;
                }).toArray();
                x++;
            });

            if (array === undefined || array.length == 0) return;

            values = cartesian(array);

            $.each(values, function (i, item) {
                $('.selectizeAttr-' + indexAttr).selectize({
                    maxItems: null,
                    valueField: 'value',
                    labelField: 'value',
                    searchField: 'value',
                    options: valuesPaired,
                    create: false
                });
                $('#varPrice').show();
                $('table#variations tbody').append('<tr><td>' + indexAttr + '</td><td><input name="variations[' + indexAttr + '][name]" type="text" value="' + item + '" class="form-control selectizeAttr-' + indexAttr + '" readonly></td>' +
                    '<td><input type="number" name="variations[' + indexAttr + '][stock]" value="" class="form-control"></td>' +
                    '<td><input type="number" name="variations[' + indexAttr + '][price]" value="0" class="form-control"></td>' +
                    '<td><button type="button" class="btn btn-link" onclick="removeVar(this);">' + "{{ __('Delete') }}" + '</button></td><tr>');


                indexAttr++;
            })

            let $quantity = $('#quantity');
            $quantity.removeAttr("required");
            $quantity.attr("disabled", true);
            // $quantity.hide();
        }
        function cartesian(arg) {
            let r = [],
                max = arg.length - 1;

            function helper(arr, i) {
                for (let j = 0, l = arg[i].length; j < l; j++) {
                    let a = arr.slice(0); // clone arr
                    a.push(arg[i][j]);
                    if (i === max)
                        r.push(a);
                    else
                        helper(a, i + 1);
                }
            }

            helper([], 0);
            return r;
        }
    </script>
@stop

