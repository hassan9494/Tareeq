@extends('admin.layout.master')
@section('title','Partners Images')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="center fadeInDown">
                <h1>{{__('Our Partners')}}</h1>
            </div>
            @if(isset($partnersBackeground))
                <section style="background-image: url({{$partnersBackeground->firstMedia('partnersBackeground')->getUrl()}});height:500px; background-size: 100% 100%;">
                    <a class="btn btn-danger text-center" href="{{route('admin.deleteBackground',$partnersBackeground->id)}}">delete background</a>
                    <div class="container">
                        <div class="row">
                         <div class="col-12">
                             <div class="partners">
                            <ul>
{{--                                @dd($partnersLogo)--}}
                              @foreach($partnersLogo as $logo)
                                    <li style="display: inline-block;float: left;width:20%;list-style: none;">
                                        <a href="{{$logo->url}}">
                                            <img class="img-responsive fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="{{$logo->firstMedia('partnersLogo')->getUrl()}}" style="width:100px;height: 100px ">
                                        </a><br>
                                            <a class="btn btn-danger" href="{{route('admin.deleteLogo',$logo->id)}}">delete</a>
                                            <a href="#" class="btn btn-success " onclick='editImage("{{ $logo->url}}","{{ $logo->firstMedia('partnersLogo')->getUrl()}}","{{ route('admin.updateLogo', $logo->id) }}", event);' data-toggle="modal" data-target="#editLogoModal" >{{ __('Update') }}</a>
                                    </li>
                              @endforeach
                            </ul>
                        </div>
                         </div>
                        </div>
                    </div>
                    <!--/.container-->
                </section>
            @else
                <div class="card bg-dark text-black-50" style="height: 500px;">
                    <img src="{{asset('backend/img/bg-1.jpg')}}" height="500px" class="card-img" >
                    <div class="card-img-overlay">
                        <a href="{{route('admin.partners.store')}}" class="btn btn-primary "
                           data-toggle="modal" data-target="#uploadbackgroundModal"
                           data-edit="false">{{ __('Uplode') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="uploadbackgroundModal" tabindex="-1" role="dialog" aria-labelledby="uploadbackgroundModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadbackgroundModal">{{__('Main Background')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('admin.partners.store')}}" enctype="multipart/form-data" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Add Background Image')}}</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
{{--                                <div class="col-md-12 col-lg-12">--}}
                                    <input type="hidden" value="partnersBackeground" name="type">
                                    <div class="form-group">
                                        <label for="img">{{__('Upload backeground Image')}}</label>
                                        <input type="file" name="img" class="form-control-file" id="img" required>
                                    </div>
                                    <div class="form-group" id="imgPreview" >
                                        <img src="" class="img-fluid" alt="" width="300px" height="300px">
                                    </div>
{{--                                </div>--}}
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
</div>
<div class="modal fade" id="editLogoModal" tabindex="-1" role="dialog" aria-labelledby="editLogoModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLogoModal">{{__('Update')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="fromAction" method="post" action="">
                    @csrf
                    @method('put')
                    <input type="hidden" value="partnersLogo" name="type">
                    <div class="form-group">
                        <label for="paragraph">{{ __('Url For Button') }}</label>
                        <input class="form-control" type="text" name="url" value="" id="url" >
                    </div>

                    <div class="form-group">
                        <label for="logoImage">{{ __('Image') }}</label>
                        <div class="custom-file">
                            <input type="file" name="img" class="custom-file-input" id="logoImage"  >
                            <label class="custom-file-label"
                                   for="logoImage">{{ __('Choose') }} {{__('file') }}</label>
                        </div>
                    </div>
                    <div class="form-group" id="imgPreview" >
                        <img src="" class="img-fluid" alt="">
                    </div>

                    <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
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
        function editImage(url,img,href,event) {
            let modal = $('#editLogoModal');
            modal.find('.modal-body input[name="url"]').val(url);
            $('#imgPreview img').attr('src', img);

            modal.find('.modal-body form').attr("action", href);

        };

    </script>
@stop

