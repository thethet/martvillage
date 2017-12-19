@extends('layouts.layout')

@section('page-title')
	Sales Report By Trip
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
				<strong>Sales Report By Trip</strong>
			</li>
		</ol>

		<h2>Sales Report By Trip</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		{!! Form::open(array('route' => 'reports.bytrips','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal validate')) !!}

			<div class="form-group">

				<label class="col-sm-3 control-label">&nbsp;</label>
				<label class="col-sm-2 control-label">Departure Date</label>
				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
						</div>
						{!! Form::text('dept_date', null, ['placeholder' => 'Departure Date','class' => 'form-control datepicker', 'id' => 'dept_date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
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

				@if(count($tripList) > 0)
				<div class="col-sm-2">
					<div class="input-group minimal">
						<a href="{{ url('reports/sales-bytrips/'. $deptDate .'/print-pdf') }}" title="Print"  class="btn btn-green btn-icon">PDF <i class="entypo-download"></i></a>
					</div>
				</div>
				@endif
			</div>
		{!! Form::close() !!}
		<br />

		@for ($t = 0; $t < count($tripList); $t++)
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">
						<h5>{{ $tripList[$t] }}</h5>
					</div>

					<div class="panel-options">
						@permission('lotin-create')
							<a href="{{ url('reports') }}">
								<i class="entypo-cancel"></i>
							</a>
							&nbsp;|&nbsp;
						@endpermission
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>

				<div class="panel-body with-table">
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th width="5%">SNo.</th>
								<th>Departure Date</th>
								<th>Departure Time</th>
								<th>Vessel No.</th>
								<th>MAHTATHA</th>
								<th>Toll Fees</th>
								<th>FOC</th>
								<th>Discount</th>
								<th>Income <br>(Include GST & Service Charge)</th>
								<th>Net Income <br>(Income - Discount)</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$totalDiscount = $totalIncome = $totalNetSales = 0;
							?>
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
									<td class="text-right">
										{{ number_format($tripReportLists[$tripList[$t]][$rp]->total_discount, 2) }}
									</td>
									<td class="text-right">
										{{ number_format($tripReportLists[$tripList[$t]][$rp]->total_income, 2) }}
									</td>
									<td class="text-right">
										{{ number_format($tripReportLists[$tripList[$t]][$rp]->net_income, 2) }}
									</td>
								</tr>
								<?php
									$totalDiscount  += $tripReportLists[$tripList[$t]][$rp]->total_discount;
									$totalIncome    += $tripReportLists[$tripList[$t]][$rp]->total_income;
									$totalNetSales  += $tripReportLists[$tripList[$t]][$rp]->net_income;
								?>
							@endfor
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="4" class="text-right"><b>TOTAL</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-right"><b>{{ number_format($totalDiscount, 2) }}</b></td>
								<td class="text-right"><b>{{ number_format($totalIncome, 2) }}</b></td>
								<td class="text-right"><b>{{ number_format($totalNetSales, 2) }}</b></td>
							</tr>
						</tbody>
					</table>

					{{-- {!! $lotins->render() !!} --}}
				</div>
			</div>
		@endfor


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

