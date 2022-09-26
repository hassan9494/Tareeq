@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">
                @if($team->hasMedia('team'))
                    <div class="flag">
                        <img  class="card-img-top"  width="200px" height="200px" src="{{ $team->firstMedia('team')->getUrl() }}">
                    </div>
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$team->name}}</h5>
            </div>
            <div class="card-footer text-muted" style="background-color:rgba(0,0,0,.03);">
                <p class="card-text">{!! $team->desc!!}</p>
            </div>
        </div>
      </div>
   </div>
@stop
