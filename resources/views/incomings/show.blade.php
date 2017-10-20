@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/incoming.png') }}" alt="Incoming">
	</div>
	<div class="col-md-8 site-header">Incoming</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif


		<div class="row">
			<div class="form-horizontal">
				<div class="form-group">
					<div class="control-label col-sm-4">
						Passenger Name:
					</div>
					<div class="control-label col-sm-7">
						{{ $outgoing->passenger_name }}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<div class="col-sm-4">
						Phone:
					</div>
					<div class="col-sm-7">
						{{ $outgoing->contact_no }}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<div class="col-sm-4">
						From ~ To:
					</div>
					<div class="col-sm-7">
						{{ $outgoing->fromCity->state_name }} ~ {{ $outgoing->toCity->state_name }}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<div class="col-sm-4">
						Weight:
					</div>
					<div class="col-sm-7">
						{{ $outgoing->weight }} kg
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<div class="col-sm-4">
						Quantity:
					</div>
					<div class="col-sm-7">
						{{ $outgoing->packing_list }} pcs
					</div>
				</div><!-- .form-group -->
			</div><!-- .form-horizontal -->

			<div class="col-sm-12 bdr pad3 mb15">
				<div class="table-cont mb0">
					<table class="packing-list-group table table-responsive ">
						<thead>
							@for($x = 1; $x <= $outgoing->packing_list; $x++)
								<?php
									$packItems =DB::table('items as i')
									->select('i.*', 's.name as sender_name', 'r.name as receiver_name')
									->leftJoin('lotins as l', 'l.id', '=', 'i.lotin_id')
									->leftJoin('senders as s', 's.id', '=', 'l.sender_id')
									->leftJoin('receivers as r', 'r.id', '=', 'l.receiver_id')
									->where('i.outgoing_id', $outgoing->id)
									->where('i.packing_id', $x)->get();

									$kgs = App\Item::select(DB::raw('sum(unit) as total_unit'))->where('outgoing_id', $outgoing->id)->where('packing_id', $x)->where('category_id', 1)->get();
									$totalKgs = $kgs[0]->total_unit;

									$fts = App\Item::select(DB::raw('sum(unit) as total_unit'))->where('outgoing_id', $outgoing->id)->where('packing_id', $x)->where('category_id', 2)->get();
									$totalFts = $fts[0]->total_unit;

									$ins = App\Item::select(DB::raw('sum(unit) as total_unit'))->where('outgoing_id', $outgoing->id)->where('packing_id', $x)->where('category_id', 3)->get();
									$totalIns = $ins[0]->total_unit;

									$docs = App\Item::select(DB::raw('sum(unit) as total_unit'))->where('outgoing_id', $outgoing->id)->where('packing_id', $x)->where('category_id', 4)->get();
									$totalDocs = $docs[0]->total_unit;

								?>
								<tr>
									<td>
										<div class="packing-header">
											<h5 class="packing-title mr0">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapses{{ $x }}" class="collapsed">
													&nbsp;&nbsp;&nbsp;&nbsp; Package List {{  $x }}
												</a>
											</h5>
										</div>
									</td>
									<th width="70px" class="bdr center">
										<span>{{ $totalKgs }}</span> kg
									</th>
									<th width="70px" class="bdr center">
										<span>{{ $totalFts }}</span> ft<sup>3</sup>
									</th>
									<th width="70px" class="bdr center">
										<span>{{ $totalIns }}</span> Ins
									</th>
									<th width="70px" class="bdr center">
										<span>{{ $totalDocs }}</span> Docs
									</th>
								</tr>
								<tr>
									<td colspan="5" class="bdr0">
										<div class="packing-list">
											<div id="collapses{{ $x }}" class="panel-collapse collapse" >
												<div class="table-cont">
													<table class="table table-bordered table-responsive" id="mypackage{{$x }}">
														<thead>
															<tr>
																<th></th>
																<th>Sender</th>
																<th>Receiver</th>
																<th>Barcode</th>
																<th>Unit(kg/ft<sup>3</sup>)</th>
																<th>Split</th>
															</tr>
														</thead>
														<tbody>
															@foreach($packItems as $pacItem)
																<tr>
																	<td></td>
																	<td>{{ $pacItem->sender_name }}</td>
																	<td>{{ $pacItem->receiver_name }}</td>
																	<td>{{ $pacItem->barcode }}</td>
																	<td>{{ $pacItem->unit }}</td>
																	<td>0</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endfor
						</thead>
					</table>
				</div>
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

			<div class="menu-icon">
				<a href="{{ url('incomings') }}" >
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
		$(document).ready(function(){});
	</script>
@stop
