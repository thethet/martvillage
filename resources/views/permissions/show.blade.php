@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3> Show Permission</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Name:</strong>
					{{ $permission->display_name }}
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Description:</strong>
					{{ $permission->description }}
				</div>
			</div>
		</div><!-- .row -->
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('permissions.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Save">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
@endsection
