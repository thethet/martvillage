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
			<div class="col-sm-4">
				<div class="form-group">
					<label class="control-label col-sm-5" for="contact">
						Contact No:
					</label>
					<label class="control-label col-sm-7" for="contact">
						{{ $sender->contact_no }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="member">
						Member No:
					</label>
					<label class="control-label col-sm-7" for="member">
						{{ $sender->member_no }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="sender">
						Sender Name:
					</label>
					<label class="control-label col-sm-7" for="sender">
						{{ $sender->name }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="nric">
						NRIC:
					</label>

					<label class="control-label col-sm-7" for="nric">
						{{ $nricCodes[$sender->nric_code_id] }} / {{ $nricTownships[$sender->nric_township_id] }} {{ $sender->nric_no }}
					</label>

				</div><!-- .form-group -->
			</div>

			<div class="col-sm-4">
				<div class="form-group">
					<label class="control-label col-sm-5" for="address">
						To:
					</label>
					<label class="control-label col-sm-7" for="address">
						{{ $receiver->address }} of {{ $receiverCount }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="contact">
						Contact No:
					</label>
					<label class="control-label col-sm-7" for="contact">
						{{ $receiver->contact_no }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="receiver">
						Receiver Name:
					</label>
					<label class="control-label col-sm-7" for="receiver">
						{{ $receiver->name }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="nric">
						NRIC:
					</label>
					<label class="control-label col-sm-7" for="nric">
						{{ $nricCodes[$receiver->nric_code_id] }} / {{ $nricTownships[$receiver->nric_township_id] }} {{ $receiver->nric_no }}
					</label>
				</div><!-- .form-group -->

			</div>

			<div class="col-sm-4">
				<div class="form-group">
					<label class="control-label col-sm-3" for="date">
						Date:
					</label>
					<label class="control-label col-sm-7" for="date">
						{{ $lotinData->date }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="lotno">
						Lot No:
					</label>
					<label class="control-label col-sm-7" for="lotno">
						{{ $lotinData->lot_no }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="from">
						From:
					</label>
					<label class="control-label col-sm-7" for="from">
						{{ $states[$lotinData->from_state] }}, {{ $countries[$lotinData->from_country] }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="to">
						To:
					</label>
					<label class="control-label col-sm-7" for="to">
						{{ $states[$lotinData->to_state] }}, {{ $countries[$lotinData->to_country] }}
					</label>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="payment">
						Payment:
					</label>
					<label class="control-label col-sm-7" for="payment">
						{{ $lotinData->payment }}
					</label>
				</div><!-- .form-group -->
			</div>
		</div>

		<div class="row tracking-status">
			<div class="col-sm-1 block pad0">
				<?php $status = (int)$lotinData->status; ?>
				<div @if( $status >= 0) class="circle circletrack-color" @else class="circle" @endif>
					<p>&nbsp;</p>
				</div>
			</div>
			<div class="col-sm-2 bline pad0">
				<div @if( $status >= 1) class="line linetrack-color" @else class="line" @endif></div>
			</div>

			<div class="col-sm-1 block pad0">
				<div @if( $status >= 1) class="circle circletrack-color" @else class="circle" @endif>
					<p>&nbsp;</p>
				</div>
			</div>
			<div class="col-sm-2 bline pad0">
				<div @if( $status >= 2) class="line linetrack-color" @else class="line" @endif></div>
			</div>

			<div class="col-sm-1 block pad0">
				<div @if( $status >= 2) class="circle circletrack-color" @else class="circle" @endif>
					<p>&nbsp;</p>
				</div>
			</div>
			<div class="col-sm-2 bline pad0">
				<div @if( $status >= 3) class="line linetrack-color" @else class="line" @endif></div>
			</div>

			<div class="col-sm-1 block pad0">
				<div @if( $status >= 3) class="circle circletrack-color" @else class="circle" @endif>
					<p>&nbsp;</p>
				</div>
			</div>
			<div class="col-sm-2 bline pad0">
				<div @if( $status >= 4) class="line linetrack-color" @else class="line" @endif></div>
			</div>

			<div class="col-sm-1 block pad0">
				<div @if( $status >= 4) class="circle circletrack-color" @else class="circle" @endif>
					<p>&nbsp;</p>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-sm-2 trans ml-30 mt54">
				Sender Office
				<br>
				(Start Point)
			</div>

			<div class="col-sm-2 trans ml60 mt54">
				On Boarding
			</div>

			<div class="col-sm-2 trans ml60 mt54">
				Landed Destination
			</div>

			<div class="col-sm-2 trans ml60 mt54">
				Destination Office
				<br>
				(Ready Collect)
			</div>

			<div class="col-sm-1 trans ml108 mt54">
				Collected
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

			@permission('tracking-show')
			<div class="menu-icon">
				<a href="{{ url('trackings/' . $lotinData->id) }}" >
					<img src="{{ asset('assets/img/Show list.png') }}" alt="Detail">
					Detail
				</a>
			</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="{{ url('dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('trackings') }}" >
					<img src="{{ asset('assets/img/Close.png') }}" alt="Close">
					Close
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
