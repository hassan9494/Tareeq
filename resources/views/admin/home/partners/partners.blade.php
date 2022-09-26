@extends('admin.layout.master')
@section('title','Partners')
@section('content')


        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                </div>
            @endif
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">{{__('partners')}}</h4>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{__('Add partners Logos and Background')}}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{__('background image')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('logo images')}}</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <form method="POST" action="{{route('admin.partners.store')}}" enctype="multipart/form-data" file="true">
                                                    @csrf
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">{{__('Add Background Image')}}</div>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <input type="hidden" value="partnersBackeground" name="type">
                                                                    <div class="form-group">
                                                                        <label for="img">{{__('Upload backeground Image')}}</label>
                                                                        <input type="file" name="img" class="form-control-file" id="img" required>
                                                                    </div>
                                                                    <div class="form-group" id="imgPreview" >
                                                                        <img src="" class="img-fluid" alt="" width="300px" height="300px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-action">
                                                            <button type="submit" class="btn btn-success float-right">{{__('Add')}}</button>

                                                        </div>
                                                    </div>
                                                </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <form method="POST" action="{{route('admin.partners.storeLogo')}}" enctype="multipart/form-data" file="true">
                                            @csrf

                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-title">{{__('Add Logo Partners')}}</div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12">
                                                            <input type="hidden" value="partnersLogo" name="type">
                                                            <div class="form-group">
                                                                <label for="url">{{__('URL')}}</label>
                                                                <input type="text" name="url" class="form-control" id="url" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="img">{{__('Upload logo Image')}}</label>
                                                                <input type="file" name="img" class="form-control-file" id="img" required>
                                                            </div>
                                                            <div class="form-group" id="imgPreview" >
                                                                <img src="" class="img-fluid" alt="" width="300px" height="300px">
                                                            </div>
                                                        </div>
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
                    </div>
                </div>
            </div>
        </div>




@stop
