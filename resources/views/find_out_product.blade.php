@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.find_out_product'))


@section('main_page')



<main>
	<div class="container wow fadeIn">
		<div class="row flex-md-row">
		
			@if (isset($data[0]))

			@php $your_product = $data[0];@endphp

			<div class="col-md-6 full-image">

				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  >
					<ol class="carousel-indicators">

						<li data-target="#carouselExampleIndicators" data-slide-to=0 class="active"></li>

						<li data-target="#carouselExampleIndicators" data-slide-to=1></li>

						<li data-target="#carouselExampleIndicators" data-slide-to=2></li>

					</ol>

					<div class="carousel-inner">
						@if($your_product->product_image_1!==null)
						<div class="carousel-item active" id="product_image_1">
							<img src="{{ Voyager::image($your_product->product_image_1)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_2">
							<img  src="{{ Voyager::image($your_product->product_image_2)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_3">
							<img  src="{{ Voyager::image($your_product->product_image_3)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_4">
							<img src="{{ Voyager::image($your_product->len_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_5">
							<img  src="{{ Voyager::image($your_product->frames_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_6">
							<img  src="{{ Voyager::image($your_product->temples_color_image)}}" class="d-block step-image">      
						</div>

						@else
							<div class="carousel-item active" id="product_image_1">
							<img src="{{ Voyager::image($your_product->len_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_2">
							<img  src="{{ Voyager::image($your_product->frames_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" id="product_image_3">
							<img  src="{{ Voyager::image($your_product->temples_color_image)}}" class="d-block step-image">      
						</div>


						@endif
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

				<div id="slider">
						@if($your_product->product_image_1!==null)
					<img class="thumbnail active" id="1"src="{{ Voyager::image($your_product->product_image_1)}}">
					<img class="thumbnail" id="2" src="{{ Voyager::image($your_product->product_image_2)}}">
					<img class="thumbnail" id="3" src="{{ Voyager::image($your_product->product_image_3)}}">	
					<img class="thumbnail" id="4"src="{{ Voyager::image($your_product->len_color_image)}}">
					<img class="thumbnail" id="5" src="{{ Voyager::image($your_product->frames_color_image)}}">
					<img class="thumbnail" id="6" src="{{ Voyager::image($your_product->temples_color_image)}}">	
						@else	
					<img class="thumbnail active" id="1"src="{{ Voyager::image($your_product->len_color_image)}}">
					<img class="thumbnail" id="2" src="{{ Voyager::image($your_product->frames_color_image)}}">
					<img class="thumbnail" id="3" src="{{ Voyager::image($your_product->temples_color_image)}}">	
						@endif			
				</div>
			</div>
			<div class="col-md-6">
				<div calss="row flex-md-row">
					<div class="col-12 own-poduct-title">
						<p>
							{{$your_product->product_name_en}}
						</p>
					</div>
					<div class="col-12 own-poduct-code">
						<p>
							( {{$your_product->product_code}} )
						</p>
					</div>
					<div class="col-12 own-poduct-money">
						<p>
							USD${{$your_product->price}}
						</p>
					</div>
					
			
					<div class="col-12 ">
						<ul>
							<li>
								{{$your_product->lens_name_en}} ({{$your_product->len_color_name}})
							<img src="{{ Voyager::image($your_product->lens_color)}}" class=" d-block step-image option_small_image">
					
							</li>	
							<li>
								{{$your_product->frames_name_en}}({{$your_product->frames_color_name}})
							<img src="{{ Voyager::image($your_product->frames_color)}}" class=" d-block step-image option_small_image">

							</li>

							<li>
								{{$your_product->temples_name_en}}({{$your_product->temples_color_name}})
							<img src="{{ Voyager::image($your_product->temples_color)}}" class=" d-block step-image option_small_image">
								

							</li>								
						</ul>
					</div>
					<div class="col-12 own-poduct-description ">

							{!! $your_product->description !!}
				
					</div>
					<div class="col-12 own-poduct-add-cart find-image">
						@if($your_product->product_image_1!==null)
						<img src="{{Voyager::image($your_product->product_image_1)}}" alt="item" style="display: none;" />
						@else
						<img src="{{Voyager::image($your_product->len_color_image)}}" alt="item" style="display: none;" />
						@endif
						@if(Auth::check())
						<button type="button" id="add-to-cart"  class="addtocart"  data-id="{{$your_product->id}}" data-image="{{Voyager::image($your_product->product_image_1)}}"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> ADD TO CART</button>
						@else
						<button type="button" id="add-to-cart" class="check_login"  data-image="{{Voyager::image($your_product->product_image_1)}}"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> ADD TO CART</button>
						@endif
					</div>
				</div>
			</div>
			@if (isset($data[1]))
			<div class="row flex-md-row other-product">
				<div class="col-md-12 may-like-title">
					<p>You may also like...</p>			
				</div>
				@if (isset($data[1]))
				@php $other_1=($data[1]); @endphp
				<div class="col-md-4 card find-image">

				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  >
					<div class="carousel-inner">
						@if($other_1->product_image_1!==null)
						<div class="carousel-item active">
							<img src="{{ Voyager::image($other_1->product_image_1)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item">
							<img  src="{{ Voyager::image($other_1->product_image_2)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" >
							<img  src="{{ Voyager::image($other_1->product_image_3)}}" class="d-block step-image">      
						</div>

						@else
							<div class="carousel-item active" >
							<img src="{{ Voyager::image($other_1->len_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" >
							<img  src="{{ Voyager::image($other_1->frames_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" >
							<img  src="{{ Voyager::image($other_1->temples_color_image)}}" class="d-block step-image">      
						</div>
						@endif
					</div>
				</div>
					<h5>{{$other_1->product_name_en}}</h5>
					<p class="price">HK${{$other_1->price}}</p>
	
					<div class="description">
						{!!$other_1->description!!}
					</div>
					@if($other_1->product_image_1!==null)
						<img src="{{Voyager::image($other_1->product_image_1)}}" alt="item" style="display: none;" />
						@else
						<img src="{{Voyager::image($other_1->len_color_image)}}" alt="item" style="display: none;" />
						@endif
					@if(Auth::check())
					<button class="addtocart"  data-id="{{$other_1->id}}">Add to Cart</button>
					@else
					<button class="check_login">Add to Cart</button>
					@endif
				</div>
				@endif 

				@if (isset($data[2]))
				@php $other_2=($data[2]); @endphp
				<div class="col-md-4 card find-image">
							<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  >
					<div class="carousel-inner">
						@if($other_1->product_image_1!==null)
						<div class="carousel-item active">
							<img src="{{ Voyager::image($other_2->product_image_1)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item">
							<img  src="{{ Voyager::image($other_2->product_image_2)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" >
							<img  src="{{ Voyager::image($other_2->product_image_3)}}" class="d-block step-image">      
						</div>

						@else
							<div class="carousel-item active" >
							<img src="{{ Voyager::image($other_2->len_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" >
							<img  src="{{ Voyager::image($other_2->frames_color_image)}}" class="d-block step-image">      
						</div>

						<div class="carousel-item" >
							<img  src="{{ Voyager::image($other_2->temples_color_image)}}" class="d-block step-image">      
						</div>
						@endif
					</div>
				</div>
					<h5>{{$other_2->product_name_en}}</h5>
					<p class="price">HK${{$other_2->price}}</p>
		
					<div class="description">{!!$other_2->description!!}</div>
							@if($other_2->product_image_1!==null)
						<img src="{{Voyager::image($other_2->product_image_1)}}" alt="item" style="display: none;" />
						@else
						<img src="{{Voyager::image($other_2->len_color_image)}}" alt="item" style="display: none;" />
						@endif
					@if(Auth::check())
					<button class="addtocart" data-id="{{$other_2->id}}">Add to Cart</button>
					@else
					<button class="check_login">Add to Cart</button>

					@endif
				</div>
				@endif 				
			</div>
			@endif 
			@else

			<div class="col-md-6">
				<div class="col-12 cant-find-title">
					<p>COULDN'T FIND WHAT YOU'RE LOOKING FOR?</p>			
				</div>	
				<div class="col-12">
					<p>Leave us a message.</p>
					{!! Form::open(array('action' => 'HomeController@asking')) !!}

					<div class="col-md-12">    

						<div class="form-check form-check-inline title_redio">
							<input class="form-check-input" type="radio" name="title" id="title" value="mr" >
							<label class="form-check-label" for="title">
								Mr.
							</label>
						</div>
						<div class="form-check form-check-inline title_redio">
							<input class="form-check-input" type="radio" name="title" id="title" value="mrs" >
							<label class="form-check-label" for="title">
								Mrs.
							</label>
						</div>
						<div class="form-check form-check-inline title_redio">
							<input class="form-check-input" type="radio" name="title" id="title" value="miss" >
							<label class="form-check-label" for="title">
								Miss
							</label>
						</div>

					</div>
					<div class="col-md-12">
						{!! Form::text('name', null, array('placeholder'=>' YOUR NAME','class'=>'form_text','required'=>'true')) !!}
					</div>
					<div class="col-md-12">
						{!! Form::email('email', null, array('placeholder'=>' CONTACT EMAIL','class'=>'form_text','required'=>'true')) !!}
					</div>
					<div class="col-md-12">
						{!! Form::text('phone', null, array('placeholder'=>' CONTECT PHONE (Option)','class'=>'form_text')) !!}
					</div>

					<div class="col-md-12">
						{!! Form::textarea('query_question', null, ['placeholder'=>'MESSAGE TO US','required'=>'true','id' => 'query_question', 'rows' => 4]) !!}
					</div>
					<div class="col-md-6 submit_button pull-right">
						{{Form::submit('SEND MESSAGE', ['class' => 'cus_submit_button ' ])}}
					</div>

					{!!  Form::close() !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-12 may-like-title">
					<p>You may also like...</p>			
				</div>
				<div class="myExMul">
					@foreach($images as $key=>$image)
					@if($key < 7)
					<a href={{ asset('/'.$image)  }} rel="myExMul-1">
						<img src={{ asset('/'.$image)  }} />
					</a>
					@endif
					@endforeach
				</div>
			</div>
			@endif 
		</div>
	</div>

</main>

<script>

	$(".thumbnail").click(function () {
		$image = '#product_image_'+$(this).attr('id');
		$(".active").removeClass("active");
		$($image).addClass("active");
	});
	$(".check_login").click(function () {
		$('#LoginModal').modal('show');
	});
</script>

<script type="text/javascript">
	
	$('.addtocart').on('click', function () {
		$('.modal_bubble').css('display','block');
		var cart_no = $('.modal_bubble').val();
		cart_no = cart_no + 1;
	     $('.modal_bubble').text(cart_no);
		var cart = $('.nav-member');
		var imgtodrag =$(this).parent('.find-image').find("img").eq(0);

		if (imgtodrag) {
			var imgclone = imgtodrag.clone()
			.offset({
				top: imgtodrag.offset().top,
				left: imgtodrag.offset().left
			})
			.css({
				'opacity': '0.7',
				'position': 'absolute',
				'width': '50%',
				'z-index': '100',
				'display':'block'
			})
			.appendTo($('body'))
			.animate({
				'top': cart.offset().top + 50,
				'left': cart.offset().left + 50,
				'width': 75,
				'height': 75
			}, 1000, 'easeInOutExpo');

			setTimeout(function () {
				cart.effect("shake", {
					times: 1,                
				}, 300);
			}, 50);

			imgclone.animate({
				'width': 0,
				'height': 0
			}, function () {
				$(this).detach()
			});
		}

		var item_id = $(this).attr('data-id');
		  $.ajax({
		  	 type:'POST',
               url:'addtocart',
               data:{'id':item_id,'_token':'{{csrf_token()}}'},
               success:function(data){
                 console.log(data);
                 return false;
               }


            });

	});


</script>

@endsection
