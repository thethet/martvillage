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

		<br>
		<br>

		<div class="row">
			<div class="table-cont">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th width="8px">No</th>
							<th>Item Name</th>
							<th>Barcode</th>
							<th>Type</th>
							<th width="120px">Unit Price</th>
							<th width="100px">Unit </th>
							<th width="100px">Quantity</th>
							<th width="120px">Amount</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$i = 1;
						$subTotal = 0;
						?>
						@foreach($items as $item)
						<?php $subTotal += $item->amount; ?>
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $item->item_name }}</td>
							<td>{{ $item->barcode }}</td>
							<td>{{ $item->category_id }}</td>
							<td>{{ $item->unit_price }}</td>
							<td>{{ $item->unit }}</td>
							<td>{{ $item->quantity }}</td>
							<td class="right">{{ number_format($item->amount, 2) }}</td>
						</tr>
						@endforeach

						<tr>
							<td>&nbsp;</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>

					<tbody class="tbl-cal" style="font-weight: bold;">
						<tr>
							<td colspan="6" class="right">Sub Total</td>
							<td class="right" id="subtotal-0">
							</td>
							<td class="right" id="subtotal-1">
								{{ number_format($subTotal, 2) }}
							</td>
						</tr>

						<tr>
							<td colspan="2">Member Discount (-):</td>
							<td></td>
							<td colspan="3" class="right">Other Discount</td>
							<td class="right" id="discount-0">
								-10%
							</td>
							<td class="right" id="discount-1">
								{{ number_format($lotinData->other_discount_amt, 2) }}
							</td>
						</tr>

						<tr>
							<td colspan="6" class="right">Service Charge:</td>
							<td class="right" id="scharge-0">
								10%
							</td>
							<td class="right" id="scharge-1">
								{{ number_format($lotinData->service_charge_amt, 2) }}
							</td>
						</tr>
						<tr>
							<td colspan="6" class="right">GST</td>
							<td class="right" id="gst-0">
								7%
							</td>
							<td class="right" id="gst-1">
								{{ number_format($lotinData->gov_tax_amt, 2) }}
							</td>
						</tr>
						<tr>
							<td colspan="6" class="right">Total</td>
							<td class="right" id="total-10">
							</td>
							<td class="right" id="total-1">
								{{ number_format($lotinData->total_amt, 2) }}
							</td>
						</tr>
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
