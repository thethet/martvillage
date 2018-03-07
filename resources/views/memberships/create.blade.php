@extends('layouts.layout')

@section('page-title')
	Memberships
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
				<a href="{{ url('memberships') }}">Memberships Management</a>
			</li>
			<li class="active">
				<strong>New Create Form</strong>
			</li>
		</ol>

		<h2>Memberships Management</h2>
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
						{!! Form::open(array('route' => 'memberships.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
										{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'form-control select2', 'id' => 'company_id', 'autocomplete' => 'off']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
										@endif
									</div>

									@if ($errors->has('company_id'))
										<span class="required">
											<strong>{{ $errors->first('company_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Offer Type <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-tag"></i></span>
										{!! Form::text('type', null, ['placeholder' => 'Offer Type', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('type'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('type') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('rate') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Offer Rate <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;%&nbsp;</span>
										{!! Form::text('rate', null, ['placeholder' => 'Offer Rate', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('rate'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('rate') }}</strong>
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
		});
	</script>
@stop

