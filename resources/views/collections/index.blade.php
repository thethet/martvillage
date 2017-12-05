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
						<img class="profile-icon" src="{{ asset('assets/img/collection.png') }}" alt="Collection">
						<p>Return to Head Office</p>
					</div>
				</a>
			</div>
			@endpermission

		</div>
	</div>

	<div class="copy-right">
		<div>
			Copyright © 2017 All Rights Reserved. MSCT Co.Ltd
		</div>
	</div>
@stop

