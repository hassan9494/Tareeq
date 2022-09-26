@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="mt-5">
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">{{$task->name}}</h5>
                    <h5>{{__('DeadLine') .':' .$task->deadLine->format('Y-m-d')}}</h5>

                </div>
                <div class="card-body">
                    <p>{!! $task->description !!}}</p>
                    <hr>

                    <table class="table table-typo">
                        <thead><h5>{{__('Comments')}}</h5></thead>
                        <tbody>
                        @foreach($userTask->comments as $comment)
                            <tr>
                            <td  width="30%">
                                <p>{{$comment->user->name}}</p>

                            </td>
                            <td width="70%"><span class="h2">{{$comment->comment}}</span></td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <form method="post" action="{{ route('admin.tasks.comment') }}">
                        @csrf
                        <input type="hidden" name="userTask" value="{{$userTask->id}}">
                        <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} "
                                          id="description" name="comment" required placeholder="Add Your Comment"></textarea>
                                @if($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary my-2" type="submit">{{__('Add')}}</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop
