@extends('layouts.layout')

@section('page-title')
	Price
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
				<a href="{{ url('pricing-setup') }}">Pricing Setup</a>
			</li>
			<li>
				<a href="{{ url('prices') }}">Price Management</a>
			</li>
			<li class="active">
				<strong>Detail Form</strong>
			</li>
		</ol>

		<h2>Price Management</h2>
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
						{!! Form::model($price, ['method' => 'PATCH','route' => ['prices.update', $price->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate']) !!}

							<div class="form-group">
								<label class="col-sm-3 control-label">Company Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
											{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'select2', 'id' => 'company_id', 'autocomplete' => 'off', 'disabled']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Category</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
										{!! Form::select('category_id', ['' => 'Select Category'] + $categoryList->toArray(), null, ['class' => 'select2', 'id' => 'category_id', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Currency</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::select('currency_id', ['' => 'Select Currency'] + $currencyList->toArray(), null, ['class' => 'select2', 'id' => 'currency_id', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Title Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-money"></i></span>
										{!! Form::text('title_name', null, ['placeholder' => 'Title Name', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Price</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::text('unit_price', null, ['placeholder' => 'Price', 'class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">From Location</label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('from_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'from_country', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('from_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'from_state', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">To Location</label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'to_country', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('to_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'to_state', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<a href="{{ route('prices.index') }}" class="btn btn-orange btn-icon">
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
@stop

