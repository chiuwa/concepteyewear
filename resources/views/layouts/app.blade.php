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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
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

  </head>

  <body>
 
<div class="icon-bar">
  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>  
</div>
<div class="icon-bar-2">
 <a href="#" class="instagram"><i class="fa fa-instagram"></i></a> 
</div>

  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex">

      <div class="d-flex">
       <button type="button" class="nav-toggle d-none d-lg-block title-close"><i class="fa fa-bars"></i></button>
         <button type="button" class="nav-member"><i class="fa fa-user-o"></i></button>
     </div>

 </div>

      <div class="nav-toggle-menu">
      <nav class="justify-content-center nav-title" style="display: flex;">
        <span><b>@yield('title')</b></span>
      </nav>
      <nav class="nav-menu d-flex justify-content-center non-active">
        <ul>
          <li class="active"><a href="index.htm">Home</a></li>
          <li><a href="#make-own">Make-Your-Own</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
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

    <footer class="mt-4 footer fadeIn">


    <div class="copyright-footer"> 
      © @php $admin_title = Voyager::setting('site.title'); echo (now()->year.' | '); print_r (' '. $admin_title) @endphp  
      </div>

    </footer>
    <!--/.Footer-->

    <!-- Start your project here-->

    <!-- /Start your project here-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script src="{{ asset('js/mdb.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript">
      new WOW().init();
    </script>


<script type="text/javascript">
  
  $('.carousel').carousel();
</script>

    <script type="text/javascript">

    function loaderPage() {
    $(".colorlib-loader").fadeOut("show");
    };


    $(window).ready(loaderPage);
    setTimeout(loaderPage, 20 * 1000);


    $('.title-close').on('click', function () {
      $('.nav-menu').addClass('nav-active').siblings().removeClass('non-active');
      $('.nav-title').css('display','none');
      $('.nav-toggle').addClass('nav-toggle-open').siblings();
      $('.nav-toggle').removeClass('title-close');

      $('.nav-toggle-open').on('click', function () {
       $('.nav-menu').addClass('non-active').siblings();
       $('.nav-menu').removeClass('nav-active');
       $('.nav-title').css('display','flex');
       $('.nav-title').addClass('nav-active');
       $('.nav-toggle').addClass('title-close').siblings().removeClass('nav-toggle-open');

       $('.title-close').on('click', function () {
        $('.nav-menu').addClass('nav-active').siblings().removeClass('non-active');
        $('.nav-title').css('display','none');
        $('.nav-toggle').addClass('nav-toggle-open').siblings();
        $('.nav-toggle').removeClass('title-close');

        $('.nav-toggle-open').on('click', function () {
         $('.nav-menu').addClass('non-active').siblings();
         $('.nav-menu').removeClass('nav-active');
         $('.nav-title').css('display','flex');
         $('.nav-toggle').addClass('title-close').siblings().removeClass('nav-toggle-open');
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

  </body>

</html>