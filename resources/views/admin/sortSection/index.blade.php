@extends('admin.layout.master')

@section('styles')
    <style>

        ul
        {
            float: left;
            margin: 20px 10px 0 20px;
            border:1px solid #999;
            width: 100px;
            padding:10px;
        }
        li
        {
            background: #fff;
            border: solid 1px #ccc;
            font-family: Arial, Tahoma, San-Serif;
            padding: 10px;
        }


    </style>
@stop

@section('content')
    <div class="container-fluid">
         <div class="row row-card-no-pd mt-5">
         <div class="col-lg-6 ">
             <h1>{{__('DeActive Section')}}</h1>
            <ul id="sortable1" class="list-group connectedSortable">
                @foreach($deActive as $sectionDeactive)
                   <li class="list-group-item active" data-id="{{$sectionDeactive->id}}">
                       {{$sectionDeactive->name}}

                     <span class="float-right" style="position: absolute;right: 10px">
                          <i class="fa fa-arrow-right" style="font-size: 20px"></i>
                     </span>

                   </li>
                @endforeach
            </ul>
         </div>

        <div class="col-lg-6">
            <h1>{{__('Active Section')}}</h1>

            <ul id="sortable2" class="list-group connectedSortable">
                @foreach($active as $sectionActive)
                    <li class="list-group-item active" data-id="{{$sectionActive->id}}">
                        <i class="fas fa-arrows-alt"></i>
                        {{$sectionActive->name}}

                    </li>
                @endforeach

            </ul>
            <button type="button" id="save" onclick="saveItem()"
                    class="btn btn-primary float-right mt-3">{{ __('Save') }}</button>
        </div>
        <div class="row mt-5 ml-3">

            <div class="col-4 ">
                <form method="post" action="{{ route('admin.sectionSort.store') }}" id="pagesForm">
                    @csrf

                </form>
            </div>
        </div>

         </div>
    </div>


@stop
@section('script')

        <script>
        let form = $('#pagesForm');
        new Sortable(document.getElementById('sortable1'), {
            group: {
                name: 'shared',
            },
            animation: 150,
            onAdd: function (event) {
                let target = $(event.item);
                console.log(target);
                target.find('i').remove();
                target.append('<span class="float-right" style="position: absolute;right: 10px"><i class="fa fa-arrow-right" style="float: left;font-size: 20px"></i></span>');
            },
        });

        new Sortable(document.getElementById('sortable2'), {
            group: {
                name: 'shared',
            },
            animation: 150,
                onAdd: function (event) {
                    console.log(event);
                    let target = $(event.item);
                    target.find('i').remove();
                    target.prepend('<i class="fa fa-arrows-alt" style="float: left"></i>');
                },
        });
        function saveItem() {
            let list = document.getElementById('sortable2');
            let x = 0;
            $.each(list.children, function (index, parent) {
                form.append('<input type="hidden" name="active[' + x + '][id]" value="' + $(parent).data('id') + '">');
                form.append('<input type="hidden" name="active[' + x + '][order]" value="' + index + '">');

                x++;
            });
            let list1 = document.getElementById('sortable1');
            let y =0;
            $.each(list1.children, function (index, parent) {
                form.append('<input type="hidden" name="deActive[' + y + '][id]" value="' + $(parent).data('id') + '">');
                y++;
            });


            form.submit();
        }

    </script>
@stop
