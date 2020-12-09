
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
              <li ><a href="user_profile"> <i class="fa fa-user"></i>Profile</a></li>

              <li class="active"><a href="order"> <i class="fa fa-edit"></i> Order </a></li>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">
    @foreach($order as $key=>$data)
      <div class="panel">
 
          <div class="panel-body bio-graph-info">
              <h1>Order {{$data->id}}</h1>
              <div class="row flex-md-row cus-row">
                    {!! Form::open(array('action'=>'HomeController@updateOrder','method'=>'post','enctype'=>'multipart/form-data')) !!}
              <div class="bio-row">
                     <p>Last Update Time :{{$data->updated_at}} </p>
                  </div>
              <div class="bio-row">
                     <p>Order Time :{{$data->created_at}} </p>
                  </div>
                    <div class="bio-row">
                     <p>Order Status :{{$data->status}} </p>
                  </div>
                       <div class="bio-row">
                     <p>Follow Up Salse :{{$data->follow_up_user_id}} </p>
                  </div>
                   <div class="bio-row full-bio-row">
                     <p>Order Totel Price : <b>HKD ${{$data->total_price}} </b></p>
                  </div>     
                  <div class="bio-row" style="display: none">
                      <p><span>Order Num: </span> {!! Form::text('order_id', $data->id, array('class'=>'form_text user-input')) !!}</p>
                  </div>
                  @if($data->receipt_image == null)
                   <div class="bio-row full-bio-row">
                      <p><span>Receipt : </span>  <input class="receipt_upload" type="file" name="receipt_image"/></p>
                  </div>
                  @else
                     <div class="bio-row full-bio-row">
                      <p><span>Receipt : </span>   <img src="{{ Voyager::image($data->receipt_image)}}" class="d-block select-image">      </p>
                  </div>
                  @endif
                 <div class="col-md-4 submit_button pull-right">
            {{Form::submit('Update Order', ['class' => 'user_submit_button' ])}}
          </div>
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


