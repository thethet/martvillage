@extends('layouts.layout')

@section('page-title')
	NRIC Code
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
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('nric-codes') }}">NRIC Code Management</a>
			</li>
			<li class="active">
				<strong>Edit Form</strong>
			</li>
		</ol>

		<h2>NRIC Code Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Edit Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($code, ['method' => 'PATCH', 'route' => ['nric-codes.update', $code->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate']) !!}

							<div class="form-group {{ $errors->has('nric_code') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">NRIC Code <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_code', null, ['placeholder' => 'NRIC Code', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>

									@if ($errors->has('nric_code'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('nric_code') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Description <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('description'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('description') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<button type="submit" class="btn btn-success">Save Changes</button>
									<button type="reset" class="btn">Reset Previous</button>
									<a href="{{ route('nric-codes.index') }}" class="btn btn-black">
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
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>
@stop
