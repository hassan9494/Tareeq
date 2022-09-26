@extends('admin.layout.master')
@section('title','categories Product')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('ALL Attributes')}}</h4>
                        </div>

                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">
                            {{__('Add New Attribute')}}
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table id="table" class="table">
                                        <thead>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        @if($attributes->count() > 0)
                                            @foreach($attributes as $attribute)
                                                <tbody>
                                                <tr>
                                                    <td>{{$attribute->name}}</td>
                                                    <td>{{$attribute->category->name}}</td>

                                                    <td>
                                                        <a href="#" onclick="editCategory('{{$attribute->getTranslation('name','en') }}','{{$attribute->getTranslation('name','ar') }}','{{route('admin.attributes.update',$attribute->id)}}','{{$attribute->category_id}}')" class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateProductCategory">
                                                            <i class='fa fa-edit'></i>{{__('Edit')}}
                                                        </a>
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
    </div>

    <!-- Modal -->
    <!-- model setting-->
    <!-- end setting -->
    <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BlogCategory">{{__('Add New Attribute')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.attributes.store')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        <div class="form-group">
                            <label for="parentCategory">{{ __('Category') }}</label>
                            <select class="form-control" name="category_id">
                                <option value="">{{__('Category')}}</option>
                                @foreach($categories as $categoryProduct)
                                    <option value="{{$categoryProduct->id}}" name="category_id" >{{$categoryProduct->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" >
                            </div>
                        @endforeach


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
                    <h5 class="modal-title" id="updateBlogCategory">{{__('Edit Attribute')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Product Category">{{ __('Category') }}</label>
                            <select class="form-control" name="category_id">
                                <option value="">{{__('Category')}}</option>
                                @foreach($categories as $categoryProduct)
                                    <option value="{{$categoryProduct->id}}"  name="category_id" >{{$categoryProduct->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" value="">
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary float-right">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#table').dataTable({
                "responsive": false,
                "paginate": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order': [['0', 'desc']]
            });
        });
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

        function editCategory(name_en,name_ar,href,parent) {
            // alert(href);
            let modal = $('#updateProductCategory');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);
            modal.find('.modal-body select[name="category_id"]').val(parent);
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
