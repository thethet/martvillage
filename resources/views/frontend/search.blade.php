@extends('frontend.layout')

@section('main')

	<main>

		<div class="white_bg">
			<div class="container margin_60">
				<br><br><br><br><br><br>
				<div class="main_title">
					<h2><span> Tarcking </span> (ဝန္ေဆာင္မွဳအေျခအေန)</h2>
				</div>
				<div class="row">
					<div class="col-md-12 box_style_1">
						{!! Form::open(array('route' => 'lot-search','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-wizard', 'id' => 'rootwizard')) !!}

							<?php
							$status = (int)$lotinData->status;
							$indicator = $status;
							$indicatorWidth = 25 * $indicator;
							?>

							<div class="form-group">
								<label class="col-sm-4">
									Contact No:
									@if($sender->contact_no)
										{{ $sender->contact_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									To:
									@if($receiver->address)
										{{ $receiver->address }} of {{ $receiverCount }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Date: {{ $lotinData->date }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Member No:
									@if($sender->member_no)
										{{ $sender->member_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Contact No:
									@if($receiver->contact_no)
										{{ $receiver->contact_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Lot No: {{ $lotinData->lot_no }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Sender Name:
									@if($sender->name)
										{{ $sender->name }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Receiver Name:
									@if($receiver->name)
										{{ $receiver->name }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									From: {{ $stateList[$lotinData->from_state] }}, {{ $countryList[$lotinData->from_country] }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									NRIC:
									@if($sender->nric_code_id != 0 && $sender->nric_township_id != 0)
										{{ $nricCodeList[$sender->nric_code_id] }} / {{ $nricTownshipList[$sender->nric_township_id] }} {{ $sender->nric_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									NRIC:
									@if($receiver->nric_code_id != 0 && $receiver->nric_township_id != 0)
										{{ $nricCodeList[$receiver->nric_code_id] }} / {{ $nricTownshipList[$receiver->nric_township_id] }} {{ $receiver->nric_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									To: {{ $stateList[$lotinData->to_state] }}, {{ $countryList[$lotinData->to_country] }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">&nbsp;</label>

								<label class="col-sm-4">&nbsp;</label>

								<label class="col-sm-4">
									Payment: {{ $lotinData->payment }}
								</label>
							</div>

							<br><br>
							<br><br>

							<div class="steps-progress" style="margin-left: 10%; margin-right: 10%;">
								<div class="progress-indicator"  style="width: {{ $indicatorWidth }}%"></div>
							</div>


							<ul>
								<li @if($status >= 0) class="completed" @endif>
									<a href="#tab1" data-toggle="tab">
										<span>1</span>Sender Office (Start Point)
									</a>
								</li>
								<li @if($status >= 1) class="completed" @elseif($status == 0) class="active" @endif>
									<a href="#tab2" data-toggle="tab">
										<span>2</span>On Boarding
									</a>
								</li>
								<li @if($status >= 2) class="completed" @elseif($status == 1) class="active" @endif>
									<a href="#tab3" data-toggle="tab">
										<span>3</span>Destination Office (Ready Collect)
									</a>
								</li>
								<li @if($status >= 3) class="completed" @elseif($status == 2) class="active" @endif>
									<a href="#tab4" data-toggle="tab">
										<span>4</span>Collected
									</a>
								</li>
								<li @if($status == 3) class="active" @endif>
									<a href="#tab5" data-toggle="tab">
										<span>5</span>Customer Received
									</a>
								</li>
							</ul>

							<br><br><br><br><br><br><br><br><br>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- End container -->
		</div>
		<!-- End white_bg -->

		<!-- End container -->
	</main>
	<!-- End main -->
@stop

@section('my-script')
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/neon-forms.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/font-icons/font-awesome/css/font-awesome.min.css') }}">


	<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/jquery.bootstrap.wizard.min.js') }}"></script>
@stop
