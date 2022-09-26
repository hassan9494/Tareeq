@extends('layouts.app')

@section('content')
    <section id="home" style="min-height: 200px" >
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="table-responsive">
                        <form method="post" action="{{ route('lesson.date.update',$thislesson) }}">
                            @csrf
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Date')}} <small></small></label>
                                            <input name="date" type="date"   value="" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{__('Time')}} <small></small></label>
                                            <input name="time" type="time"   value="" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('Comment')}} <small></small></label>
                                            <textarea class="form-control" name="comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-lg">{{__('Change')}}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')

@endsection
