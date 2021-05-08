@extends('layouts.app')
@section('title',setting('site.title') ." | Make Own")


@section('main_page')



<main>
 <div class="container-fluid  makeOwn-page">
  <div class="row flex-column-reverse flex-md-row">
    <div class="col-md-6 offset-md-1 makeOwnleftside" >
      {!! Form::open(array('action'=>'HomeController@findOwn','method'=>'post','id'=>'regForm')) !!}
      <br>
      <a class="enquire_link" href="enquire">COULDN'T FIND WHAT YOU'RE LOOKING FOR?</a>
      <div class="tab" data-id="frame">
        <p class="step-title">STEP 1 - Frames</p>
        <br>
        <p class="step-options">OPTION A</p>
        @foreach($frames as $key2=>$frame)
        <div class="form-check step-radio frame_div" >
          @if($key2 == 0)
          <input class="form-check-input" type="radio" name="frame_options" id="frame" value={{$frame->id}} checked="checked" >
          @else
          <input class="form-check-input" type="radio" name="frame_options" id="frame" value={{$frame->id}}  >
          @endif

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
        <div  class="frame_color_div" id="frame_color_div">


        </div>
      </div>

  <!--div class="tab" data-id="temple">
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
</div-->
<div class="tab" data-id="temple_color">
  <p class="step-title">STEP 3 - Temple Color</p>
  <br>

  <p class="step-options" id ="temple_option_line">OPTION C</p>
  <div class="temple_color_div" id="temple_color_div">
  </div>
</div>
 <!--div class="tab active" data-id="len">
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
    </div-->
    <div class="tab" data-id="len_color">
      <p class="step-title">STEP 4 - Len Color</p>
      <br>

      <p class="step-options" id ="len_option_line">OPTION D</p>
      <div  class="len_color_div" id="len_color_div">
      </div>
    </div>
    <br><br>





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
<div class="col-md-6 makeOwnNext">
  <div>
    <button type="button" id="prevBtn"  onclick="nextPrev(-1)"> < PREVIOUS STEP</button>
  </div>
  </div>
<div class=" makeOwnNext">
  <div>
    <button type="button" id="nextBtn" onclick="nextPrev(1)"> <i class="fa fa-arrow-right mr-2"> </i> NEXT STEP</button>
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
  });
  // $('#prevBtn').on('click', function () {
  //   if($type =='len_color'){
  //     $type ='temple_color';
  //   }
  //   else if($type =='temple_color'){
  //     $type = 'frame_color';
  //   }
  //   else if($type =='frame_color'){
  //     $type = 'frame';
  //   }

  // });
  $('#nextBtn').on('click', function () { 

    if(typeof $type =='undefined' || $type =='frame'){

      $option =  $('.frame_div').find('input:checked').prop("checked", true).val();

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
            var i =0 ;
            $.each(all_option, function(index) {
             var APP_URL = {!! json_encode(url('/')) !!}
             html+='<div class="form-check step-radio ">';
             if(i == 0){
               html+='<input class="form-check-input" type="radio" name="frame_color_options" id="frame_color" value='+all_option[index].id+' checked="checked" >';
               html+='<label class="form-check-label" for="frame_color_options"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"> </div> </label>' ; 
               html+='</div>';   
               $(".active").removeClass("active");
               image+='<div class="carousel-item active"   id="frame_color_image_'+all_option[index].id+'">';
               image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image" ></div>';

             }else{
              html+='<input class="form-check-input" type="radio" name="frame_color_options" id="frame_color" value='+all_option[index].id+' >';
              html+='<label class="form-check-label" for="frame_color_options"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"> </div> </label>' ;
              html+='</div>';  
              image+='<div class="carousel-item"   id="frame_color_image_'+all_option[index].id+'">';
              image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';  
            }


            i = i +1;
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
              console.log($type);
            });

          }else{
            $('#frame_color_div').html('');
            html='<label> This Frame with out any color options</label>';
            $('#frame_color_div').append(html);         
          }
        },complete: function(index) {
          $type = 'frame_color';
  //         $('#prevBtn').on('click', function () {
  //           if($type =='len_color'){
  //             $type ='temple_color';
  //           }
  //           else if($type =='temple_color'){
  //             $type = 'frame_color';
  //           }
  //           else if($type =='frame_color'){
  //             $type = 'frame';
  //           }
  // console.log($type);
  //         });
},

});
    }

    if($type =='temple_color'){
     console.log($type);
     $.ajax({
      type:'POST',
      url:'getLensColor',
      data:{'_token':'{{csrf_token()}}'},
      success:function(data){
        var  all_option =data;
        var  html = '';
        var image = ''; 

        if(all_option!=''){
          $('#len_color_div').html('');
          var y =0 ;
          $.each(all_option, function(index) {

            var APP_URL = {!! json_encode(url('/')) !!}
            html+='<div class="form-check step-radio ">';
            if(y == 0){
              html+='<input class="form-check-input" type="radio" name="len_color_options" id="len_color" value='+all_option[index].id+'  checked="checked">';
              html+='<label class="form-check-label" for="len_color_options"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"></div> </label>'  ;
              html+='</div>'; 
              $(".active").removeClass("active");
              image+='<div class="carousel-item active"   id="len_color_image_'+all_option[index].id+'">';
              image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';
            }else{
             html+='<input class="form-check-input" type="radio" name="len_color_options" id="len_color" value='+all_option[index].id+' >';
             html+='<label class="form-check-label" for="len_color_options"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"></div> </label>'  ;
             html+='</div>'; 
             image+='<div class="carousel-item"   id="len_color_image_'+all_option[index].id+'">';
             image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';
           }  

           y = y +1;
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
      },complete: function(index) {
       $type = 'len_color';
  //       $('#prevBtn').on('click', function () {
  //         if($type =='len_color'){
  //           $type ='temple_color';
  //         }
  //         else if($type =='temples'){
  //           $type = 'frames_color';
  //         }
  //         else if($type =='frames_color'){
  //           $type = 'frame';
  //         }
  // console.log($type);
  //       });
},

});
   }
   if($type == 'frame_color'){
     console.log($type);
     $.ajax({
      type:'POST',
      url:'getTemplesColor',
      data:{'_token':'{{csrf_token()}}'},
      success:function(data){
        var  all_option = data;
        var  html = '';
        var image = ''; 

        if(all_option!=''){
         $('#temple_color_div').html('');
         var z =0 ;
         $.each(all_option, function(index) {
          var APP_URL = {!! json_encode(url('/')) !!}      
          html+='<div class="form-check step-radio ">';
          if(z == 0){
            html+='<input class="form-check-input" type="radio" name="temple_color_options" id="temple_color" value='+all_option[index].id+' checked="checked" >';
            html+='<label class="form-check-label" for="temple_color"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"></div> </label>'  ;
            html+='</div>'; 
            $(".active").removeClass("active");
            image+='<div class="carousel-item active"   id="temple_color_image_'+all_option[index].id+'">';
            image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';
          }else{
            html+='<input class="form-check-input" type="radio" name="temple_color_options" id="temple_color" value='+all_option[index].id+' >';
            html+='<label class="form-check-label" for="temple_color"> '+all_option[index].color_name+' <div class="options_image" ><img src="'+APP_URL+'/storage/'+all_option[index].color_image+'" class=" d-block step-image option_small_image"></div> </label>'  ;
            html+='</div>'; 
            image+='<div class="carousel-item"   id="temple_color_image_'+all_option[index].id+'">';
            image+='<img src="'+APP_URL+'/storage/'+all_option[index].image+'" class=" d-block step-image"></div>';
          }  

          z = z+1;
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
          console.log($type);
        });

       }else{
         $('#temple_color_div').html('');
         html='<label> This Temple with out any color options</label>';
         $('#temple_color_div').append(html);         
       }
     },complete: function(index) {
      $type = 'temple_color';
  //     $('#prevBtn').on('click', function () {
  //       if($type =='len_color'){
  //         $type ='temple_color';
  //       }
  //       else if($type =='temples'){
  //         $type = 'frames_color';
  //       }
  //       else if($type =='frames_color'){
  //         $type = 'frame';
  //       }
  // console.log($type);
  //     });
},

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


<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>

@endsection
