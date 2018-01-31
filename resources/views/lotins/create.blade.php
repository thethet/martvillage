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
											{!! Form::text('to_state_id_news',  $receiverLastNo, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-add', 'autocomplete' => 'off', 'readonly']) !!}
											{!! Form::hidden('to_state_id_new',  $receiverLastId, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'to-adds', 'autocomplete' => 'off', 'readonly']) !!}
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
											{!! Form::select('to_state_ids', ['' => 'Select Address'] + $receiveAddressList->toArray(), null, ['class' => 'form-control', 'id' => 'address', 'autocomplete' => 'off']) !!}
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
										<span class="input-group-addon"><i class="entypo-map"></i></span>
										{!! Form::text('lot_no', $logNo, ['placeholder' => 'Lot No', 'class' => 'form-control', 'id' => 'lot_no', 'autocomplete' => 'off', 'readonly']) !!}
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
										{!! Form::select('from_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control', 'id' => 'country_id', 'autocomplete' => 'off']) !!}
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
										{!! Form::select('from_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'form-control', 'id' => 'state_id', 'autocomplete' => 'off']) !!}
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
										{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['class' => 'form-control', 'id' => 'to_country_id', 'autocomplete' => 'off']) !!}
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
										{!! Form::select('to_state', ['' => 'Select State/City'] + $stateList->toArray(), null, ['class' => 'form-control', 'id' => 'to_state_id', 'autocomplete' => 'off']) !!}
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
													@if ($errors->has("lots.$j.barcode"))
														{!! Form::text('lots['.$j.'][barcode]', null, ['placeholder' => 'Barcode', 'class' => 'form-control barcode has-error', 'id' => 'barcode-'.$j, 'autocomplete' => 'off']) !!}
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.barcode") }}</strong>
														</span>
													@else
														{!! Form::text('lots['.$j.'][barcode]', null, ['placeholder' => 'Barcode', 'class' => 'form-control barcode', 'id' => 'barcode-'.$j, 'autocomplete' => 'off']) !!}
													@endif
													{{-- {{dd($errors)}} --}}
												</td>

												<td>
													{!! Form::select('lots['.$j.'][price_id]',  ['' => 'Select Type'] + $priceList->toArray(), null, ['class' => 'form-control price_id', 'id' => 'priceid-'.$j, 'autocomplete' => 'off']) !!}

													@if ($errors->has("lots.$j.price_id"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.price_id") }}</strong>
														</span>
													@endif
													{!! Form::hidden('lots['.$j.'][category_id]', null, ['placeholder' => 'Category', 'class' => 'form-control category_id', 'id' => 'category_id-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
													{!! Form::hidden('lots['.$j.'][currency_id]', null, ['placeholder' => 'Currency', 'class' => 'form-control currency_id', 'id' => 'currency_id-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
												</td>

												<td>
													<div class="col-sm-7" style="padding: 0;">
														{!! Form::text('lots['.$j.'][unit_price]', null, ['placeholder' => 'Unit Price', 'class' => 'form-control unit_price', 'id' => 'unitprice-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
													</div>
													<label class="col-sm-5 control-label" style="padding: 0;padding-top: 7px;">
														<span id="unit-price-{{ $j }}" class="unit-prices"></span>
													</div>
												</td>

												<td>
													<div class="col-sm-8" style="padding: 0;">
														{!! Form::text('lots['.$j.'][unit]', null, ['placeholder' => 'Unit', 'class' => 'form-control unit', 'id' => 'unit-'.$j, 'autocomplete' => 'off', 'readonly']) !!}
														{{-- {!! Form::text('lots['.$j.'][unit_type]', null, ['placeholder' => 'Unit', 'class' => 'form-control unit-type', 'id' => 'unit-type-'.$j, 'autocomplete' => 'off', 'readonly']) !!} --}}
													</div>
													<label class="col-sm-1 control-label" style="padding-left: 3px;">
														<span id="unit-type-{{ $j }}"></span>
													</label>
													@if ($errors->has("lots.$j.unit"))
														<span class="validate-has-error">
															<strong>{{ $errors->first("lots.$j.unit") }}</strong>
														</span>
													@endif
												</td>

												<td>
													<div class="input-spinner">
														<button type="button" class="btn btn-default">-</button>
															{!! Form::text('lots['.$j.'][quantity]', 1, ['placeholder' => 'Quantity', 'class' => 'form-control quantity size-1', 'id' => 'quantity-'.$j, 'autocomplete' => 'off', 'data-min' => 0, 'data-max' => 99]) !!}
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
												{{ Form::hidden('total_amt', null, ['id' => 'subtotal']) }}
												{{ Form::hidden('item_count', $j, ['id' => 'itm-count']) }}
											</td>
											<td class="text-right">
												<b><span id="sub-text">0.00</span></b>
											</td>
										</tr>

										<tr>
											<td colspan="6" class="text-right"><b>Member Discount (-)</b></td>
											<td class="text-right">
												{{ Form::hidden('member_discount', null, ['id' => 'member_discount']) }}
												{{ Form::hidden('member_discount_amt', null, ['id' => 'member_discount_amt']) }}
												<b><span id="member-rate-text">0</span> %</b>
											</td>
											<td class="text-right">
												<b><span id="member-text">0.00</span></b>
											</td>
										</tr>

										<tr>
											<td colspan="6" class="text-right">
												<b>Other Discount (-)</b><br>
												<label class="control-label col-sm-8">&nbsp;</label>
												<label class="control-label col-sm-2">
													{{ Form::radio('other_discount_type', 0, false, ['class' => 'other_discount_type', 'id' => 'otherp']) }} By Percent
												</label>
												<label class="control-label col-sm-2">
													{{ Form::radio('other_discount_type', 1, false, ['class' => 'other_discount_type', 'id' => 'othera']) }} By Amount
												</label>
											</td>
											<td class="text-right">
												<div class="form-group">
													<label class="col-sm-4 control-label">
														&nbsp;
													</label>
													<div class="col-sm-5" style="padding: 0;">
														{!! Form::text('other_discount', 0, ['placeholder' => 'Other Discount', 'class' => 'form-control', 'id' => 'other_discount', 'autocomplete' => 'off', 'readonly']) !!}

														@if ($errors->has('other_discount'))
															<span class="text-danger">
																<strong>{{ $errors->first('other_discount') }}</strong>
															</span>
														@endif
													</div>
													<label class="col-sm-1 control-label"><b>%</b></label>
												 </div>
											</td>
											<td class="text-right">
												{{ Form::text('other_discount_amt', 0, ['class' => 'form-control', 'id' => 'other_discount_amt', 'autocomplete' => 'off', 'readonly']) }}
												@if ($errors->has('other_discount_amt'))
													<span class="text-danger">
														<strong>{{ $errors->first('other_discount_amt') }}</strong>
													</span>
												@endif
											</td>
										</tr>

										<tr>

											<td colspan="4" rowspan="3" class="text-right">
												{!! Form::textarea('remarks', null, ['placeholder' => 'Remarks', 'class' => 'form-control', 'id' => 'remarks', 'autocomplete' => 'off', 'rows' => 4]) !!}
											</td>
											<td colspan="2" class="text-right"><b>GST</b></td>
											<td class="text-right">
												{{ Form::hidden('gov_tax', $myCompany->gst_rate, ['id' => 'gst']) }}
												{{ Form::hidden('gov_tax_amt', 0.00, ['id' => 'gst_amt']) }}
												<b>{{ $myCompany->gst_rate }} %</b>
											</td>
											<td class="text-right">
												<b><span id="gst-text">0.00</span></b>
											</td>
										</tr>

										<tr>
											<td colspan="2" class="text-right"><b>Service Charges</b></td>
											<td class="text-right">
												{{ Form::hidden('service_charge', $myCompany->service_rate, ['id' => 'service']) }}
												{{ Form::hidden('service_charge_amt', 0.00, ['id' => 'service_amt']) }}
												<b>{{ $myCompany->service_rate }} %</b>
											</td>
											<td class="text-right">
												<b><span id="service-text">0.00</span></b>
											</td>
										</tr>

										<tr>
											<td colspan="2" class="text-right"><b>Net Balance</b></td>
											<td class="text-right">
												{{ Form::hidden('net_amt', null, ['id' => 'net_amt']) }}
											</td>
											<td class="text-right">
												<b><span id="net-text">0.00</span></b>
											</td>
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

@section('my-style')
	<style type="text/css" media="screen">
		.validate-has-error{
			color: #cc2424;
		}

		.has-error {
			border-color: #ffafbd;
		}
	</style>
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

			calculateTotal();

			$('.price_id').attr('readonly', true);
			$('#state_id').attr('readonly', true);
			$('#to_country_id').attr('readonly', true);
			$('#to_state_id').attr('readonly', true);

			$("#company_id").change(function(){
				var companyId = $(this).val();

				$.ajax({
					type: 'GET',
					url: "{{ url('lotins/search-last-receiver') }}",
					dataType: 'json',
					delay: 250,
					data: {
						companyId: companyId,
					}
					,
				}).then(function (datas) {
					if(datas != null) {
						$('#to-add').val(datas);
					}
				});
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
					if(data != null) {
						var html = '<option value="">Select State/City</option>';
						for (var i = 0, len = data.items.length; i < len; ++i) {
							html += '<option value="' + data.items[i]['id'] + '">' + data.items[i]['text'] + '</option>';
						}
						stateSelect.children().remove().end().append(html);
					}
				});
				$('#state_id').attr('readonly', false);
			});

			$("#state_id").change(function(event) {
				$('#to_country_id').attr('readonly', false);

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

				$('#to_state_id').attr('readonly', false);
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
				$('.price_id').attr('readonly', false);
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
					if(data != null) {
						$('#unit-type-' + classes[1]).text(data.unit);
						$('#unitprice-' + classes[1]).val(parseFloat(data.unit_price).toFixed(2));
						$('#category_id-' + classes[1]).val(data.category_id);
						$('#currency_id-' + classes[1]).val(data.currency_id);
						if(data.unit != '%') {
							// $('#unit-price-' + classes[1]).text((parseFloat(data.unit_price).toFixed(2)) + " " + data.type + "(per " + data.unit  + ")");
							$('#unit-' + classes[1]).val(1);
							$('#unit-' + classes[1]).attr('readonly', false);
							$('#unit-price-' + classes[1]).text(data.type + "(per " + data.unit  + ")");
							$('#unitprice-' + classes[1]).attr('readonly', true);
							var amount = parseFloat(data.unit_price) * parseFloat($('#quantity-' + classes[1]).val());
						} else {
							$('#unit-' + classes[1]).val(parseFloat(data.unit_price));
							$('#unit-' + classes[1]).attr('readonly', true);
							$('#unit-price-' + classes[1]).text(data.type);
							$('#unitprice-' + classes[1]).val(1);
							$('#unitprice-' + classes[1]).attr('readonly', false);

							var amount = ((parseFloat(data.unit_price) * parseFloat($('#quantity-' + classes[1]).val())) / 100);

						}

						$('#amount-' + classes[1]).val(parseFloat(amount).toFixed(2));
						calculateTotal();
					} else {
						$('#unit-' + classes[1]).val('');
						$('#unit-type-' + classes[1]).val('');
						$('#unitprice-' + classes[1]).val(parseFloat(0).toFixed(2));
						$('#category_id-' + classes[1]).val(0);
						$('#currency_id-' + classes[1]).val(0);
						$('#unit-price-' + classes[1]).text('');

						var amount = parseFloat(0) * parseFloat($('#quantity-' + classes[1]).val());

						$('#unitprice-' + classes[1]).attr('readonly', true);
						$('#amount-' + classes[1]).val(parseFloat(amount).toFixed(2));
						calculateTotal();
					}
				});
			});

			$('input[type=radio]').change( function() {
				if($(this).val() == 0 ) {
					$('#other_discount').attr('readonly', false);
					$('#other_discount_amt').attr('readonly', true);
					$('#other_discount_amt').val(0);
				} else {
					$('#other_discount').attr('readonly', true);
					$('#other_discount').val(0);
					$('#other_discount_amt').attr('readonly', false);
				}
				calculateTotal();
			});

			$("#other_discount").focusout(function(){
				calculateTotal();
			});

			$("#other_discount_amt").focusout(function(){
				calculateTotal();
			});

			$('.quantity').keyup(function() {
				var classes = this.id.split('-');
				var quantity = parseFloat($(this).val()).toFixed(2);

				var unit = $('#unit-' + classes[1]).val();
				unit = parseFloat(unit).toFixed(2);

				var unitprice = $('#unitprice-' + classes[1]).val();
				unitprice = parseFloat(unitprice).toFixed(2);

				var unittype = $('#unit-type-' + classes[1]).text();

				if(unittype != '%') {
					var amt = quantity * unit * unitprice;
				} else {
					console.log("up: "+unitprice);
					console.log("q: "+quantity);
					console.log("u: "+unit);
					var amt = parseFloat((quantity * unitprice * unit / 100));
					console.log(amt)
				}
				amt = parseFloat(amt).toFixed(2);

				$('#amount-' + classes[1]).val(amt);
				calculateTotal();

			});

			$('.unit').keyup(function() {
				var classes = this.id.split('-');
				var unit = parseFloat($(this).val()).toFixed(2);

				var quantity = $('#quantity-' + classes[1]).val();
				quantity = parseFloat(quantity).toFixed(2);

				var unitprice = $('#unitprice-' + classes[1]).val();
				unitprice = parseFloat(unitprice).toFixed(2);

				var unittype = $('#unit-type-' + classes[1]).text();
				console.log(unitprice);

				if(unittype != '%') {
					var amt = quantity * unit * unitprice;
				} else {
					console.log("up: "+unitprice);
					console.log("q: "+quantity);
					console.log("u: "+unit);
					var amt = parseFloat((quantity * unitprice * unit / 100));
					console.log(amt)
				}
				amt = parseFloat(amt).toFixed(2);
				if(isNaN(amt)) {
					$('#amount-' + classes[1]).val('');
				} else {
					$('#amount-' + classes[1]).val(amt);
				}

				calculateTotal();

			});

			$('.unit_price').keyup(function() {
				var classes = this.id.split('-');
				var unitprice = parseFloat($(this).val()).toFixed(2);

				var quantity = $('#quantity-' + classes[1]).val();
				quantity = parseFloat(quantity).toFixed(2);

				var unit = $('#unit-' + classes[1]).val();
				unit = parseFloat(unit).toFixed(2);

				var unittype = $('#unit-type-' + classes[1]).text();

				if(unittype != '%') {
					var amt = quantity * unit * unitprice;
				} else {
					console.log("up: "+unitprice);
					console.log("q: "+quantity);
					console.log("u: "+unit);
					var amt = parseFloat((quantity * unitprice * unit / 100));
					console.log(amt)
				}
				amt = parseFloat(amt).toFixed(2);
				if(isNaN(amt)) {
					$('#amount-' + classes[1]).val('');
				} else {
					$('#amount-' + classes[1]).val(amt);
				}

				calculateTotal();

			});
		});

		function calculateTotal() {
			var subTotal = 0;
			var netTotal = 0;
			var member = 0;
			var other = 0;
			var gst = 0;
			var service = 0;

			var count = parseInt($('#itm-count').val());

			for(var n = 0; n < count; n++) {
				var amount = parseFloat($('#amount-'+n).val());
				if(isNaN(amount)) {
					amount = 0;
				}
				subTotal = parseFloat(subTotal) + parseFloat(amount);
			}

			subTotal = parseFloat(subTotal).toFixed(2);
			$('#subtotal').val(subTotal);
			$('#sub-text').text(subTotal);

			// Calculate Member Discount
			var memberRate = $('#member_discount').val();
			member = parseFloat(subTotal) * parseFloat(memberRate / 100);
			member = parseFloat(member).toFixed(2);
			$('#member_discount_amt').val(member);
			$('#member-text').text(member);

			// Calculate Other Discount
			var radioValue = $("input[name='other_discount_type']:checked").val();
			if(radioValue == 0){
				var otherRate = $('#other_discount').val();
				other = parseFloat(subTotal) * parseFloat(otherRate / 100);
				if(isNaN(other)) {
					other = 0;
				}
				other = parseFloat(other);
			} else {
				var other = $('#other_discount_amt').val();
				if(isNaN(other)) {
					other = 0;
				}
				other = parseFloat(other);
			}
			$('#other_discount_amt').val(other);

			// Calculate GST Amount
			var gstRate = $('#gst').val();
			gst = parseFloat(subTotal) * parseFloat(gstRate / 100);
			gst = parseFloat(gst).toFixed(2);
			$('#gst_amt').val(gst);
			$('#gst-text').text(gst);

			// Calculate ServiceCharge Amount
			var serviceRate = $('#service').val();
			service = parseFloat(subTotal) * parseFloat(serviceRate / 100);
			service = parseFloat(service).toFixed(2);
			$('#service_amt').val(service);
			$('#service-text').text(service);

			netTotal = parseFloat(subTotal) + parseFloat(gst) + parseFloat(service) - parseFloat(member) - parseFloat(other);
			netTotal = parseFloat(netTotal).toFixed(2);
			$('#net_amt').val(netTotal);
			$('#net-text').text(netTotal);
		}
	</script>
@stop

