@extends('layouts.layout')

@section('page-title')
	Company
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
				<a href="{{ url('companies') }}">Company Management</a>
			</li>
			<li class="active">
				<strong>Edit Form</strong>
			</li>
		</ol>

		<h2>Company Management</h2>
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
						{!! Form::model($company, ['method' => 'PATCH','route' => ['companies.update', $company->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']) !!}

							<div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase "></i></span>
										{!! Form::text('company_name', null, ['placeholder' => 'Company Name','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('company_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('company_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('short_code') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Short Code <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-bookmarks"></i></span>
										{!! Form::text('short_code', null, ['placeholder' => 'Short Code','class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>

									@if ($errors->has('short_code'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('short_code') }}</strong>
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
										<span class="validate-has-error">
											<strong>{{ $errors->first('contact_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mail"></i></span>
										{!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control', 'id' => 'email', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('email'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('expiry_date') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Expiry Date <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('expiry_date', null, ['placeholder' => 'Expiry Date','class' => 'form-control datepicker', 'id' => 'expiry_date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('expiry_date'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('expiry_date') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Logo</label>

								<div class="col-sm-5">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
											@if($company->logo == null)
												<img src="http://placehold.it/200x150" alt="...">
											@else
												<img src="{{ asset('uploads/logos/'. $company->logo) }}" alt="ID PHOTO">
											@endif
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
										<div>
											<span class="btn btn-white btn-file">
												<span class="fileinput-new">Select image</span>
												<span class="fileinput-exists">Change</span>
												<input type="file" name="image" accept="image/*">
											</span>
											<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
										</div>
									</div>

									@if ($errors->has('image'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('return_period') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Return Period <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('return_period', null, ['placeholder' => 'Return Period','class' => 'form-control', 'autocomplete' => 'off']) !!}
										<span class="input-group-addon">Days</span>
									</div>

									@if ($errors->has('return_period'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('return_period') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('gst_rate') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">GST <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;%&nbsp;</span>
										{!! Form::text('gst_rate', null, ['placeholder' => 'GST','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('gst_rate'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('gst_rate') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('service_rate') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Service Charges <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;%&nbsp;</span>
										{!! Form::text('service_rate', null, ['placeholder' => 'Service Charges','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('service_rate'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('service_rate') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Address</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::text('unit_number', null, ['placeholder' => 'Unit Number','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-home"></i></span>
										{!! Form::text('building_name', null, ['placeholder' => 'Building Name','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-address"></i></span>
										{!! Form::text('street', null, ['placeholder' => 'Street','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Country <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('country_id', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'country_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('country_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('country_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('state_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">State/City <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('state_id', ['' => 'Select State/City'] + $stateList->toArray(), null, ['id'=>'state_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('state_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('state_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('township_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Township <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-direction"></i></span>
										{!! Form::select('township_id', ['' => 'Select Township'] + $townshipList->toArray(), null, ['id'=>'township_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('township_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('township_id') }}</strong>
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
									<a href="{{ route('companies.index') }}" class="btn btn-orange btn-icon">
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

			$("#country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var countryId = $('#country_id').val();
				var stateSelect = $('#state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						countryId: countryId
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

			$("#state_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var stateId = $('#state_id').val();
				var townshipSelect = $('#township_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('townships/search-township-state') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						stateId: stateId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select Township</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					townshipSelect.children().remove().end().append(html) ;
				});
			});

		});
	</script>
@stop

