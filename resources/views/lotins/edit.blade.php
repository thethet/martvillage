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
				<strong>Edit Form</strong>
			</li>
		</ol>

		<h2>Lotin Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Edit Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($lotinData, ['method' => 'PATCH','route' => ['lotins.update', $lotinData->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']) !!}

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
											{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'select2', 'id' => 'company_id', 'autocomplete' => 'off']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control', 'id' => 'company_id']) !!}
										@endif
									</div>

									@if ($errors->has('company_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('company_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('member_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Member No</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-users"></i></span>
										{!! Form::text('member_no', null, ['placeholder' => 'Member No', 'class' => 'form-control', 'id' => 'member_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>

									@if ($errors->has('member_no'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('member_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('s_contact_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Sender's Contact <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mobile"></i></span>
										{!! Form::text('s_contact_no', null, ['placeholder' => "Sender's Contact", 'class' => 'form-control', 'id' => 's_contact_no', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('s_contact_no'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('s_contact_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('sender_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Sender's Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('sender_name', null, ['placeholder' => "Sender's Name", 'class' => 'form-control', 'id' => 'sender-name', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('sender_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('sender_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Sender's NRIC Number</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'select2', 'id' => 'nric_code', 'data-allow-clear' => 'true']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'select2', 'autocomplete' => 'off', 'id' => 'nric_township']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'id' => 'nric_no', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">To <span class="text-danger">*</span></label>

								<div id="address-input">
									<div class="col-sm-5">
										<div class="input-group minimal">
											<span class="input-group-addon"><i class="entypo-users"></i></span>
											{!! Form::text('to_state_id_news', $receiverLastNo, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-add', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('to_state_id_new', $receiverLastId, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-adds', 'autocomplete' => 'off', 'readonly']) !!}
										</div>
									</div>

									<div class="col-sm-1">
										<a href="#" class="btn btn-black btn-icon" id="back">Back<i class="entypo-reply"></i></a>
									</div>
								</div>

								<div id="address-list">
									<div class="col-sm-5">
										<div class="input-group minimal">
											<span class="input-group-addon"><i class="entypo-user"></i></span>
											{!! Form::select('to_state_ids', ['' => 'Select Address'] + $receiveAddressList->toArray(), null, ['class' => 'select2', 'id' => 'address', 'autocomplete' => 'off']) !!}
										</div>
									</div>

									<div class="col-sm-1">
										<a href="#" class="btn btn-primary btn-icon" id="noadd">Add<i class="entypo-plus"></i></a>
									</div>

								</div>
							</div>

							<div class="form-group {{ $errors->has('r_contact_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Receiver's Contact <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-mobile"></i></span>
										{!! Form::text('r_contact_no', null, ['placeholder' => "Receiver's Contact", 'class' => 'form-control', 'id' => 'r_contact_no', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('r_contact_no'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('r_contact_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('receiver_name') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Receiver's Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-user"></i></span>
										{!! Form::text('receiver_name', null, ['placeholder' => "Receiver's Name", 'class' => 'form-control', 'id' => 'r_name', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('receiver_name'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('receiver_name') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Receiver's NRIC Number</label>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('r_nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'select2', 'id' => 'r_nric_code', 'data-allow-clear' => 'true']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('r_nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'select2', 'autocomplete' => 'off', 'id' => 'r_nric_township']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('r_nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Date <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-calendar"></i></span>
										{!! Form::text('date', date('Y-m-d'), ['placeholder' => 'Date','class' => 'form-control datepicker', 'id' => 'date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off', 'disabled']) !!}
									</div>

									@if ($errors->has('date'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('date') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('lot_no') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Lot No</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-map"></i></span>
										{!! Form::text('lot_no', null, ['placeholder' => 'Lot No', 'class' => 'form-control', 'id' => 'lot_no', 'autocomplete' => 'off', 'disabled']) !!}
									</div>

									@if ($errors->has('lot_no'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('lot_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('from_country') || $errors->has('from_state')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">From Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('from_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'country_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('from_country'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('from_country') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('from_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'state_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('from_state'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('from_state') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('to_country') || $errors->has('to_state')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">To Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'select2', 'id' => 'to_country_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_country'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_country') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('to_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'select2', 'id' => 'to_state_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_state'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_state') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('payment')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Payment <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::select('payment', ['' => 'Select Payment'] + Config::get('myVars.Payment'), null, ['class' => 'select2', 'id' => 'payment', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('payment'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('payment') }}</strong>
										</span>
									@endif
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
									<button type="submit" class="btn btn-success btn-icon">
										Save Changes
										<i class="entypo-floppy"></i>
									</button>
									<button type="reset" class="btn btn-info btn-icon">
										Reset Previous
										<i class="entypo-erase"></i>
									</button>
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

	<script>
		$(document).ready(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});

			// Fetch the preselected item, and add to the control
			var companyId = $('#company_id').val();
			var countryId = $('#country_id').val();
			var stateId = $('#state_id').val();
			$.ajax({
				type: 'GET',
				url: "{{ url('states/search-state-country') }}",
				dataType: 'json',
				delay: 250,
				data: {
					search: '',
					companyId: companyId,
					countryId: countryId
				}
				,
			}).then(function (data) {
				if(data != null) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						if(stateId == data.items[i]['id']) {
							html += '<option value="' + data.items[i]['id'] + '" selected>' + data.items[i]['text'] + '</option>';
						} else {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
					}
					$('#state_id').children().remove().end().append(html);
				}
			});

			var companyId = $('#company_id').val();
			var countryId = $('#to_country_id').val();
			var fromStateId = $('#state_id').val();
			var toStateId = $('#to_state_id').val();
			$.ajax({
				type: 'GET',
				url: "{{ url('states/search-state-country') }}",
				dataType: 'json',
				delay: 250,
				data: {
					search: '',
					companyId: companyId,
					countryId: countryId,
					fromStateId: fromStateId
				}
				,
			}).then(function (data) {
				if(data != null) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						if(toStateId == data.items[i]['id']) {
							html += '<option value="' + data.items[i]['id'] + '" selected>' + data.items[i]['text'] + '</option>';
						} else {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
					}
					$('#to_state_id').children().remove().end().append(html);
				}
			});



			$('a#back').hide();

			$("a#noadd").bind('click', function () {
				$('#address-input').show();
				$('#address-list').hide();
				$('a#back').show();

				$('#r_contact_no').val('');
				$('#r_contact_no').attr('readonly', false);

				$('#to_state_id').val('');
				$('#to_state_id').attr('readonly', false);
				// $('#to-add').attr('readonly', false);

				$('#r_name').val('');
				$('#r_name').attr('readonly', false);

				$('#r_nric_code').val('');
				$('#r_nric_code').attr('disabled', false);
				$('#select2-r_nric_code-container').text('Code');

				$('#r_nric_township').val('');
				$('#r_nric_township').attr('disabled', false);
				$('#select2-r_nric_township-container').text('Township');

				$('#r_nric_no').val('');
				$('#r_nric_no').attr('readonly', false);
			});


			$("a#back").bind('click', function () {
				$('#address-input').hide();
				$('#address-list').show();

				$('#r_contact_no').val('');
				$('#r_contact_no').attr('readonly', false);

				$('#to_state_id').val('');
				$('#to_state_id').attr('readonly', false);
				// $('#to-add').attr('readonly', false);

				$('#r_name').val('');
				$('#r_name').attr('readonly', false);

				$('#r_nric_code').val('');
				$('#r_nric_code').attr('disabled', false);
				$('#select2-r_nric_code-container').text('Code');

				$('#r_nric_township').val('');
				$('#r_nric_township').attr('disabled', false);
				$('#select2-r_nric_township-container').text('Township');

				$('#r_nric_no').val('');
				$('#r_nric_no').attr('readonly', false);

				$('#select2-address-container').text('Address');
				$('#address').val('');
			});

			$('#address-list').hide();

			$("#nric_code").change(function(event) {
				// Fetch the preselected item, and add to the control
				var nricCodeId = $('#nric_code').val();
				var nricTwnSelect = $('#nric_township');
				$.ajax({
					type: 'GET',
					url: "{{ url('nrictownships/nric-township') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						nricCodeId: nricCodeId
					}
					,
				}).then(function (data) {
					if(data != null) {
						var html = '<option value="">Township</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						nricTwnSelect.children().remove().end().append(html)
					}
				});
			});

			$("#r_nric_code").change(function(event) {
				// Fetch the preselected item, and add to the control
				var nricCodeId = $('#r_nric_code').val();
				var nricTwnSelect = $('#r_nric_township');
				$.ajax({
					type: 'GET',
					url: "{{ url('nrictownships/nric-township') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						nricCodeId: nricCodeId
					}
					,
				}).then(function (data) {
					if(data != null) {
						var html = '<option value="">Township</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						nricTwnSelect.children().remove().end().append(html);
					}
				});
			});

			$("#country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#country_id').val();
				var stateSelect = $('#state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId
					}
					,
				}).then(function (data) {
					if(data != null) {
						var html = '<option value="">Select State/City</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						stateSelect.children().remove().end().append(html);
					}
				});
				$('#state_id').attr('disabled', false);
			});

			$("#state_id").change(function(event) {
				$('#to_country_id').attr('disabled', false);

				var companyId = $('#company_id').val();
				var countryId = $('#to_country_id').val();
				var fromStateId = $('#state_id').val();
				var stateSelect = $('#to_state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId,
						fromStateId: fromStateId
					}
					,
				}).then(function (data) {
					if(data != null) {
						var html = '<option value="">Select State/City</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						stateSelect.children().remove().end().append(html);
					}
				});
			});

			$("#to_country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var companyId = $('#company_id').val();
				var countryId = $('#to_country_id').val();
				var fromStateId = $('#state_id').val();
				var stateSelect = $('#to_state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						companyId: companyId,
						countryId: countryId,
						fromStateId: fromStateId
					}
					,
				}).then(function (data) {
					if(data != null) {
						var html = '<option value="">Select State/City</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						stateSelect.children().remove().end().append(html);
					}
				});

				$('#to_state_id').attr('disabled', false);
			});

			$("#to_state_id").change(function(event) {

				// Fetch the preselected item, and add to the control
				var fromCountryId = $('#country_id').val();
				var fromStateId = $('#state_id').val();
				var toCountryId = $('#to_country_id').val();
				var toStateId = $('#to_state_id').val();
				var stateSelect = $('.price_id');
				var companyId = $('#company_id').val();
				$.ajax({
					type: 'GET',
					url: "{{ url('lotins/search-price-list') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						fromCountryId: fromCountryId,
						fromStateId: fromStateId,
						toCountryId: toCountryId,
						toStateId: toStateId,
						companyId: companyId
					}
					,
				}).then(function (data) {
					if(data != null) {
						var html = '<option value="">Select Type</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						stateSelect.children().remove().end().append(html);
					}
				});
				$('.price_id').attr('disabled', false);
			});


			$("#member_no").focusout(function(){
				var memberNo = $("#member_no").val();
				var contactNo = $('#s_contact_no').val();

				$.ajax({
					type: 'GET',
					url: "{{ url('members/search-member') }}",
					dataType: 'json',
					delay: 250,
					data: {
						memberNo: memberNo
					}
					,
				}).then(function (data) {
					if(data != null) {
						$('#member_discount').val(data.rate);
						$('#member-rate-text').text(data.rate);

						$('#s_contact_no').val(data.contact_no);
						// $('#s_contact_no').attr('readonly', true);
						$('#sender-name').val(data.name);
						$('#sender-name').attr('readonly', true);
						if(data.nric_code_id != 0) {
							$('#nric_code').val(data.nric_code_id);
						}
						if(data.nric_township_id != 0) {
							$('#nric_township').val(data.nric_township_id);
						}
						$('#nric_no').val(data.nric_no);

						var contactNo = data.contact_no;
						$.ajax({
							type: 'GET',
							url: "{{ url('receivers/search-address-member') }}",
							dataType: 'json',
							delay: 250,
							data: {
								contactNo: contactNo,
								memberNo: memberNo
							}
							,
						}).then(function (datas) {
							if(datas != null) {
								$('#s_contact_no').attr('readonly', true);

								$('#sender-name').val(datas.s_name);
								$('#sender-name').attr('readonly', true);

								if(datas.s_nric_code_id != 0) {
									$('#nric_code').val(datas.s_nric_code_id);
								}
								if(datas.s_nric_township_id != 0) {
									$('#nric_township').val(datas.s_nric_township_id);
								}
								$('#nric_no').val(datas.s_nric_no);
								$('#nric_no').attr('readonly', true);


								$('#lot_no').attr('readonly', true);

								$('#address').attr('disabled', false);
								$('#country_id').attr('disabled', false);
								$('#state_id').attr('disabled', false);
								$('#date').attr('readonly', false);
								$('#s_contact_no').attr('readonly', false);

								$('#address-list').show();
								$('#address-input').hide();
							} else {
								$('#address-input').show();
								$('#address-list').hide();
							}
						});

						var contactNo = $('#s_contact_no').val();
						var memberNo = $("#member_no").val();
						$.ajax({
							type: 'GET',
							url: "{{ url('receivers/search-address') }}",
							dataType: 'json',
							delay: 250,
							data: {
								search: '',
								contactNo: contactNo,
								memberNo: memberNo
							}
							,
						}).then(function (mydata) {
							if(mydata != null) {
								var html = '<option value="">Select Address</option>';
								for (var i = 0, len = mydata.items.length; i < len; ++i) {
									html += '<option value="' + mydata.items[i]['id'] + '">' + mydata.items[i]['text'] + '</option>';
								}
								$('#address').children().remove().end().append(html);
								$('#address-list').show();
								$('#address-input').hide();
							}
						});
					}
				});
			});

			$("#s_contact_no").focusout(function(){
				var memberNo = $("#member_no").val();
				var contactNo = $('#s_contact_no').val();

				$.ajax({
					type: 'GET',
					url: "{{ url('receivers/search-address-member') }}",
					dataType: 'json',
					delay: 250,
					data: {
						contactNo: contactNo,
						memberNo: memberNo
					}
					,
				}).then(function (datas) {
					if(datas != null) {
						$('#member_no').val(datas.member_no);

						$('#s_contact_no').attr('readonly', true);

						$('#sender-name').val(datas.s_name);
						$('#sender-name').attr('readonly', true);

						if(datas.s_nric_code_id != 0) {
							$('#nric_code').val(datas.s_nric_code_id);
						}
						if(datas.s_nric_township_id != 0) {
							$('#nric_township').val(datas.s_nric_township_id);
						}
						$('#nric_no').val(datas.s_nric_no);
						$('#nric_no').attr('readonly', true);


						$('#lot_no').attr('readonly', true);

						$('#address').attr('disabled', false);
						$('#country_id').attr('disabled', false);
						$('#state_id').attr('disabled', false);
						$('#date').attr('readonly', false);
						$('#s_contact_no').attr('readonly', false);

						var contactNo = datas.contact_no;
						$.ajax({
							type: 'GET',
							url: "{{ url('receivers/search-address-member') }}",
							dataType: 'json',
							delay: 250,
							data: {
								contactNo: contactNo,
								memberNo: memberNo
							}
							,
						}).then(function (datas) {
							if(datas != null) {
								$('#s_contact_no').attr('readonly', true);

								$('#sender-name').val(datas.s_name);
								$('#sender-name').attr('readonly', true);

								if(datas.s_nric_code_id != 0) {
									$('#nric_code').val(datas.s_nric_code_id);
								}
								if(datas.s_nric_township_id != 0) {
									$('#nric_township').val(datas.s_nric_township_id);
								}
								$('#nric_no').val(datas.s_nric_no);
								$('#nric_no').attr('readonly', true);


								$('#lot_no').attr('readonly', true);

								$('#address').attr('disabled', false);
								$('#country_id').attr('disabled', false);
								$('#state_id').attr('disabled', false);
								$('#date').attr('readonly', false);
								$('#s_contact_no').attr('readonly', false);

								$('#address-list').show();
								$('#address-input').hide();
							} else {
								$('#address-input').show();
								$('#address-list').hide();
							}
						});

						var contactNo = $('#s_contact_no').val();
						var memberNo = $("#member_no").val();
						$.ajax({
							type: 'GET',
							url: "{{ url('receivers/search-address') }}",
							dataType: 'json',
							delay: 250,
							data: {
								search: '',
								contactNo: contactNo,
								memberNo: memberNo
							}
							,
						}).then(function (mydata) {
							if(mydata != null) {
								var html = '<option value="">Select Address</option>';
								for (var i = 0, len = mydata.items.length; i < len; ++i) {
									html += '<option value="' + mydata.items[i]['id'] + '">' + mydata.items[i]['text'] + '</option>';
								}
								$('#address').children().remove().end().append(html);
								$('#address-list').show();
								$('#address-input').hide();
							}
						});
					} else {

						$('#address-input').show();
						$('#address-list').hide();
					}
				});
			});

			$("#address").change(function(){
				var address = $(this).val();

				$.ajax({
					type: 'GET',
					url: "{{ url('lotins/search-receiver') }}",
					dataType: 'json',
					delay: 250,
					data: {
						address: address,
					}
					,
				}).then(function (datas) {
					if(datas != null) {
						$('#r_contact_no').val(datas.contact_no);
						$('#r_contact_no').attr('readonly', true);

						$('#r_name').val(datas.name);
						$('#r_name').attr('readonly', true);

						if(datas.nric_code_id != 0) {
							$('#r_nric_code_id').val(datas.nric_code_id);
						}
						if(datas.nric_township_id != 0) {
							$('#r_nric_township_id').val(datas.nric_township_id);
						}
						$('#r_nric_no').val(datas.nric_no);
						$('#r_nric_no').attr('readonly', true);
					}
				});
			});
		});
	</script>
@stop

