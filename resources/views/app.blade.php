
@extends('layouts.app')

@section('title', setting('site.title'))
@section('main_page')
@php use \App\Http\Controllers\HomeController; 
@endphp
@php 
$carousel  = HomeController::getCarousel(); 
@endphp         


<!--Main layout-->
<main >
 <div class="justify-content-center wow fadeIn"  style="display: flex; max-height: 1100px;">
  <div class="carousel-fluid">
    <div id="carouselExampleFade"  class="carousel slide carousel-fade" data-ride="carousel" style="position: inherit !important;">
      <div class="carousel-inner">
        @foreach($carousel as $key=>$c)
        @if($key=='0')
        <div class="carousel-item active">
          <div class="desv-carousel-caption" >
           <label class="desv-carousel-label">{{ Voyager::setting('site.main-carousel_label')}}</label>
           <p><a class="btn desv-carousel-buttom" href="makeOwn" role="button"><i class="fa fa-arrow-right mr-3"></i> Create Now</a>
           </p>
         </div>

         <img src="{{ Voyager::image($c->value)}}" class=" d-block w-100 ">      
       </div>
       @else
       <div class="carousel-item">
        <img src="{{ Voyager::image($c->value)}}" class=" d-block w-100">
      </div>    
      @endif  
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>


<div class="container-fluid d-flex main-fluid  wow fadeIn">
  <div class="main-introduction">
    <span class="main-introduction-title">We Are @yield('title').</span>
    <br> <br>
   {!! Voyager::setting('site.main-introduction-dc') !!}
  </div>
</div>

<div class="container">

  <!--Section: Main info-->
  <section class="mt-5 wow fadeIn">

    <div class="row">
      <div class="col-12 story-title text-center">
        THE STORY BEHIND
      </div>

      <div class="col-6 image_class">
        @php
        $promotion_image = Voyager::setting('site.promotion_image_1', '');
        @endphp
        @if($promotion_image !== '')
        <img  class="content_image responsive" src="{{ Voyager::image($promotion_image) }}" type="image/png">
        @endif
      </div>
      <div class="col-1">
        <span class="vertical-mode">Environment</span>
      </div>
      <div class="col-1">
        <span class="left-bor"></span>
      </div>
      <div class="col-md-4 col-sm-12">
        <span class="content-text">
          {!! Voyager::setting('site.content-text_1') !!}
</span>
      </div>
      
    </div>

  </section>
  <!--Section: Main info-->

  <section class="wow fadeIn section-div">

    <div class="row">
      <div class="col-4">
        <span class="content-text remove-on-mobile">
           {!! Voyager::setting('site.content-text_2') !!}

</span>
     </div>
     
     <div class="col-1">
      <span class="left-bor"></span>
    </div>

    <div class="col-1">
      <span class="vertical-mode">The Highest Standards</span>
    </div>
    <div class="col-6 image_class">
      @php
      $promotion_image = Voyager::setting('site.promotion_image_2', '');
      @endphp
      @if($promotion_image !== '')
      <img  class="content_image responsive" src="{{ Voyager::image($promotion_image) }}" type="image/png">
      @endif
    </div>
    <div class="col-12 d-none display-on-mobile">
      <span class="content-text-2">
 {!! Voyager::setting('site.content-text_3') !!}
   
</span>
    </div>

  </div>

</section>

<section class="wow fadeIn section-div">

  <div class="row">

    <div class="col-6 image_class">
      @php
      $promotion_image = Voyager::setting('site.promotion_image_3', '');
      @endphp
      @if($promotion_image !== '')
      <img  class="content_image responsive" src="{{ Voyager::image($promotion_image) }}" type="image/png">
      @endif
    </div>
    <div class="col-1">
      <span class="vertical-mode">Workmanship</span>
    </div>
    <div class="col-1">
      <span class="left-bor"></span>
    </div>


    <div class="col-md-4 col-sm-12">
      <span class="content-text">
Every pair of eyeglasses are made by a series of manufacturing processes.<br><br> To ensure the quality of our products,<br> our professional factory specialists are holding a strict code of practice to maintain the consistency.

</span>
    </div>
  </div>

</section>

<section  class="wow fadeIn section-div">
 <div class="row">
  <div class="col-12 get-design text-center">
    GET YOUR DESIGN NOW
  </div>
  <div class="col-12 get-design-buttom text-center">
    <a class="btn desv-design-buttom" href="#" role="button"><i class="fa fa-arrow-right mr-3"></i> Create Now</a>
  </div>
</div>
</section>

</div>
</main>





@endsection


