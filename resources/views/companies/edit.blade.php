@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/company.png') }}" alt="Company">
	</div>
	<div class="col-md-8 site-header">Company Profile</div>
@stop

@section('main')
{!! Form::model($company, ['method' => 'PATCH','route' => ['companies.update', $company->id], 'id' => 'company-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
	<div class="main-content">
		<div class="small-10 columns">
			<p><b><span class="required">*</span> Fields are required</b></p>
		</div>

		<div class="row">
			<div class="col col-md-8">
				<div class="form-group">
					<label class="control-label col-sm-3" for="company"><strong>Company Name: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						@if (Auth::user()->hasRole('administrator'))
							{!! Form::text('company_name', null, array('placeholder' => 'Please Enter Company Name', 'class' => 'form-control')) !!}
						@else
							{!! Form::text('company_name', null, array('placeholder' => 'Please Enter Company Name', 'class' => 'form-control', 'disabled' => true)) !!}
						@endif

						@if ($errors->has('company_name'))
							<span class="required">
								<strong>{{ $errors->first('company_name') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="company"><strong>Short Code: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::text('short_code', null, array('placeholder' => 'Enter Short Code','class' => 'form-control', 'disabled' => true)) !!}
						@if ($errors->has('short_code'))
							<span class="required">
								<strong>{{ $errors->first('short_code') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="contact-no"><strong>Contact No.: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						@if (Auth::user()->hasRole('administrator'))
							{!! Form::text('contact_no', null, array('placeholder' => 'Please Enter Contact Number', 'class' => 'form-control')) !!}
						@else
							{!! Form::text('contact_no', null, array('placeholder' => 'Please Enter Contact Number', 'class' => 'form-control', 'disabled' => true)) !!}
						@endif

						@if ($errors->has('contact_no'))
							<span class="required">
								<strong>{{ $errors->first('contact_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="email"><strong>Email: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						@if (Auth::user()->hasRole('administrator'))
							{!! Form::text('email', null, array('placeholder' => 'Please Enter Email', 'class' => 'form-control')) !!}
						@else
							{!! Form::text('email', null, array('placeholder' => 'Please Enter Email', 'class' => 'form-control', 'disabled' => true)) !!}
						@endif

						@if ($errors->has('email'))
							<span class="required">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="email"><strong>Expiry Date: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						@if (Auth::user()->hasRole('administrator'))
							{!! Form::text('expiry_date', null, array('placeholder' => 'Please Enter Expiry Date', 'class' => 'form-control', 'id' => 'expiry_date')) !!}
						@else
							{!! Form::text('expiry_date', null, array('placeholder' => 'Please Enter Expiry Date', 'class' => 'form-control', 'id' => 'expiry_date', 'disabled' => true)) !!}
						@endif

						@if ($errors->has('expiry_date'))
							<span class="required">
								<strong>{{ $errors->first('expiry_date') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="email"><strong>Company Logo:</strong></label>
					<div class="col-sm-6">
						{!! Form::file('image') !!}
						@if ($errors->has('image'))
							<span class="required">
								<strong>{{ $errors->first('image') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->
			</div>

			<div class="col-sm-3">
				@if($company->logo)
				<div class="photobox">
					<img src="{{ asset('uploads/logos/'.$company->logo) }}" alt="Company Logo">
				</div>
				@else
				<div class="photobox">
					Company Logo
				</div>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="address"><strong>Address</strong></label>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="unit number"><strong>Unit Number:</strong></label>
			<div class="col-sm-4">
				{!! Form::text('unit_number', null, array('placeholder' => 'Please Enter Unit Number', 'class' => 'form-control')) !!}
			</div>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="building"><strong>Building Name:</strong></label>
			<div class="col-sm-4">
				{!! Form::text('building_name', null, array('placeholder' => 'Please Enter Building Name', 'class' => 'form-control')) !!}
			</div>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="street"><strong>Street:</strong></label>
			<div class="col-sm-4">
				{!! Form::text('street', null, array('placeholder' => 'Please Enter Street', 'class' => 'form-control')) !!}
			</div>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="country"><strong>Country:</strong></label>
			<div class="col-sm-4">
				{!! Form::select('country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'country_id', 'class' => 'form-control']) !!}
			</div>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="state"><strong>State:</strong></label>
			<div class="col-sm-4">
				{!! Form::select('state_id', ['' => 'Select State'] + $states->toArray(), null, ['id'=>'state_id', 'class' => 'form-control']) !!}
			</div>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="township"><strong>Township:</strong></label>
			<div class="col-sm-4">
				{!! Form::select('township_id', ['' => 'Select Township'] + $townships->toArray(), null, ['id'=>'township_id', 'class' => 'form-control']) !!}
			</div>
		</div><!-- .form-group -->

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
				<a href="#" id="reset" onclick="document.getElementById('company-form').reset();">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('companies.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('company-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
{!! Form::close() !!}
@stop

@section('my-script')
	<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.js') }}"></script>
	<script>
		$(document).ready(function(){
			var date_input=$('input[name="expiry_date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});

			$("#country_id").select2();

			$("#state_id").select2({
				ajax: {
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var countryId = $('#country_id').val();
						return {
							search: params.term,
							countryId: countryId
						};
					},
					processResults: function (data, params) {
						console.log(data)
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$("#township_id").select2({
				ajax: {
					url: "{{ url('townships/search-township-state') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var stateId = $('#state_id').val();
						return {
							search: params.term,
							stateId: stateId
						};
					},
					processResults: function (data, params) {
						console.log(data)
						return {
							results: data.items
						};
					},
					cache: true
				},
			});
		})
	</script>
@stop
