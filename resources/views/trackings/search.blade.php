@extends('layouts.layout')

@section('page-title')
	Tracking
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('trackings') }}">Tracking Management</a>
			</li>
			<li class="active">
				<strong>Search Result Form</strong>
			</li>
		</ol>

		<h2>Tracking Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Search Result Form</strong>
						</div>

						<div class="panel-options">
							<a href="{{ url('trackings/' . $lotinData->id) }}">
								<i class="entypo-list"></i> Detail
							</a>
							&nbsp;|&nbsp;
							<a href="{{ url('trackings') }}"><i class="entypo-cancel"></i></a>
							&nbsp;|&nbsp;
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::open(array('route' => 'trackings.search','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-wizard', 'id' => 'rootwizard')) !!}

							<?php $status = (int)$lotinData->status; ?>

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

							<div class="steps-progress">
								<div class="progress-indicator"></div>
							</div>

							<ul>
								<li @if($status == 0) class="completed" @endif>
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
								<li>
									<a href="#tab5" data-toggle="tab">
										<span>5</span>Customer Received
									</a>
								</li>
							</ul>

							<br><br>
							<br><br>

							<div class="form-group">
								<label class="col-sm-1 control-label"></label>

								<div class="col-sm-5">
									<a href="{{ url('trackings/' . $lotinData->id) }}" class="btn btn-success">
										<i class="entypo-list"></i> Detail
									</a>
									<a href="{{ route('trackings.index') }}" class="btn btn-black">
										Back
									</a>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
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
	<link rel="stylesheet" href="{{ asset('assets/js/selectboxit/jquery.selectBoxIt.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/jquery.bootstrap.wizard.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.inputmask.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-switch.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.multi-select.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

@stop

