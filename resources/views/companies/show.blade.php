@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3> Show Company</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Company Name:</strong>
					{{ $company->company_name }}
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Contact No.:</strong>
					{{ $company->contact_no }}
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Email:</strong>
					{{ $company->email }}
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Expiry Date:</strong>
					{{ $company->expiry_date }}
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Address:</strong>
					{{ $company->address }}
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
				<a href="{{ route('companies.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Save">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
@endsection
