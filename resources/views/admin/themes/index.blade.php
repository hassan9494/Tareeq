@extends('admin.layout.master')
@section('content')
    <div class="container-fluid">
    <div class="row row-card-no-pd ">
        <div class="col-lg-12 ">
        <h1>{{__('Themes')}}</h1>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#colorWebsite">
            {{__('Website Color')}}
        </button>
        </div>
        <div class="col-lg-12 ">

            @foreach($themes->except([3,5]) as $theme)
                <div class="card" style="width: 18rem; display: inline-block">
{{--                    <img class="card-img-top" src="{{asset($theme->img)}}" alt="Card image cap" style="height: 200px">--}}
                    <div class="card-body">
                        <h5 class="card-title">{{$theme->name}}</h5>
                        <p class="card-text">{{$theme->desc}}</p>
                        <a href="{{route('admin.activeTheme',$theme)}}" class="btn {{$theme->name == setting('theme.site')?'btn-success disabled':'btn-primary'}}" >{{$theme->name == setting('theme.site')?'activated':'active'}}</a>

                        <a type="button" style="color:#fff;" onclick='showImage("{{asset($theme->img)}}", event);'
                                class="btn btn-info" data-toggle="modal" data-target="#showImageModal">
                            {{__('Preview')}}
                        </a>

                        <!-- Modal -->
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
    <!-- model setting-->
    <div class="modal fade" id="colorWebsite" tabindex="-1" role="dialog" aria-labelledby="colorWebsite" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="colorWebsite">{{__('Website Color')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data"
                          action="{{ route('admin.settings.update') }}">
                        @method('PUT')
                        @csrf
                        @foreach($settings as $key=>$value)
                            @if( $key != 'top_bar_background_color' && $key != 'top_border_color' && $key != 'top_bar_text_color' && $key != 'navbar_background_color' && $key != 'button_color' && $key != 'navbar_text_color' && $key != 'navbar_hover_color' && $key != 'navbar_active_color' && $key != 'footer_bottom_background_color'  && $key != 'footer_bottom_text_color' && $key !='footer_background_color' && $key != 'footer_text_color' && $key != 'footer_bottom_border_color' )
                                @if($key == 'top_bar_visible' || $key == 'phone_number_visible' || $key ==  'email_address_visible')
                                    <div class="form-group" style="margin: 10px">
                                        <label for="{{ $key }}">{{ucwords(str_replace('_', ' ', $key)) }}</label>
                                        <input type="checkbox" class="status"  name="{{ $key }}"  value="{{$value}}" {{$value == 1 ? 'checked' : 0 }}>
                                        <span style=" " data-href="{{route('admin.visible')}}"  data-checked="{{ __('on') }}" data-unchecked="{{ __('off') }}"></span>

                                    </div>
                                @endif
                                @else
                                    <div class="form-group" style="margin: 10px">
                                        <label for="{{ $key }}">{{ucwords(str_replace('_', ' ', $key)) }}</label>
                                        <input type="color" name="{{ $key }}" class="status" value="{{$value }}">
                                    </div>
                                @endif

                          @endforeach
                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end setting -->

    <div class="modal fade" id="showImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <img src="" class="img-fluid">
                </div>

            </div>
        </div>
    </div>


@stop
@section('script')
    <script>

        $('.status').change(function () {
            let status = $(this).prop('checked');
            let name = $(this).attr('name');
            // console.log(name);
            let href = $(this).next().attr('data-href');
            if(status){status = 1}else{status = 0}
            $.ajax({
                url: href,
                method: 'post',
                data: {'value': status,'name':name, '_token': "{{ csrf_token() }}"},
                success: function (data) {
                    // window.location.reload();
                }
            });
        });
        function showImage(img,event) {
            let modal = $('#showImageModal');
            modal.find(' img').attr('src', img);


        };

    </script>
@stop
