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
				<a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">

				<strong>Dashboard</strong>
			</li>
		</ol>

		<div class="row">
			<div class="col-sm-3">
				<a href="{{ url('settings') }}">
					<div class="tile-stats tile-primary">
						<div class="icon"><i class="entypo-cog"></i></div>
						<div class="num">
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>

						<h3>SETTING</h3>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
					</div>
				</a>
			</div>

			@permission('user-list')
				<div class="col-sm-3">
					<a href="{{ url('/users') }}">
						<div class="tile-stats tile-red">
							<div class="icon"><i class="entypo-users"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>USERS</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('member-list')
				<div class="col-sm-3">
					<a href="{{ url('/members') }}">
						<div class="tile-stats tile-aqua">
							<div class="icon"><i class="fa fa-user-secret"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>
							<h3>MEMBERS</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('lotin-list')
				<div class="col-sm-3">
					<a href="{{ url('/lotins') }}">
						<div class="tile-stats tile-blue">
							<div class="icon"><i class="fa fa-truck"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>LOTIN</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('lotbalance-list')
				<div class="col-sm-3">
					<a href="{{ url('/lotbalances') }}">
						<div class="tile-stats tile-cyan">
							<div class="icon"><i class="entypo-map"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>TRACKING</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('outgoing-list')
				<div class="col-sm-3">
					<a href="{{ url('/outgoings') }}">
						<div class="tile-stats tile-purple">
							<div class="icon"><i class="fa fa-shopping-cart"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>OUTGOING</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('incoming-list')
				<div class="col-sm-3">
					<a href="{{ url('/incomings') }}">
						<div class="tile-stats tile-pink">
							<div class="icon"><i class="fa fa-truck"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>INCOMING</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('collection-list')
				<div class="col-sm-3">
					<a href="{{ url('/collections') }}">
						<div class="tile-stats tile-orange">
							<div class="icon"><i class="fa fa-database"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>COLLECTION</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission

			@permission('report-list')
				<div class="col-sm-3">
					<a href="{{ url('/reports') }}">
						<div class="tile-stats tile-green">
							<div class="icon"><i class="entypo-chart-bar"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>REPORT</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</a>
				</div>
			@endpermission
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

