@extends('layout.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/company.png') }}" alt="Company">
						Company
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/price-tag.png') }}" alt="Price">
						Price
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="tracking-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Location">
						Location
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/roles') }}">
					<div class="card">
						<img src="{{ asset('assets/img/permission.png') }}" alt="Permission">
						Permission
					</div>
				</a>
			</div>
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
