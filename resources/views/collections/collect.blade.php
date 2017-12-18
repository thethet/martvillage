@extends('layouts.layout')

@section('page-title')
	Collection
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
				<a href="{{ url('collections') }}">Collection Management</a>
			</li>
			<li class="active">
				<strong>Item List for Ready to Collect</strong>
			</li>
		</ol>

		<h2>Item List for Ready to Collect</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		{!! Form::open(array('route' => 'collections.ready.collect','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal validate')) !!}

			<div class="form-group">
				<label class="col-sm-2  control-label">Landed Destination Date</label>

				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
						</div>
						{!! Form::text('incoming_date', null, ['placeholder' => 'Landed Destination Date','class' => 'form-control datepicker', 'id' => 'incoming_date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<label class="col-sm-2  control-label">Delivery Date</label>
				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
						</div>
						{!! Form::text('date', null, ['placeholder' => 'Delivery Date','class' => 'form-control datepicker', 'id' => 'date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
					</div>
				</div>

			</div>

			<div class="form-group">
				<label class="col-sm-2  control-label">Lot Number</label>

				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-map"></i>
						</div>
						{!! Form::text('lot_no', null, ['placeholder' => 'Lot Number','class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<label class="col-sm-2  control-label">Receiver Contact No</label>
				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-location"></i>
						</div>
						{!! Form::text('contact_no', null, ['placeholder' => 'Receiver Contact No','class' => 'form-control', 'autocomplete' => 'off']) !!}
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
					Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries
				</div>

				<div class="panel-options">
					@permission('lotin-create')
						<a href="{{ url('collections') }}">
							<i class="entypo-cancel"></i>
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
							<th>Lot No.</th>
							<th>Sender Name</th>
							<th>Sender Contact No.</th>
							<th>Member No.</th>
							<th>Reciever Name</th>
							<th>Receiver Contact No.</th>
							<th>From - To</th>
							<th>Delivery Date</th>
							<th>Landed Date</th>
							@if(Auth::user()->hasRole('administrator'))
							<th>Company Name</th>
							@endif
							<th width="5%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotins as $key => $lotin)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $lotin->lot_no }}</td>
							<td>{{ $lotin->sender_name }}</td>
							<td>{{ $lotin->sender_contact }}</td>
							<td>{{ $lotin->member_no }}</td>
							<td>{{ $lotin->receiver_name }}</td>
							<td>{{ $lotin->receiver_contact }}</td>
							<td>
								{{ $stateList[$lotin->from_state] }} <=> {{ $stateList[$lotin->to_state] }}
							</td>
							<td>{{ $lotin->date }}</td>
							<td>{{ $lotin->incoming_date }}</td>
							@if(Auth::user()->hasRole('administrator'))
								<td>
									{{ $companyList[$lotin->company_id] }}
								</td>
							@endif
							<td>
								@if($lotin->status == 2)
									<a href="{{ url('collections/collected/' . $lotin->id) }}" class="btn btn-green btn-icon btn-sm text-white">
										Pickup<i class="entypo-box"></i>
									</a>
								@else
									Collected
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $lotins->render() !!}
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
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('lotins/"+ id +"') !!}",
						type: 'DELETE',
						data: {_token: '{!! csrf_token() !!}'},
						dataType: 'JSON',
						success: function (data) {
							window.location.replace(data.url);
						}
					});
				}
			});
		});
	</script>
@stop

