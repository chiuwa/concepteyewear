
@extends('layouts.app')
@section('title',setting('site.title') ." | Orders" )


@section('main_page')



<main>
	<div class="container">
		

   <div class="row flex-md-row cus-row">
    <div class="profile-nav col-md-3">
      <div class="panel">
        <div class="user-heading round">

          <h1>{{$user->name}}</h1>
          <p>{{$user->email}}</p>
        </div>

        <ul class="nav nav-pills nav-stacked">
          <li ><a href="user_profile"> <i class="fa fa-user"></i>Profile</a></li>

          <li class="active"><a href="order"> <i class="fa fa-edit"></i> Order </a>  @if($order_number!=0)
           <span style="color:red;font-size: 10px;
           font-weight: 600;">({{$order_number}})</span>
         @endif</li>
       </ul>
     </div>
   </div>
   <div class="profile-info col-md-9">
    @foreach($order as $key=>$data)
    <div class="panel">

      <div class="panel-body bio-graph-info">
        <h1>Order {{$data->id}}  <a class="enquire_link" href="{{ route('order_detail', ['id' => $data->id]) }}" style="float:right;font-size: 1rem;color: #89817e;">Order Details >></a></h1>


        <div class="row flex-md-row cus-row">
          {!! Form::open(array('action'=>'HomeController@updateOrder','method'=>'post','enctype'=>'multipart/form-data')) !!}
          <div class="bio-row">
           <p>Last Update Time :{{$data->updated_at}} </p>
         </div>
         <div class="bio-row">
           <p>Order Time :{{$data->created_at}} </p>
         </div>
         <div class="bio-row">
           <p>Order Status :<b>{{$data->status}}</b> </p>
         </div>
         <div class="bio-row">
           <p>Contact Person :{{$data->follow_up_user_id}} </p>
         </div>

         <div class="bio-row full-bio-row">
           <p>Order Total Amount : <b>US ${{$data->total_price}} </b></p>
         </div>     

         <div class="bio-row full-bio-row">
           <p>Order Details :</p>
           @foreach($data->order_detail as $key2 => $product) 
           <ul>
            <li>Product : {{$product->product->product_name_en}}</a> </li>
            <li>Unit Price : ${{$product->product->price}}</li>
            <li>Qty : {{$product->product_qty}}</li>
            <li>Total  : ${{$product->detail_price}}</li>

            @if(($product->model_name)!='' || ($product->model_dc) !='')
            <li>Printing instructions:</li> 
            <ul>
              <li>Left Inner Temple : {{$product->model_name}}</li>
              <li>Right Inner temple : {{$product->model_dc}}</li>
            </ul>
            @endif
          </ul>
          @endforeach
        </div>    


        <div class="bio-row" style="display: none">
          <p><span>Order Num: </span> {!! Form::text('order_id', $data->id, array('class'=>'form_text user-input')) !!}</p>
        </div>
        @if($data->receipt_image == null)
        <div class="col-md-12 full-bio-row">
          <p>  <input class="receipt_upload" type="file" name="receipt_image"/ required> <br><span>Payment receipt upload(jpg ,png image only) </span></p>
        </div>

        <div>
          Our Bank Information:  <br>  <br>                                                               
          <label  class="order_back">A/C Name    : </label><label class="order_back_2">Concept Eyewear Manufacturer Ltd   </label>   <br>                                                                 
          <label  class="order_back">Bank Name   :  </label><label class="order_back_2">DBS Bank (Hong Kong)Ltd     </label>   <br>                                                                             
          <label  class="order_back">Bank Address: </label><label class="order_back_2">Unit 9-18,12/F,Miramar Tower,134 Nathan Road, <br>Tsimshatsui Kowloon,Hong Kong         </label>   <br>        


          <label  class="order_back">A/C No      : </label><label class="order_back_2">016-494-470092114.  </label>   <br>                                                                                
          <label  class="order_back">SWIFT       : </label><label class="order_back_2">DHBKHKHH   </label>   <br>               
        </div>
        <div class="col-md-6 submit_button pull-right">
          {{Form::submit('Upload Payment Receipt', ['class' => 'user_submit_button' ])}}
        </div>
        @else    
        <div>
          Our Bank Information:  <br>  <br>                                                               
          <label  class="order_back">A/C Name    : </label><label class="order_back_2">Concept Eyewear Manufacturer Ltd   </label>   <br>                                                                 
          <label  class="order_back">Bank Name   :  </label><label class="order_back_2">DBS Bank (Hong Kong)Ltd     </label>   <br>                                                                             
          <label  class="order_back">Bank Address: </label><label class="order_back_2">Unit 9-18,12/F,Miramar Tower,134 Nathan Road, <br>Tsimshatsui Kowloon,Hong Kong         </label>   <br>                                                                    

          <label  class="order_back">A/C No      : </label><label class="order_back_2">016-494-470092114.  </label>   <br>                                                                                
          <label  class="order_back">SWIFT       : </label><label class="order_back_2">DHBKHKHH   </label>   <br>               
        </div>
                     <!--div class="bio-row full-bio-row">
                      <p><span>Receipt : </span>   <img src="{{ Voyager::image($data->receipt_image)}}" class="d-block select-image">      </p>
                    </div-->
                    @endif

                    {!!  Form::close() !!}
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>


        </div>
      </main>




      @endsection


