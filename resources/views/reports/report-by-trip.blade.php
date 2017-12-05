@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/incoming.png') }}" alt="Incoming">
	</div>
	<div class="col-md-8 site-header">Income Report By Trip</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			{!! Form::open(array('route' => 'reports.bytrips','method'=>'POST', 'id' => 'incomings-search-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
			<div class="form-group">
				<label class="control-label col-sm-2" for="date">
					<strong>Departure Date:</strong>
				</label>
				<div class="col-sm-2">
					{!! Form::text('dept_date', null, array('placeholder' => 'Departure Date','class' => 'form-control')) !!}
					@if ($errors->has('dept_date'))
						<span class="required">
							<strong>{{ $errors->first('dept_date') }}</strong>
						</span>
					@endif
				</div>

				<label class="control-label col-sm-1" for="date"></label>

				<label class="control-label col-sm-1" for="button"></label>
				<div class="col-sm-2">
					<a href="#" id="add" onclick="document.getElementById('incomings-search-form').submit();">
						<div class="addbtn">
							<img src="{{ asset('assets/img/Search.png') }}" alt="Search">
								Search
						</div>
					</a>
				</div>
			</div><!-- .form-group -->

			<div class="form-group"></div>
			{!! Form::close() !!}
		</div>

		@for ($t = 0; $t < count($tripList); $t++)
			<h5>{{ $tripList[$t] }}</h5>
			<div class="table-cont">
				<table class="table table-bordered table-responsive">
					<tr>
						<th>No</th>
						<th>Depture Date</th>
						<th>Depture Time</th>
						<th>Vessel No.</th>
						<th>MAHTATHA</th>
						<th>Toll Fees</th>
						<th>FOC</th>
						<th>Discount</th>
						<th>Income <br>(Include GST & Service Charge)</th>
						<th>Net Income <br>(Income - Discount)</th>
					</tr>

						@for($rp = 0; $rp < count($tripReportLists[$tripList[$t]]); $rp++)
							<tr>
								<td>{{ $rp + 1 }}</td>
								<td>
									{{ $tripReportLists[$tripList[$t]][$rp]->dept_date }}
								</td>
								<td>
									{{ $tripReportLists[$tripList[$t]][$rp]->dept_time }}
								</td>
								<td>
									{{ $tripReportLists[$tripList[$t]][$rp]->vessel_no }}
								</td>
								<td>{{ '-' }}</td>
								<td>{{ '-' }}</td>
								<td>{{ '-' }}</td>
								<td style="text-align: right;">
									{{ number_format($tripReportLists[$tripList[$t]][$rp]->total_discount, 2) }}
								</td>
								<td style="text-align: right;">
									{{ number_format($tripReportLists[$tripList[$t]][$rp]->total_income, 2) }}
								</td>
								<td style="text-align: right;">
									{{ number_format($tripReportLists[$tripList[$t]][$rp]->net_income, 2) }}
								</td>
							</tr>
						@endfor

				</table>
			</div>
			<br><br>
		@endfor

	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('reports') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.js') }}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"/>

	<script>
		$(document).ready(function(){
			var dept_date=$('input[name="dept_date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			dept_date.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});

			$('#timepicker').timepicker({
				minuteStep: 5
			});
		});
	</script>
@stop
