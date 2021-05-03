@extends('layouts.app')
@section('title',setting('site.title') ." | Reset Password")


<main>
	<div class="container wow fadeIn">
		<div class="row flex-md-row">

			<div class="col-md-12">
				
				<div class="col-12">
				<br><br><br><br>
					{!! Form::open(array('action' => 'Auth\ResetPasswordController@ResetPassword')) !!}

					<div class="col-md-12">
						{!! Form::text('new_password', null, array('placeholder'=>' New Password','class'=>'form_text','required'=>'true')) !!}
					</div>
				
					<div class="col-md-12" style="display: none;">
					 <input class="text-center login_field" name="token" type="text"  value="{{$token}}" required="true">
					</div>

					
					<div class="col-md-12" style="display: none;">
					 <input class="text-center login_field" name="email" type="email"  value="{{$email}}"  required="true">
					</div>
					<div class="col-md-12 submit_button pull-right">
						{{Form::submit('Update Password', ['class' => 'cus_submit_button ' ])}}
					</div>

					{!!  Form::close() !!}
				</div>
			</div>

	
		</div>
	</div>

</main>