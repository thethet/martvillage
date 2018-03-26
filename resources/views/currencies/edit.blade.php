@extends('layouts.layout')

@section('page-title')
	Currency
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
				<a href="{{ url('currencies') }}">Currency Management</a>
			</li>
			<li class="active">
				<strong>Edit Form</strong>
			</li>
		</ol>

		<h2>Currency Management</h2>
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
						{!! Form::model($currency, ['method' => 'PATCH','route' => ['currencies.update', $currency->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate']) !!}

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
											{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'select2', 'id' => 'company_id', 'autocomplete' => 'off', 'disabled']) !!}
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

							<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Currency Type <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="fa fa-money"></i></span>
										{!! Form::text('type', null, ['placeholder' => 'Currency Type', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('type'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('type') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('from_location') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Country <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('from_location', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'from_location', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('from_location'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('from_location') }}</strong>
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
									<a href="{{ route('currencies.index') }}" class="btn btn-orange btn-icon">
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

			// Fetch the preselected item, and add to the control
			var companyId = $('#company_id').val();
			var fromCountryId = $('#from_location').val();
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
					if(fromCountryId == data.items[i]['id']) {
						html += '<option value="' + data.items[i]['id'] + '" selected>' + data.items[i]['text'] + '</option>';
					} else {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
				}
				$('#from_location').children().remove().end().append(html) ;
			});
		});
	</script>
@stop

