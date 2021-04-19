@extends('layouts.app')
@section('title',setting('site.title') ." |  Enquire")


@section('main_page')



<main>
	<div class="container wow fadeIn">
		<div class="row flex-md-row">

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
	
		</div>
	</div>

</main>


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
