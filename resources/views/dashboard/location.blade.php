@extends('layouts.layout')

@section('page-title')
	Location
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li class="active">

				<strong>Location</strong>
			</li>
		</ol>


		<div class="row">
			@permission('country-list')
				<a href="{{ url('countries') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-cyan">
							<div class="icon"><i class="entypo-globe"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>COUNTRY</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('state-list')
				<a href="{{ url('states') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-purple">
							<div class="icon"><i class="entypo-location"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>STATE</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('township-list')
				<a href="{{ url('townships') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-pink">
							<div class="icon"><i class="entypo-direction"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>TOWNSHIP</h3>
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

