<!DOCTYPE HTML>
<?php

use TCG\Voyager\Models\Setting;
use \App\Http\Controllers\HomeController; 
?>

<html>
@php 
$carousel  = HomeController::getCarousel(); 

@endphp    

<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0J9GL73CF3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0J9GL73CF3');
</script>
<!-- Global site tag (gtag.js) - Google Ads: 721286711 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-721286711"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-721286711');
</script>

<!-- Event snippet for Website traffic conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-721286711/asyHCMrv84kCELfs99cC'});
</script>


  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>@yield('title')</title>
  <meta name="description"  content="The eyes crafters can make your own glasses. Click the link get more information." />
  <meta name="robots" content="index,follow">

  <meta property="og:type" content="website" />
  <meta property="og:title" content="@yield('title')" />
  <meta property="og:description" content="The eyes crafters can make your own glasses. Click the link get more information." />
  <meta property="og:url" content="{{url()->current()}}" />
  <meta property="og:site_name" content="THE EYES CRAFTERS" />
  <meta property="og:image" content="https://theeyescrafters.com/storage/logo/theeyescrafters_logo.jpeg" />
  <meta property="og:locale" content="en-us" />
  <!-- Font Awesome -->
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  
  <link rel="stylesheet" href="{{'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' }}">
  <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"-->
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">

  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

  <link rel="stylesheet" href="{{ asset('css/boxicons/css/boxicons.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/icofont/icofont.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/justifiedGallery.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/colorbox.css') }}">

</head>
<body>
  <div class="colorlib-loader"></div>
  <div class="icon-bar">
    <div class="icon-backgroud">
      <a href="//{{Voyager::setting('site.facebook')}}" target="_blank"  class="facebook" ><img  class="png_icon" src="/images/facebook.png" onmouseover="fb_hover(this);" onmouseout="fb_unhover(this);"></a> 
    </div>
    <div class="icon-backgroud">
     <a href="//{{Voyager::setting('site.instagram')}}" target="_blank" class="instagram"><img  class="png_icon" src="/images/instagram.png" onmouseover="ig_hover(this);" onmouseout="ig_unhover(this);"></a> 
   </div> 
   <div class="icon-backgroud">
     <a href="//{{Voyager::setting('site.pinterest')}}" target="_blank" class="pinterest"><img  class="png_icon" src="/images/pinterest.png" onmouseover="pi_hover(this);" onmouseout="pi_unhover(this);"></a> 
   </div> 
   <div class="icon-backgroud">
     <a href="//{{Voyager::setting('site.twitter')}}" target="_blank" class="twitter"><img  class="png_icon" src="/images/twitter.png" onmouseover="tw_hover(this);" onmouseout="tw_unhover(this);"></a> 
   </div> 
 </div>


 <header id="header" class="fixed-top">
  <div class="container-fluid d-flex">
       
    <div class="d-flex">
     <button type="button" class="nav-toggle d-none d-lg-block title-close"><i class="fa fa-bars"></i></button>
      @if(Auth::check())
       @php 
        $order_number  = HomeController::getOrder(); 
        $cart_number  = HomeController::getCart(); 
        @endphp  
     @if($order_number!=0 ||  $cart_number!=0)
     <button type="button" class="nav-member"  data-toggle="modal" data-target="#LoginModal" ><img style="width: 45%;" src="/images/user.png"><div class="user_bubble"></div></button>     
     @else
      <button type="button" class="nav-member"  data-toggle="modal" data-target="#LoginModal" ><img style="width: 45%;" src="/images/user.png"></button>
     @endif
     @else
       <button type="button" class="nav-member"  data-toggle="modal" data-target="#LoginModal" ><img style="width: 45%;" src="/images/user.png"></button>
          @endif
   </div>
   <!--i class="fa fa-user-o"></i-->
 </div>

 <div class="nav-toggle-menu">
  <nav class="justify-content-center nav-title" style="display: flex;">
     @php
        $logo = Voyager::setting('site.logo');
        @endphp
        @if($logo)
       <a href="/home">  <img  class="responsive logo_image"  src="{{ Voyager::image($logo) }}" type="image/png"></a>
        @else
          <a href="/home"><span style="color: #000000;">{{Voyager::setting('site.title')}}</span></a>
        @endif
  </nav>
  <nav class="nav-menu d-flex justify-content-center non-active">
    <ul>
      <li class="active"><a href="/home">Home</a></li>
      <li><a href="/makeOwn">Make-Your-Own</a></li>
      <li><a href="/lookbook">Lookbook</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/contact">Contact</a></li>
          <!--li class="drop-down"><a href="">Drop Down</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="drop-down"><a href="#">Drop Down 2</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
     
            </ul>
          </li--> 
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header>

  <!-- End Header -->
  <!-- Navbar -->
  

  @yield('main_page')

  <!--Main layout-->
  <!--Footer-->

  <footer class=" footer fadeIn">


    <div class="copyright-footer"> 
      © @php $admin_title = Voyager::setting('site.title'); echo (now()->year.' | '); print_r (' '. $admin_title) @endphp  
    </div>

  </footer>
  <!--/.Footer-->
  <!--Modal: modalPush-->
  <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info desv-modal" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="desv-header">
       <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    @if(Auth::check())


    <div class="modal-body">
      <div class="text-center">
        <span class="modal-title">WELCOME, {{ Auth::user()->name}}</span>
      </div>
          @if  (\Session::has('success'))
          <div class="alert" id="message" value="open" role="alert" style="display: none">
       {!! \Session::get('success') !!}
          </div>
          @endif
       
      <div class="container">
       <div class="login_main">
        @if($cart_number!=0)
      <div class="modal_bubble" value ="{{$cart_number}}" >{{$cart_number}}</div>
      @else
        <div class="modal_bubble" style="display: none">{{$cart_number}}</div>
      @endif
         <div class="member_button d-flex justify-content-center">
          <a class="btn member-btn d-flex justify-content-center" href="shopping_cart"><p> <i class="fa fa-shopping-cart member-icon mr-3" aria-hidden="true"></i> MY SHOPPING CART</p></a>
        </div>
        @if($order_number!=0)
         <div class="modal_bubble_2">{{$order_number}}</div>
               @endif
        <div class="member_button d-flex justify-content-center">
          <a class="btn member-btn d-flex justify-content-center" href="user_profile"><p> <i class="fa fa-user member-icon mr-3" aria-hidden="true"></i> PROFILE SETTINGS</p></a>
        </div>
     
        <div class="login_submit_button">
          <a class="btn logout-btn text-center" href="logout">@lang('frontend.logout')</a>
        </div>
      </div>

    </div>

  </div>

  @else          
  <!--Body-->
  <div class="modal-body">
    <div class="text-center">
      <span class="modal-title">MEMBERSHIP</span>
    </div>

    <div class="container">

      <ul id="myTab" class="nav nav-tabs">
        <li class="active modal-login modal-left" >
          <a href="#login-div" data-toggle="tab">@lang('frontend.login')</a>
        </li>
        <li  class="modal-login" ><a href="#register" data-toggle="tab">@lang('frontend.register')</a></li>
      </ul>

      <div id="myTabContent" class="tab-content">
        <div class="login_div tab-pane active" id="login-div">
          @if ($errors->any())
          @foreach($errors->all() as $message)
          <div class="alert alert-danger" id="message" value="open" role="alert">
            {{$message}}
          </div>
          @endforeach
          @endif
          {!! Form::open(array('action' => 'LoginController@login')) !!}
          @csrf

          <div class="login_main">

            <div class="input-login row">
              <div class="login_label col-5">
                <span>USERNAME</span> 
              </div>
              <div class="login_input col-7">
                <input class="text-center login_field" name="email" type="email"  required="true">
              </div>
            </div>

            <div class="input-login row"> 
              <div class="login_label col-5">
                <span>PASSWORD</span> 
              </div>
              <div class="login_input col-7">
                <input class="text-center login_field" name="password" type="password"  required="true">
              </div>
            </div>

            <div class="pull-right forget_pw_div">
              <a class="forget_pw" href="#forget_pw">Forgot Password</a>
            </div>

            <div class="login_remember pull-left">
              <input class="custom-control-input" type="radio" name="rememberRadios" id="rememberRadios1" value="1">
              <label class="custom-control-label" for="rememberRadios1">
                Remember Me
              </label>
            </div>
            <div class="login_submit_button">
             {{Form::submit('Login', ['class' => 'login-btn text-center'])}}
           </div>
         </div>

         {{ Form::close() }}
       </div>


       <div class="login_div tab-pane " id="register">
         @if ($errors->any())
          @foreach($errors->all() as $message)
          <div class="alert alert-danger" id="message" value="open" role="alert">
            {{$message}}
          </div>
          @endforeach
          @endif
           {!! Form::open(array('action' => 'LoginController@register')) !!}
           @csrf
        <div class="login_main">

                <div class="input-login row">
              <div class="login_label col-5">
                <span>NAME</span> 
              </div>
              <div class="login_input col-7">
                <input class="text-center login_field" name="name" type="text"  required="true">
              </div>
            </div>



              <div class="input-login row">
              <div class="login_label col-5">
                <span>EMAIL</span> 
              </div>
              <div class="login_input col-7">
                <input class="text-center login_field" name="email" type="email"  required="true">
              </div>
            </div>
            <div class="input-login row">
              <div class="login_label col-5">
                <span>MOBILE</span> 
              </div>
              <div class="login_input col-7">
                <input class="text-center login_field" name="mobile" type="text"  required="true">
              </div>
            </div>


            <div class="input-login row"> 
              <div class="login_label col-5">
                <span>PASSWORD</span> 
              </div>
              <div class="login_input col-7">
                <input class="text-center login_field" name="password" type="password"  required="true">
              </div>
            </div>
              
        
            </div>
            <div class="login_submit_button">
             {{Form::submit('Registration', ['class' => 'login-btn text-center'])}}
           </div>
         </div>

         {{ Form::close() }}
        </div>
      </div>

    </div>
  </div>


</div>
@endif
<!--Footer-->

</div>
<!--/.Content-->
</div>
</div>
<!--Modal: modalPush-->
<!-- Start your project here-->

<!-- /Start your project here-->

<!-- SCRIPTS -->
<!-- JQuery -->

<!-- Bootstrap tooltips -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script src="{{ asset('js/mdb.min.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/jquery.justifiedGallery.min.js') }}"></script>

<script src="{{ asset('js/jquery.colorbox.js') }}"></script>

<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

<script type="text/javascript">
  new WOW().init();
</script>


<script type="text/javascript">
  $('.carousel').carousel();
</script>

<script type="text/javascript">
  $alert_data = $("#message").html();
  console.log($alert_data);

  if($alert_data.length > 1){
   $('#LoginModal').modal('show');
 }
</script>

<script type="text/javascript">
  $(window).ready(setTimeout(loaderPage, 800));
  

  function loaderPage() {
    $(".colorlib-loader").fadeOut("show");
  };

  $('.title-close').on('click', function () {
    $('.nav-menu').addClass('nav-active');
     $('.nav-title').addClass('non-active');
   // $('.nav-title').css('display','none');
    $('.nav-toggle').addClass('nav-toggle-open').siblings();
    $('.nav-toggle').removeClass('title-close');

    $('.nav-toggle-open').on('click', function () {


     $('.nav-menu').addClass('non-active').siblings();
     $('.nav-menu').removeClass('nav-active');
      $('.nav-title').removeClass('non-active');
        $('.nav-title').addClass('nav-active');
    // $('.nav-title').css('display','flex');
     $('.nav-title').addClass('nav-active');
     $('.nav-toggle').addClass('title-close').siblings().removeClass('nav-toggle-open');


     $('.title-close').on('click', function () {

       $('.nav-menu').addClass('nav-active').siblings();
        $('.nav-menu').removeClass('non-active').siblings();
    
        $('.nav-title').addClass('non-active').siblings();
         $('.nav-title').removeClass('nav-active');

      $('.nav-toggle').addClass('nav-toggle-open').siblings();
      $('.nav-toggle').removeClass('title-close');


      $('.nav-toggle-open').on('click', function () {

      $('.nav-menu').addClass('non-active').siblings();
     $('.nav-menu').removeClass('nav-active');
      $('.nav-title').removeClass('non-active');
        $('.nav-title').addClass('nav-active');
    // $('.nav-title').css('display','flex');
     $('.nav-title').addClass('nav-active');
     $('.nav-toggle').addClass('title-close').siblings().removeClass('nav-toggle-open');

     $('.title-close').on('click', function () {

       $('.nav-menu').addClass('nav-active').siblings();
        $('.nav-menu').removeClass('non-active').siblings();
    
        $('.nav-title').addClass('non-active').siblings();
         $('.nav-title').removeClass('nav-active');

      $('.nav-toggle').addClass('nav-toggle-open').siblings();
      $('.nav-toggle').removeClass('title-close');

    });
     });
    });
   });
  });

  $('.mobile-nav-toggle').on('click', function () {
   $('.nav-menu').addClass('non-active').siblings();
   $('.nav-menu').removeClass('nav-active');
   $('.nav-title').css('display','flex');
   $('.nav-title').addClass('nav-active');
   $('.nav-toggle').addClass('title-close').siblings().removeClass('nav-toggle-open');
 });
  
</script>
<script type="text/javascript">

  $('.myExMul').justifiedGallery({
   lastRow : 'nojustify', 
   rowHeight : 200, 
   rel : 'gallery',
   margins : 20
 }).on('jg.complete', function () {
  $(this).find('a').colorbox({
    maxWidth : '90%',
    maxHeight : '90%',
    opacity : 0.7 ,




  });
});

</script>

<script type="text/javascript">

  function fb_hover(element) {
    element.setAttribute('src', '/images/facebook_black.png');
  }

  function fb_unhover(element) {
    element.setAttribute('src', '/images/facebook.png');
  }

  function ig_hover(element) {
    element.setAttribute('src', '/images/instagram_black.png');
  }

  function ig_unhover(element) {
    element.setAttribute('src', '/images/instagram.png');
  }
  
   function pi_hover(element) {
    element.setAttribute('src', '/images/pinterest_black.png');
  }

  function pi_unhover(element) {
    element.setAttribute('src', '/images/pinterest.png');
  }
   function tw_hover(element) {
    element.setAttribute('src', '/images/twitter_black.png');
  }

  function tw_unhover(element) {
    element.setAttribute('src', '/images/twitter.png');
  }
</script>

</body>

</html>