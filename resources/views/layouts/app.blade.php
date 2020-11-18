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

  <link rel="stylesheet" href="{{ asset('css/justifiedGallery.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/colorbox.css') }}">

</head>
<body>
  <div class="colorlib-loader"></div>
  <div class="icon-bar">
    <div class="icon-backgroud">
      <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
    </div>
    <div class="icon-backgroud">
     <a href="#" class="instagram"><i class="fa fa-instagram"></i></a> 
   </div> 
 </div>


 <header id="header" class="fixed-top">
  <div class="container-fluid d-flex">

    <div class="d-flex">
     <button type="button" class="nav-toggle d-none d-lg-block title-close"><i class="fa fa-bars"></i></button>
     <button type="button" class="nav-member"  data-toggle="modal" data-target="#LoginModal" ><i class="fa fa-user-o"></i></button>
   </div>

 </div>

 <div class="nav-toggle-menu">
  <nav class="justify-content-center nav-title" style="display: flex;">
    <a href="home"><span style="color: #000000;">{{Voyager::setting('site.title')}}</span></a>
  </nav>
  <nav class="nav-menu d-flex justify-content-center non-active">
    <ul>
      <li class="active"><a href="home">Home</a></li>
      <li><a href="make-own">Make-Your-Own</a></li>
      <li><a href="lookbook">Lookbook</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="contact">Contact</a></li>
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
            <div class="alert alert-danger " role="alert">
              {{$message}}
            </div>
            @endforeach
            @endif
            {!! Form::open(array('action' => 'LoginController@login')) !!}

            <div class="login_main">

              <div class="input-login row">
                <div class="login_label col-5">
                  <span>USERNAME</span> 
                </div>
                <div class="login_input col-7">
                  <input class="text-center login_field" name="username" type="input"  required="true">
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
               {{Form::submit('LONIG', ['class' => 'login-btn text-center'])}}
             </div>
           </div>

           {{ Form::close() }}
         </div>


         <div class="login_div tab-pane " id="register">
          <div class="login_main text-center">
            <h5>Coming Soon</h5>
          </div>
        </div>

      </div>
    </div>
    

  </div>

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
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script src="{{ asset('js/mdb.min.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/jquery.justifiedGallery.min.js') }}"></script>

<script src="{{ asset('js/jquery.colorbox.js') }}"></script>

<script type="text/javascript">
  new WOW().init();
</script>


<script type="text/javascript">
  $('.carousel').carousel();
</script>

<script type="text/javascript">
  $(window).ready(setTimeout(loaderPage, 800));
  

  function loaderPage() {
    $(".colorlib-loader").fadeOut("show");
  };

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

</body>

</html>