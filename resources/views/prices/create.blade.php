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
				<strong>New Create Form</strong>
			</li>
		</ol>

		<h2>Price Management</h2>
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
						{!! Form::open(array('route' => 'prices.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
											{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'select2', 'id' => 'company_id', 'autocomplete' => 'off']) !!}
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

							<div class="form-group {{ $errors->has('from_country') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">From Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('from_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'from_country', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('from_country'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('from_country') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('from_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'from_state', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('from_state'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('from_state') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('to_country') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">To Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control' select2, 'id' => 'to_country', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_country'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_country') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('to_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'to_state', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_state'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_state') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Category <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
										{!! Form::select('category_id', ['' => 'Select Category'] + $categoryList->toArray(), null, ['class' => 'select2', 'id' => 'category', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('category_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('category_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('currency_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Currency <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::select('currency_id', ['' => 'Select Currency'] + $currencyList->toArray(), null, ['class' => 'select2', 'id' => 'currency_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('currency_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('currency_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('title_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Title Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-money"></i></span>
										{!! Form::text('title_name', null, ['placeholder' => 'Title Name', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('title_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('title_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('unit_price') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Price <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::text('unit_price', null, ['placeholder' => 'Price', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('unit_price'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('unit_price') }}</strong>
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

	<script>
		$(document).ready(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});

			// Fetch the preselected item, and add to the control
			var companyId = $('#company_id').val();
			var countrySelect = $('#from_country');
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

			$('#from_state').attr('disabled', true);
			$('#to_country').attr('disabled', true);
			$('#to_state').attr('disabled', true);
			$('#currency_id').attr('disabled', true);

			$("#company_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countrySelect = $('#from_country');
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
				$('#from_state').attr('disabled', true);
				$('#currency_id').attr('disabled', true);
			});

			$("#from_country").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#from_country').val();
				var stateSelect = $('#from_state');
				var currencySelect = $('#currency_id');
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
				$('#from_state').attr('disabled', false);
				$('#currency_id').attr('disabled', false);

				$.ajax({
					type: 'GET',
					url: "{{ url('currencies/search-by-from-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						countryId: countryId,
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select Currency</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					currencySelect.children().remove().end().append(html) ;
				});
			});

			$("#from_state").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#to_country').val();
				var fromStateId = $('#from_state').val();
				var stateSelect = $('#to_state');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId,
						fromStateId: fromStateId,
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});

				$('#to_country').attr('disabled', false);
			});

			$("#to_country").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#to_country').val();
				var fromStateId = $('#from_state').val();
				var stateSelect = $('#to_state');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId,
						fromStateId: fromStateId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});

				$('#to_state').attr('disabled', false);
			});
		});
	</script>
@stop

