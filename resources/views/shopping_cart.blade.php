@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.shopping_cart'))


@section('main_page')



<main>
	<div class="container wow fadeIn ">
		@if(count($cart)>0)
		<div class="row flex-md-row cus-row">
			<div class="col-12  main_title_div">
				<span class="shopping-cart-title">MY SHOPPING CART</span>
			</div>


			<div class="col-4 item_count d-none d-block d-md-none">
				@php $item_count = count($cart); $all_price = 0 ; @endphp
				@if($item_count < 2)
				<p id="count_1" data-count="{{$item_count}}">{{$item_count}} Item</p>
				@else
				<p id="count_1" data-count="{{$item_count}}">{{$item_count}} Items</p>
				@endif
			</div>

			<div class="col-8 d-none d-block d-md-none ">
				<button class="btn item-clear pull-right" >Clear All</button>

			</div>

			<div class="col-md-12 d-none d-md-block">
				<div class="row flex-md-row cus-row">
					<div class="col-md-5">
						<p class="item_sm_title"> Item & Description</p>
					</div>

					<div class="col-md-2">

						<p class="item_sm_title"> Unit Price</p>
					</div>

					<div class="col-md-3 ">
						<p class="item_sm_title"> Order Qty</p>	
					</div>

					<div class="col-md-2">

						<p class="item_sm_title"> Totle</p>
					</div>
				</div>
			</div>

			@foreach($cart as $key=>$c)
			<div class="cart_item row" id="item_{{$c['id']}}">
				<div class="col-md-5">
					<div class="row">
						<div class="col-4 item_image">
							<img src="{{ Voyager::image($c['product_image'])}}" class="img-fluid center">  
						</div>
						<div class="col-8">
							<p class="item_name">{{ $c['product_name_en']}}</p>
							<p>{{ $c['description']}}</p>
						</div>
					</div>
				</div>

				<div class="col-md-2 col-3 item_other d-flex justify-content-center">

					<p>HKD${{ $c['price']}}</p>
				</div>

				<div class="col-md-3 col-6 item_other ">
					<div class="row">
						<div class="col-3">
							<div class="qty_icon add_qty" id="{{$c['id']}}" data-price="{{$c['price']}}">
								<i class="fa fa-plus" aria-hidden="true"></i>
							</div>
						</div>
						<div class="col-6  d-flex justify-content-center">
							<input type="text" id="qty_{{$c['id']}}" data-name="qty_{{$c['id']}}" data-price="{{$c['price']}}" data-id="{{$c['id']}}" class="item_qty" value="{{ $c['qty']}}">
						</div>
						<div class="col-3">
							<div class="qty_icon min_qty"  id="{{$c['id']}}" data-price="{{$c['price']}}">
								<i class="fa fa-minus" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
				@php $tot_price = $c['qty']* $c['price'] ; 
				$all_price = $all_price + $tot_price;
				@endphp
				<div class="col-md-2 col-3 d-flex justify-content-center item_other tot_price" data-price="{{$c['price']}}" id="tot_price_{{$c['id']}}">

					<p>HKD${{$tot_price}}</p>
				</div>
			</div>

			@endforeach

			<div class="col-md-5 d-none d-md-block">
				<button class="btn item-clear">Clear All</button>
			</div>
			<div class="col-md-3 item_count  d-none d-md-block">
				@php $item_count = count($cart); @endphp
				@if($item_count < 2)
				<p id="count_2" data-count="{{$item_count}}">{{$item_count}} Item</p>
				@else
				<p id="count_2" data-count="{{$item_count}}">{{$item_count}} Items</p>
				@endif
			</div>
			<div class="col-6 col-md-2 item_count">
				<p>Grand Total</p>
			</div>
			<div class="col-6 col-md-2 item_count">
				<p id="tital_price" class="pull-right">HKD${{$all_price}}</p>
			</div>

		</div>
		<div class="col-md-12 d-flex justify-content-center">
			<button type="button"  id="add-to-cart_2" > <i class="fa fa-shopping-cart mr-3" aria-hidden="true"></i> Check—Out</button>
		</div>
		<br>
		@else
<div class="row flex-md-row cus-row">
			<div class="col-12 no-item-title">
					<p>Couldn't Find What You're Looking For?</p>			
				</div>
				<div class="col-md-12 d-flex justify-content-center">
			<a href="makeOwn"  class="text-center" id="add-to-cart_2" > <i class="fa fa-arrow-right mr-3"></i> Make Your Own</a>
		</div>
			</div>	
		@endif
	</div>
</main>

<script type="text/javascript">
	
	$('.add_qty').on('click', function () {
		var item_id = $(this).attr('id'); 
		var item_qty = parseInt($('#qty_'+item_id).val(),10);
		var new_item_qty = item_qty+1; 
		var item_price = parseInt($(this).attr('data-price'),10); 
		var new_item_price = item_price*new_item_qty;
		$('#qty_'+item_id).val(new_item_qty);
		$('#tot_price_'+item_id).text('HKD$'+new_item_price);
		$('#tot_price_'+item_id).attr('data-price',new_item_price) ;
		var new_tot_price = 0 ;
		$(".cart_item").each(function(){
			var tot_price = parseInt($(this).find(".tot_price").attr('data-price'),10);
			new_tot_price = tot_price + new_tot_price;
		});
		$('#tital_price').text('HKD$'+new_tot_price);
	});


	$('.min_qty').on('click', function () {
		var item_id = $(this).attr('id'); 
		var item_qty = parseInt($('#qty_'+item_id).val(),10);
		var new_item_qty = item_qty-1; 
		if (new_item_qty < 1  ){
			$('#item_'+item_id).remove();
			var now_count_1 = parseInt($('#count_1').attr('data-count'),10);

			var now_count = now_count_1 - 1; 
			$('#count_1').attr('data-count',now_count) ;

			if(now_count > 1){
				$('#count_1').text(now_count+' Items');
				$('#count_2').text(now_count+' Items');
			}else{
				$('#count_1').text(now_count+' Item');
				$('#count_2').text(now_count+' Item');
			}
		}
		var item_price = parseInt($(this).attr('data-price'),10); 
		var new_item_price = item_price*new_item_qty;
		$('#qty_'+item_id).val(new_item_qty);
		$('#tot_price_'+item_id).text('HKD$'+new_item_price);
		$('#tot_price_'+item_id).attr('data-price',new_item_price) ;
		var new_tot_price = 0 ;
		$(".cart_item").each(function(){
			var tot_price = parseInt($(this).find(".tot_price").attr('data-price'),10);
			new_tot_price = tot_price + new_tot_price;
		});
		$('#tital_price').text('HKD$'+new_tot_price);

	});

	$('.item_qty').change(function() {
		var item_id = $(this).attr('data-id'); 
		var item_qty = parseInt($(this).val(),10);
		var item_price = parseInt($(this).attr('data-price'),10);
		var new_item_price = item_qty*item_price;
		$('#tot_price_'+item_id).text('HKD$'+new_item_price);
		$('#tot_price_'+item_id).attr('data-price',new_item_price) ;
		var new_tot_price = 0 ;
		$(".cart_item").each(function(){
			var tot_price = parseInt($(this).find(".tot_price").attr('data-price'),10);
			new_tot_price = tot_price + new_tot_price;
		});
		$('#tital_price').text('HKD$'+new_tot_price);
	});


	$('.item-clear').on('click', function () {

		if (confirm('Are you sure clear all product?')) {

			$.ajax({
				type:'POST',
				url:'clearAllItem',
				data:{'_token':'{{csrf_token()}}'},
				success:function(data){
					location.reload();
				}

			});
		} 

	});

</script>


@endsection
