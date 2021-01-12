@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.about'))


@section('main_page')
<main>
 <div class="container d-flex wow fadeIn other_page">
  <div class="row"> 


    <div class="col-12 contact_title_email">
      <span class="contact_title">We are The Eyes Crafters. <br>We are here to bring you a brand new eyewear production experience.</span>

    </div>



    <div class="col-md-12 address">
      <span class="contact_title">Order 100+ to create your design</span>
      <br>   
      <span>We understand the MOQ of designing and producing a batch of eyewear is very high. Businesses and brands who are interested in producing eyewear might hold back their innovative ideas due to the high threshold. At The Eyes Crafters, you can get your design by ordering 100 or more eyeglasses in each combination.
      </span>
    </div>


  
    <div class="col-md-12 address">
      <span class="contact_title">Numerous Combinations</span>
      <br>   
      <span>At The Eyes Crafters, you can “Make Your Own” eyeglasses on our platform. We got a wide range of choices for each component, including 20 different shapes of frames with 20 different colors!</span>
    </div>


    <div class="col-md-12 address">
      <span class="contact_title">We Got Your Back</span>
      <br>   
      <span>Please don’t be worry if you can’t find the perfect eyeglasses on our site, our teams are always here to help. Please feel free to talk to our team, and we will find the best solution for you!</span>
    </div>


  </div>
</div>
</main>
@endsection
