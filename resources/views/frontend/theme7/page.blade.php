@extends('frontend.'.setting('theme.site').'.layout.master')
@section('content')

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! html_entity_decode($page->content) !!}
                </div>

            </div>
        </div>
    </section>



@stop

