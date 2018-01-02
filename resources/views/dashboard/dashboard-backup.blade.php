@extends('layouts.layout')

@section('page-title')
	Dashboard
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">

				<strong>Dashboard</strong>
			</li>
		</ol>

		<div class="row">
			<div class="col-sm-3">
				<div class="tile-stats tile-primary">
					<div class="icon"><i class="entypo-suitcase"></i></div>
					<div class="num" data-start="0" data-end="{{ $companies }}" data-duration="1500" data-delay="0">0</div>

					<h3>Registered Companies</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="tile-stats tile-red">
					<div class="icon"><i class="entypo-users"></i></div>
					<div class="num" data-start="0" data-end="{{ $users }}" data-duration="1500" data-delay="0">0</div>

					<h3>Registered Users</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="tile-stats tile-aqua">
					<div class="icon"><i class="fa fa-user-secret"></i></div>
					<div class="num" data-start="0" data-end="{{ $members }}" data-duration="1500" data-delay="0">0</div>

					<h3>Registered Members</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="tile-stats tile-blue">
					<div class="icon"><i class="entypo-location"></i></div>
					<div class="num" data-start="0" data-end="{{ $countries }}" data-duration="1500" data-delay="0">0</div>

					<h3>Registered Countries</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div class="tile-stats tile-cyan">
					<div class="icon"><i class="entypo-location"></i></div>
					<div class="num" data-start="0" data-end="{{ $cities }}" data-duration="1500" data-delay="0">0</div>

					<h3>Registered Cities</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="tile-stats tile-purple">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<div class="num" data-start="0" data-end="{{ $lotins }}" data-duration="1500" data-delay="0">0</div>

					<h3>Today Lot Balance</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="tile-stats tile-pink">
					<div class="icon"><i class="fa fa-truck"></i></div>
					<div class="num" data-start="0" data-end="{{ $incomings }}" data-duration="1500" data-delay="0">0</div>

					<h3>Today Incoming</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="tile-stats tile-orange">
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
					<div class="num" data-start="0" data-end="{{ $outgoings }}" data-duration="1500" data-delay="0">0</div>

					<h3>Today Outgoing</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div class="tile-stats tile-green">
					<div class="icon"><i class="fa fa-database"></i></div>
					<div class="num" data-start="0" data-end="{{ $collections }}" data-duration="1500" data-delay="0">0</div>

					<h3>Today Collections</h3>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

