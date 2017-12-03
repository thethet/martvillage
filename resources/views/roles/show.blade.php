@extends('layouts.layout')

@section('page-title')
	Role
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
				<a href="{{ url('roles') }}">Role Management</a>
			</li>
			<li class="active">
				<strong>Detail Form</strong>
			</li>
		</ol>

		<h2>Role Management</h2>
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
						{!! Form::model($role, ['method' => 'GET', 'route' => ['roles.index'], 'id' => 'role-form', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate']) !!}

							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									{!! Form::text('name', null, array('placeholder' => 'Name', 'class' => 'form-control', 'disabled')) !!}

									@if ($errors->has('name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Display Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									{!! Form::text('display_name', null, array('placeholder' => 'Display Name', 'class' => 'form-control', 'disabled')) !!}

									@if ($errors->has('display_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('display_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Description <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									{!! Form::textarea('description', null, array('placeholder' => 'Description', 'class' => 'form-control', 'disabled')) !!}

									@if ($errors->has('name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Permission</label>

								<div class="col-sm-9">
									@if(!empty($rolePermissions))
										@foreach($rolePermissions as $v)
											<label class="label label-success">{{ $v->display_name }}</label>
										@endforeach
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<button type="submit" class="btn btn-black">Back</button>
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

