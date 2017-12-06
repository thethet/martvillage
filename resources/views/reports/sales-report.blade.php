@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/incoming.png') }}" alt="Incoming">
	</div>
	<div class="col-md-8 site-header">Sales Report</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			{!! Form::open(array('route' => 'reports.sales','method'=>'POST', 'id' => 'incomings-search-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
			<div class="form-group">
				<label class="control-label col-sm-2" for="date">
					<strong>Date:</strong>
				</label>
				<div class="col-sm-2">
					@if(Request::has('date'))
					{!! Form::text('date', null, array('placeholder' => 'Departure Date','class' => 'form-control')) !!}
					@else
					{!! Form::text('date', date('Y-m-d'), array('placeholder' => 'Departure Date','class' => 'form-control')) !!}
					@endif
					@if ($errors->has('date'))
						<span class="required">
							<strong>{{ $errors->first('date') }}</strong>
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

		<?php
			$i = 1;
			$j = 1;
			$totalSalesCash   = $totalDiscountCash   = $totalNetSalesCash   = 0;
			$totalSalesCredit = $totalDiscountCredit = $totalNetSalesCredit = 0;
		?>

		<h4>Daily Sales Report by Cash</h4>
		<div class="table-cont">
			<table class="table table-bordered table-responsive">
				<tr>
					<th>No</th>
					<th>Description</th>
					<th>Sales</th>
					<th>Discount</th>
					<th>Net Sales</th>
				</tr>
				@foreach($lotinsByCash as $key => $byCash)
				<tr>
					<td>{{ $i++ }}</td>
					<td>Cargo (Cash) [{{ $key }}]</td>
					<td class="right">{{ number_format($byCash['total_sales'], 2) }}</td>
					<td class="right">{{ number_format($byCash['total_dis'], 2) }}</td>
					<td class="right">{{ number_format($byCash['net_sales'], 2) }}</td>
				</tr>
				<?php
					$totalSalesCash    += $byCash['total_sales'];
					$totalDiscountCash += $byCash['total_dis'];
					$totalNetSalesCash += $byCash['net_sales'];
				?>
				@endforeach
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><b>TOTAL INCOME</b></td>
					<td class="right"><b>{{ number_format($totalSalesCash, 2) }}</b></td>
					<td class="right"><b>{{ number_format($totalDiscountCash, 2) }}</b></td>
					<td class="right"><b>{{ number_format($totalNetSalesCash, 2) }}</b></td>
				</tr>
			</table>
		</div>

		<br><br>
		<h4>Daily Sales Report by Credit</h4>
		<div class="table-cont">
			<table class="table table-bordered table-responsive">
				<tr>
					<th>No</th>
					<th>Description</th>
					<th>Sales</th>
					<th>Discount</th>
					<th>Net Sales</th>
				</tr>
				@foreach($lotinsByCredit as $key => $byCredit)
				<tr>
					<td>{{ $i++ }}</td>
					<td>Cargo (Cash) [{{ $key }}]</td>
					<td class="right">{{ number_format($byCredit['total_sales'], 2) }}</td>
					<td class="right">{{ number_format($byCredit['total_dis'], 2) }}</td>
					<td class="right">{{ number_format($byCredit['net_sales'], 2) }}</td>
				</tr>
				<?php
					$totalSalesCredit    += $byCredit['total_sales'];
					$totalDiscountCredit += $byCredit['total_dis'];
					$totalNetSalesCredit += $byCredit['net_sales'];
				?>
				@endforeach
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><b>TOTAL INCOME</b></td>
					<td class="right"><b>{{ number_format($totalSalesCredit, 2) }}</b></td>
					<td class="right"><b>{{ number_format($totalDiscountCredit, 2) }}</b></td>
					<td class="right"><b>{{ number_format($totalNetSalesCredit, 2) }}</b></td>
				</tr>
			</table>
		</div>


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
			var date=$('input[name="date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			date.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});
			// date.datepicker('setDate', new Date());
		});
	</script>
@stop
