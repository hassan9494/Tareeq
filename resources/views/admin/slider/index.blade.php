@extends('admin.layout.master')
@section('title','Slider')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="bd-example">
                    @if(count($slider)>0)
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                @foreach($slider as $slide)
                                    @if($loop->first)
                                        <div class="carousel-item active">
                                            <img src="{{ $slide->firstMedia('slider')->getUrl() }}" height="400px" class="d-block w-100" alt="{{ $slide->firstMedia('slider')->filename }}">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{ $slide->header }}</h5>
                                                <p>{{ $slide->paragraph }}</p>
                                                <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#sliderModal" data-edit="false">{{__('Upload')}}</a>
                                                <a href="#" class="btn btn-success " onclick='editImage("{{ $slide->getTranslation('header', 'en') }}","{{ $slide->getTranslation('header', 'ar') }}","{{ $slide->getTranslation('paragraph', 'en') }}","{{ $slide->getTranslation('paragraph', 'ar') }}","{{ $slide->getTranslation('direction','en') }}","{{ $slide->getTranslation('direction','ar') }}","{{ $slide->firstMedia('slider')->getUrl()}}","{{ $slide->url}}","{{ $slide->getTranslation('btn_name', 'en') }}","{{ $slide->getTranslation('btn_name', 'ar') }}","{{ route('admin.slider.update', $slide) }}", event);' data-toggle="modal" data-target="#editsliderModal" >{{ __('Edit') }}</a>
                                                <button class="btn btn-danger" onclick="removeSlide('{{ $slide->header }}', '{{ route('admin.slider.delete', $slide) }}', event);">{{ __('Delete') }}</button>
                                                @if($slide->url !== null)
                                                    <button class="btn btn-primary">{{$slide->btn_name}}</button>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img src="{{ $slide->firstMedia('slider')->getUrl()}}" height="400px"  class="d-block w-100" alt="{{ $slide->firstMedia('slider')->filename }}">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>{{ $slide->header }}</h5>
                                                <p>{{ $slide->paragraph }}</p>
                                                <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#sliderModal" data-edit="false">{{__('Upload')}}</a>
                                                <a href="#" class="btn btn-success " onclick='editImage("{{ $slide->getTranslation('header', 'en') }}","{{ $slide->getTranslation('header', 'ar') }}","{{ $slide->getTranslation('paragraph', 'en') }}","{{ $slide->getTranslation('paragraph', 'ar') }}","{{ $slide->getTranslation('direction','en') }}","{{ $slide->getTranslation('direction','ar') }}","{{ $slide->firstMedia('slider')->getUrl()}}","{{ $slide->url}}","{{ $slide->getTranslation('btn_name', 'en') }}","{{ $slide->getTranslation('btn_name', 'ar') }}","{{ route('admin.slider.update', $slide) }}", event);' data-toggle="modal" data-target="#editsliderModal" >{{ __('Edit') }}</a>
                                                <button class="btn btn-danger" onclick="removeSlide('{{ $slide->header }}', '{{ route('admin.slider.delete', $slide) }}', event);">{{ __('Delete') }}</button>
                                                <!-- REMOVE BUTTON IF NOT FOUND-->
                                                @if($slide->url !== null)
                                                 <button class="btn btn-primary">{{$slide->btn_name}}</button>
                                               @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    @else
                        <div class="card bg-dark text-black-50" style="height: 500px;">
                            <img src="{{asset('backend/img/bg-1.jpg')}}" height="500px" class="card-img" >
                            <div class="card-img-overlay">
                                <h5 class="card-title">title</h5>
                                <p class="card-text">paragraph</p>
                                <a href="{{ route('admin.slider.store')}}" class="btn btn-primary "
                                   data-toggle="modal" data-target="#sliderModal"
                                   data-edit="false">{{ __('Uplode') }}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sliderModalLabel">{{__('Main slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="post" action="{{ route('admin.slider.store')}}" file="true">
                        @csrf
                        <input type="hidden" name="type" value="slider">
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="header_{{$locale}}">{{ $locale == 'en'? __('English Header') : __('Arabic Header') }}</label>
                                <input class="form-control" type="text" name="header_{{$locale}}" value="" id="header_{{$locale}}" >
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="paragraph_{{$locale}}">{{ $locale == 'en'? __('English Paragraph') : __('Arabic Paragraph') }}</label>
                                <input class="form-control" type="text" name="paragraph_{{$locale}}" value="" id="paragraph_{{$locale}}">
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="Direction_{{$locale}}">{{ $locale == 'en'? __('English Text Direction') : __('Arabic Text Direction') }}</label>:-&nbsp;&nbsp;
                                {{__('right')}} <input  type="radio" name="Direction_{{$locale}}" value="right" id="Direction_{{$locale}}">
                                {{__('center')}}<input  type="radio" name="Direction_{{$locale}}" value="center" id="Direction_{{$locale}}" checked>
                                {{__('left')}} <input  type="radio" name="Direction_{{$locale}}" value="left" id="Direction_{{$locale}}">
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="paragraph">{{ __('Url For Button') }}</label>
                            <input class="form-control" type="text" name="url" value="" id="url" >
                        </div>
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="btn_name_{{$locale}}">{{ $locale == 'en'? __('English Button Name') : __('Arabic Button Name') }}</label>
                                <input class="form-control" type="text" name="btn_name_{{$locale}}" value="" id="btn_name_{{$locale}}" >
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="catImage">{{ __('Image') }}</label>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="catImage"  >
                                <label class="custom-file-label"
                                       for="catImage">{{ __('Choose') }} {{__('file') }}</label>
                            </div>
                        </div>
                        <div class="form-group" id="imgPreview" style="display: none">
                            <img src="" class="img-fluid" alt="">
                        </div>

                        <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editsliderModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sliderModalLabel">{{__('Edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="fromAction" method="post" action="">
                        @csrf
                        @method('put')
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="header_{{$locale}}">{{ $locale == 'en'? __('English Header') : __('Arabic Header') }}</label>
                                <input class="form-control" type="text" name="header_{{$locale}}" value="" id="header_{{$locale}}" >
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="paragraph_{{$locale}}">{{ $locale == 'en'? __('English Paragraph') : __('Arabic Paragraph') }}</label>
                                <input class="form-control" type="text" name="paragraph_{{$locale}}" value="" id="paragraph_{{$locale}}">
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="Direction_{{$locale}}">{{ $locale == 'en'? __('English Text Direction') : __('Arabic Text Direction') }}</label>:-&nbsp;&nbsp;
                                {{__('right')}} <input  type="radio" name="Direction_{{$locale}}" value="right" id="Direction_{{$locale}}">
                                {{__('center')}}<input  type="radio" name="Direction_{{$locale}}" value="center" id="Direction_{{$locale}}" >
                                {{__('left')}} <input  type="radio" name="Direction_{{$locale}}" value="left" id="Direction_{{$locale}}" >
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="paragraph">{{ __('Url For Button') }}</label>
                            <input class="form-control" type="text" name="url" value="" id="url" >
                        </div>
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="btn_name_{{$locale}}">{{ $locale == 'en'? __('English Button Name') : __('Arabic Button Name') }}</label>
                                <input class="form-control" type="text" name="btn_name_{{$locale}}" value="" id="btn_name_{{$locale}}" >
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="catImage">{{ __('Image') }}</label>
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="catImage" >
                                <label class="custom-file-label"
                                       for="catImage">{{ __('Choose') }} {{__('file') }}</label>
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

        function editImage(header_en,header_ar,paragraph_en,paragraph_ar,Direction_en,Direction_ar,img,url,btn_name_en,btn_name_ar,href,event) {
            let modal = $('#editsliderModal');
            modal.find('.modal-body input[name="header_en"]').val(header_en);
            modal.find('.modal-body input[name="header_ar"]').val(header_ar);
            modal.find('.modal-body input[name="paragraph_en"]').val(paragraph_en);
            modal.find('.modal-body input[name="paragraph_ar"]').val(paragraph_ar);
            modal.find('.modal-body input[name="Direction_en" ][value="'+Direction_en+'"]').attr('checked','checked');
            modal.find('.modal-body input[name="Direction_ar" ][value="'+Direction_ar+'"]').attr('checked','checked');
            modal.find('.modal-body input[name="url"]').val(url);
            modal.find('.modal-body input[name="btn_name_en"]').val(btn_name_en);
            modal.find('.modal-body input[name="btn_name_ar"]').val(btn_name_ar);
            $('#imgPreview img').attr('src', img);
            // $('#imgPreview').show();

            modal.find('.modal-body form').attr("action", href);

        };

        function removeSlide(name, url, e) {
            e.preventDefault();
            swal({
                title: "{{ __('Are you sure') }}?",
                text: "{{ __('You are deleting') }} ( " + name + " )",
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

