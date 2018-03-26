@extends('layouts.layout')

@section('page-title')
	NRIC Township
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
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('nric-townships') }}">NRIC Township Management</a>
			</li>
			<li class="active">
				<strong>New Create Form</strong>
			</li>
		</ol>

		<h2>NRIC Township Management</h2>
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
						{!! Form::open(array('route' => 'nric-townships.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

							<div class="form-group {{ $errors->has('nric_code_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">NRIC Code <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_code_id', ['' => 'Select NRIC Code'] + $nricCodeList->toArray(), null, ['class' => 'select2', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('nric_code_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('nric_code_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('township') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Township <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::text('township', null, ['placeholder' => 'Township', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('township'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('township') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('short_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Township Short Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('short_name', null,['placeholder' => 'Township Short Name', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('short_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('short_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('serial_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Serial Number <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('serial_no', null, ['placeholder' => 'Serial Number', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('serial_no'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('serial_no') }}</strong>
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
									<a href="{{ route('nric-townships.index') }}" class="btn btn-orange btn-icon">
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
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});
		});
	</script>
@stop

