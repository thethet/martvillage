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
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('lotins') }}">Lotin Management</a>
			</li>
			<li class="active">
				<strong>New Create Form</strong>
			</li>
		</ol>

		<h2>Lotin Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>New Create Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::open(array('route' => 'lotins.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

							<div class="form-group {{ $errors->has('company_id') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Company Name <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-suitcase"></i></span>
										@if(Auth::user()->hasRole('administrator'))
											{!! Form::select('company_id', ['' => 'Select Company'] + $companyList->toArray(), null, ['class' => 'form-control', 'id' => 'company_id', 'autocomplete' => 'off']) !!}
										@else
											{!! Form::text('company_name', Auth::user()->company->company_name, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
											{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
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
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('member_no', null, ['placeholder' => 'Member No', 'class' => 'form-control', 'id' => 'member_no', 'autocomplete' => 'off']) !!}
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
										{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control', 'id' => 'nric_code', 'data-allow-clear' => 'true']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nric_township']) !!}
									</div>
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::text('nric_no', null, ['placeholder' => '(N) xxxxxx','class' => 'form-control', 'autocomplete' => 'off']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">To <span class="text-danger">*</span></label>

								<div id="address-input">
									<div class="col-sm-5">
										<div class="input-group minimal">
											<span class="input-group-addon"><i class="entypo-users"></i></span>
											{!! Form::text('to_state_id_news',  $receiverLastNo, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-add', 'autocomplete' => 'off', 'readonly']) !!}
											{!! Form::hidden('to_state_id_new',  $receiverLastNo, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-adds', 'autocomplete' => 'off', 'readonly']) !!}
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
											{!! Form::select('to_state_ids', ['' => 'Select Address'] + $receiveAddressList->toArray(), null, ['class' => 'form-control', 'id' => 'address', 'autocomplete' => 'off', 'readonly']) !!}
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
										{!! Form::select('r_nric_code_id', ['' => 'Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control', 'id' => 'r_nric_code', 'data-allow-clear' => 'true']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-vcard"></i></span>
										{!! Form::select('r_nric_township_id', ['' => 'Township'] + $nricTownshipList->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'r_nric_township']) !!}
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
										{!! Form::text('date', date('Y-m-d'), ['placeholder' => 'Date','class' => 'form-control datepicker', 'id' => 'date', 'data-format' => 'yyyy-mm-dd', 'autocomplete' => 'off']) !!}
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
										<span class="input-group-addon"><i class="entypo-info"></i></span>
										{!! Form::text('lot_no', $logNo, ['placeholder' => 'Lot No', 'class' => 'form-control', 'id' => 'lot_no', 'autocomplete' => 'off', 'readonly']) !!}
									</div>

									@if ($errors->has('lot_no'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('lot_no') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('country_id') || $errors->has('state_id')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">From Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('country_id', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control', 'id' => 'country_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('country_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('country_id') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('state_id', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'form-control', 'id' => 'state_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('state_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('state_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('to_country_id') || $errors->has('to_state_id')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">To Location <span class="text-danger">*</span></label>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-globe"></i></span>
										{!! Form::select('to_country_id', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control', 'id' => 'to_country_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_country_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_country_id') }}</strong>
										</span>
									@endif
								</div>

								<div class="col-sm-4">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-location"></i></span>
										{!! Form::select('to_state_id', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'form-control', 'id' => 'to_state_id', 'autocomplete' => 'off']) !!}
									</div>

									@if ($errors->has('to_state_id'))
										<span class="validate-has-error">
											<strong>{{ $errors->first('to_state_id') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group {{ ($errors->has('payment')) ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Payment <span class="text-danger">*</span></label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon">&nbsp;<i class="fa fa-usd"></i>&nbsp;</span>
										{!! Form::select('payment', ['' => 'Select Payment'] + Config::get('myVars.Payment'), null, ['class' => 'form-control', 'id' => 'payment', 'autocomplete' => 'off']) !!}
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
											<th>Unit Price</th>
											<th width="8%">Unit</th>
											<th width="13%">Quantity</th>
											<th width="10%">Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php $j = 0; ?>
										@for($i = 0; $i < 7; $i++)
											<tr id="row{{ $j }}">
												<td>{{ $j+1 }}</td>
												<td>
													{!! Form::text('lots['.$j.'][item_name]', null, ['placeholder' => 'Item Name', 'class' => 'form-control item_name', 'id' => 'itemname-'.$j, 'autocomplete' => 'off']) !!}
													@if ($errors->has("lots.$j.item_name"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.item_name") }}</strong>
														</span>
													@endif
												</td>

												<td>
													{!! Form::text('lots['.$j.'][barcode]', null, ['placeholder' => 'Barcode', 'class' => 'form-control barcode', 'id' => 'barcode-'.$j, 'autocomplete' => 'off']) !!}
													@if ($errors->has("lots.$j.barcode"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.barcode") }}</strong>
														</span>
													@endif
												</td>

												<td>
													{!! Form::select('lots['.$j.'][price_id]',  ['' => 'Select Type'] + $priceList->toArray(), null, ['class' => 'form-control price_id', 'id' => 'priceid-'.$j, 'autocomplete' => 'off']) !!}

													@if ($errors->has("lots.$j.price_id"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.price_id") }}</strong>
														</span>
													@endif
													{!! Form::hidden('lots['.$j.'][unit_price]', null, ['placeholder' => 'Unit Price', 'class' => 'form-control unit_price', 'id' => 'unitprice-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
													{!! Form::hidden('lots['.$j.'][category_id]', null, ['placeholder' => 'Category', 'class' => 'form-control category_id', 'id' => 'category_id-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
												</td>

												<td id="unit-price-{{ $j }}" class="unit-prices">
												</td>

												<td>
													<div class="form-group" style="margin: 0;">
														<div class="col-sm-9" style="padding: 0;">
															{!! Form::text('lots['.$j.'][unit]', null, ['placeholder' => 'Unit', 'class' => 'form-control unit', 'id' => 'unit-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
															{!! Form::hidden('lots['.$j.'][unit_type]', null, ['placeholder' => 'Unit', 'class' => 'form-control unit-type', 'id' => 'unit-type-'.$j, 'autocomplete' => 'off']) !!}
														</div>
														<label class="control-label col-sm-3" style="padding-left: 5px; padding-right: 0;">
															<span id="unit-types-{{ $j }}" class="unit-types"></span>
														</label>
													</div>
													@if ($errors->has("lots.$j.unit"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.unit") }}</strong>
														</span>
													@endif
												</td>

												<td>

													<div class="input-spinner">
														<button type="button" class="btn btn-default">-</button>
															{!! Form::text('lots['.$j.'][quantity]', 1, ['placeholder' => 'Quantity', 'class' => 'form-control size-1', 'id' => 'quantity-'.$j, 'autocomplete' => 'off', 'data-min' => 0, 'data-max' => 99]) !!}
														<button type="button" class="btn btn-default">+</button>
													</div>

													@if ($errors->has("lots.$j.quantity"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.quantity") }}</strong>
														</span>
													@endif
												</td>

												<td>
													{!! Form::text('lots['.$j.'][amount]', null, ['placeholder' => 'Amount', 'class' => 'form-control amount', 'id' => 'amount-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
													@if ($errors->has("lots.$j.amount"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.amount") }}</strong>
														</span>
													@endif
												</td>
											</tr>
											<?php $j++; ?>
										@endfor


										@for($x = 0; $x < 3; $x++)
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
											<td class="text-right">
												{{ Form::hidden('subtotal', null, ['id' => 'subtotal']) }}
												{{ Form::hidden('item_count', $j, ['id' => 'itm-count']) }}
											</td>
											<td class="text-right"></td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>Member Discount</b></td>
											<td class="text-right"></td>
											<td class="text-right"></td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>Other Discount</b></td>
											<td class="text-right"></td>
											<td class="text-right"></td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>GST</b></td>
											<td class="text-right">
												{{ Form::hidden('gst', $myCompany->gst_rate, ['id' => 'service']) }}
												<b>{{ $myCompany->gst_rate }} %</b>
											</td>
											<td class="text-right"></td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>Service Charges</b></td>
											<td class="text-right">
												{{ Form::hidden('service', $myCompany->service_rate, ['id' => 'service']) }}
												<b>{{ $myCompany->service_rate }} %</b>
											</td>
											<td class="text-right"></td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>Net Balance</b></td>
											<td class="text-right"></td>
											<td class="text-right"></td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<button type="submit" class="btn btn-success btn-icon">
										Save
										<i class="entypo-floppy"></i>
									</button>
									<button type="reset" class="btn btn-info btn-icon">
										Reset
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
					var html = '<option value="">Township</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					nricTwnSelect.children().remove().end().append(html) ;
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
					var html = '<option value="">Township</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					nricTwnSelect.children().remove().end().append(html) ;
				});
			});

			$("#country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var countryId = $('#country_id').val();
				var stateSelect = $('#state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						countryId: countryId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});
			});

			$("#to_country_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var countryId = $('#to_country_id').val();
				var stateSelect = $('#to_state_id');
				$.ajax({
					type: 'GET',
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: {
						search: '',
						countryId: countryId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select State/City</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html) ;
				});
			});

			$("#to_state_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var fromCountryId = $('#country_id').val();
				var fromStateId = $('#state_id').val();
				var toCountryId = $('#to_country_id').val();
				var toStateId = $('#to_state_id').val();
				var stateSelect = $('.price_id');
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
						toStateId: toStateId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select Type</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html);
				});
			});


			$(".price_id").change(function(event) {
				// Fetch the preselected item, and add to the control
				var priceId = $(this).val();
				var classes = this.id.split('-');

				$.ajax({
					type: 'GET',
					url: "{{ url('lotins/search-unitprice') }}",
					dataType: 'json',
					delay: 250,
					data: {
						priceId: priceId
					}
					,
				}).then(function (data) {
					var html = '<option value="">Select Type</option>';
					for (var i = 0, len = data.items.length; i < len; ++i) {
						html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
					}
					stateSelect.children().remove().end().append(html);
				});
			});
		});
	</script>
@stop

