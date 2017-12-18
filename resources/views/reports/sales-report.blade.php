@extends('layouts.layout')

@section('page-title')
	Sales Report
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('reports') }}">Report Management</a>
			</li>
			<li class="active">
				<strong>Sales Report</strong>
			</li>
		</ol>

		<h2>Sales Report</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		{!! Form::open(array('route' => 'reports.sales','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal validate')) !!}

			<div class="form-group">

				<label class="col-sm-5 control-label">&nbsp;</label>
				<label class="col-sm-2 control-label">Delivery Date</label>
				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
						</div>
						{!! Form::text('date', null, ['placeholder' => 'Delivery Date','class' => 'form-control datepicker', 'id' => 'date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
					</div>
				</div>


				<div class="col-sm-2">
					<div class="input-group minimal">
						<button type="submit" class="btn btn-blue btn-icon">
							Search
							<i class="entypo-search"></i>
						</button>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
		<br />

		<h4>Daily Sales Report By Cash</h4>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					{{-- Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries --}}
				</div>

				<div class="panel-options">
					@permission('lotin-create')
						<a href="{{ url('collections') }}">
							<i class="entypo-cancel"></i>
						</a>
						&nbsp;|&nbsp;
					@endpermission
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<?php
				$i = 1;
				$j = 1;
				$totalSalesCash   = $totalDiscountCash   = $totalNetSalesCash   = 0;
				$totalSalesCredit = $totalDiscountCredit = $totalNetSalesCredit = 0;
			?>
			<div class="panel-body with-table">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Description</th>
							<th width="15%">Sales</th>
							<th width="15%">Discount</th>
							<th width="15%">Net Sales</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotinsByCash as $key => $byCash)
							<tr>
								<td>{{ $i++ }}</td>
								<td>Cargo (Cash) [{{ $key }}]</td>
								<td class="text-right">{{ number_format($byCash['total_sales'], 2) }}</td>
								<td class="text-right">{{ number_format($byCash['total_dis'], 2) }}</td>
								<td class="text-right">{{ number_format($byCash['net_sales'], 2) }}</td>
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
							<td colspan="2" class="text-right"><b>TOTAL INCOME</b></td>
							<td class="text-right"><b>{{ number_format($totalSalesCash, 2) }}</b></td>
							<td class="text-right"><b>{{ number_format($totalDiscountCash, 2) }}</b></td>
							<td class="text-right"><b>{{ number_format($totalNetSalesCash, 2) }}</b></td>
						</tr>
					</tbody>
				</table>

				{{-- {!! $lotins->render() !!} --}}
			</div>
		</div>

		<br>
		<h4>Daily Sales Report By Credit</h4>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					{{-- Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries --}}
				</div>

				<div class="panel-options">
					@permission('lotin-create')
						<a href="{{ url('collections') }}">
							<i class="entypo-cancel"></i>
						</a>
						&nbsp;|&nbsp;
					@endpermission
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<?php
				$i = 1;
				$j = 1;
				$totalSalesCash   = $totalDiscountCash   = $totalNetSalesCash   = 0;
				$totalSalesCredit = $totalDiscountCredit = $totalNetSalesCredit = 0;
			?>
			<div class="panel-body with-table">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Description</th>
							<th width="15%">Sales</th>
							<th width="15%">Discount</th>
							<th width="15%">Net Sales</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotinsByCredit as $key => $byCredit)
							<tr>
								<td>{{ $j++ }}</td>
								<td>Cargo (Cash) [{{ $key }}]</td>
								<td class="text-right">{{ number_format($byCredit['total_sales'], 2) }}</td>
								<td class="text-right">{{ number_format($byCredit['total_dis'], 2) }}</td>
								<td class="text-right">{{ number_format($byCredit['net_sales'], 2) }}</td>
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
							<td colspan="2" class="text-right"><b>TOTAL INCOME</b></td>
							<td class="text-right"><b>{{ number_format($totalSalesCredit, 2) }}</b></td>
							<td class="text-right"><b>{{ number_format($totalDiscountCredit, 2) }}</b></td>
							<td class="text-right"><b>{{ number_format($totalNetSalesCredit, 2) }}</b></td>
						</tr>
					</tbody>
				</table>

				{{-- {!! $lotins->render() !!} --}}
			</div>
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

@section('my-script')
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{ asset('assets/js/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('assets/js/fileinput.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('lotins/"+ id +"') !!}",
						type: 'DELETE',
						data: {_token: '{!! csrf_token() !!}'},
						dataType: 'JSON',
						success: function (data) {
							window.location.replace(data.url);
						}
					});
				}
			});
		});
	</script>
@stop

