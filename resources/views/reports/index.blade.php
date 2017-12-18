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
			@permission('collection-list')
				<a href="{{ url('reports/sales') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-cyan">
							<div class="icon"><i class="entypo-chart-bar"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>MAIN REPORT</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('collection-list')
				<a href="{{ url('/reports/bytrips') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-purple">
							<div class="icon"><i class="entypo-chart-area"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>TRIP REPORT</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
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

