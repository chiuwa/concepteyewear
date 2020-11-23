@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.makeOwn'))


@section('main_page')



<main>
 <div class="container-fluid wow fadeIn makeOwn-page">
<div class="row flex-column-reverse flex-md-row">
    <div class="col-md-6 offset-md-1">
        <form id="regForm" action="">

        	<div class="tab active">
        		<p class="step-title">STEP 1 - LENS</p>
        		<br>

        		<p class="step-options">OPTION A</p>
        		@foreach($lens as $key=>$len)
        		<div class="form-check step-radio">
        			<input class="form-check-input" type="radio" name="lens_options" id="lens_options" value={{$len->id}} >
        			<label class="form-check-label" for="lens_options">
        				{{$len->name_en}}
        			</label>
        		</div>
        		@endforeach
        	</div>

        	<div class="tab ">
        		<p class="step-title">STEP 2 - Frames</p>
        		<br>

        		<p class="step-options">OPTION B</p>
        		@foreach($lens as $key=>$len)
        		<div class="form-check step-radio">
        			<input class="form-check-input" type="radio" name="lens_options" id="lens_options" value={{$len->id}} >
        			<label class="form-check-label" for="lens_options">
        				{{$len->name_en}}
        			</label>
        		</div>
        		@endforeach
        	</div>

<div style="overflow:auto;margin-top:30%;">
  <div style="float:left;">
    <button type="button" id="prevBtn" onclick="nextPrev(-1)"> < PREVIOUS STEP</button>
      </div>
       <div style="float:right;">
    <button type="button" id="nextBtn" onclick="nextPrev(1)"> <i class="fa fa-arrow-right mr-2"> </i> NEXT STEP</button>
  </div>
</div>

<!-- Circles which indicates the steps of the form: -->
<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>

</div>
        </form>
    </div>
  <div class="col-md-5 full-image">


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="0" >
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
  	  	  @foreach($lens as $key=>$len)
         @if($key=='0')
        <div class="carousel-item active" id="len_image_{{$len->id}}">
         <img src="{{ Voyager::image($len->image)}}" class="d-block step-image">      
       </div>
       @else
       <div class="carousel-item"   id="len_image_{{$len->id}}">
        <img src="{{ Voyager::image($len->image)}}" class=" d-block step-image">
      </div>    
      @endif 
    @endforeach
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
</div>
      </div>
</main>

<script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "<i class='fa fa-arrow-right mr-2'> </i>SEE CUSTOM-MADE RESULTS";
  } else {
    document.getElementById("nextBtn").innerHTML = "<i class='fa fa-arrow-right mr-2'> </i> NEXT STEP";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>


<script>


$('input[type=radio][name=lens_options]').on('change', function() {
	$len_image = '#len_image_'+$(this).val();
	 $(".active").removeClass("active");
	  $($len_image).addClass("active");
	  console.log($len_image);

});
</script>

@endsection
