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
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($lotinData, ['method' => 'PATCH','route' => ['lotins.update', $lotinData->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']) !!}

							<div class="form-group">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
											{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'form-control select2', 'id' => 'company_id', 'autocomplete' => 'off', 'disabled']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
										@endif
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Member No</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-users"></i></span>
										{!! Form::text('member_no', null, ['placeholder' => 'Member No', 'class' => 'form-control', 'id' => 'member_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Sender's Contact <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mobile"></i></span>
										{!! Form::text('s_contact_no', null, ['placeholder' => "Sender's Contact", 'class' => 'form-control', 'id' => 's_contact_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Sender's Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('sender_name', null, ['placeholder' => "Sender's Name", 'class' => 'form-control', 'id' => 'sender-name', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Sender's NRIC Number</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control select2', 'id' => 'nric_code', 'data-allow-clear' => 'true', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'nric_township', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'id' => 'nric_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">To <span class="text-danger">*</span></label>

								<div id="address-input">
									<div class="col-sm-5">
										<div class="input-group minimal">
											<span class="input-group-addon"><i class="entypo-users"></i></span>
											{!! Form::text('to_state_id_news',  $receiverLastNo, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-add', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('to_state_id_new',  $receiverLastId, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-adds', 'autocomplete' => 'off', 'readonly']) !!}
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Receiver's Contact <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mobile"></i></span>
										{!! Form::text('r_contact_no', null, ['placeholder' => "Receiver's Contact", 'class' => 'form-control', 'id' => 'r_contact_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Receiver's Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('receiver_name', null, ['placeholder' => "Receiver's Name", 'class' => 'form-control', 'id' => 'r_name', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Receiver's NRIC Number</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('r_nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control select2', 'id' => 'r_nric_code', 'data-allow-clear' => 'true', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('r_nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'form-control select2', 'autocomplete' => 'off', 'id' => 'r_nric_township', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('r_nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Date <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('date', date('Y-m-d'), ['placeholder' => 'Date','class' => 'form-control datepicker', 'id' => 'date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Lot No</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-map"></i></span>
										{!! Form::text('lot_no', null, ['placeholder' => 'Lot No', 'class' => 'form-control', 'id' => 'lot_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ ($errors->has('from_country') || $errors->has('from_state')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">From Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('from_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control select2', 'id' => 'country_id', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('from_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'form-control select2', 'id' => 'state_id', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ ($errors->has('to_country') || $errors->has('to_state')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">To Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control select2', 'id' => 'to_country_id', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('to_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'form-control select2', 'id' => 'to_state_id', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ ($errors->has('payment')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Payment <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::select('payment', ['' => 'Select Payment'] + Config::get('myVars.Payment'), null, ['class' => 'form-control select2', 'id' => 'payment', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
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
										<?php $j = 10 - count($itemList); $i = 1; ?>

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
													@if($item->price_id > 0)
														{{ $priceList[$item->price_id] }}
													@endif
												</td>

												<td  class="unit-prices">
													{{ number_format($item->unit_price, 2) }} @if($item->currency_id > 0) {{ $currencyList[$item->currency_id] }} @endif @if($item->category_id > 0) ({{ $categoryList[$item->category_id] }}) @endif
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
												{!! Form::textarea('remarks', null, ['placeholder' => 'Remarks', 'class' => 'form-control', 'id' => 'remarks', 'autocomplete' => 'off', 'rows' => 4]) !!}
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
									<a href="{{ route('lotins.index') }}" class="btn btn-orange btn-icon">
										Back
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

