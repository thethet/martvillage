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
				<strong>Detail Form</strong>
			</li>
		</ol>

		<h2>User Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Detail Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($user, ['method' => 'GET', 'route' => ['users.index', $user->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered']) !!}

							<div class="form-group">
								<label class="col-sm-3 control-label">Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">NRIC Number</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control', 'id' => 'nric_code', 'data-allow-clear' => 'true', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nric_township', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Date of Birth</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
										{!! Form::text('dob', null, ['placeholder' => 'Date of Birth','class' => 'form-control datepicker', 'id' => 'dob', 'data-format' => 'yyyy-mm-dd', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Contact No</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mobile"></i></span>
										{!! Form::text('contact_no', null, ['placeholder' => 'Contact Number','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Email</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mail"></i></span>
										{!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control', 'id' => 'email', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">ID Photo</label>

								<div class="col-sm-5">

									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
											@if($user->photo == null)
												<img src="http://placehold.it/200x150" alt="...">
											@else
												<img src="{{ asset('uploads/profile/'.$user->photo) }}" alt="ID PHOTO">
											@endif
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
									</div>

								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Gender</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
										{!! Form::select('gender', ['' => 'Select Gender'] + Config::get('myVars.Gender'), null, ['class' => 'form-control', 'id' => 'gender', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Marital Status</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::select('marital_status', ['' => 'Select Marital Status'] + Config::get('myVars.MaritalStatus'), null, ['class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Role</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-flow-tree"></i></span>

										@if (Auth::user()->hasRole('administrator') || Auth::user()->hasRole('owner'))
											{!! Form::select('role', ['' => 'Select Role'] + $roleList->toArray(), $userRole, ['class' => 'form-control', 'disabled']) !!}
										@else
											{!! Form::select('roles', ['' => 'Select Role'] + $roleList->toArray(), $userRole, ['class' => 'form-control', 'disabled']) !!}
											{!! Form::hidden('role', $userRole) !!}
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Position</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-users"></i></span>
										{!! Form::text('position', null, ['placeholder' => 'Position','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Username</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mail"></i></span>
										{!! Form::text('username', null, ['placeholder' => 'Username','class' => 'form-control', 'id' => 'username', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Password</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-key"></i></span>
										{!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Confirm Password</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-key"></i></span>
										{!! Form::password('confirm_password', ['placeholder' => 'Confirm Password','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Address</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::text('unit_number', null, ['placeholder' => 'Unit Number','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-home"></i></span>
										{!! Form::text('building_name', null, ['placeholder' => 'Building Name','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-address"></i></span>
										{!! Form::text('street', null, ['placeholder' => 'Street','class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Country</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('country_id', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'country_id', 'class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">State/City</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('state_id', ['' => 'Select State/City'] + $stateList->toArray(), null, ['id'=>'state_id', 'class' => 'form-control', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Township</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::select('township_id', ['' => 'Select Township'] + $townshipList->toArray(), null, ['id'=>'township_id', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
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
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>
@stop

