
@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.user_profile'))


@section('main_page')



<main>
	<div class="container wow fadeIn">
		

	<div class="row flex-md-row cus-row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
     
              <h1>{{$user->name}}</h1>
              <p>{{$user->email}}</p>
          </div>

          <ul class="nav nav-pills nav-stacked">
              <li class="active"><a href="user_profile"> <i class="fa fa-user"></i>Profile</a></li>

              <li><a href="order"> <i class="fa fa-edit"></i> Order </a></li>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">

      <div class="panel">
 
          <div class="panel-body bio-graph-info">
              <h1>User Profile</h1>
              <div class="row flex-md-row cus-row">


              		{!! Form::open(array('action'=>'HomeController@updateProfile','method'=>'post')) !!}

		
                  <div class="bio-row">
                      <p><span>Name </span> {!! Form::text('name', $user->name, array('class'=>'form_text user-input','required'=>'true')) !!}</p>
                  </div>

                  <div class="bio-row">
                      <p><span>Email </span> {!! Form::email('email', $user->email, array('class'=>'form_text user-input','disabled'=>'disabled')) !!}</p>
                  </div>
   			        	<div class="bio-row">
                      <p><span>Mobile </span> {!! Form::text('mobile', $user->mobile, array('class'=>'form_text user-input')) !!}</p>
                  </div>
              <div class="bio-row">
                      <p><span>Address </span> {!! Form::text('address', $user->address , array( 'class'=>'form_text user-input')) !!}</p>
                  </div>

              		<div class="bio-row">
                      <p><span>Password </span> {!! Form::text('password',null, array('placeholder'=>' New Password', 'class'=>'form_text user-input')) !!}</p>
                  </div>


                  	<div class="col-md-4 submit_button pull-right">
						{{Form::submit('Update Profile', ['class' => 'user_submit_button' ])}}
					</div>
               {!!  Form::close() !!}
              </div>
          </div>
      </div>

  </div>
</div>


	</div>
</main>




@endsection


