@extends('admin.layout.master')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <form method="POST" action="{{route('admin.mediaUpload')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                            @csrf
                            <div class="form-group">
                                <label for="img">{{__('Upload Image')}}</label>
                                <input type="file" name="img[]" class="form-control-file" id="img" multiple required>
                            </div>
                            <div class="form-group" id="imgPreview" >
                                <img src="" class="img-fluid" alt="" width="300px" height="300px">
                            </div>
                              <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($media as $mediaPhoto)
{{--                            @dd($mediaPhoto)--}}
                            <div class="col-md-3" style="margin-bottom: 10px">
                                   <img src="{{$mediaPhoto->getUrl()}}" style="width:100%;height:132px">
                                    <button class="btn btn-secondary btn-sm" aria-label="copied" data-clipboard-text="{{$mediaPhoto->getUrl()}}">{{__('Copy Path')}}</button>
                                <a class="btn btn-danger btn-sm"  href="{{route('admin.mediaDelete',$mediaPhoto->id)}}" >
                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).on('change','#img', function (e) {
            let x;

            // console.log($(n));

            for( x = 0 ;x<$(e.target.files).length; x++ ){
                let reader = new FileReader();


                // var name = document.createElement('p');
                let name =e.target.files[x].name;
                // $('#imgPreview').append(name);
                var l = document.getElementsByClassName('img-fluid');
                $(l).remove();
                reader.onload = function (event) {

                    let target = $('#imgPreview');

                    target.append(' <div style="display: inline-block;"><img name='+name+' src='+event.target.result+' width="100px" style="margin: 10px;"  id="image" class="img-fluid">'
                    );
                };
                reader.readAsDataURL(e.target.files[x]);
                $('#imgPreview').show();
            }
        });

        var clipboard = new ClipboardJS('.btn');

        clipboard.on('success', function(e) {
            // swal(''e.trigger,'Copied!');
            swal({
                title: "Copied!",
                icon: "success",
                buttons: {
                    confirm : {
                        className: 'btn btn-success'
                    }
                }
            })
        });

    </script>
@stop

