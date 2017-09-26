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
					{{-- <th width="20px">Action</th> --}}
				</tr>
				@foreach ($lotinData as $key => $lotin)
				<tr>
					<td>{{ ++$i }}</td>
					<td>{{ $lotin->lot_no }}</td>

					<td>{{ $sender[$lotin->sender_id] }}</td>

					<td>{{ $senderContact[$lotin->sender_id] }}</td>

					<td>{{ $member[$lotin->sender_id] }}</td>

					<td>{{ $receiver[$lotin->receiver_id] }}</td>

					<td>{{ $receiverContact[$lotin->receiver_id] }}</td>

					<td>
						{{ $states[$lotin->from_state] }} <=> {{ $states[$lotin->to_state] }}
					</td>

					{{-- <td>
						{!! Form::checkbox('edit', $lotin->id, null, ['class' => 'editboxes']) !!}
					</td> --}}
				</tr>
				@endforeach
			</table>
		</div>
		{!! $lotinData->render() !!}

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
					<a href="{{ url('lotins/create') }}" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="{{ url('dashboard') }}" >
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
	<script>
		$(document).ready(function(){});

	</script>
@stop
