@extends('layouts.layout')

@section('page-title')
	Incoming
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong>Incoming Management</strong>
			</li>
		</ol>

		<h2>Incoming Management</h2>
		<br />

		{!! Form::open(array('route' => 'incomings.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

			<div class="form-group">
				<label class="col-sm-2  control-label">&nbsp;</label>

				<div class="col-sm-3">
					&nbsp;
				</div>

				<label class="col-sm-2  control-label">Arrival Date</label>
				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
						</div>
						{!! Form::text('arrival_date', null, ['placeholder' => 'Arrival Date','class' => 'form-control datepicker', 'id' => 'arrival_date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="col-sm-2">
					<div class="input-group minimal">
						<button type="submit" class="btn btn-blue btn-icon">
							Search
							<i class="entypo-search"></i>
						</button>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
		<br />

		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $p + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $p + $perPage }} @endif of {{ $total }} entries
				</div>

				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body with-table">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Name</th>
							<th>Contact No.</th>
							<th>From Location</th>
							<th>To Location</th>
							<th>Weight</th>
							<th>Carrier</th>
							<th>Vessel No.</th>
							<th>Depature Time</th>
							<th>Arrival Time</th>
							@if(Auth::user()->hasRole('administrator'))
							<th>Company Name</th>
							@endif
							<th>Package List</th>
						</tr>
					</thead>
					<tbody>
						@foreach($outgoingList as $outgoing)
						<tr>
							<td>{{ ++$p }}</td>
							<td>{{ $outgoing->passenger_name }}</td>
							<td>{{ $outgoing->contact_no }}</td>
							<td>{{ $outgoing->fromCity->state_name }}</td>
							<td>{{ $outgoing->toCity->state_name }}</td>
							<td>{{ $outgoing->weight }}</td>
							<td>{{ $outgoing->carrier_name }}</td>
							<td>{{ $outgoing->vessel_no }}</td>
							<td>{{ $outgoing->dept_date }} [ {{ date('g:i A', strtotime($outgoing->dept_time)) }} ]</td>
							<td>
								{{ $outgoing->arrival_date }} [ {{ date('g:i A', strtotime($outgoing->arrival_time)) }} ]
							</td>
							@if(Auth::user()->hasRole('administrator'))
							<td>
								{{ $companyList[$outgoing->company_id] }}
							</td>
							@endif
							<td>
								<a href="{{ url('incomings/'. $outgoing->id) }}" class="btn btn-green btn-icon btn-sm text-white">
									<b>{{ $outgoing->packing_list }}</b>
									<i class="entypo-archive"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $outgoingList->render() !!}
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
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<style>
		.text-white {
			color: #fff !important;
		}

		.text-danger {
			color: #f00 !important;
		}

		.text-primary {
			color: #0275d8 !important;
		}

		.text-warning {
			color: #f0ad4e !important;
		}

		.text-success {
			color: #5cb85c !important
		}

		.bg-danger {
			background: #B22222 !important;
		}

		.bg-default {
			background: grey !important;
		}

		.bg-warning {
			background-color: #f0ad4e !important;
		}

		.bg-primary {
			background-color: #0275d8 !important;
		}

		td {
			cursor: pointer;
		}
	</style>

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('incomings/"+ id +"') !!}",
						type: 'DELETE',
						data: {_token: '{!! csrf_token() !!}'},
						dataType: 'JSON',
						success: function (data) {
							window.location.replace(data.url);
						}
					});
				}
			});

			$("#gopreviousMonth").on("click",function(){
				var calendarDate = $('#prevMonth').val();
				var url = "{{ url('incomings/calendar') }}";
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
				var url = "{{ url('incomings/calendar') }}";
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

		function searchByDay(sday) {

			var url = "{{ url('incomings/searchbyday') }}";
			$.ajax({
				url: url,
				type: 'GET',
				data: {
					searchDay: sday,
					// mode: 'edit'
				},
				success: function(data)
				{
					window.location.replace(data.url);
				}
			});
		}
	</script>
@stop

