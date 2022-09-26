@extends('admin.layout.master')
@section('title','Events')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Team')}}</h4>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table">
                                    <thead>
                                    <th>{{__('Image')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                   @if($teams->count() > 0)
                                       @foreach($teams as $team)
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($team->hasMedia('team'))
                                            <div class="flag">
                                                <img width="80" height="80" src="{{ $team->lastMedia('team')->getUrl() }}">
                                            </div>
                                                @endif
                                        </td>
                                        <td>{{$team->name}}</td>
                                        <td>
                                          {{$team->desc}}
                                        </td>
                                        <td>
{{--                                            <form action="{{route('admin.events.destroy',$event->id)}}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
                                                <a href="{{route('admin.teams.edit',$team->id)}}" class="btn btn-info btn-xs">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>
                                                <a href="{{route('admin.teams.show',$team->id)}}" class="btn btn-primary btn-xs">{{__('Show')}}</a>

                                                <button class="btn btn-danger btn-xs" type="submit" onclick="removeTeam('{{ $team->name }}', '{{route('admin.team.destroy',$team->id)}}')">
                                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                                </button>
{{--                                            </form>--}}
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

@section('script')
    <script>
        function removeTeam(name, url, e) {
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
