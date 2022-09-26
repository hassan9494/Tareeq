@extends('admin.layout.master')
@section('title','Category Images')
@section('content')

            <div class="page-inner">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }} </li>
                        @endforeach
                    </div>
                @endif
                <div class="page-header">
                    <h4 class="page-title">{{__('Portfolio')}}</h4>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addImage">{{__('Add Category Image')}}</button>
                            </div>
                            <div class="card-body">
                              @if(count($categories) > 0 )
                                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">{{__('All works')}}</a>
                                        </li>
                                        @foreach($categories as $category)

                                        <li class="nav-item">
                                            <a class="nav-link " id="pills-home-tab-nobd" data-toggle="pill" href="#{{$category->id}}" role="tab" aria-controls="pills-home-nobd" aria-selected="true">{{$category->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                  @if(count($categories) > 0)
                                    <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                        <div class="row">

                                                @foreach($categories as $category)
                                                @foreach($category->getMedia('cat') as $image)
                                                <div class="col-sm-6 col-md-3">
                                                    <img src="{{$image->getUrl()}}"  width="220px" height="220px" style="display: block;margin-bottom: 20px">
                                                    <button class="btn btn-danger" onclick="removeImage('{{ route('admin.deleteImage', $image) }}', event);">{{__('Delete')}}</button>
                                                    <a  class="btn btn-success " onclick="editDescription('{{ $image->description}}','{{ route('admin.updateImage', $image)}}', event);" data-toggle="modal" data-target="#editDescription">{{ __('Edit') }}</a>

                                                </div>
                                                @endforeach
                                            @endforeach

                                        </div>
                                    </div>
                                        @foreach($categories as $category)
                                        <div class="tab-pane fade" id="{{$category->id}}" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                        <div class="row">
                                            @foreach($category->getMedia('cat') as $image)
                                            <div class="col-sm-6 col-md-3">
                                                 <img src="{{$image->getUrl()}}"   width="220px" height="220px">

                                                 <a class="btn btn-danger" onclick="removeImage('{{ route('admin.deleteImage', $image) }}', event);">{{__('Delete')}}</a>
                                                <a  class="btn btn-success " onclick="editDescription('{{ $image->description}}','{{ route('admin.updateImage', $image)}}', event);" data-toggle="modal" data-target="#editDescription">{{ __('Edit') }}</a>

                                            </div>
                                            @endforeach
                                        </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editDescription" tabindex="-1" role="dialog" aria-labelledby="editDescription"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDescription">{{__('Edit')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data" id="fromAction" method="post" action="">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="description">{{ __('description') }}</label>
                                    <div class="custom-file">
                                        <input type="text" name="description"  class="form-control" id="description"  maxlength="108"  >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('Add Image')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('admin.addImage')}}" enctype="multipart/form-data" file="true">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('Select Category') }}</label>
                                    <select name="category" class="form-control" id="cat">
                                        @foreach($categories as $cat)
                                            {{--                                                            <option value="null" selected ></option>--}}
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @foreach(config('locales') as $locale)
                                    <div class="form-group">
                                        <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Short Description ') : __('Arabic Short Description ') }}</label>
                                        <input type="text" name="description_{{$locale}}" class="form-control"  maxlength="108">
                                    </div>
                                @endforeach

                                <div class="form-group">
                                    <label for="img">{{__('Upload Image')}}</label>
                                    <input type="file" name="img" class="form-control" id="img">
                                </div>
                                <div class="form-group" id="imgPreview" >
                                    <img src="" class="img-fluid" alt="" width="300px" height="300px">
                                </div>
                                <button type="submit" class="btn btn-primary float-right">{{__('Add')}}</button>
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

        function editDescription(description,href,event) {
            let modal = $('#editDescription');
            modal.find('.modal-body input[name="description"]').val(description);

            modal.find('.modal-body form').attr("action", href);

        };

        function removeImage(url, e) {
            e.preventDefault();
            swal({
                title: "{{ __('Are you sure') }}?",
                text: "{{ __('You are deleting') }}",
                // icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: '{{ __('Yes, I am sure!') }}',
                cancelButtonText: "{{ __('No, cancel it') }}"
            }).then(
                function (obj) {
                    if (obj) {
                        // alert(obj);
                        window.location = url;
                    }
                }
            );
        }
    </script>
@stop
