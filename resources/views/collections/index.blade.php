@extends('layouts.layout')

@section('site-title')
	Cargo Management System
@stop
@section('main')
	<div class="main-content">
		<div class="row">

			@permission('collection-list')
			<div class="col-md-2">
				<a href="{{ url('/collections/ready-collect') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/collection.png') }}" alt="Collection">
						<p>Ready to Collect</p>
					</div>
				</a>
			</div>
			@endpermission

			@permission('collection-list')
			<div class="col-md-2">
				<a href="{{ url('/collections/return') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/incoming.png') }}" alt="Collection">
						<p>Return to Head Office</p>
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

