@extends('voyager::master')

@section('page_title', __('voyager::generic.view'))
@section('page_header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<h1 class="page-title">


   <a href="{{ route('voyager.order.edit', $dataType->id) }}" class="btn btn-info">
    <span class="glyphicon glyphicon-pencil"> {{ __('voyager::generic.edit') }}</span>&nbsp;
</a>

<a href="{{ route('voyager.order.index') }}" class="btn btn-warning">
    <span class="glyphicon glyphicon-list"> {{ __('voyager::generic.index') }}</span>&nbsp;
</a>
<button id="cmd" class="btn btn-danger">generate PDF</button>
@if($dataType->receipt_image!==null)
<a  href="{{Voyager::image($dataType->receipt_image)}}" target="_blank" class="btn btn-dark"> 
    <span class=" glyphicon glyphicon-picture"> Receipt </span></a>

    @endif
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('content')

<style type="text/css">
    .FieldLabel
    {
        font-weight: bold;
        padding: 5px;

    }
    .FieldLabel2
    {
        font-weight: bold;
        padding: 5px;
        min-width: 50px;

    }
    .RightAlignedInputs input
    {
        text-align: right;
    }

    .center {
      margin: auto;
      border: 3px solid gainsboro;
      padding: 10px;
      margin-top:5%;
      width: 50%;
  }

  @media(max-width: 900px) {
    .center {
        width: 100% !important;
    }
}

</style>

<div id="content">
    <div  class="center" id="Orders_editForm1" style="background-color: #ffffff">
        <table   style="width: 100%" >
            <tr>
                <td valign="top">
                    <table>
                       <tr>
                        <td class="FieldLabel">
                            Oder ID:
                        </td>
                        <td>
                            <div class="FieldPlaceholder DataOnly" id="order_id" data-val="{{$dataType->id}}">
                               #{{$dataType->id}}</div>
                           </td>
                       </tr>
                       <tr>
                        <td class="FieldLabel">
                            Customer:
                        </td>
                        <td>
                            <div class="FieldPlaceholder DataOnly">
                               {{$dataType->customer->name}} # {{$dataType->user_id}}</div>
                           </td>
                       </tr>
                       <tr>
                        <td class="FieldLabel">
                            Employee:
                        </td>
                        <td>
                            <div class="FieldPlaceholder DataOnly">
                             @if($dataType->follow_up_user_id!==null)
                             {{$dataType->follow_up_user_id}}</div>
                             @else
                         N/A</div>
                         @endif
                     </td>
                 </tr>
                 <tr>
                    <td class="FieldLabel">
                        Order Date:
                    </td>
                    <td>
                        <div class="FieldPlaceholder DataOnly">
                          {{$dataType->created_at}}</div>
                      </td>
                  </tr>
                  <tr>
                    <td class="FieldLabel">
                        Last Update:
                    </td>
                    <td>
                        <div class="FieldPlaceholder DataOnly">
                            {{$dataType->updated_at}}</div></div>
                        </td>
                    </tr>

                </table>
            </td>
            <td valign="top">
                <table style="float: right" 
                class="RightAlignedInputs">
                <tr>
                    <td class="FieldLabel">
                        Address:
                    </td>
                    <td>
                        <div class="FieldPlaceholder DataOnly" 
                        style="float: right">
                        {{$dataType->customer->address}}</div>
                    </td>
                </tr>
                <tr>
                    <td class="FieldLabel">
                        Email:
                    </td>
                    <td>
                        <div class="FieldPlaceholder DataOnly" 
                        style="float: right">
                        {{$dataType->customer->email}}</div>
                    </td>
                </tr>
                <tr>
                    <td class="FieldLabel">
                        Mobile:
                    </td>
                    <td>
                        <div class="FieldPlaceholder DataOnly" 
                        style="float: right">
                        {{$dataType->customer->mobile}}</div>
                    </td>
                </tr>
                <tr>
                    <td class="FieldLabel">
                        Order Status:
                 </td>
                 <td>
                    <div class="FieldPlaceholder DataOnly" 
                    style="float: right">
                    {{$dataType->status}}</div></div>
                </td>
            </tr>
            <tr>

            </tr>
        </table>
    </td>
</tr>

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
  @foreach($dataType->order_detail as $key => $product) 
  <tr style="height: 50px;">
    <td class="FieldLabel2">
        {{$product->product->product_name}}
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

  @foreach($dataType->order_detail as $key => $product) 
  <tr style="height: 50px;">
   <td class="FieldLabel2">
       ${{$product->detail_price}}
   </td> 
</tr>
@endforeach
</table>
</td>




<tr>
    <td valign="bottom">
        <table>
            <tr>
                <td class="FieldLabel">

                </td>
                <td>
                    <div class="FieldPlaceholder DataOnly">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="FieldLabel">

                </td>
                <td>
                    <div class="FieldPlaceholder DataOnly">
                    </div>
                </td>
            </tr>
        </table>
    </td>
    <td align="right">
        <table style="margin-right: 4px;" 
        class="RightAlignedInputs">
        <tr>
            <td class="FieldLabel">
                Subtotal:
            </td>
            <td  align="right">
                <div class=" FieldPlaceholder DataOnly" 
                style="float: right">
                ${{$dataType->total_price}}</div>
            </td>
        </tr>
        <tr>
            <td class="FieldLabel">
                Freight:
            </td>
            <td align="right">
                <div class="FieldPlaceholder DataOnly " 
                style="float: right">
            N/A </div>
        </td>
        <tr>
           <td class="FieldLabel">
            Discount:
        </td>
        <td align="right">
            <div class="FieldPlaceholder DataOnly " 
            style="float: right">
        N/A </div>
    </td>

</tr>
<tr>
    <td class="FieldLabel">
        Total:
    </td>
    <td>
        <div class="FieldLabel FieldPlaceholder DataOnly" 
        style="float: right">
        ${{$dataType->total_price}}</div>
    </td>
</tr>
</table>
</td>
</tr>
</table>
</div>
</div>



<script type="text/javascript">


var pdf = new jsPDF('l', 'pt','a4');
$('#cmd').click(function () {
    var order_id = $('#order_id').attr('data-val');

 pdf.addHTML($('#Orders_editForm1')[0], function () {
     pdf.save(order_id+'_order.pdf');
 });

});
</script>
@stop
