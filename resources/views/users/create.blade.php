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
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
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
						{!! Form::open(['route' => 'users.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']) !!}

							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">NRIC Number</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control', 'id' => 'nric_code', 'data-allow-clear' => 'true']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nric_township']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('dob') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Date of Birth <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
										{!! Form::text('dob', null, ['placeholder' => 'Date of Birth','class' => 'form-control datepicker', 'id' => 'dob', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('dob'))
										<span class="validate-has-error">
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
										{!! Form::text('contact_no', null, ['placeholder' => 'Contact Number','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('contact_no'))
										<span class="validate-has-error">
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
										{!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control', 'id' => 'email', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('email'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
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
									@if ($errors->has('image'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Gender <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										{!! Form::select('gender', ['' => 'Select Gender'] + Config::get('myVars.Gender'), null, ['class' => 'form-control', 'id' => 'gender', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('gender'))
										<span class="validate-has-error">
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
										{!! Form::select('marital_status', ['' => 'Select Marital Status'] + Config::get('myVars.MaritalStatus'), null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('marital_status'))
										<span class="validate-has-error">
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
										{!! Form::select('role', ['' => 'Select Role'] + $roleList->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('role'))
										<span class="validate-has-error">
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
										{!! Form::text('position', null, ['placeholder' => 'Position','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Username <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mail"></i></span>
										{!! Form::text('username', null, ['placeholder' => 'Username','class' => 'form-control', 'id' => 'username', 'readonly' => true, 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('username'))
										<span class="validate-has-error">
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
										{!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('password'))
										<span class="validate-has-error">
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
										{!! Form::password('confirm_password', ['placeholder' => 'Confirm Password','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('confirm_password'))
										<span class="validate-has-error">
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
										{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'form-control', 'id' => 'company_id', 'autocomplete' => 'off']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control', 'id' => 'company_id']) !!}
										@endif
									</div>

									@if ($errors->has('company_id'))
										<span class="validate-has-error">
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
										{!! Form::text('unit_number', null, ['placeholder' => 'Unit Number','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-home"></i></span>
										{!! Form::text('building_name', null, ['placeholder' => 'Building Name','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-address"></i></span>
										{!! Form::text('street', null, ['placeholder' => 'Street','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Country <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('country_id', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'country_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('country_id'))
										<span class="validate-has-error">
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
										{!! Form::select('state_id', ['' => 'Select State/City'] + $stateList->toArray(), null, ['id'=>'state_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('state_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('state_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('township_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Township</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::select('township_id', ['' => 'Select Township'] + $townshipList->toArray(), null, ['id'=>'township_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('township_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('township_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<button type="submit" class="btn btn-success btn-icon">
										Save
										<i class="entypo-floppy"></i>
									</button>
									<button type="reset" class="btn btn-info btn-icon">
										Reset
										<i class="entypo-erase"></i>
									</button>
									<a href="{{ route('users.index') }}" class="btn btn-orange btn-icon">
										Back
										<i class="entypo-reply"></i>
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

	<script>
		$(document).ready(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});

			$('#state_id').attr('disabled', true);
			$('#township_id').attr('disabled', true);

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

			$("#company_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				if({{ Auth::user()->hasRole('administrator') }} == 1) {
					var companyId = {{ Auth::user()->company_id }};
				} else {
					var companyId = $('#company_id').val();
				}

				var countrySelect = $('#country_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('countries/search-by-company') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select Country</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					countrySelect.children().remove().end().append(html) ;
				});
			});


			$("#country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				if({{ Auth::user()->hasRole('administrator') }} == 1) {
					var companyId = {{ Auth::user()->company_id }};
				} else {
					var companyId = $('#company_id').val();
				}
				var countryId = $('#country_id').val();
				var stateSelect = $('#state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId,
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});
				$('#state_id').attr('disabled', false);
			});

			$("#state_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var stateId = $('#state_id').val();
				var townshipSelect = $('#township_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('townships/search-township-state') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						stateId: stateId,
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select Township</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					townshipSelect.children().remove().end().append(html) ;
				});
				$('#township_id').attr('disabled', false);
			});

		});
	</script>
@stop

