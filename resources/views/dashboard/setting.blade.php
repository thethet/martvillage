@extends('layouts.layout')

@section('page-title')
	Setting
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

				<strong>Setting</strong>
			</li>
		</ol>


		<div class="row">
			@permission('nric-code-list')
				<a href="{{ url('nric-codes') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-cyan">
							<div class="icon">
								<img src="{{ asset('assets/icons/nriccode.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>NRIC CODE</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('nric-township-list')
				<a href="{{ url('nric-townships') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-purple">
							<div class="icon">
								<img src="{{ asset('assets/icons/nrictownship.png') }}" alt="">
							</div>

							<div class="title">
								<h3> &nbsp;<br>NRIC TOWNSHIP</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('permission-list')
				<a href="{{ url('permissions') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-green">
							<div class="icon">
								<img src="{{ asset('assets/icons/permission.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>PERMISSION</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('role-list')
				<a href="{{ url('roles') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-orange">
							<div class="icon">
								<img src="{{ asset('assets/icons/role.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>ROLE</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('company-list')
				<a href="{{ url('companies') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-green">
							<div class="icon">
								<img src="{{ asset('assets/icons/company.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>COMPANY</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			{{-- @permission('location-list') --}}
				<a href="{{ url('locations') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-red">
							<div class="icon">
								<img src="{{ asset('assets/icons/location.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>LOCATION</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			{{-- @endpermission --}}

			@permission('price-list')
				<a href="{{ url('pricing-setup') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-aqua">
							<div class="icon">
								<img src="{{ asset('assets/icons/pricingsetup.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>PRICING SETUP</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('membership-list')
				<a href="{{ url('memberships') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-blue">
							<div class="icon">
								<img src="{{ asset('assets/icons/facility.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>MEMBERSHIPS</h3>
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
