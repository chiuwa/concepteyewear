@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.find_out_product'))


@section('main_page')



<main>
	<div class="container wow fadeIn other_page">
<div class="row flex-column-reverse flex-md-row">

		@if (isset($data[0]))

		@php $your_product = $data[0]; @endphp

 <div class="col-md-6">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  >
  <ol class="carousel-indicators">

  <li data-target="#carouselExampleIndicators" data-slide-to=0 class="active"></li>

    <li data-target="#carouselExampleIndicators" data-slide-to=1></li>
  
    <li data-target="#carouselExampleIndicators" data-slide-to=2></li>
  
  </ol>

  <div class="carousel-inner">

        <div class="carousel-item active" id="product_image_1">
         <img src="{{ Voyager::image($your_product->product_image_1)}}" class="d-block step-image">      
       </div>

 		<div class="carousel-item" id="product_image_2">
         <img src="{{ Voyager::image($your_product->product_image_2)}}" class="d-block step-image">      
       </div>

       	<div class="carousel-item" id="product_image_3">
         <img src="{{ Voyager::image($your_product->product_image_3)}}" class="d-block step-image">      
       </div>

  </div>
  <a class="carousel-control-prev step-style" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon step-style-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next step-style" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon step-style-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
<div class="col-md-6">
	
</div>

		@else

<h1>NO DATA</h1>

		@endif 

	</div>
	</div>
</main>




@endsection
