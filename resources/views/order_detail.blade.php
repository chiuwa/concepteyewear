
@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.order_detail'))


@section('main_page')



<main>
  <div class="container wow fadeIn">

   <a href="{{ route('order') }}" class="btn btn-dark">
    <span ><< &nbsp; Back To Orders </span>
  </a>
  <br><br>

  <p>Last Update Time :{{$order->updated_at}} </p>


  <p>Order Time :{{$order->created_at}} </p>


  <p>Order Status :<b>{{$order->status}}</b> </p>


  <td >
    <hr>
    <table style="width: 100%">
      <tr style="height: 50px;">
        <td class="FieldLabel2">
         Product 
       </td> 
       <td class="FieldLabel2" >
        Unit Price
      </td> 
      <td class="FieldLabel2" >
        Qty
      </td> 
      <td class="FieldLabel2" >
        Model
      </td> 
    </tr>
    @foreach($order->order_detail as $key => $product) 
    <tr style="height: 50px;">
      <td class="FieldLabel2">
       <a class="enquire_link" id="product" data-id="{{$product->product->id}}" data-toggle="modal" data-target="#ProductModal"> {{$product->product->product_name}} </a>
     </td> 
     <td class="FieldLabel2" >
       ${{$product->product->price}}
     </td> 
     <td class="FieldLabel2" >
      {{$product->product_qty}}
    </td> 
    <td class="FieldLabel2" >
      <li>{{$product->model_name}}</li>
      <li>{{$product->product->model_dc}}</li>
    </td> 
  </tr>
  @endforeach
</table>
</td>

<td >
  <table style="float: right" 
  class="RightAlignedInputs">
  <tr style="height: 50px;">
    <td class="FieldLabel2">
      Total
    </td> 
  </tr>

  @foreach($order->order_detail as $key => $product) 
  <tr style="height: 50px;">
   <td class="FieldLabel2">
     ${{$product->detail_price}}
   </td> 
 </tr>
 @endforeach
</table>
</td>
</div>
</main>


<div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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



  <div class="modal-body">
    <div class="text-center">
      <span class="modal-title"></span>

    </div>

<br><br>

    <div class="container modal-container">


    </div>
  </div>
</div>
</div>
</div>


<script>

  $('#product').on('click', function () {
   $prop_id = $(this).data('id');
   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
   $.ajax({
    type:'POST',
    url: '{{ route('productView') }}',
    data:{'product_id':$prop_id,'_token':'{{csrf_token()}}'},
    dataType: 'json',
    success:function(data){
      $('.modal-title').text('');
      $('.modal-title').text(data.product_name);
      var APP_URL = {!! json_encode(url('/')) !!}
      $html = '';
      $html += '<div class="col-6"><div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" > <div class="carousel-inner">';
      $html += ' <div class="carousel-item active" id="product_image_1">';
      $html += '<img src="'+APP_URL+'/storage/'+data.len_color_image+'"  class="d-block step-image"> </div>';  
      $html += ' <div class="carousel-item " id="product_image_2">';
      $html += '<img src="'+APP_URL+'/storage/'+data.frames_color_image+'"  class="d-block step-image"> </div>';  
      $html += ' <div class="carousel-item " id="product_image_3">';
      $html += '<img src="'+APP_URL+'/storage/'+data.temples_color_image+'"  class="d-block step-image"> </div>';  
      if(data.product_image_1!=''){
        $html += ' <div class="carousel-item " id="product_image_4">';
      $html += '<img src="'+APP_URL+'/storage/'+data.product_image_1+'"  class="d-block step-image"> </div>';  
      }
        if(data.product_image_2!=''){
        $html += ' <div class="carousel-item " id="product_image_5">';
      $html += '<img src="'+APP_URL+'/storage/'+data.product_image_2+'"  class="d-block step-image"> </div>';  
      }
        if(data.product_image_3!=''){
        $html += ' <div class="carousel-item " id="product_image_6">';
      $html += '<img src="'+APP_URL+'/storage/'+data.product_image_3+'"  class="d-block step-image"> </div>';  
      }

      $html += '</div></div></div>';   
      $('.modal-container').html('');
      $('.modal-container').append($html); 
      $('.carousel').carousel();
      console.log(data.product_name);
    }

  });



 });

</script>
@endsection


