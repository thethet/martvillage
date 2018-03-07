@extends('layouts.layout')

@section('page-title')
	Outgoing
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
				<a href="{{ url('companies') }}">Outgoing Management</a>
			</li>
			<li class="active">
				<strong>Passenger Edit Form</strong>
			</li>
		</ol>

		<h2>Outgoing Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Passenger Edit Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($outgoing, ['method' => 'PATCH','route' => ['outgoings.update', $outgoing->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']) !!}

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
										<span class="required">
											<strong>{{ $errors->first('company_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('passenger_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Passenger Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('passenger_name', null, ['placeholder' => 'Passenger Name','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('passenger_name'))
										<span class="required">
											<strong>{{ $errors->first('passenger_name') }}</strong>
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
										<span class="required">
											<strong>{{ $errors->first('contact_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('dept_date') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Depature Date <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('dept_date', null, ['placeholder' => 'Depature Date','class' => 'form-control datepicker', 'id' => 'dept_date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('dept_date'))
										<span class="required">
											<strong>{{ $errors->first('dept_date') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('dept_time') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Depature Time</label>

								<div class="col-sm-5">
									<div class="input-group">
										{!! Form::text('dept_time', date('g:i A', strtotime($outgoing->dept_time)), ['placeholder' => 'Depature Time','class' => 'form-control timepicker', 'id' => 'dept_time', 'data-template' => 'dropdown', 'data-minute-step' => '5', 'autocomplete' => 'off']) !!}
										<div class="input-group-addon">
											<a href="#"><i class="entypo-clock"></i></a>
										</div>
									</div>
									@if ($errors->has('dept_time'))
										<span class="required">
											<strong>{{ $errors->first('dept_time') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('arrival_date') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Arrival Date <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('arrival_date', null, ['placeholder' => 'Arrival Date','class' => 'form-control datepicker', 'id' => 'arrival_date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('arrival_date'))
										<span class="required">
											<strong>{{ $errors->first('arrival_date') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('arrival_time') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Arrival Time</label>

								<div class="col-sm-5">
									<div class="input-group">
										{!! Form::text('arrival_time', date('g:i A', strtotime($outgoing->arrival_time)), ['placeholder' => 'Arrival Time','class' => 'form-control timepicker', 'id' => 'arrival_time', 'data-template' => 'dropdown', 'data-minute-step' => '5', 'autocomplete' => 'off']) !!}
										<div class="input-group-addon">
											<a href="#"><i class="entypo-clock"></i></a>
										</div>
									</div>
									@if ($errors->has('arrival_time'))
										<span class="required">
											<strong>{{ $errors->first('arrival_time') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('from_country') || $errors->has('from_city')) ? ' has-error' : '' }}">
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
										{!! Form::select('from_city', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'from_city', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('from_city'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('from_city') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('to_country') || $errors->has('to_city')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">To Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'to_country', 'autocomplete' => 'off']) !!}
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
										{!! Form::select('to_city', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'to_city', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_city'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_city') }}</strong>
										</span>
									@endif
								</div>
							</div>


							<div class="form-group {{ $errors->has('weight') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Weight <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
										{!! Form::text('weight', null, ['placeholder' => 'Weight','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('weight'))
										<span class="required">
											<strong>{{ $errors->first('weight') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('other') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Other</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('other', null, ['placeholder' => 'Other','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('other'))
										<span class="required">
											<strong>{{ $errors->first('other') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('carrier_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Carrier</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-subway"></i></span>
										{!! Form::text('carrier_name', null, ['placeholder' => 'Carrier','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('carrier_name'))
										<span class="required">
											<strong>{{ $errors->first('carrier_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('vessel_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Vessel No.</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-automobile"></i></span>
										{!! Form::text('vessel_no', null, ['placeholder' => 'Vessel No.','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('vessel_no'))
										<span class="required">
											<strong>{{ $errors->first('vessel_no') }}</strong>
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
									<a href="{{ route('outgoings.index') }}" class="btn btn-orange btn-icon">
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

			// Fetch the preselected item, and add to the control
			var companyId = $('#company_id').val();
			var countryId = $('#from_country').val();
			var fromStateId = $('#from_city').val();
			$.ajax({
				type: 'GET',
				url: "{{ url('states/search-state-country') }}",
				dataType: 'json',
				delay: 250,
				data: {
					search: '',
					companyId: companyId,
					countryId: countryId
				}
				,
			}).then(function (data) {
				console.log(data.items)
				var html = '<option value="">Select State/City</option>';
				for (var i = 0, len = data.items.length; i < len; ++i) {
					if(fromStateId == data.items[i]['id']) {
						html += '<option value="' + data.items[i]['id'] + '" selected>' + data.items[i]['text'] + '</option>';
					} else {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
				}
				$('#from_city').children().remove().end().append(html) ;
			});

			// Fetch the preselected item, and add to the control
			var companyId = $('#company_id').val();
			var countryId = $('#to_country').val();
			var fromStateId = $('#from_city').val();
			var toStateId = $('#to_city').val();
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
					if(toStateId == data.items[i]['id']) {
						html += '<option value="' + data.items[i]['id'] + '" selected>' + data.items[i]['text'] + '</option>';
					} else {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
				}
				$('#to_city').children().remove().end().append(html) ;
			});



			$("#from_country").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#from_country').val();
				var stateSelect = $('#from_city');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId
					}
					,
				}).then(function (data) {
					console.log(data.items)
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});

				$('#from_city').attr('disabled', false);
			});

			$("#from_city").change(function(event) {
				$('#to_country').attr('disabled', false);

				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#to_country').val();
				var fromStateId = $('#from_city').val();
				var stateSelect = $('#to_city');
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
			});

			$("#to_country").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#to_country').val();
				var fromStateId = $('#from_city').val();
				var stateSelect = $('#to_city');
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

				$('#to_city').attr('disabled', false);
			});
		});
	</script>
@stop

