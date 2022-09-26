@extends('admin.layout.master')

@section('title', 'Settings | General')
@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"
                              action="{{ route('admin.settings.update') }}">
                            @method('PUT')
                            @csrf
                            @foreach($settings as $key=>$value)
                                @if($key != 'logo')
                                    @if($key != 'tags')
                                        @if( $key != 'top_bar_background_color' && $key != 'top_bar_text_color' && $key != 'top_border_color' && $key != 'navbar_background_color'  && $key != 'footer_background_color' && $key != 'button_color' && $key != 'navbar_text_color' && $key != 'navbar_hover_color' && $key != 'navbar_active_color' && $key !='footer_background_color' && $key != 'footer_bottom_background_color' && $key != 'footer_bottom_text_color' && $key != 'footer_text_color' && $key != 'footer_bottom_border_color' && $key != 'top_bar_visible' && $key != 'phone_number_visible' && $key !=  'email_address_visible')
                                        <span class="mt-5">
                                            <label for="{{ $key }}">{{ucwords(str_replace('_', ' ', $key)) }}</label>
                                            <input type="text" name="{{ $key }}" class="form-control" id="{{ $key }}"
                                                   value="{{ $value }}">
                                        </span>

                                        @endif
                                        @else
                                        <div class="form-group">
                                            <label for="tags">{{ __('SEO keywords') }}</label>
                                            <input type="text" name="tags" class="form-control tags  selectize-{{ $loop->index }}" value="{{$value }}">
                                        </div>

                                    @endif
                                @else
                                    <div class="form-row">
                                        <div class="col-md-2   text-center">
                                            <div class="form-group" id="imgPreview">
                                                <img src="{{ asset('logo') . '/' . $value }}" class="img-fluid"
                                                     alt="{{ $value }}">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="catImage">{{ __('Logo') }} ( {{ setting('general.logo') }}
                                                                                       )</label>
                                                <div class="custom-file">
                                                    <input type="file" name="logo" class="custom-file-input"
                                                           id="catImage">
                                                    <label class="custom-file-label"
                                                           for="catImage">{{ __('Choose') }} {{__('file') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
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

        $('.tags').selectize({
            persist: false,
            createOnBlur: true,
            create: true
        });
    </script>
@stop
