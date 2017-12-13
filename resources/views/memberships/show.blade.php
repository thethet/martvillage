@extends('layouts.layout')

@section('page-title')
	Membership
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
				<a href="{{ url('memberships') }}">Memberships Management</a>
			</li>
			<li class="active">
				<strong>Detial Form</strong>
			</li>
		</ol>

		<h2>Memberships Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Detial Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($offer, ['method' => 'PATCH','route' => ['memberships.update', $offer->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']) !!}

							<div class="form-group">
								<label class="col-sm-3 control-label">Company Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
										{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'form-control', 'id' => 'company_id', 'autocomplete' => 'off', 'disabled']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Offer Type</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-tag"></i></span>
										{!! Form::text('type', null, ['placeholder' => 'Offer Type', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Offer Rate</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;%&nbsp;</span>
										{!! Form::text('rate', null, ['placeholder' => 'Offer Rate', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<a href="{{ route('memberships.index') }}" class="btn btn-orange btn-icon">
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
