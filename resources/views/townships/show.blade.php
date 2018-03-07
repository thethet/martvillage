@extends('layouts.layout')

@section('page-title')
	Township
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
				<a href="{{ url('townships') }}">Township Management</a>
			</li>
			<li class="active">
				<strong>Detail Form</strong>
			</li>
		</ol>

		<h2>Township Management</h2>
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
						{!! Form::model($township, ['method' => 'PATCH','route' => ['townships.update', $township->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate']) !!}

							<div class="form-group">
								<label class="col-sm-3 control-label">State/City</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('state_id', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'state_id', 'class' => 'form-control select2', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Township Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::text('township_name', null, ['placeholder' => 'Township Name', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Township Code</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-flag"></i></span>
										{!! Form::text('code', null, ['placeholder' => 'Township Code', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Description</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<a href="{{ route('townships.index') }}" class="btn btn-orange btn-icon">
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
			if (is_string($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>
@stop

