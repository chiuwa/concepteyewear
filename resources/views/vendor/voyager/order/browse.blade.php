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
          <th scope="col">Total Price</th>
          <th scope="col">Status</th>
          <th scope="col">Order</th>
          <th scope="col">Updated at</th>
      </tr>
  </thead>
  <tbody>

     @foreach($dataType as $key => $v)
     <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$v->user_id}}</td>
      <td>{{$v->total_price}}</td>
      <td>{{$v->status}}</td>
      <td>
         @foreach($v->order_detail as $key2 => $product) 
        <ul>

          <li>Product : {{$product->product->product_name_en}}</li>
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
   <td>{{$v->updated_at}}</td>
</tr>

@endforeach
</tbody>
</table>
</div>
@stop