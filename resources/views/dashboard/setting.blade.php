@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			@permission('company-list')
			<div class="col-md-2">
				<a href="{{ url('/companies') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/company.png') }}" alt="Company">
						Company
					</div>
				</a>
			</div>
			@endpermission

			@permission('price-list')
			<div class="col-md-2">
				<a href="{{ url('/prices') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/price-tag.png') }}" alt="Price">
						Price
					</div>
				</a>
			</div>
			@endpermission

			@permission('location-list')
			<div class="col-md-2">
				<a href="{{ url('/locations') }}">
					<div class="card">
						<img class="tracking-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Location">
						Location
					</div>
				</a>
			</div>
			@endpermission

			@permission('role-list')
			<div class="col-md-2">
				<a href="{{ url('/roles') }}">
					<div class="card">
						<img src="{{ asset('assets/img/roleicon.png') }}" alt="Role">
						Role
					</div>
				</a>
			</div>
			@endpermission

			@permission('permission-list')
			<div class="col-md-2">
				<a href="{{ url('permissions') }}">
					<div class="card">
						<img src="{{ asset('assets/img/permission.png') }}" alt="Permission">
						Permission
					</div>
				</a>
			</div>
			@endpermission
		</div>
	</div>

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="">
					Home
				</a>
			</div>
		</div>
	</div>
@stop
