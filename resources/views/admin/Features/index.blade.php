@extends('admin.layout.master')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Features')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <thead>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Subject')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    @if($features->count() > 0)
                                        @foreach($features as $feature)
                                            <tbody>
                                            <tr>
                                                <td>
                                                    @if($feature->hasMedia('feature'))
                                                        <div class="flag">
                                                            <img width="80" height="80" src="{{ $feature->lastMedia('feature')->getUrl() }}">
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{$feature->title}}</td>
                                                <td>
                                                    {{$feature->desc}}
                                                </td>
                                                <td>
{{--                                                    <form action="{{route('admin.feature.destroy',$feature->id)}}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
                                                        <a href="{{route('admin.feature.edit',$feature->id)}}" class="btn btn-info btn-xs">
                                                            <i class='fa fa-edit'></i> {{__('Edit')}}
                                                        </a>
{{--                                                        <a href="{{route('admin.feature.show',$feature->id)}}" class="btn btn-primary btn-xs">{{__('Show')}}</a>--}}
                                                        <button class="btn btn-danger btn-xs"  onclick="removeFeature('{{$feature->name}}','{{route('admin.feature.destroy',$feature->id)}}')">
                                                            <i class="fas fa-trash"></i> {{__('Delete')}}
                                                        </button>
{{--                                                    </form>--}}
                                                </td>
                                            </tr>

                                            </tbody>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop


