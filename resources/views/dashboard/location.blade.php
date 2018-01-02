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
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
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
					<div class="col-sm-2">
						<div class="tile-title tile-cyan">
							<div class="icon">
								<img src="{{ asset('assets/icons/country.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>COUNTRY</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('state-list')
				<a href="{{ url('states') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-purple">
							<div class="icon">
								<img src="{{ asset('assets/icons/city.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>STATE</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('township-list')
				<a href="{{ url('townships') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-pink">
							<div class="icon">
								<img src="{{ asset('assets/icons/township.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>TOWNSHIP</h3>
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

@section('my-style')
	<style type="text/css" media="screen">
		.tile-title .title h3 {
			padding-top: 5px;
		}
		.tile-title .title p {
			padding-bottom: 5px;
		}
		.tile-title .icon img {
			height: 100px;
		}
	</style>
@stop
