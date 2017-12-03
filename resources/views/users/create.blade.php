@extends('layouts.layout')

@section('page-title')
	User
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('users') }}">User Management</a>
			</li>
			<li class="active">
				<strong>New Create Form</strong>
			</li>
		</ol>

		<h2>User Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>New Create Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::open(array('route' => 'users.store','method'=>'POST', 'id' => 'user-form', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')) !!}

							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
									</div>

									@if ($errors->has('name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">NRIC Number <span class="text-danger">*</span></label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodes->toArray(), null, ['class' => 'form-control', 'id' => 'nric_code', 'data-allow-clear' => 'true']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownships->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nric_township']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_no', null, array('placeholder' => '(N) xxxxxx','class' => 'form-control')) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Date of Birth <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('dob', null, array('placeholder' => 'Date of Birth','class' => 'form-control datepicker', 'id' => 'dob', 'data-format' => 'yyyy-mm-dd')) !!}
									</div>

									@if ($errors->has('dob'))
										<span class="required">
											<strong>{{ $errors->first('dob') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('contact_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Contact No <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mobile"></i></span>
										{!! Form::text('contact_no', null, array('placeholder' => 'Contact Number','class' => 'form-control')) !!}
									</div>

									@if ($errors->has('contact_no'))
										<span class="required">
											<strong>{{ $errors->first('contact_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mail"></i></span>
										{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'id' => 'email')) !!}
									</div>

									@if ($errors->has('email'))
										<span class="required">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">ID Photo</label>

								<div class="col-sm-5">

									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
											<img src="http://placehold.it/200x150" alt="...">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
										<div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="image" accept="image/*">
											</span>
											<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
										</div>
									</div>

								</div>
							</div>

							<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Gender <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										{!! Form::select('gender', ['' => 'Select Gender'] + Config::get('myVars.Gender'), null, ['class' => 'form-control', 'id' => 'gender']) !!}
									</div>

									@if ($errors->has('gender'))
										<span class="required">
											<strong>{{ $errors->first('gender') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('marital_status') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Marital Status <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::select('marital_status', ['' => 'Select Marital Status'] + Config::get('myVars.MaritalStatus'), null, ['class' => 'form-control']) !!}
									</div>

									@if ($errors->has('marital_status'))
										<span class="required">
											<strong>{{ $errors->first('marital_status') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Role <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-flow-tree"></i></span>
										{!! Form::select('role', ['' => 'Select Role'] + $roles->toArray(), null, ['class' => 'form-control']) !!}
									</div>

									@if ($errors->has('role'))
										<span class="required">
											<strong>{{ $errors->first('role') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Position</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-users"></i></span>
										{!! Form::text('position', null, array('placeholder' => 'Position','class' => 'form-control')) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mail"></i></span>
										{!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control', 'id' => 'username', 'readonly' => true)) !!}
									</div>

									@if ($errors->has('username'))
										<span class="required">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-key"></i></span>
										{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
									</div>

									@if ($errors->has('password'))
										<span class="required">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Confirm Password <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-key"></i></span>
										{!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
									</div>

									@if ($errors->has('confirm_password'))
										<span class="required">
											<strong>{{ $errors->first('confirm_password') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
										{!! Form::select('company_id', ['' => 'Select Company'] + $companies->toArray(), null, ['class' => 'form-control', 'id' => 'company_id']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'readonly' => true]) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
										@endif
									</div>

									@if ($errors->has('company_id'))
										<span class="required">
											<strong>{{ $errors->first('company_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Address</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::text('unit_number', null, array('placeholder' => 'Unit Number','class' => 'form-control')) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-home"></i></span>
										{!! Form::text('building_name', null, array('placeholder' => 'Building Name','class' => 'form-control')) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-address"></i></span>
										{!! Form::text('street', null, array('placeholder' => 'Street','class' => 'form-control')) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Country <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'country_id', 'class' => 'form-control']) !!}
									</div>

									@if ($errors->has('country_id'))
										<span class="required">
											<strong>{{ $errors->first('country_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('state_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">State/City <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('state_id', ['' => 'Select State/City'] + $states->toArray(), null, ['id'=>'state_id', 'class' => 'form-control']) !!}
									</div>

									@if ($errors->has('state_id'))
										<span class="required">
											<strong>{{ $errors->first('state_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn">Reset</button>
									<a href="{{ route('users.index') }}" class="btn btn-black">
										Back
									</a>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>


		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

@section('my-script')
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{ asset('assets/js/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('assets/js/fileinput.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<script>
		$(document).ready(function(){
			$("#email").keyup(function(event) {
				var email = $("#email").val();
				$("#username").val(email);
			});

			$("#email").focusout(function(){
				var email = $("#email").val();
				$("#username").val(email);
			});

			$("#nric_code").change(function(event) {
				// Fetch the preselected item, and add to the control
				var nricCodeId = $('#nric_code').val();
				var nricTwnSelect = $('#nric_township');
				$.ajax({
					type: 'GET',
					url: "{{ url('nrictownships/nric-township') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						nricCodeId: nricCodeId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Township</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					nricTwnSelect.children().remove().end().append(html) ;
				});
			});

			$("#country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var countryId = $('#country_id').val();
				var stateSelect = $('#state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						countryId: countryId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});
			});

		});
	</script>
@stop

