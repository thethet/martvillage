@extends('layouts.layout')

@section('page-title')
	Report
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">

				<strong>Report Management</strong>
			</li>
		</ol>


		<div class="row">
			@permission('report-list')
				<a href="{{ url('reports/sales') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-cyan">
							<div class="icon">
								<img src="{{ asset('assets/icons/dailyreport.png') }}" alt="">
							</div>

							<div class="title">
								<h3>DAILY SALES REPORT</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('report-list')
				<a href="{{ url('/reports/bytrips') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-purple">
							<div class="icon">
								<img src="{{ asset('assets/icons/tripreport.png') }}" alt="">
							</div>

							<div class="title">
								<h3>SALES REPORT BY TRIP</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

