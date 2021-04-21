@extends('layouts.app')
@section('title',setting('site.title') ." | About")


@section('main_page')
<main>
 <div class="container-flex d-flex">
     @php
     $promotion_image = Voyager::setting('site.about_banner', '');
        @endphp
        <div class="bg-image" id="jumboid" style="background: url({{ Voyager::image($promotion_image)}});">
      </div>
    </div>

   <div class="container-flex d-flex">
         @php
        $promotion_image_1 = Voyager::setting('site.about_banner_2', '');
        @endphp
<div class="bg-image" id="jumboid" style="background: url({{ Voyager::image($promotion_image_1)}});">
<div class="about_main">
<div class="container d-flex wow fadeIn ">

  <div class=" row flex-md-row" style="    margin-top: 8vh;">

 <div class="col-md-1 ">
 </div>
    <div class="col-md-3 about_box">
      <p class="about_title">Order 100+ to create your design</p>
      <hr style="border: 1px solid black;"><br>   
      <p class="about_dc">We understand the MOQ of designing and producing a batch of eyewear is very high. Businesses and brands who are interested in producing eyewear might hold back their innovative ideas due to the high threshold. At The Eyes Crafters, you can get your design by ordering 100 or more eyeglasses in each combination.
      </p>
    </div>


  
    <div class="col-md-3 about_box">
      <p class="about_title">Numerous Combinations</p>
        <hr style="border: 1px solid black;"><br>   
      <p class="about_dc">At The Eyes Crafters, you can “Make Your Own” eyeglasses on our platform. We got a wide range of choices for each component, including 20 different shapes of frames with 20 different colors!</p>
    </div>


    <div class="col-md-3 about_box">
      <p class="about_title">We Got Your Back</p>
        <hr style="border: 1px solid black;"><br>  
      <p class="about_dc">Please don’t be worry if you can’t find the perfect eyeglasses on our site, our teams are always here to help. Please feel free to talk to our team, and we will find the best solution for you!</p>
    </div>

  </div>
  </div>

</div>
     

  </div>
  </div>
</main>
@endsection
