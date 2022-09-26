@extends('admin.layout.master')
@section('title','Categories')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary float-right"  data-toggle="modal" data-target="#addCategory">{{__('Add Category')}}</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <thead>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    @if($categories->count() > 0)
                                        @foreach($categories as $cat)
                                            <tbody>
                                            <tr>
                                                <td>
                                                   {{$cat->name}}
                                                </td>
                                                <td>
{{--                                                    <form action="{{route('admin.category.destroy',$cat->id)}}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
                                                        <button class="btn btn-danger btn-xs" type="submit" onclick="removeCategory('{{$cat->name}}','{{route('admin.cat.destroy',$cat->id)}}')">
                                                            <i class="fas fa-trash"></i>{{__(' Delete')}}
                                                        </button>

                                                        <a href="#" class="btn btn-info btn-xs" data-toggle="modal" onclick="editCategory('{{$cat->getTranslation('name','en') }}','{{$cat->getTranslation('name','ar') }}','{{route('admin.category.update',$cat)}}')" data-target="#editCategoryModal">
                                                            <i class='fa fa-edit'></i> {{__('Edit')}}
                                                        </a>


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
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Edit Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data" file="true" >
                        @csrf
                        @method('PUT')
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" value="" class="form-control" placeholder="enter category name _{{$locale}}">
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary float-right">{{__('update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Add Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.category.store')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" placeholder="enter category name _{{$locale}}">
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary float-right">{{__('Add')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop


@section('script')
    <script>
        function removeCategory(name, url, e) {
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

        $('.tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });

        function editCategory(name_en,name_ar,href,parent) {
            console.log(parent);
            let modal = $('#editCategoryModal');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);
            modal.find('.modal-body  select > option[value="'+parent+'"]').attr('selected','selected');
            // $('.modal-body #imgPreview1 img').attr('src', img);
            // $('.modal-body #imgPreview2 img').attr('src', bannerImg);
            modal.find('.modal-body form').attr("action", href);

        };

    </script>
@stop


