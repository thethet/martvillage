@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/incoming.png') }}" alt="Incoming">
	</div>
	<div class="col-md-8 site-header">Incoming</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			{!! Form::open(array('route' => 'companies.store','method'=>'POST', 'id' => 'company-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
			<div class="form-group">
				<label class="control-label col-sm-2" for="date">
					<strong>Dept Date:<span class="required">*</span></strong>
				</label>
				<div class="col-sm-2">
					{!! Form::text('dept_date', null, array('placeholder' => 'Depature Date','class' => 'form-control')) !!}
					@if ($errors->has('dept_date'))
						<span class="required">
							<strong>{{ $errors->first('dept_date') }}</strong>
						</span>
					@endif
				</div>

				<label class="control-label col-sm-1" for="date"></label>

				<label class="control-label col-sm-2" for="time">
					<strong>Time:<span class="required">*</span></strong>
				</label>
				<div class="col-sm-2">
					{!! Form::text('time', null, array('placeholder' => 'Depature Time','class' => 'form-control', 'id' => 'timepicker')) !!}
					@if ($errors->has('time'))
						<span class="required">
							<strong>{{ $errors->first('time') }}</strong>
						</span>
					@endif
				</div>
				<label class="control-label col-sm-2" for="button"></label>
				<div class="col-sm-1">
					<a href="#" id="add" onclick="document.getElementById('outgoing-form').submit();">
						<div class="addbtn">
							<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
								Add
						</div>
					</a>
				</div>
			</div><!-- .form-group -->

			<div class="form-group"></div>
			{!! Form::close() !!}
		</div>

		<div class="row">
			<div class="table-cont">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th colspan="11" class="center">Passenger List</th>
						</tr>
						<tr>
							<th width="8px">No</th>
							{{-- <th width="8px">&nbsp</th> --}}
							<th>Name</th>
							<th>Phone</th>
							<th>From City</th>
							<th>To City</th>
							<th>Weight</th>
							<th>Carrier</th>
							<th>Vessel No.</th>
							<th>Time</th>
							<th>Package List</th>
						</tr>
					</thead>

					<tbody>
						<?php $no = 1; ?>
						@foreach($outgoingList as $outgoing)
							<tr>
								<td>{{ $no++ }}</td>
								{{-- <td>
									{!! Form::checkbox('edit', $outgoing->id, null, ['class' => 'editboxes']) !!}
								</td> --}}
								<td>{{ $outgoing->passenger_name }}</td>
								<td>{{ $outgoing->contact_no }}</td>
								<td>{{ $outgoing->from_city }}</td>
								<td>{{ $outgoing->to_city }}</td>
								<td>{{ $outgoing->weight }}</td>
								<td>{{ $outgoing->carrier_name }}</td>
								<td>{{ $outgoing->vessel_no }}</td>
								<td>{{ $outgoing->dept_date }} [ {{ date('H:i A', strtotime($outgoing->time)) }} ]</td>
								<td>
									<a href="{{ url('incomings/'. $outgoing->id) }}">
										{{ $outgoing->packing_list }}
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			{{-- @permission('outgoing-create')
				<div class="menu-icon">
					<a href="#" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('outgoing-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('outgoing-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="#" id="reset" onclick="document.getElementById('outgoing-form').reset();">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon --> --}}

			<div class="menu-icon">
				<a href="{{ url('dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			{{-- <div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('lotin-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon --> --}}
		</div>
	</div><!-- .footer-menu -->
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.js') }}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"/>

	<script>
		$(document).ready(function(){
			$('#timepicker').timepicker({
				minuteStep: 5
			});
		});
	</script>
@stop