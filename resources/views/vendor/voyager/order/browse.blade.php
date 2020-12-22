@extends('voyager::master')
@section('page_title','Order')
@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
      Order
  </h1>
</div>
@stop

@section('content')

<div class="page-content browse container-fluid">
  <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">User</th>
           <th scope="col">Follow Up User</th>
            <th scope="col">Order Time</th>
          <th scope="col">Total Price</th>
          <th scope="col">Status</th>
          <th scope="col">Order</th>
          <th scope="col">Receipt</th>
          <th scope="col">Updated At</th>
      </tr>
  </thead>
  <tbody>

     @foreach($dataType as $key => $v)
     <tr>
      <th scope="row">{{$key}}</th>
      <td><a class="image-link" href="users/{{$v->user_id}}" target="_blank">{{$v->user_id}}</a> </td>
      @if($v->receipt_image!==null)
           <td><a class="image-link" href="users/{{$v->follow_up_user_id}}" target="_blank">{{$v->follow_up_user_id}}</a> </td>
           @else
  <td><label style="color:red">No One Follow</label></td>
@endif
        <td>{{$v->created_at}}</td>
      <td>${{$v->total_price}}</td>
      <td>{{$v->status}}</td>
      <td>
         @foreach($v->order_detail as $key2 => $product) 
        <ul>

          <li>Product : <a class="image-link" href="product/{{$product->product_id}}" target="_blank">{{$product->product->product_name_en}}</a> </li>
          <li>Unit Price : ${{$product->product->price}}</li>
           <li>Qty : {{$product->product_qty}}</li>
             <li>Total  : ${{$product->detail_price}}</li>
          <li>Code : {{$product->product->product_code}}</li>
            <li>Model : {{$product->model_name}}</li>
              <li>Model DC : {{$product->product->model_dc}}</li>
         
      </ul>
      <hr>
       @endforeach
  </td>
   <td> 
@if($v->receipt_image!==null)
    <a class="image-link" href="{{Voyager::image($v->receipt_image)}}" target="_blank">Open Receipt</a>

@else
<label style="color:red">No receipt</label>
@endif
</td>
   <td>{{$v->updated_at}}</td>
</tr>

@endforeach
</tbody>
</table>
</div>
@stop
<script type="text/javascript">
      $(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>