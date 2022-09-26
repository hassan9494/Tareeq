@extends('admin.layout.master')
@section('title','Events')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Events')}}</h4>
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
                                    <th>{{__('Short Description')}}</th>
                                    <th>{{__('Active')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                   @if($events->count() > 0)
                                       @foreach($events as $event)
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($event->hasMedia('event'))
                                            <div class="flag">
                                                <img width="80" height="80" src="{{ $event->lastMedia('event')->getUrl() }}">
                                            </div>
                                                @endif
                                        </td>
                                        <td>{{$event->name}}</td>
                                        <td>
                                          {{$event->sh_desc}}
                                        </td>
                                        <td>
                                            <label class="colorinput switch switch-label switch-pill switch-success switch-md float-left">
                                                <input class="switch-input status colorinput-input"  type="checkbox" {{$event->active ? "checked":''}} name="active" value="secondary">
                                                <span class="switch-slider colorinput-color bg-secondary" style=" " data-href="{{route('admin.active', $event) }}"  data-checked="{{ __('on') }}" data-unchecked="{{ __('off') }}"></span>
                                            </label>
                                        </td>
                                        <td>
{{--                                            <form action="{{route('admin.events.destroy',$event->id)}}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
                                                <a href="{{route('admin.events.edit',$event->id)}}" class="btn btn-info btn-xs">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>
                                                <a href="{{route('admin.events.show',$event->id)}}" class="btn btn-primary btn-xs">{{__('Show')}}</a>

                                                <button class="btn btn-danger btn-xs" type="submit" onclick="removeEvent('{{ $event->name }}', '{{route('admin.event.destroy',$event->id)}}')">
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
        $('.status').change(function () {
            let status = $(this).prop('checked');
            // console.log(status);
            let href = $(this).next().attr('data-href');
            if(status){status = 1}else{status = 0}
            $.ajax({
                url: href,
                method: 'post',
                data: {'active': status, '_token': "{{ csrf_token() }}"},
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
        function removeProduct(name, url, e) {
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
        $(document).ready(function() {
            $('#table').dataTable({
                "responsive": false,
                "paginate": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order': [['0', 'desc']]
            });
        });
    </script>
@stop

