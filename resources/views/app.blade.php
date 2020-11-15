
@extends('layouts.app')

@section('title', setting('site.title'))
@section('main_page')
@php use \App\Http\Controllers\HomeController; 
@endphp
   @php 
    $carousel  = HomeController::getCarousel(); 
  @endphp         


    <!--Main layout-->
    <main>
 <div class="justify-content-center " style="display: flex; max-height: 1100px;">
      <div class="carousel-fluid">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" style="position: inherit !important;">
          <div class="carousel-inner">
            @foreach($carousel as $key=>$c)
            @if($key=='0')
            <div class="carousel-item active">
              <div class="desv-carousel-caption" >
               <label class="desv-carousel-label">WEAR YOUR OWN STYLE</label>
               <p><a class="btn desv-carousel-buttom" href="#" role="button"><i class="fa fa-arrow-right mr-3"></i> Create Now</a>
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


 <div class="container-fluid d-flex main-fluid">
  <div class="main-introduction">
      <span class="main-introduction-title">We Are @yield('title').</span>
      <br>
      <span class="main-introduction-dc">It 's time to make moves.</span>
      <br><br>
      <span class="main-introduction-dc">Our one-stop solution can help you to bring your dreams into reality, combine with our experienced operation team.
To provide clients with not only products but also design, packaging, logistics and further services.</span>
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
              <span class="vertical-mode">Workmanship</span>
            </div>
            <div class="col-1">
            <span class="left-bor"></span>
            </div>
            <div class="col-4">
              <span class="content-text">Abbie Top.<br>
                I'm a paragraph. Click here to add your<br>
                own text and edit me. It's easy.</span>
            </div>
          </div>

        </section>
        <!--Section: Main info-->

         <section class="wow fadeIn section-div">

          <div class="row">
            <div class="col-4">
              <span class="content-text">Mia Shirt.<br>
             I'm a paragraph. Click here to add your<br>
              own text and edit me. It's easy.</span>
            </div>
        
            <div class="col-1">
            <span class="left-bor"></span>
            </div>

                <div class="col-1">
              <span class="vertical-mode">Material-Recycling</span>
            </div>
             <div class="col-6 image_class">
              @php
              $promotion_image = Voyager::setting('site.promotion_image_2', '');
              @endphp
              @if($promotion_image !== '')
              <img  class="content_image responsive" src="{{ Voyager::image($promotion_image) }}" type="image/png">
              @endif
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
              <span class="vertical-mode">Detail-Oriented</span>
            </div>
            <div class="col-1">
            <span class="left-bor"></span>
            </div>
            <div class="col-4">
              <span class="content-text">Melisa Coat.<br>
                I'm a paragraph. Click here to add your<br>
                own text and edit me. It's easy.</span>
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


