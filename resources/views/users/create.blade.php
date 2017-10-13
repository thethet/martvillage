@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/profile.png') }}" alt="Profile">
	</div>
	<div class="col-md-8 site-header">User Profile</div>
@stop

@section('main')
{!! Form::open(array('route' => 'users.store','method'=>'POST', 'id' => 'user-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
	<div class="main-content">
		<div class="small-10 columns">
			<p><b><span class="required">*</span> Fields are required</b></p>
		</div>

		<div class="row">
			<div class="col col-md-7">
				<div class="form-group">
					<label class="control-label col-sm-3" for="name"><strong>Name: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::text('name', null, array('placeholder' => 'Please Enter Name','class' => 'form-control')) !!}
						@if ($errors->has('name'))
							<span class="required">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="nric"><strong>NRIC Number:</strong></label>
					<div class="col-sm-8">
						<div class="col-sm-3" style="padding-left: 0;">
							{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodes->toArray(), null, ['class' => 'form-control', 'id' => 'nric_code']) !!}
							@if ($errors->has('nric_code_id'))
								<span class="required">
									<strong>{{ $errors->first('nric_code_id') }}</strong>
								</span>
							@endif
						</div>

						<div class="col-sm-3" style="padding-left: 0;">
							{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownships->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nric_township']) !!}
							@if ($errors->has('nric_township_id'))
								<span class="required">
									<strong>{{ $errors->first('nric_township_id') }}</strong>
								</span>
							@endif
						</div>

						<div class="col-sm-5" style="padding-left: 0;">
							{!! Form::text('nric_no', null, array('placeholder' => '(N) xxxxxx','class' => 'form-control')) !!}
							@if ($errors->has('nric_no'))
								<span class="required">
									<strong>{{ $errors->first('nric_no') }}</strong>
								</span>
							@endif
						</div>
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="dob"><strong>Date of Birth: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::text('dob', null, array('placeholder' => 'Please Enter Date of Birth','class' => 'form-control', 'id' => 'dob')) !!}
						@if ($errors->has('dob'))
							<span class="required">
								<strong>{{ $errors->first('dob') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="contact-no"><strong>Contact No.: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::text('contact_no', null, array('placeholder' => 'Please Enter Contact Number','class' => 'form-control')) !!}
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
						{!! Form::text('email', null, array('placeholder' => 'Please Enter Email','class' => 'form-control', 'id' => 'email')) !!}
						@if ($errors->has('email'))
							<span class="required">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="email"><strong>ID Photo:</strong></label>
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
				{{-- <div class="photobox">
					<img src="{{ asset('assets/img/msct_logo.jpg') }}" alt="Company Logo">
				</div> --}}

				<div class="photobox">
					ID PHOTO
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col col-md-7">
				<div class="form-group">
					<label class="control-label col-sm-3" for="gender"><strong>Gender: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::select('gender', ['' => 'Select Gender'] + Config::get('myVars.Gender'), null, ['class' => 'form-control']) !!}
						@if ($errors->has('gender'))
							<span class="required">
								<strong>{{ $errors->first('gender') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="marital"><strong>Marital Status: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::select('marital_status', ['' => 'Select Marital Status'] + Config::get('myVars.MaritalStatus'), null, ['class' => 'form-control']) !!}
						@if ($errors->has('marital_status'))
							<span class="required">
								<strong>{{ $errors->first('marital_status') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="role"><strong>Role: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::select('role', ['' => 'Select Role'] + $roles->toArray(), null, ['class' => 'form-control']) !!}
						@if ($errors->has('role'))
							<span class="required">
								<strong>{{ $errors->first('role') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="position"><strong>Position:</strong></label>
					<div class="col-sm-6">
						{!! Form::text('position', null, array('placeholder' => 'Please Enter Position','class' => 'form-control')) !!}
						@if ($errors->has('position'))
							<span class="required">
								<strong>{{ $errors->first('position') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="username"><strong>Username: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::text('username', null, array('placeholder' => 'Please Enter Username','class' => 'form-control', 'id' => 'username', 'readonly' => true)) !!}
						@if ($errors->has('username'))
							<span class="required">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="password"><strong>Password: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::password('password', array('placeholder' => 'Please Enter Password','class' => 'form-control')) !!}
						@if ($errors->has('password'))
							<span class="required">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label style="padding-right: 0;" class="control-label col-sm-3" for="confirm-password"><strong>Confirm Password: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						{!! Form::password('confirm_password', array('placeholder' => 'Please Enter Confirm Password','class' => 'form-control')) !!}
						@if ($errors->has('confirm_password'))
							<span class="required">
								<strong>{{ $errors->first('confirm_password') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="company"><strong>Company Name: <span class="required">*</span></strong></label>
					<div class="col-sm-6">
						@if(Auth::user()->hasRole('administrator'))
							{!! Form::select('company_id', ['' => 'Select Company'] + $companies->toArray(), null, ['class' => 'form-control', 'id' => 'company_id']) !!}
							@if ($errors->has('company_id'))
								<span class="required">
									<strong>{{ $errors->first('company_id') }}</strong>
								</span>
							@endif
						@else
							{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'readonly' => true]) !!}
							{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
						@endif
					</div>
				</div><!-- .form-group -->
			</div>

			<div class="col-sm-5">
				<div class="form-group">
					<label class="control-label col-sm-5" for="address"><strong>Address</strong></label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="unit number"><strong>Unit Number:</strong></label>
					<div class="col-sm-7">
						{!! Form::text('unit_number', null, array('placeholder' => 'Please Enter Unit Number','class' => 'form-control')) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="building"><strong>Building Name:</strong></label>
					<div class="col-sm-7">
						{!! Form::text('building_name', null, array('placeholder' => 'Please Enter Building Name','class' => 'form-control')) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="street"><strong>Street:</strong></label>
					<div class="col-sm-7">
						{!! Form::text('street', null, array('placeholder' => 'Please Enter Street','class' => 'form-control')) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="country"><strong>Country:</strong></label>
					<div class="col-sm-7">
						{!! Form::select('country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'country_id', 'class' => 'form-control']) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="state"><strong>State:</strong></label>
					<div class="col-sm-7">
						{!! Form::select('state_id', ['' => 'Select State'] + $states->toArray(), null, ['id'=>'state_id', 'class' => 'form-control']) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="township"><strong>Township:</strong></label>
					<div class="col-sm-7">
						{!! Form::select('township_id', ['' => 'Select Township'] + $townships->toArray(), null, ['id'=>'township_id', 'class' => 'form-control']) !!}
					</div>
				</div><!-- .form-group -->
			</div>
		</div>
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
				<a href="#" id="reset" onclick="document.getElementById('user-form').reset();">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('users.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('user-form').submit();">
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
			var date_input=$('input[name="dob"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});

			$("#email").keyup(function(event) {
				var email = $("#email").val();
				$("#username").val(email);
			});

			$("#nric_code").select2();

			$("#nric_township").select2({
				ajax: {
					url: "{{ url('nrictownships/nric-township') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var nricCodeId = $('#nric_code').val();
						return {
							search: params.term,
							nricCodeId: nricCodeId
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

			$("#company_id").select2();
		});
	</script>
@stop
