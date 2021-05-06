
@extends('layouts.app')
@section('title',setting('site.title') ." | Order Detail")


@section('main_page')



<main>
  <div class="container wow fadeIn">

   <a href="{{ route('order') }}" class="btn btn-dark">
    <span ><< &nbsp; Back To Orders </span>
  </a>
@if($order->receipt_image!=null)
  <a class="btn btn-info"  data-toggle="modal" data-target="#ReceiptModal">Receipt </a>
  @endif
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

    <td class="FieldLabel2">
      Total
    </td> 
  
    </tr>
    @foreach($order->order_detail as $key => $product) 
    <tr style="height: 50px;">
      <td class="FieldLabel2">
       <a class="enquire_link product_class" id="product" data-id="{{$product->product->id}}" data-toggle="modal" data-target="#ProductModal"> {{$product->product->product_name}} </a>
     </td> 
     <td class="FieldLabel2" >
       ${{$product->product->price}}
     </td> 
     <td class="FieldLabel2" >
      {{$product->product_qty}}
    </td> 
    <td class="FieldLabel2" >
      <li>{{$product->model_name}}</li>
      <li>{{$product->model_dc}}</li>
    </td> 
    <td class="FieldLabel2">
     ${{$product->detail_price}}
   </td> 
  </tr>
  @endforeach
</table>
</td>

<td >

</td>
</div>
</main>


<div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-notify modal-info product-modal" role="document">
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
      <span class="modal-title_1"></span>

    </div>

    <br><br>

    <div class="container modal-container">


    </div>
  </div>
</div>
</div>
</div>


<div class="modal fade" id="ReceiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-notify modal-info product-modal" role="document">
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
      <span class="modal-title">Receipt</span>
      <img src="{{ Voyager::image($order->receipt_image)}}" class="d-block" style="width: 100%">
    </div>

    <br><br>

    <div class="container">


    </div>
  </div>
</div>
</div>
</div>

<script>

  $('.product_class').on('click', function () {
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

      if(data==null){
        console.log('no data');
      $('.modal-container').html('');
      $('.modal-container').append('This Product Without Perview'); 
      return false;
      }
      var APP_URL = {!! json_encode(url('/')) !!}
      $html = '';
      $html += '<div class="row"><div class="col-md-6"><div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" > <div class="carousel-inner">';
            if(data.len_color_image!=null){
      $html += ' <div class="carousel-item active" id="product_image_1">';
      $html += '<img src="'+APP_URL+'/storage/'+data.len_color_image+'"  class="d-block step-image"> </div>';  
    }
             if(data.frames_color_image!=null){
      $html += ' <div class="carousel-item " id="product_image_2">';
      $html += '<img src="'+APP_URL+'/storage/'+data.frames_color_image+'"  class="d-block step-image"> </div>';  
    }
    if(data.temples_color_image!=null){
      $html += ' <div class="carousel-item " id="product_image_3">';
      $html += '<img src="'+APP_URL+'/storage/'+data.temples_color_image+'"  class="d-block step-image"> </div>';  
    }
      if(data.product_image_1!=null){
        $html += ' <div class="carousel-item " id="product_image_4">';
        $html += '<img src="'+APP_URL+'/storage/'+data.product_image_1+'"  class="d-block step-image"> </div>';  
      }
      if(data.product_image_2!=null){
        $html += ' <div class="carousel-item " id="product_image_5">';
        $html += '<img src="'+APP_URL+'/storage/'+data.product_image_2+'"  class="d-block step-image"> </div>';  
      }
      if(data.product_image_3!=null){
        $html += ' <div class="carousel-item " id="product_image_6">';
        $html += '<img src="'+APP_URL+'/storage/'+data.product_image_3+'"  class="d-block step-image"> </div>';  
      }

      $html += '</div></div></div>';   
      $html += '<div class="col-md-6"><div calss="row flex-md-row">  <div class="col-md-6 own-poduct-title"><p>'+data.product_name_en+'</p></div>';
      $html += '<div class="col-md-6 "><p>'+data.product_code+'</p></div>';
      $html += '<div class="col-md-6 "><p>US $ <b>'+data.price+'</b></p></div>';
      $html += ' <div class="col-md-6 "><ul><li>'+data.lens_name_en+' '+data.len_color_name+'<img src="'+APP_URL+'/storage/'+data.lens_color+'" class=" d-block step-image option_small_image"> </li><li>'+data.frames_name_en+' '+data.frames_color_name+'<img src="'+APP_URL+'/storage/'+data.frames_color+'" class=" d-block step-image option_small_image"> </li>  <li>'+data.temples_name_en+' '+data.temples_color_name+'<img src="'+APP_URL+'/storage/'+data.temples_color+'" class=" d-block step-image option_small_image"></li> </ul></div>';
      $html += '<div class="col-md-6 own-poduct-description ">'+data.description+'</div>';
      $html += '</div></div></div><br><br>';   
      $('.modal-container').html('');
      $('.modal-container').append($html); 
      $('.carousel').carousel();

    }

  });



 });

</script>
@endsection


