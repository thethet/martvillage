@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/outgoing.png') }}" alt="Outgoing">
	</div>
	<div class="col-md-8 site-header">Outgoing</div>
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
				{{-- <div id='calendar' ></div> --}}
				<div class="table-cont">
					<?php
						$startDay    = date('w', strtotime($currentMonthYear));
						$daysInMonth = date('t', strtotime($currentMonthYear));
						$today       = date('d');

						$thisMonth = date('F Y');

						$previousMonth = date('F Y', strtotime('-1 month', strtotime($currentMonthYear)));
						$nextMonth     = date('F Y', strtotime('+1 month', strtotime($currentMonthYear)));

						$currentStart = $startDay;
					?>
					<table class="calendar table table-bordered table-responsive">
						<thead>
							<tr>
								<th colspan="7" class="caption">
									<a href="#" id="gopreviousMonth">
										<img class="calendar-icon" src="{{ asset('assets/img/prev.png') }}" alt="previousMonth">
									</a>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									{{ $currentMonthYear }}
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="#" id="gonextMonth">
										<img class="calendar-icon" src="{{ asset('assets/img/next.png') }}" alt="nextMonth">
									</a>
									{!! Form::hidden('prev_month', $previousMonth, ['class' => 'form-control', 'id' => 'prevMonth']) !!}
									{!! Form::hidden('next_month', $nextMonth, ['class' => 'form-control', 'id' => 'nextMonth']) !!}
								</th>
							</tr>
							<tr>
								@foreach($dayHeader as $header)
									<th>{{ $header }}</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@if($startDay == 0)
							<tr>
							@endif

							@for($j = 1; $j <= $currentStart; $j++)
							<td></td>
							@endfor

							@for($listDay = 1; $listDay <= $daysInMonth; $listDay++)
								@if($startDay == 7)
								<?php $startDay = 0; ?>
								</tr>
								@endif


								@if(array_key_exists($listDay, $outgoingPackingList))
								<td @if($listDay == $today && $currentMonthYear == $thisMonth) class="today" @elseif($startDay == 0) class="sunday" @elseif($startDay == 6) class="saturday" @endif>
									{{ $listDay }}

									@if($outgoingPackingList[$listDay]['package_date'] == $currentMonthYear)
										<span class="br-corner">
											{{ $outgoingPackingList[$listDay]['package'] }}/{{ $outgoingPackingList[$listDay]['total'] }}
										</span>
									@endif
								</td>
								@else
								<td @if($listDay == $today && $currentMonthYear == $thisMonth) class="today" @elseif($startDay == 0) class="sunday" @elseif($startDay == 6) class="saturday" @endif>
									{{ $listDay }}
								</td>
								@endif

								<?php $startDay++; ?>
							@endfor

							@for($i = $startDay; $i < 7; $i++)
							<td></td>
							@endfor

							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-lg-8 bdr mb15">
				{!! Form::open(array('route' => 'outgoings.store','method'=>'POST', 'id' => 'outgoing-form', 'class' => 'form-horizontal')) !!}
				{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
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
						{!! Form::text('contact_no', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
						@if ($errors->has('contact_no'))
							<span class="required">
								<strong>{{ $errors->first('contact_no') }}</strong>
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
						<div class="col-sm-6" style="padding: 0;">
							@if(Auth::user()->hasRole('administrator') || Auth::user()->hasRole('owner'))
								{!! Form::select('from_country', ['' => 'Country'] + $countryList->toArray(), null, ['id'=>'from_country', 'class' => 'form-control']) !!}
							@else
								{!! Form::text('from_country_name', $countryList[Auth::user()->country_id], array('class' => 'form-control', 'disabled' => true, 'id' => 'from_country_name')) !!}
								{!! Form::hidden('from_country', Auth::user()->country_id, array('class' => 'form-control')) !!}
							@endif
							@if ($errors->has('from_country'))
								<span class="required">
									<strong>{{ $errors->first('from_country') }}</strong>
								</span>
							@endif
						</div>

						<div class="col-sm-6" style="padding: 0;">
							@if(Auth::user()->hasRole('administrator') || Auth::user()->hasRole('owner'))
								{!! Form::select('from_city', ['' => 'State'] + $stateList->toArray(), null, ['id'=>'from_city', 'class' => 'form-control']) !!}
							@else
								{!! Form::text('from_city_name', $stateList[Auth::user()->state_id], array('class' => 'form-control', 'disabled' => true, 'id' => 'from_city_name')) !!}
								{!! Form::hidden('from_city', Auth::user()->state_id, array('class' => 'form-control')) !!}
							@endif
							@if ($errors->has('from_city'))
								<span class="required">
									<strong>{{ $errors->first('from_city') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<label class="control-label col-sm-2" for="to state">
						<strong>To:<span class="required">*</span></strong>
					</label>
					<div class="col-sm-4">
						<div class="col-sm-6" style="padding: 0;">
							{!! Form::select('to_country', ['' => 'Country'] + $countryList->toArray(), null, ['id'=>'to_country', 'class' => 'form-control']) !!}
							@if ($errors->has('to_country'))
								<span class="required">
									<strong>{{ $errors->first('to_country') }}</strong>
								</span>
							@endif
						</div>

						<div class="col-sm-6" style="padding: 0;">
							{!! Form::select('to_city', ['' => 'State'] + $stateList->toArray(), null, ['id'=>'to_city', 'class' => 'form-control']) !!}
							@if ($errors->has('to_city'))
								<span class="required">
									<strong>{{ $errors->first('to_city') }}</strong>
								</span>
							@endif
						</div>
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

				<div class="form-group" style="margin-bottom: 21px; margin-top: 10px;">
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
						<a href="#" id="add" onclick="document.getElementById('outgoing-form').submit();">
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

					<tbody>
						<?php $no = 1; ?>
						@foreach($outgoingList as $outgoing)
							<tr>
								<td>{{ $no++ }}</td>
								<td>
									{!! Form::checkbox('edit', $outgoing->id, null, ['class' => 'editboxes']) !!}
								</td>
								<td>{{ $outgoing->passenger_name }}</td>
								<td>{{ $outgoing->contact_no }}</td>
								<td>{{ $outgoing->fromCity->state_name }}</td>
								<td>{{ $outgoing->toCity->state_name }}</td>
								<td>{{ $outgoing->weight }}</td>
								<td>{{ $outgoing->carrier_name }}</td>
								<td>{{ $outgoing->vessel_no }}</td>
								<td>{{ $outgoing->dept_date }} [ {{ date('H:i A', strtotime($outgoing->time)) }} ]</td>
								<td>
									<a href="{{ url('outgoings/'. $outgoing->id .'/packing-list') }}">
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

			@permission('outgoing-create')
				<div class="menu-icon">
					<a href="#" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			{{-- @permission('outgoing-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			{{-- @permission('outgoing-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			<div class="menu-icon">
				<a href="#" id="reset" onclick="document.getElementById('outgoing-form').reset();">
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

	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> --}}
	{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> --}}
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

			$("#outgoing-form :input").prop("disabled", true);

			$("#add-item").on("click",function(){
				$("#outgoing-form :input").prop("disabled", false);
				$('#from_country_name').prop("disabled", true);
				$('#from_city_name').prop("disabled", true);
			});


			$('#timepicker').timepicker({
				minuteStep: 5
			});

			/*$('#calendar').fullCalendar({
				theme: true,
				header: {
					left: 'prev,next,today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				}
			});*/

			$("#from_country").select2();

			$("#from_city").select2({
				ajax: {
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var countryId = $('#from_country').val();
						return {
							search: params.term,
							countryId: countryId
						};
					},
					processResults: function (data, params) {
						return {
							results: data.items
						};
					},
					cache: true
				},
			});


			$("#to_country").select2();

			$("#to_city").select2({
				ajax: {
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var countryId = $('#to_country').val();
						return {
							search: params.term,
							countryId: countryId
						};
					},
					processResults: function (data, params) {
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$("#edit").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{{ url('outgoings/ajax/id/edit') }}",
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

			/*$("#delete").on("click",function(){
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

			$("#gopreviousMonth").on("click",function(){
				var calendarDate = $('#prevMonth').val();
				var url = "{{ url('outgoings/calendar') }}";
				$.ajax({
					url: url,
					type: 'GET',
					data: {
						calendarDate: calendarDate,
						// mode: 'edit'
					},
					success: function(data)
					{
						window.location.replace(data.url);
					}
				});
			});


			$("#gonextMonth").on("click",function(){
				var calendarDate = $('#nextMonth').val();
				var url = "{{ url('outgoings/calendar') }}";
				$.ajax({
					url: url,
					type: 'GET',
					data: {
						calendarDate: calendarDate,
						// mode: 'edit'
					},
					success: function(data)
					{
						window.location.replace(data.url);
					}
				});
			});
		});
	</script>
@stop
