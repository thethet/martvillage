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
			<li class="active">
				<strong>Outgoing Management</strong>
			</li>
		</ol>

		<h2>Outgoing Management</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		<br />
		<div class="row">
			<div class="col-lg-4">
				{{-- <div id='calendar' ></div> --}}
				<div class="table-cont">
					<?php
						$curY = date('Y', strtotime($currentMonthYear));
						$curM = date('m', strtotime($currentMonthYear));
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
								<th colspan="7" class="text-white text-center bg-danger">
									<div class="icon-el col-md-3 col-sm-4">
										<a href="#" id="gopreviousMonth" class="text-white">
											<i class="fa fa-chevron-circle-left"></i>
										</a>
									</div>

									<div class="icon-el col-md-6 col-sm-4">
										<a href="#" id="gocurrentMonth" class="text-white">
											<b>{{ $currentMonthYear }}</b>
										</a>
									</div>
									<div class="icon-el col-md-3 col-sm-4">
										<a href="#" id="gonextMonth" class="text-white">
											<i class="fa fa-chevron-circle-right"></i>
										</a>
									</div>
									{!! Form::hidden('prev_month', $previousMonth, ['class' => 'form-control', 'id' => 'prevMonth']) !!}
									{!! Form::hidden('next_month', $nextMonth, ['class' => 'form-control', 'id' => 'nextMonth']) !!}
									{!! Form::hidden('current_month', $currentMonthYear, ['class' => 'form-control', 'id' => 'currentMonth']) !!}
								</th>
							</tr>
							<tr>
								@foreach($dayHeader as $header)
									<th  class="text-white text-center bg-danger"><b>{{ $header }}</b></th>
								@endforeach
							</tr>
						</thead>
						<tbody id="calendar">
							@if($startDay == 0)
							<tr>
							@endif

							@for($j = 1; $j <= $currentStart; $j++)
							<td></td>
							@endfor

							@for($listDay = 1; $listDay <= $daysInMonth; $listDay++)
								<?php
									$searchDay = $curY . '-' . $curM . '-' . $listDay;
									$sday = date('Y-m-d', strtotime($searchDay));
								?>
								@if($startDay == 7)
								<?php $startDay = 0; ?>
								</tr>
								@endif


								@if(array_key_exists($listDay, $outgoingPackingList))
									<td @if($listDay == $today && $currentMonthYear == $thisMonth) class="text-center bg-default" @elseif($listDay == Session::get('theDate')) class="bg-warning" @else class="text-center" @endif>

										<a href="#" onClick = "searchByDay('{{ $sday }}');" @if($listDay == $today && $currentMonthYear == $thisMonth) class="text-white" @elseif($startDay == 0) class="text-danger" @elseif($startDay == 6) class="text-primary" @elseif($listDay == Session::get('theDate')) class="text-white" @else @endif>
											{{ $listDay }}
										</a>

										@if($outgoingPackingList[$listDay]['package_date'] == $currentMonthYear)
											<sub class="text-success">
												<b>
													{{ $outgoingPackingList[$listDay]['package'] }}/{{ $outgoingPackingList[$listDay]['total'] }}
												</b>
											</sub>
										@endif
									</td>
								@else
									<td onClick = "searchByDay('{{ $sday }}');"  @if($listDay == $today && $currentMonthYear == $thisMonth) class="text-center bg-default" @elseif($listDay == Session::get('theDate')) class="bg-warning" @else class="text-center" @endif>

										<a href="#" @if($listDay == $today && $currentMonthYear == $thisMonth) class="text-white" @elseif($startDay == 0) class="text-danger" @elseif($startDay == 6) class="text-primary" @elseif($listDay == Session::get('theDate')) class="text-white" @else  @endif>
											<b>{{ $listDay }}</b>
										</a>
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
		</div>

		<br />
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $p + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $p + $perPage }} @endif of {{ $total }} entries
				</div>

				<div class="panel-options">
					@permission('outgoing-create')
						<a href="{{ url('outgoings/create') }}">
							<i class="entypo-plus-squared"></i>
							New
						</a>
						&nbsp;|&nbsp;
					@endpermission
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
							<th>Depature  Time</th>
							@if(Auth::user()->hasRole('administrator'))
							<th>Company Name</th>
							@endif
							<th>Package List</th>
							<th width="15%">Action</th>
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
							@if(Auth::user()->hasRole('administrator'))
							<td>
								{{ $companyList[$outgoing->company_id] }}
							</td>
							@endif
							<td>
								<a href="{{ url('outgoings/'. $outgoing->id .'/packing-list') }}" class="btn btn-green btn-icon btn-sm text-white">
									<b>{{ $outgoing->packing_list }}</b>
									<i class="entypo-archive"></i>
								</a>
							</td>
							<td>
								<a href="{{ url('outgoings/'. $outgoing->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								@if((Auth::user()->hasRole('administrator') || $outgoing->company_id == Auth::user()->company_id) && ((date('Y-m-d') == date('Y-m-d', strtotime($outgoing->dept_date))) && (date('g:i A') == date('g:i A', strtotime($outgoing->dept_time)))))
									@permission('outgoing-edit')
										<a href="{{ url('outgoings/'. $outgoing->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
											<i class="entypo-pencil"></i>
										</a>
									@endpermission

									{{-- @if($outgoing->id != Auth::user()->id)
										@permission('user-delete')
											<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $outgoingoutgoings->id }}" title="Delete">
												<i class="entypo-trash"></i>
											</a>
										@endpermission
									@endif --}}
								@endif

								@if($outgoing->packing_list > 0)
									<a href="{{ url('outgoings/'. $outgoing->id .'/packing-list/print-pdf') }}" class="btn btn-green btn-icon btn-sm text-white">
										<b>PDF</b>
										<i class="entypo-download"></i>
									</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{{-- {!! $outgoingList->render() !!} --}}
				{!! $outgoingList->appends(['currentMonthYear' => $currentMonthYear])->links() !!}
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
						url: "{!! url('outgoings/"+ id +"') !!}",
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

			$("#gocurrentMonth").on("click",function(){
				var calendarDate = $('#currentMonth').val();
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
			});gocurrentMonth

		});

		function searchByDay(sday) {

			var url = "{{ url('outgoings/searchbyday') }}";
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

