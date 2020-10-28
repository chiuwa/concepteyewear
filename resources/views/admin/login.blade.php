@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.service_platform'))


@section('main_page')


<div class="container">
  <div class="row">
    <div class="common_main_div">
     <!--   <div class="col-md-12 text-center">
          <label>@lang('frontend.service_platform')</label>
          <hr>
          <br>
      </div> -->

      <div class="col-md-6">
          <div class="text-center">
            <label>@lang('frontend.login')</label>
            <hr>
        </div>
        <div class="login_div">
            @if ($errors->any())
            @foreach($errors->all() as $message)
            <div class="alert alert-danger " role="alert">
              {{$message}}
          </div>
          @endforeach
          @endif
          {!! Form::open(array('action' => 'LoginController@login')) !!}

          <div class="login_main">
           <div class="col-md-1 col-xs-1"></div>
           <div class="col-md-10">       
              <div class="col-md-12">
                <input class="un text-center" name="email" type="email" align="center" placeholder="User Email" required="true">
            </div>
            <div class="col-md-12">
                <input class="pass text-center" name="password" type="password" align="center" placeholder="Password" required="true">
            </div>
            <div class="col-md-12 login_submit_button">
             {{Form::submit('Login', ['class' => 'login100-form-btn text-center'])}}
         </div>
     </div>
     <div class="col-md-1 col-xs-1"></div>
 </div>

</div>
{{ Form::close() }}
</div>


<div class="col-md-6">
  <div class="text-center">
    <label>@lang('frontend.register')</label>
    <hr>
</div>

<ul id="myTab" class="nav nav-tabs">
    <li class="active" style="width:50%;text-align: center;">
      <a href="#client" data-toggle="tab">@lang('frontend.client')</a>
  </li>
  <li  style="width:50%;text-align: center;"><a href="#staff" data-toggle="tab">@lang('frontend.staff')</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="login_div tab-pane fade in active" id="client">
      @if ($errors->any())
      @foreach($errors->all() as $message)
      <div class="alert alert-danger " role="alert">
        {{$message}}
    </div>
    @endforeach
    @endif
    {!! Form::open(array('action' => 'LoginController@client_register')) !!}
    <div class="login_main_2">
       <div class="col-md-1 col-xs-1"></div>
       <div class="col-md-10">       
        <div class="col-md-12">
          <input class="un text-center" name="email" type="email" align="center" placeholder="Email" required="true">
      </div>

      <div class="col-md-4 col-xs-4">                    
          <select class="form-control option_list" name="area_code">
            <option>+852</option>
            <option>+853</option>
            <option>+86</option>
            <option>other</option>                         
        </select>

    </div>
    <div class="col-md-8 col-xs-8">
      <input class="pass text-center" name="mobile" type="text" align="center" placeholder="Mobile" required="true">
  </div>
  <div class="col-md-12 col-xs-12 ">
      <input class="pass text-center" name="password" type="password" align="center" placeholder="Password" required="true">
  </div>

  <div class="col-md-12  login_submit_button">
   {{Form::submit('Register', ['class' => 'login100-form-btn text-center'])}}
</div>
</div>
<div class="col-md-1 col-xs-1"></div>
</div>
{{ Form::close() }}
</div>


<div class="login_div tab-pane fade" id="staff">
    @if ($errors->any())
    @foreach($errors->all() as $message)
    <div class="alert alert-danger " role="alert">
      {{$message}}
  </div>
  @endforeach
  @endif
  {!! Form::open(array('action' => 'LoginController@staff_register')) !!}
  <div class="login_main_3">
   <div class="col-md-1 col-xs-1"></div>
   <div class="col-md-10">       
       <div class="col-md-12">
          <input class="un text-center" name="email" type="email" align="center" placeholder="Email" required="true">
      </div>

      <div class="col-md-4 col-xs-4">                    
          <select class="form-control option_list" name="area_code">
            <option>+852</option>
            <option>+853</option>
            <option>+86</option>
            <option>other</option>                         
        </select>

    </div>
    <div class="col-md-8 col-xs-8">
      <input class="pass text-center" name="mobile" type="text" align="center" placeholder="Mobile" required="true">
  </div>

  <div class="col-md-12 col-xs-12" style="margin-bottom: 25px;">                    
      <select class="form-control option_list" name="work_type">
        <option>Programmer</option>
        <option>Designer</option>   
        <option>other</option>                         
    </select>

</div>
<div class="col-md-12 col-xs-12" style="margin-bottom: 25px;">                    
  <select class="form-control option_list" name="staff_level">
    <option>Interns</option>
    <option>Junior</option>   
    <option>Senior</option> 
    <option>other</option>                            
</select>

</div>

<div class="col-md-12 col-xs-12">
  <input class="pass text-center" name="password" type="password" align="center" placeholder="Password" required="true">
</div>
<div class="col-md-12 col-xs-12 login_submit_button">
   {{Form::submit('Register', ['class' => 'login100-form-btn text-center'])}}
</div>
</div>
<div class="col-md-1 col-xs-1"></div>
</div>
{{ Form::close() }}
</div>

</div>
</div>


</div>

</div>

</div>

@endsection

