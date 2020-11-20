@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.makeOwn'))


@section('main_page')



<main>
 <div class="container wow fadeIn other_page">
<div class="row flex-column-reverse flex-md-row">
    <div class="col-md-6">
        sidebar
    </div>
    <div class="col-md-6">
        main
    </div>
</div>
      </div>
</main>




@endsection
