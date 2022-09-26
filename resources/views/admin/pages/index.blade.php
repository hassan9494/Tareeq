@extends('admin.layout.master')

@section('title', 'Pages')
@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="pagesTable">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Parent')}}</th>
                                    <th scope="col">{{__('Link')}}</th>
                                    <th scope="col">{{__('Published')}}</th>
                                    <th scope="col">{{__('Created')}}</th>
                                    <th scope="col">{{__('Updated')}}</th>
                                   <th scope="col">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody id="pagesTableRows">
                                @foreach($pages as $page)
                                    <tr>
                                        @if($page->homepage)
                                            <th class="align-middle" scope="row">
                                                <i class="fa fa-home"></i>
                                                {{ $page->order }}
                                            </th>
                                        @else
                                            <th class="align-middle" scope="row">{{ $loop->iteration }}</th>
                                        @endif
                                        <td class="align-middle">{{ $page->name }}</td>
                                        <td class="align-middle">
                                            @if($page->parent_id == null)
                                              {{ __('null') }}
                                            @else
                                              {{$page->parent->name}}
                                            @endif

                                        </td>

                                        <td class="align-middle">pages/{{ $page->slug }}</td>
                                        <td class="align-middle">{{ $page->published  ? ('yes'): __('Not Yet') }}</td>
                                        <td class="align-middle">{{ $page->created_at }}</td>
                                        <td class="align-middle">{{ $page->updated_at }}</td>
                                            <td>
{{--                                                <form action="{{route('admin.pages.destroy',$page->id)}}" method="POST">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
                                                    <a href="{{route('admin.pages.edit',$page->id)}}" class="btn btn-info btn-xs">
                                                        <i class='fa fa-edit'></i> {{__('Edit')}}
                                                    </a>

                                                    <button class="btn btn-danger btn-xs"  onclick="removePage('{{$page->name}}','{{route('admin.pages.destroy',$page->id)}}');">
                                                        <i class="fas fa-trash"></i> {{__('Delete')}}
                                                    </button>

{{--                                                </form>--}}
                                            </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        function removePage(name, url, e) {
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
