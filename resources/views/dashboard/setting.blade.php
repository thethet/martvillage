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
			@permission('nric-code-list')
				<a href="{{ url('nric-codes') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-cyan">
							<div class="icon"><i class="entypo-vcard"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>NRIC CODE</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('nric-township-list')
				<a href="{{ url('nric-townships') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-purple">
							<div class="icon"><i class="entypo-vcard"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>NRIC TOWNSHIP</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('permission-list')
				<a href="{{ url('permissions') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-green">
							<div class="icon"><i class="entypo-user"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>PERMISSION</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('role-list')
				<a href="{{ url('roles') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-orange">
							<div class="icon"><i class="entypo-flow-tree"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>ROLE</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('company-list')
				<a href="{{ url('companies') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-green">
							<div class="icon"><i class="entypo-suitcase"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>COMPANY</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('location-list')
				<a href="{{ url('locations') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-red">
							<div class="icon"><i class="entypo-location"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>LOCATION</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('price-list')
				<a href="{{ url('prices') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-aqua">
							<div class="icon"><i class="fa fa-money"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>PRICES</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('member-offer-list')
				<a href="{{ url('member-offers') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-blue">
							<div class="icon"><i class="entypo-tag"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>MEMBER OFFERS</h3>
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

