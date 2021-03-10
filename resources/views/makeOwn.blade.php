@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.makeOwn'))


@section('main_page')



<main>
 <div class="container-fluid wow fadeIn makeOwn-page">
  <div class="row flex-column-reverse flex-md-row">
    <div class="col-md-6 offset-md-1">
      {!! Form::open(array('action'=>'HomeController@findOwn','method'=>'post','id'=>'regForm')) !!}
     

    <div class="tab" data-id="frame">
      <p class="step-title">STEP 1 - Frames</p>
      <br>

      <p class="step-options">OPTION A</p>
      @foreach($frames as $key2=>$frame)
      <div class="form-check step-radio">
       <input class="form-check-input" type="radio" name="frame_options" id="frame" value={{$frame->id}} >
       <label class="form-check-label" for="frame_options">
        {{$frame->name_en}}
        <img src="{{ Voyager::image($frame->image)}}" class="d-block select-image">      
      </label>
    </div>
  
    @endforeach
  </div>
  <div class="tab" data-id="frame_color">
    <p class="step-title">STEP 2 - Frame Color</p>
    <br>

    <p class="step-options" id ="frame_option_line">OPTION B</p>
    <div id="frame_color_div">

         
    </div>
  </div>

  <div class="tab" data-id="temple">
    <p class="step-title">STEP 3 - Temples</p>
    <br>

    <p class="step-options">OPTION C</p>
    @foreach($temples as $key2=>$temple)
    <div class="form-check step-radio">
     <input class="form-check-input" type="radio" name="temple_options" id="temple" value={{$temple->id}} >
     <label class="form-check-label" for="temple_options">
      {{$temple->name_en}}
      <img src="{{ Voyager::image($temple->image)}}" class="d-block select-image">      
    </label>
  </div>
  @endforeach
</div>
<div class="tab" data-id="temple_color">
  <p class="step-title">STEP 4 - Temple Color</p>
  <br>

  <p class="step-options" id ="temple_option_line">OPTION D</p>
  <div id="temple_color_div">
  </div>
</div>
 <div class="tab active" data-id="len">
        <p class="step-title">Step 5 - Lenes</p>
        <br>

        <p class="step-options">OPTION E</p>
        @foreach($lens as $key=>$len)
        <div class="form-check step-radio">
         <input class="form-check-input" type="radio" name="lens_options" id="len" value={{$len->id}} >
         <label class="form-check-label" for="lens_options">
          {{$len->name_en}}

          <img src="{{ Voyager::image($len->image)}}" class="d-block select-image">      

        </label>
      </div>
      @endforeach
    </div>
    <div class="tab" data-id="len_color">
      <p class="step-title">STEP 6 - Len Color</p>
      <br>

      <p class="step-options" id ="len_option_line">OPTION F</p>
      <div id="len_color_div">
      </div>
    </div>
    <br><br>
<div style="margin-top:30%;">
  <div style="float:left;margin-bottom:10%;">
    <button type="button" id="prevBtn"  onclick="nextPrev(-1)"> < PREVIOUS STEP</button>
  </div>
  <div style="float:right;margin-bottom:10%;">
    <button type="button" id="nextBtn" onclick="nextPrev(1)"> <i class="fa fa-arrow-right mr-2"> </i> NEXT STEP</button>
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


  <div id="carouselExampleIndicators" class="carousel slide make-slide" data-ride="carousel" data-interval="99999">

   <div class="carousel-inner">
     @php $i = 0 ;  @endphp
     @foreach($images as $key=>$type)
     @foreach($type as $key2=>$image)
     @if($i=='0')
     <div class="carousel-item active" id="{{$key}}_image_{{$image->id}}">
       <img src="{{ Voyager::image($image->image)}}" class="d-block step-image">      
     </div>
     @else
     <div class="carousel-item"  id="{{$key}}_image_{{$image->id}}">
      <img src="{{ Voyager::image($image->image)}}" class=" d-block step-image">
    </div> 
    @endif 
    @php $i++ ;  @endphp

    @endforeach
    @endforeach
  </div>

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
    console.log($type);
 console.log($option);
  });

  $('#nextBtn').on('click', function () { 
  

   if($type == 'len'){  

    $.ajax({
      type:'POST',
      url:'getLensColor',
      data:{'option':$option,'_token':'{{csrf_token()}}'},
      success:function(data){
        var  all_option =data;
        var  html = '';
        var image = ''; 

        if(all_option!=''){
          $('#len_color_div').html('');

         $.each(all_option, function(index) {
        var APP_URL = {!! json_encode(url('/')) !!}
          html+='<div class="form-check step-radio ">';
          html+='<input class="form-check-input" type="radio" name="len_color_options" id="len_color" value='+all_option[index].id+' >';
          html+='<label class="form-check-label" for="len_color_options"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"></div> </label>'  ;
          html+='</div>';   
          image+='<div class="carousel-item"   id="len_color_image_'+all_option[index].id+'">';


          image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';

        });
         $('#len_color_div').append(html); 
         $('.carousel-inner').append(image); 

         $('input[type=radio]').on('change', function() {
          $image = '#'+$(this).attr('id')+'_image_'+$(this).val();
          $(".active").removeClass("active");
          $($image).addClass("active");
           $option = '';
            $type ='';
            $option = $(this).val();
            $type =  $(this).attr('id');
        });

       }else{
                $('#len_color_div').html('');
        html='<label> This Len with out any color options</label>';
        $('#len_color_div').append(html);         
      }
    }

  });

  }
  if($type == 'frame'){

    $.ajax({
      type:'POST',
      url:'getFramesColor',
      data:{'option':$option,'_token':'{{csrf_token()}}'},
      success:function(data){
        var  all_option =data;
        var  html = '';
        var image = ''; 

        if(all_option!=''){
          $('#frame_color_div').html('');
         
         $.each(all_option, function(index) {
           var APP_URL = {!! json_encode(url('/')) !!}
          html+='<div class="form-check step-radio ">';
          html+='<input class="form-check-input" type="radio" name="frame_color_options" id="frame_color" value='+all_option[index].id+' >';
          html+='<label class="form-check-label" for="frame_color_options"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"> </div> </label>' ; 
          html+='</div>';   
          image+='<div class="carousel-item"   id="frame_color_image_'+all_option[index].id+'">';


          image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';

        });
         $('#frame_color_div').append(html); 
         $('.carousel-inner').append(image); 

         $('input[type=radio]').on('change', function() {
          $image = '#'+$(this).attr('id')+'_image_'+$(this).val();
          $(".active").removeClass("active");
          $($image).addClass("active");
           $option = '';
            $type ='';
            $option = $(this).val();
            $type =  $(this).attr('id');
        });

       }else{
                $('#frame_color_div').html('');
        html='<label> This Frame with out any color options</label>';
        $('#frame_color_div').append(html);         
      }
    }

  });
  }


  if($type == 'temple'){
    console.log($type);
    console.log($option);
    $.ajax({
      type:'POST',
      url:'getTemplesColor',
      data:{'option':$option,'_token':'{{csrf_token()}}'},
      success:function(data){
        var  all_option = data;
        var  html = '';
        var image = ''; 
       
        if(all_option!=''){
         $('#temple_color_div').html('');

         $.each(all_option, function(index) {
                 var APP_URL = {!! json_encode(url('/')) !!}      
          html+='<div class="form-check step-radio ">';
          html+='<input class="form-check-input" type="radio" name="temple_color_options" id="temple_color" value='+all_option[index].id+' >';
          html+='<label class="form-check-label" for="temple_color"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"></div> </label>'  ;
          html+='</div>';   
          image+='<div class="carousel-item"   id="temple_color_image_'+all_option[index].id+'">';
         

          image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';

        });
         $('#temple_color_div').append(html); 
         $('.carousel-inner').append(image); 

         $('input[type=radio]').on('change', function() {
          $image = '#'+$(this).attr('id')+'_image_'+$(this).val();
          $(".active").removeClass("active");
          $($image).addClass("active");
             $option = '';
            $type ='';
            $option = $(this).val();
            $type =  $(this).attr('id');
        });

       }else{
         $('#temple_color_div').html('');
        html='<label> This Temple with out any color options</label>';
        $('#temple_color_div').append(html);         
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

 // fixStepIndicator(n)
}

function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
 // if (n == 1 && !validateForm()) return false;
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
