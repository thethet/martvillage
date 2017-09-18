@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/lot-in.png') }}" alt="Lot-in">
	</div>
	<div class="col-md-8 site-header">Lot-in</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			<div class="col-lg-4">
				<div id='calendar'></div>
			</div>

			<div class="col-lg-8 bdr mb15">
				{!! Form::open(array('route' => 'outgoings.store','method'=>'POST', 'id' => 'outgoing-form', 'class' => 'form-horizontal')) !!}
				<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
					<label class="control-label col-sm-2" for="name">
						<strong>Name:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('passenger_name', null, array('placeholder' => 'Passenger Name','class' => 'form-control')) !!}
						@if ($errors->has('passenger_name'))
							<span class="required">
								<strong>{{ $errors->first('passenger_name') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
					<label class="control-label col-sm-2" for="phone">
						<strong>Phone:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
						@if ($errors->has('phone'))
							<span class="required">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
						@endif
					</div>

					<label class="control-label col-sm-2" for="date">
						<strong>Dept Date:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('dept_date', null, array('placeholder' => 'Depature Date','class' => 'form-control')) !!}
						@if ($errors->has('dept_date'))
							<span class="required">
								<strong>{{ $errors->first('dept_date') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
					<label class="control-label col-sm-2" for="from state">
						<strong>From:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::select('from_state', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'from_state', 'class' => 'form-control']) !!}
						@if ($errors->has('from_state'))
							<span class="required">
								<strong>{{ $errors->first('from_state') }}</strong>
							</span>
						@endif
					</div>

					<label class="control-label col-sm-2" for="to state">
						<strong>To:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::select('to_state', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'to_state', 'class' => 'form-control']) !!}
						@if ($errors->has('to_state'))
							<span class="required">
								<strong>{{ $errors->first('to_state') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
					<label class="control-label col-sm-2" for="weight">
						<strong>Weight:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('weight', null, array('placeholder' => 'Weight','class' => 'form-control')) !!}
						@if ($errors->has('weight'))
							<span class="required">
								<strong>{{ $errors->first('weight') }}</strong>
							</span>
						@endif
					</div>

					<label class="control-label col-sm-2" for="other">
						<strong>Other:</strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('other', null, array('placeholder' => 'Other','class' => 'form-control')) !!}
						@if ($errors->has('other'))
							<span class="required">
								<strong>{{ $errors->first('other') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
					<label class="control-label col-sm-2" for="carrier">
						<strong>Carrier:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('carrier', null, array('placeholder' => 'Carrier','class' => 'form-control')) !!}
						@if ($errors->has('carrier'))
							<span class="required">
								<strong>{{ $errors->first('carrier') }}</strong>
							</span>
						@endif
					</div>

					<label class="control-label col-sm-2" for="vessel">
						<strong>Vessel No.:</strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('vessel_no', null, array('placeholder' => 'Vessel No.','class' => 'form-control')) !!}
						@if ($errors->has('vessel_no'))
							<span class="required">
								<strong>{{ $errors->first('vessel_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
					<label class="control-label col-sm-2" for="time">
						<strong>Time:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						{!! Form::text('time', null, array('placeholder' => 'Depature Time','class' => 'form-control', 'id' => 'timepicker')) !!}
						@if ($errors->has('time'))
							<span class="required">
								<strong>{{ $errors->first('time') }}</strong>
							</span>
						@endif
					</div>
					<label class="control-label col-sm-4" for="button"></label>
					<div class="col-sm-2">
						<a href="#" id="add" onclick="document.getElementById('currency-form').submit();">
							<div class="addbtn">
								<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
									Add
							</div>
						</a>
					</div>
				</div><!-- .form-group -->


				{!! Form::close() !!}
			</div>
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
							<th width="8px">&nbsp</th>
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

			@permission('lotin-create')
				<div class="menu-icon">
					<a href="#" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('lotin-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="#" id="delete">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('lotin-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->
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

	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
	{{-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
	{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/> --}}


	<script>
		$(document).ready(function(){
			var date_input=$('input[name="dept_date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});

			$('#timepicker').timepicker({
				minuteStep: 5
			});

			$('#calendar').fullCalendar({
				theme: true,
				header: {
					left: 'prev,next,today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				}
			});

			$("#from_state").select2();

			$("#to_state").select2();

			/*$("#edit").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{{ url('prices/ajax/id/edit') }}",
							type: 'GET',
							data: {
								id: id,
								mode: 'edit'
							},
							success: function(data)
							{
								window.location.replace(data.url);
							}
						});
					}
				});
			});

			$("#delete").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{!! url('prices/"+ id +"') !!}",
							type: 'DELETE',
							data: {_token: '{!! csrf_token() !!}'},
							dataType: 'JSON',
							success: function (data) {
								window.location.replace(data.url);
							}
						});
					}
				});
			});*/
		});
	</script>
@stop
