@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__('Event Setting')}}</h2>
                    </div>
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.section.setting.update')}}" enctype="multipart/form-data" file="true">
                            @csrf
                            @method('Put')
                            <input type="hidden" name="type" value="event">

                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                    <input type="text" name="name_{{$locale}}" class="form-control" value="{{$eventSection->getTranslation('name',$locale)}}">
                                </div>
                            @endforeach
                            @foreach(config('locales') as $locale)
                                <div class="form-group">
                                    <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                    <input type="text" name="description_{{$locale}}" class="form-control" value="{{$eventSection->getTranslation('description',$locale)}}">
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="backgroungColor">{{__('Section Color')}}</label>
                                <input type="color" name="backgroungColor" value="{{$eventSection->backgroundColor}}">
                            </div>

                            <div class="form-group">
                                <label for="img">{{__('Upload Image')}}</label>
                                <input type="file" name="img"  id="img" multiple >
                            </div>

                            <div class="form-row">
                                <div class="col-md-2   text-center">
                                    <div class="form-group" id="imgPreview">
                                        @if($eventSection->hasMedia('event'))
                                            <img src="{{$eventSection->firstMedia('event')->getUrl()}}" class="img-fluid"
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
        $('.active').change(function () {
            let active = $(this).prop('checked');
            // console.log(status);
            let href = $(this).next().attr('data-href');
            if(active){active = 1}else{active = 0}
            $.ajax({
                url: href,
                method: 'post',
                data: {'active': active, '_token': "{{ csrf_token() }}"},
                success: function (data) {
                    // window.location.reload();
                }
            });
        });
        function removeEvent(name, url, e) {
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
