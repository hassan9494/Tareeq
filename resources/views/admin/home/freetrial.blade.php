@extends('admin.'.setting('theme.admin').'.layout.master')

@section('title', 'free trial')

@section('content')


<div class="row row-card-no-pd">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">{{__('Free Trial Section')}}</h4>
                </div>
            </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="{{ route('admin.section.setting.update') }}">
                @method('PUT')
                @csrf
                <input type="hidden" name="type" value="freetrial">
                @foreach(config('locales') as $locale)
                    <input type="hidden" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter title" value="freetrial">
                @endforeach
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <label for="url">{{__('Url')}}</label> --}}
                            {{-- <input type="url" name="url" class="form-control " value="{{route('freeTrial')}}"></input> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{__('Upload Image')}}</label>
                            <input type="file" name="backgroundImage"  id="backgroundImage">
                        </div>
                        <div class="form-row">
                            <div class="col-md-4   text-center">
                                <div class="form-group"id="imgPreview2" >
                                    @if($freetrial->hasMedia('backgroundImage'))
                                        <img src="{{ $freetrial->firstMedia('backgroundImage')->getUrl() }}" class="img-fluid"
                                             alt="" height="200px" width="300px">
                                    @else
                                        <img src="" class="img-fluid"
                                             alt="no image" height="200px" width="300px">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary save-btn"> {{ __('Save') }}</button>
            </form>
        </div>
    </div>
    </div>
</div>
@stop

@section('script')
    <script>


        $('input[type="file"][name="backgroundImage"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            // $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview2 img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });


        $('.tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });
    </script>
@stop

