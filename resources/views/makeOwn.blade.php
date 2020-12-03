@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.makeOwn'))


@section('main_page')



<main>
 <div class="container-fluid wow fadeIn makeOwn-page">
  <div class="row flex-column-reverse flex-md-row">
    <div class="col-md-6 offset-md-1">
      {!! Form::open(array('action'=>'HomeController@findOwn','method'=>'post','id'=>'regForm')) !!}
      <div class="tab active" data-id="len">
        <p class="step-title">Step 1 - Lenes</p>
        <br>

        <p class="step-options">OPTION A</p>
        @foreach($lens as $key=>$len)
        <div class="form-check step-radio">
         <input class="form-check-input" type="radio" name="lens_options" id="len" value={{$len->id}} >
         <label class="form-check-label" for="lens_options">
          {{$len->name_en}}
        </label>
      </div>
      @endforeach
    </div>
    <div class="tab" data-id="len_color">
      <p class="step-title">STEP 2 - Len Color</p>
      <br>

      <p class="step-options" id ="len_option_line">OPTION B</p>
      <div id="len_color_div">
      </div>
    </div>

    <div class="tab" data-id="frame">
      <p class="step-title">STEP 3 - Frames</p>
      <br>

      <p class="step-options">OPTION C</p>
      @foreach($frames as $key2=>$frame)
      <div class="form-check step-radio">
       <input class="form-check-input" type="radio" name="frame_options" id="frame" value={{$frame->id}} >
       <label class="form-check-label" for="frame_options">
        {{$frame->name_en}}
      </label>
    </div>
    @endforeach
  </div>

  <div style="overflow:auto;margin-top:30%;">
    <div style="float:left;">
      <button type="button" id="prevBtn" data-step="home" onclick="nextPrev(-1)"> < PREVIOUS STEP</button>
    </div>
    <div style="float:right;">
      <button type="button" id="nextBtn" data-step="len_color" onclick="nextPrev(1)"> <i class="fa fa-arrow-right mr-2"> </i> NEXT STEP</button>
    </div>
  </div>

  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>

  </div>

  {!!  Form::close() !!}
</div>
<div class="col-md-5 full-image">


  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="0" >

   <div class="carousel-inner">
     @php $i = 0 ;  @endphp
     @foreach($images as $key=>$type)
     @foreach($type as $key2=>$image)
     @if($i=='0')
     <div class="carousel-item active" id="{{$key}}_image_{{$image->id}}">
       <img src="{{ Voyager::image($image->image)}}" class="d-block step-image">      
     </div>
     @else
     <div class="carousel-item"   id="{{$key}}_image_{{$image->id}}">
      <img src="{{ Voyager::image($image->image)}}" class=" d-block step-image">
    </div> 
    @endif 
    @php $i++ ;  @endphp

    @endforeach
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

  $('input[type=radio]').on('change', function() {
    $image = '#'+$(this).attr('id')+'_image_'+$(this).val();
    $(".active").removeClass("active");
    $($image).addClass("active");

    $option = '';
    $type ='';
    $option = $(this).val();
    $type =  $(this).attr('id');

  });

  $('#nextBtn').on('click', function () { 
 $('#len_color_div').html('');
    var step = $(this).attr('data-step');

    if($type == 'len'){  
      console.log( $('#len_color_div'));
      $.ajax({
        type:'POST',
        url:'getLensColor',
        data:{'option':$option,'_token':'{{csrf_token()}}'},
        success:function(data){
          var  all_option =data;
          var  html = '';
          var image = ''; 
          $('#len_color_div').html('');
          if(all_option!=''){
           $.each(all_option, function(index) {

            html+='<div class="form-check step-radio ">';
            html+='<input class="form-check-input" type="radio" name="len_color_options" id="len_color" value='+all_option[index].id+' >';
            html+='<label class="form-check-label" for="frame_options"> '+all_option[index].color_name+' <div class="options_color" style="background-color:'+all_option[index].color+' "></div> </label>'  
            html+='</div>';   
            image+='<div class="carousel-item"   id="len_color_image_'+all_option[index].id+'">';
            var APP_URL = {!! json_encode(url('/')) !!}

            image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';

          });
           $('#len_color_div').append(html); 
           $('.carousel-inner').append(image); 

          $('input[type=radio]').on('change', function() {
            $image = '#'+$(this).attr('id')+'_image_'+$(this).val();
            $(".active").removeClass("active");
            $($image).addClass("active");
          });

         }else{
            html='<label> This Len with out any color options</label>';
            $('#len_color_div').append(html);         
         }
       }

     });
    }

  });

</script>



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




@endsection
