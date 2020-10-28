@extends('layouts.app')
@section('title',setting('site.title') ." | ". __('frontend.services_package'))


@section('main_page')
<div class="container">
	<div class="row">
		<div class="col-md-12 div_botton">
			<div class="common_main_div">
				<div class="col-md-3 col-sm-3 service_div" data-aos="zoom-out-right" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
					<div class="service_title">
						<span>@lang('frontend.intern')</span>
					</div>

					<div class="service_desc">
						<ul class="service_desc_extra">
							<li>@lang('frontend.base_web_dssign')</li>						
							<li>@lang('frontend.custom_by_limit')</li>
							<li>@lang('frontend.responsive')</li>
							<li>@lang('frontend.samall_personal_web')</li>
						</ul>
					</div>
					<hr>
					<div class="service_desc_other">
						<ul class="service_desc_extra">
							<li>@lang('frontend.led_by_senior')</li>
							<li>@lang('frontend.new_or_fresh')</li>
							<li>@lang('frontend.low_cost')</li>						
						</ul>
					</div>
					<div class="chartRadarDiv" >
						<canvas id="chartRadar"></canvas>
					</div>
					<div class="service_price_primary">
						<span class="service_per_month">
							@lang('frontend.fee') : 
						</span>
						<span class="service_price">			
							$5,000 - $35,000
						</span>

					</div>
					<div class="service_apply">
						<a href="#" data-id="intern_plan" class="quota_button" data-toggle="modal" data-target="#Quota_Modal">@lang('frontend.free_quota')</a>

					</div>
				</div>

				<div class="col-md-3 col-sm-3 service_div" data-aos="zoom-in-down" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
					<div class="service_title">
						<span>@lang('frontend.low_lv_plan')</span>
					</div>

					<div class="service_desc">
						<ul class="service_desc_extra">
							<li>@lang('frontend.pro_web_design')</li>
							<li>@lang('frontend.sup_lang_switch')</li>
							<li>@lang('frontend.cms')</li>
							<li>@lang('frontend.main_upgrade')</li>								
							<li>@lang('frontend.custom_by_required')</li>
							<li>@lang('frontend.responsive')</li>
							<li>@lang('frontend.SME')</li>
							<li>@lang('frontend.small_shop')</li>
						</ul>
					</div>
					<hr>
					<div class="service_desc_other">
						<ul class="service_desc_extra">
							<li>@lang('frontend.experienced_employees')</li>
							<li>@lang('frontend.designer_fee')</li>	

						</ul>
					</div>
					<div class="chartRadarDiv2" >
						<canvas id="chartRadar2"></canvas>
					</div>

					<div class="service_price_primary">
						<span class="service_per_month">
							@lang('frontend.fee') : 
						</span>
						<span class="service_price">			
							$50,000 - $150,000
						</span>

					</div>
					<div class="service_apply">
						<a href="#" data-id="low_lv_plan" class="quota_button" data-toggle="modal" data-target="#Quota_Modal">@lang('frontend.free_quota')</a>

					</div>
				</div>




				<div class="col-md-3 col-sm-3 service_div" data-aos="zoom-in-left" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
					<div class="service_title">
						<span>@lang('frontend.full_lv_plan')</span>
					</div>
					
					<div class="service_desc">
						<ul class="service_desc_extra">
							<li>@lang('frontend.style_function_custom')</li>
							<li>@lang('frontend.highly_custom')</li>
							<li>@lang('frontend.sup_lang_switch')</li>
							<li>@lang('frontend.cms')</li>
							<li>@lang('frontend.main_upgrade')</li>								
							<li>@lang('frontend.custom_by_required')</li>
							<li>@lang('frontend.responsive')</li>
							<li>@lang('frontend.unique_features')</li>
							<li>@lang('frontend.complete_desingn')</li>
						</ul>
					</div>
					<hr>
					<div class="service_desc_other">
						<ul class="service_desc_extra">
							<li>@lang('frontend.dev_by_senior')</li>
							<li>@lang('frontend.higher_budgets')</li>
							<li>@lang('frontend.long_term_dev')</li>						
						</ul>
					</div>
					<div class="chartRadarDiv3" >
						<canvas id="chartRadar3"></canvas>
					</div>
					<div class="service_price_primary">
						<span class="service_per_month">
							@lang('frontend.fee') : 
						</span>
						<span class="service_price">			
							$150,000 Up
						</span>

					</div>
					<div class="service_apply">
						<a href="#"  data-id="full_plan" class="quota_button" data-toggle="modal" data-target="#Quota_Modal">@lang('frontend.free_quota')</a>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="Quota_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">@lang('frontend.free_quota')</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label id="selected_plan"></label>
				{!! Form::open(array('action' => 'HomeController@plan_asking')) !!}
				<div class="col-md-12 col-xs-12">
					<div class="col-md-12">
						<div style="margin-top:25px; ">

							<label class="radio-inline ">{!! Form::radio('title', "mr", null,['required']) !!}Mr.</label>

							<label class="radio-inline ">{!! Form::radio('title', "mrs", null) !!}Mrs.</label>

							<label class="radio-inline ">{!! Form::radio('title', "miss", null) !!}Miss</label>

						</div>   

					</div>
					<div class="col-md-12">
						<input class="pass text-center" name="name" type="text" align="center" placeholder="Surname" required="true">       
					</div>

					<div class="col-md-12">
						<input class="pass text-center" name="email" type="email" align="center" placeholder="Email" required="true">
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
					<div class="col-md-12">
						<input class="pass text-center" name="plan" type="hidden" align="center" placeholder="plan">
					</div>	
						<div class="col-md-12">
						<div style="margin-top:25px; ">

							<label class="radio-inline ">{!! Form::radio('contact_type', "mobile", null,['required']) !!}Call you first</label>

							<label class="radio-inline ">{!! Form::radio('contact_type', "email", null) !!}Email you first</label>

						</div>   

					</div>


				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>


<div id="popupmodal" class="modal hide fade popup_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  </div>
  <div class="modal-body">
    <p class="text-center">
     @php
     if(Session::has('modal_message_success')){
     echo( Session::get('modal_message_success') );
   }elseif(Session::has('modal_message_error')){
   echo(  Session::get('modal_message_error') );
 }
 @endphp
</p>
</div>

<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>	
	//定義變數
	var chartRadarDOM;
	var chartRadarData;
	var chartRadarOptions;

    	//載入雷達圖
    	Chart.defaults.global.legend.display = false;
    	Chart.defaults.global.defaultFontColor =' #908E65';
    	chartRadarDOM = document.getElementById("chartRadar");
    	chartRadarData;
    	chartRadarOptions = 
    	{
    		scale: 
    		{
    			ticks: 
    			{
    				fontSize: 1,
    				beginAtZero: true,
    				maxTicksLimit: 5,
    				min:0,
    				max:100
    			},
    			pointLabels: 
    			{
    				fontSize: 12,
    				color: '#F6490D'
    			},
    			gridLines: 
    			{
    				color: '#FFD768'
    			}
    		}
    	};

    	
    	var graphData =new Array();
    	graphData.push(60);
    	graphData.push(40);
    	graphData.push(40);
	// graphData.push(20);
	// graphData.push(97);
	
	//CreateData
	chartRadarData = {
		labels: [' {!! trans('frontend.Cost-effectiveness') !!}', '{!! trans('frontend.Time benefit') !!}', '{!! trans('frontend.Experience') !!}'],
		datasets: [{
			label: "Skill Level",
			backgroundColor: "rgb(47, 92, 111,0.8)",
			borderColor: "rgba(63,63,74,.8)",
			pointBackgroundColor: "rgba(63,63,74,1)",
			pointBorderColor: "rgba(0,0,0,0)",
			pointHoverBackgroundColor: "#fff",
			pointHoverBorderColor: "rgba(0,0,0,0.3)",
			pointBorderWidth: 5,
			data: graphData}]
		};
		
	//Draw
	var chartRadar = new Chart(chartRadarDOM, {
		type: 'radar',
		data: chartRadarData,
		options: chartRadarOptions
	});
</script>

<script>	
	//定義變數
	var chartRadarDOM2;
	var chartRadarData2;
	var chartRadarOptions2;
	
    	//載入雷達圖
    	Chart.defaults.global.legend.display = false;
    	Chart.defaults.global.defaultFontColor =' #908E65';
    	chartRadarDOM2 = document.getElementById("chartRadar2");
    	chartRadarData2;
    	chartRadarOptions2 = 
    	{
    		scale: 
    		{
    			ticks: 
    			{
    				fontSize: 1,
    				beginAtZero: true,
    				maxTicksLimit: 5,
    				min:0,
    				max:100
    			},
    			pointLabels: 
    			{
    				fontSize: 12,
    				color: '#F6490D'
    			},
    			gridLines: 
    			{
    				color: '#FFD768'
    			}
    		}
    	};

    	
    	var graphData2 =new Array();
    	graphData2.push(75);
    	graphData2.push(60);
    	graphData2.push(80);
	// graphData.push(20);
	// graphData.push(97);
	

	//CreateData
	chartRadarData2 = {
		labels: [' {!! trans('frontend.Cost-effectiveness') !!}', '{!! trans('frontend.Time benefit') !!}', '{!! trans('frontend.Experience') !!}'],
		datasets: [{
			label: "Skill Level",
			backgroundColor: "rgb(47, 92, 111,0.8)",
			borderColor: "rgba(63,63,74,.8)",
			pointBackgroundColor: "rgba(63,63,74,1)",
			pointBorderColor: "rgba(0,0,0,0)",
			pointHoverBackgroundColor: "#fff",
			pointHoverBorderColor: "rgba(0,0,0,0.3)",
			pointBorderWidth: 5,
			data: graphData2}]
		};
		
	//Draw
	var chartRadar2 = new Chart(chartRadarDOM2, {
		type: 'radar',
		data: chartRadarData2,
		options: chartRadarOptions2
	});
</script>


<script>	
	//定義變數
	var chartRadarDOM3;
	var chartRadarData3;
	var chartRadarOptions3;
	
    	//載入雷達圖
    	Chart.defaults.global.legend.display = false;
    	Chart.defaults.global.defaultFontColor =' #908E65';
    	chartRadarDOM3 = document.getElementById("chartRadar3");
    	chartRadarData3;
    	chartRadarOptions3 = 
    	{
    		scale: 
    		{
    			ticks: 
    			{
    				fontSize: 1,
    				beginAtZero: true,
    				maxTicksLimit: 5,
    				min:0,
    				max:100
    			},
    			pointLabels: 
    			{
    				fontSize: 12,
    				color: '#F6490D'
    			},
    			gridLines: 
    			{
    				color: '#FFD768'
    			}
    		}
    	};


    	var graphData3 =new Array();
    	graphData3.push(90);
    	graphData3.push(70);
    	graphData3.push(80);
	// graphData.push(20);
	// graphData.push(97);
	
	//CreateData
	chartRadarData3 = {
		labels: [' {!! trans('frontend.Cost-effectiveness') !!}', '{!! trans('frontend.Time benefit') !!}', '{!! trans('frontend.Experience') !!}'],
		datasets: [{
			label: "Skill Level",
			backgroundColor: "rgb(47, 92, 111,0.8)",
			borderColor: "rgba(63,63,74,0.8)",
			pointBackgroundColor: "rgba(63,63,74,0.5)",
			pointBorderColor: "rgba(0,0,0,0)",
			pointHoverBackgroundColor: "#fff",
			pointHoverBorderColor: "rgba(0,0,0,0.3)",
			pointBorderWidth: 5,
			data: graphData3}]
		};
		
	//Draw
	var chartRadar3 = new Chart(chartRadarDOM3, {
		type: 'radar',
		data: chartRadarData3,
		options: chartRadarOptions3
	});
</script>

<script>
$(function(){
	$( ".quota_button" ).bind('click',function(){
		$plan_name = $( this).data('id');
		console.log($plan_name);
		if ($plan_name == 'intern_plan'){
			$("#selected_plan").text("{!! trans('frontend.intern') !!}");
			$('input[name=plan]').val('intern');
		}
		if ($plan_name == 'low_lv_plan'){
			$("#selected_plan").text("{!! trans('frontend.low_lv_plan') !!}");
				$('input[name=plan]').val('basic');
		}
		if ($plan_name == 'full_plan'){
			$("#selected_plan").text("{!! trans('frontend.full_lv_plan') !!}");
				$('input[name=plan]').val('standard ');
		}
	});
	});
</script>
@if( Session::has('modal_message_error') || Session::has('modal_message_success'))
<script type="text/javascript">
  $(document).ready(function() {
    $('#popupmodal').modal();
    $('#popupmodal').removeClass( "hide" )
  });
</script>

@endif
@endsection
