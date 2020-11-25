@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.lookbook'))


@section('main_page')



<main>
 <div class="container wow fadeIn other_page">

    <div class="col-12 text-center main_title_div">
      <span class="main_title">CHECK OUT WHAT’S NEW</span>
</div>
  

<div class="myExMul">
	
  @foreach($images as $key=>$image)
 <a href={{ asset('/'.$image)  }} rel="myExMul-1">
    <img src={{ asset('/'.$image)  }} />
       </a>
      @endforeach
</div>

    </div>
</main>




@endsection
