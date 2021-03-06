@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/incoming.png') }}" alt="Incoming">
	</div>
	<div class="col-md-8 site-header">Collection</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			{!! Form::open(array('route' => 'collections.ready.search','method'=>'POST', 'id' => 'incomings-search-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
			<div class="form-group">
				<label class="control-label col-sm-3" for="date">
					<strong>Landed Destination Date:</strong>
				</label>
				<div class="col-sm-4">
					{!! Form::text('incoming_date', null, array('placeholder' => 'Landed Destination Date','class' => 'form-control')) !!}
					@if ($errors->has('incoming_date'))
						<span class="required">
							<strong>{{ $errors->first('incoming_date') }}</strong>
						</span>
					@endif
				</div>
			</div><!-- .form-group -->

			<div class="form-group">
				<label class="control-label col-sm-3" for="date">
					<strong>Delivery Date:</strong>
				</label>
				<div class="col-sm-4">
					{!! Form::text('date', null, array('placeholder' => 'Delivery Date','class' => 'form-control')) !!}
					@if ($errors->has('date'))
						<span class="required">
							<strong>{{ $errors->first('date') }}</strong>
						</span>
					@endif
				</div>
			</div><!-- .form-group -->

			<div class="form-group">
				<label class="control-label col-sm-3" for="date">
					<strong>Lot Number:</strong>
				</label>
				<div class="col-sm-4">
					{!! Form::text('lot_no', null, array('placeholder' => 'Lot Number','class' => 'form-control')) !!}
					@if ($errors->has('lot_no'))
						<span class="required">
							<strong>{{ $errors->first('lot_no') }}</strong>
						</span>
					@endif
				</div>
			</div><!-- .form-group -->

			<div class="form-group">
				<label class="control-label col-sm-3" for="date">
					<strong>Receiver Contact No:</strong>
				</label>
				<div class="col-sm-4">
					{!! Form::text('contact_no', null, array('placeholder' => 'Receiver Contact No','class' => 'form-control')) !!}
					@if ($errors->has('contact_no'))
						<span class="required">
							<strong>{{ $errors->first('contact_no') }}</strong>
						</span>
					@endif
				</div>
			</div><!-- .form-group -->

			<div class="form-group">
				<label class="control-label col-sm-3" for="button"></label>
				<div class="col-sm-2">
					<a href="#" id="add" onclick="document.getElementById('incomings-search-form').submit();">
						<div class="addbtn">
							<img src="{{ asset('assets/img/Search.png') }}" alt="Search">
								Search
						</div>
					</a>
				</div>
			</div><!-- .form-group -->

			<div class="form-group"></div>
			{!! Form::close() !!}
		</div>

		<div class="table-cont">
			<table class="table table-bordered table-responsive">
				<tr>
					<th>No</th>
					<th>Lot No.</th>
					<th>Sender Name</th>
					<th>Sender Contact No.</th>
					<th>Member No.</th>
					<th>Reciever Name</th>
					<th>Receiver Contact No.</th>
					<th>From - To</th>
					<th>Delivery Date</th>
					<th>Landed Date</th>
					<th>Action</th>
				</tr>
				@foreach ($lotins as $key => $lotin)
				<tr>
					<td>{{ ++$i }}</td>
					<td>{{ $lotin->lot_no }}</td>

					<td>{{ $lotin->sender_name }}</td>

					<td>{{ $lotin->sender_contact }}</td>

					<td>{{ $lotin->member_no }}</td>

					<td>{{ $lotin->receiver_name }}</td>

					<td>{{ $lotin->receiver_contact }}</td>

					<td>
						{{ $states[$lotin->from_state] }} <=> {{ $states[$lotin->to_state] }}
					</td>

					<td>{{ $lotin->date }}</td>

					<td>{{ $lotin->incoming_date }}</td>

					<td>
						@if($lotin->status == 2)
							<a href="{{ url('collections/collected/' . $lotin->id) }}" class="btn">Pickup</a>
						@else
							Collected
						@endif
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{!! $lotins->render() !!}

	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('collections') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
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

	<script>
		$(document).ready(function(){
			var incoming_date=$('input[name="incoming_date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			incoming_date.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});

			var date_input=$('input[name="date"]'); //our date input has the name "date"
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});
			// date_input.datepicker('setDate', new Date());

			$('#timepicker').timepicker({
				minuteStep: 5
			});
		});
	</script>
@stop
