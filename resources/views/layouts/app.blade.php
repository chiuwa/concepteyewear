<!DOCTYPE HTML>
<?php

use TCG\Voyager\Models\Setting;
use \App\Http\Controllers\HomeController; 
?>

<html>
   @php 
    $carousel  = HomeController::getCarousel(); 
  @endphp    
    <img rel="preload" style="display:none;" src={{ Voyager::image($carousel[0]->value) }} />   
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
      
  </head>

  <body>
 
      <div class="colorlib-loader"></div>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="https://mdbootstrap.com/material-design-for-bootstrap/" target="_blank">
          <!--strong>De. S&V</strong-->
              @php
              $admin_favicon = Voyager::setting('site.logo', '');
              @endphp
              @if($admin_favicon !== '')
              <img  class="logo_class" src="{{ Voyager::image($admin_favicon) }}" type="image/png" responsive alt="Home" width="80" height="80">
              @endif
         
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">HOME
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://mdbootstrap.com/material-design-for-bootstrap/" target="_blank">MAKE Your Own</a>
            </li>
            <!--li class="nav-item">
              <a class="nav-link" href="https://mdbootstrap.com/getting-started/" target="_blank">Product</a>
            </li-->
            <li class="nav-item">
              <a class="nav-link" href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank">CONTACT US</a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">

            <li class="nav-item">
              <a href="https://www.facebook.com/mdbootstrap" class="nav-link" target="_blank">
             LOG IN
              </a>
            </li>
            <li class="nav-item">
              <a href="https://twitter.com/MDBootstrap" class="nav-link" target="_blank">
                <i class="fa fa-shopping-cart"></i> 
              </a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded" target="_blank">
             <i class="fa fa-user-circle"></i> GUEST
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

@yield('main_page')
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center font-small mt-4 wow fadeIn">

      <!--Call to action-->
      <div class="pt-4">
        <a class="btn btn-outline-white" href="https://mdbootstrap.com/getting-started/" target="_blank" role="button">Download MDB
          <i class="fa fa-download ml-2"></i>
        </a>
        <a class="btn btn-outline-white" href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank" role="button">Start free tutorial
          <i class="fa fa-graduation-cap ml-2"></i>
        </a>
      </div>
      <!--/.Call to action-->

      <hr class="my-4">

      <!-- Social icons -->
      <div class="pb-4">
        <a href="https://www.facebook.com/mdbootstrap" target="_blank">
          <i class="fa fa-facebook mr-3"></i>
        </a>

        <a href="https://twitter.com/MDBootstrap" target="_blank">
          <i class="fa fa-twitter mr-3"></i>
        </a>


        <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
          <i class="fa fa-google-plus mr-3"></i>
        </a>

        <a href="https://dribbble.com/mdbootstrap" target="_blank">
          <i class="fa fa-dribbble mr-3"></i>
        </a>

        <a href="https://pinterest.com/mdbootstrap" target="_blank">
          <i class="fa fa-pinterest mr-3"></i>
        </a>

        <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
          <i class="fa fa-github mr-3"></i>
        </a>

        <a href="http://codepen.io/mdbootstrap/" target="_blank">
          <i class="fa fa-codepen mr-3"></i>
        </a>
      </div>
      <!-- Social icons -->

      <!--Copyright-->
      <div class="footer-copyright py-3">
        &#xA9; 2018 Copyright:
        <a href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank"> MDBootstrap.com </a>
      </div>
      <!--/.Copyright-->

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



    <script type="text/javascript">
      new WOW().init();
    </script>


    <script type="text/javascript">
    function loaderPage() {
    $(".colorlib-loader").fadeOut("show");
    };
    $(window).ready(loaderPage);
    setTimeout(loaderPage, 20 * 1000);
    </script>

  </body>

</html>