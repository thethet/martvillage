@extends('layouts.layout')

@section('page-title')
	Lotin
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
				<a href="{{ url('lotins') }}">Lotin Management</a>
			</li>
			<li class="active">
				<strong>Detail Form</strong>
			</li>
		</ol>

		<h2>Lotin Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Detail Form</strong>
						</div>

						<div class="panel-options">
							<a href="{{ url('lotins/'. $lotinData->id .'/print-pdf') }}" title="Print"><i class="entypo-print"></i></a>
							&nbsp;|&nbsp;
							<a href="{{ url('lotins') }}" title="Close"><i class="entypo-cancel"></i></a>
							&nbsp;|&nbsp;
							<a href="#" data-rel="collapse" title="Hide"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($lotinData, ['method' => 'PATCH','route' => ['lotins.update', $lotinData->id], 'role' => 'form', 'class' => 'form-horizontal validate', 'enctype' => 'multipart/form-data']) !!}

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

							<div class="form-group">
								<table class="table table-bordered responsive">
									<thead>
										<tr>
											<th width="5%">SNo.</th>
											<th>Item's Name</th>
											<th>Barcode No</th>
											<th>Type</th>
											<th width="13%">Unit Price</th>
											<th width="8%">Unit</th>
											<th width="13%">Quantity</th>
											<th width="10%">Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php $j = 7 - count($itemList); $i = 1; ?>

										@foreach($itemList as $item)
											<tr>
												<td>{{ $i++ }}</td>
												<td>
													{{ $item->item_name }}
												</td>

												<td>
													{{ $item->barcode }}
												</td>

												<td>
													{{ $priceList[$item->price_id] }}
												</td>

												<td  class="unit-prices">
													{{ number_format($item->unit_price, 2) }} {{ $currencyList[$item->currency_id] }} ({{ $categoryList[$item->category_id] }})
												</td>

												<td class="text-right">
													{{ $item->unit }}
												</td>

												<td class="text-right">
													<div class="input-spinner">
														{{ $item->quantity}}
													</div>
												</td>

												<td class="text-right">
													{{ number_format($item->amount, 2) }}
												</td>
											</tr>
										@endforeach


										@for($x = 0; $x < $j; $x++)
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
										@endfor

										<tr>
											<td colspan="6" class="text-right"><b>Sub Total</b></td>
											<td class="text-right"></td>
											<td class="text-right">
												<b>
													{{ number_format($lotinData->total_amt, 2) }}
												</b>
											</td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>Member Discount (-)</b></td>
											<td class="text-right">
												<b>
													{{ $lotinData->member_discount }} %
												</b>
											</td>
											<td class="text-right">
												<b>
													{{ number_format($lotinData->member_discount_amt, 2) }}
												</b>
											</td>
										</tr>

										<tr>
											<td colspan="6" class="text-right">
												<b>Other Discount (-)</b>
											</td>
											<td class="text-right">
												<b>
													{{ $lotinData->other_discount }} %
												</b>
											</td>
											<td class="text-right">
												<b>
													{{ number_format($lotinData->other_discount_amt, 2) }}
												</b>
											</td>
										</tr>

										<tr>
											<td colspan="4" rowspan="3" class="text-right">
												{!! Form::textarea('remarks', null, ['placeholder' => 'Remarks', 'class' => 'form-control', 'id' => 'remarks', 'autocomplete' => 'off', 'rows' => 4, 'disabled']) !!}
											</td>
											<td colspan="2" class="text-right"><b>GST</b></td>
											<td class="text-right">
												<b>{{ $lotinData->gov_tax }} %</b>
											</td>
											<td class="text-right">
												<b>
													{{ number_format($lotinData->gov_tax_amt, 2) }}
												</b>
											</td>
										</tr>

										<tr>
											<td colspan="2" class="text-right"><b>Service Charges</b></td>
											<td class="text-right">
												<b>{{ $lotinData->service_charge }} %</b>
											</td>
											<td class="text-right">
												<b>
													{{ number_format($lotinData->service_charge_amt, 2) }}
												</b>
											</td>
										</tr>

										<tr>
											<td colspan="2" class="text-right"><b>Net Balance</b></td>
											<td class="text-right">
											</td>
											<td class="text-right">
												<b>
													{{ number_format($lotinData->net_amt, 2) }}
												</b>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<a href="{{ url('lotins/'. $lotinData->id . '/edit') }}" class="btn btn-orange btn-icon">
										Back To Edit
										<i class="entypo-reply"></i>
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
@stop

