@extends('layouts.app')
@section('title',setting('site.title') ." | Forgot Password")


<main>
	<div class="container wow fadeIn">
		<div class="row flex-md-row">

			<div class="col-md-12">
				
				<div class="col-12">
				<br><br><br>
				<br>
					{!! Form::open(array('action' => 'HomeController@goToNewPw')) !!}

					<div class="col-md-12">
						{!! Form::text('email', null, array('placeholder'=>' Email | Username','class'=>'form_text','required'=>'true')) !!}
					</div>
				
				
					<div class="col-md-12 submit_button pull-right">
						{{Form::submit('Forgot Password', ['class' => 'cus_submit_button ' ])}}
					</div>

					{!!  Form::close() !!}
				</div>
			</div>

	
		</div>
	</div>

</main>