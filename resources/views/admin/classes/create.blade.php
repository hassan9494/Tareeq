@extends('admin.layout.master')
@section('title','Create Course')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.classes.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Add Class')}}</div>

                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Student') }}*</label>
                                        <select name="student_id" id="category"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Student') }}</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Teacher') }}*</label>
                                        <select name="teacher_id" id="category"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Teacher') }}</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" >{{ __('Course') }}</label>
                                        <select name="product_id" class="form-control  " id="country" >
                                        @foreach(\App\CategoryProduct::all() as $category)
                                            <optgroup label="{{$category->name}}">
                                                @foreach($category->products->where('status',1) as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="weeks">{{__('Start From') }}*</label>
                                        <input type="date" name="start_from" class="form-control" id="weeks" placeholder="Enter "  required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="weeks">{{__('Num Of Week') }}*</label>
                                        <input type="number" name="weeks" class="form-control" id="weeks" placeholder="Enter " value="1" min="1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weeks">{{__('Session Time / Minute') }}*</label>
                                        <input type="number" name="session_time" class="form-control" id="weeks"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">{{ __('Use Application') }}*</label>
                                        <select name="application" id="category"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                           {{-- <option value="">{{ __('Select') }} {{ __('Application') }}</option> --}}
                                                <option value="zoom">Zoom</option>
                                                <option value="zoom">TeamLink</option>

                                        </select>
                                    </div>
                                </div>

                            </div><hr>


                            <h3>{{__('Days')}} <small></small></h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Sunday')}} <small></small></label>
                                        <input name="days[sunday]" type="time"  value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Monday')}} <small></small></label>
                                        <input name="days[monday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Tuesday')}} <small></small></label>
                                        <input name="days[tuesday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Wednesday')}} <small>*</small></label>
                                        <input name="days[wednesday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Thursday')}} <small></small></label>
                                        <input name="days[thursday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Friday')}} <small></small></label>
                                        <input name="days[friday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>{{__('Saturday')}} <small></small></label>
                                        <input name="days[saturday]" type="time"   value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="free" type="checkbox" value="1">
                                    <span class="form-check-sign">{{__('Free Trial')}}</span>
                                </label>
                            </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        let  index = 0, indexAttr = 1, values = [], valuesPaired = [];

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

        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: false,
                lang: '{{ config("app.locale") }}',
                toolbar: [
                    // [groupName, [list of button]]
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['style', 'ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['insert', [ 'table','hr','video','link']],
                    ['custom', ['picture']],
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['misc', ['fullscreen', 'undo', 'redo', 'help', 'codeview']]
                ],
            });
        });



    </script>
@stop
