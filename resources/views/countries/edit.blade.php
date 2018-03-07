@extends('layouts.layout')

@section('page-title')
	Country
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3">
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="#">Location</a>
			</li>
			<li>
				<a href="{{ url('countries') }}">Country Management</a>
			</li>
			<li class="active">
				<strong>Edit Form</strong>
			</li>
		</ol>

		<h2>Country Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Edit Create Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($country, ['method' => 'PATCH','route' => ['countries.update', $country->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate']) !!}

							<div class="form-group {{ $errors->has('country_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Country Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::text('country_name', null, ['placeholder' => 'Country Name', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('country_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('country_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('country_code') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Country Code <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-flag"></i></span>
										{!! Form::text('country_code', null, ['placeholder' => 'Country Code', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('country_code'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('country_code') }}</strong>
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
									<button type="submit" class="btn btn-success btn-icon">
										Save Changes
										<i class="entypo-floppy"></i>
									</button>
									<button type="reset" class="btn btn-info btn-icon">
										Reset Previous
										<i class="entypo-erase"></i>
									</button>
									<a href="{{ route('countries.index') }}" class="btn btn-orange btn-icon">
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
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
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

