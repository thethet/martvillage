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

		{!! Form::open(array('route' => 'lotins.store','method'=>'POST', 'id' => 'lotin-form', 'class' => 'form-horizontal')) !!}
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Contact No: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('s_contact_no', null, array('placeholder' => 'Contact No','class' => 'form-control', 'id' => 's_contact_no')) !!}
						@if ($errors->has('s_contact_no'))
							<span class="required">
								<strong>{{ $errors->first('s_contact_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Member No: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('member_no', null, array('placeholder' => 'Member No','class' => 'form-control', 'id' => 'member_no')) !!}
						@if ($errors->has('member_no'))
							<span class="required">
								<strong>{{ $errors->first('member_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Sender Name: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('sender_name', null, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'sender-name')) !!}
						@if ($errors->has('sender_name'))
							<span class="required">
								<strong>{{ $errors->first('sender_name') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>NRIC: <span class="required">*</span></strong>
					</label>

					<div class="col-sm-3" style="padding-right: 0;">
						{!! Form::select('nric_code_id', ['' => 'Code'] + $nricCodes->toArray(), null, ['class' => 'form-control', 'id' => 'nric_code', 'disabled' => true]) !!}
						@if ($errors->has('nric_code_id'))
							<span class="required">
								<strong>{{ $errors->first('nric_code_id') }}</strong>
							</span>
						@endif
					</div>

					<div class="col-sm-3" style="padding-right: 0;">
						{!! Form::select('nric_township_id', ['' => 'Township'] + $nricTownships->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'nric_township', 'disabled' => true]) !!}
						@if ($errors->has('nric_township_id'))
							<span class="required">
								<strong>{{ $errors->first('nric_township_id') }}</strong>
							</span>
						@endif
					</div>

				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
					</label>

					<div class="col-sm-7" style="padding-right: 0;">
						{!! Form::text('nric_no', null, array('placeholder' => '(N) xxxxxx','class' => 'form-control', 'id' => 'nric_no', 'readonly' => true)) !!}
						@if ($errors->has('nric_no'))
							<span class="required">
								<strong>{{ $errors->first('nric_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->
			</div>

			<div class="col-sm-4">
				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>To: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7" id="address-input">
						{!! Form::text('to_state_id_new', null, array('placeholder' => 'Address','class' => 'form-control', 'id' => 'to-add', 'readonly' => true)) !!}
					</div>
					<div class="col-sm-7" id="address-list">
						{!! Form::select('to_state_id', ['' => 'Address'] + $receiveAddress->toArray(), null, ['class' => 'form-control', 'id' => 'address', 'readonly' => true]) !!}

						<a href="#" class="addbtn" id="noadd">address</a>
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Contact No: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('r_contact_no', null, array('placeholder' => 'Contact No','class' => 'form-control', 'id' => 'r_contact_no', 'readonly' => true)) !!}
						@if ($errors->has('r_contact_no'))
							<span class="required">
								<strong>{{ $errors->first('r_contact_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Receiver Name: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('receiver_name', null, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'r_name', 'readonly' => true)) !!}
						@if ($errors->has('receiver_name'))
							<span class="required">
								<strong>{{ $errors->first('receiver_name') }}</strong>
							</span>
						@endif
					</div>
					<div class="col-sm-3"></div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>NRIC: <span class="required">*</span></strong>
					</label>

					<div class="col-sm-3" style="padding-right: 0;">
						{!! Form::select('r_nric_code_id', ['' => 'Code'] + $nricCodes->toArray(), null, ['class' => 'form-control', 'id' => 'r_nric_code', 'disabled' => true]) !!}
						@if ($errors->has('r_nric_code_id'))
							<span class="required">
								<strong>{{ $errors->first('r_nric_code_id') }}</strong>
							</span>
						@endif
					</div>

					<div class="col-sm-3" style="padding-right: 0;">
						{!! Form::select('r_nric_township_id', ['' => 'Township'] + $nricTownships->toArray(), null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'r_nric_township', 'disabled' => true]) !!}
						@if ($errors->has('r_nric_township_id'))
							<span class="required">
								<strong>{{ $errors->first('r_nric_township_id') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
					</label>


					<div class="col-sm-7" style="padding-right: 0;">
						{!! Form::text('r_nric_no', null, array('placeholder' => '(N) xxxxxx','class' => 'form-control', 'id' => 'r_nric_no', 'readonly' => true)) !!}
						@if ($errors->has('r_nric_no'))
							<span class="required">
								<strong>{{ $errors->first('r_nric_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->
			</div>

			<div class="col-sm-4">
				<div class="form-group">
					<label class="control-label col-sm-3" for="date"><strong>Date:<span class="required">*</span></strong></label>
					<div class="col-sm-7">
						{!! Form::text('date', null, array('placeholder' => 'Enter Date','class' => 'form-control', 'id' => 'date')) !!}
						@if ($errors->has('date'))
							<span class="required">
								<strong>{{ $errors->first('date') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="logno"><strong>Log No:<span class="required">*</span></strong></label>
					<div class="col-sm-7">
						{!! Form::text('lot_no', $logNo, array('placeholder' => 'Enter Lot No','class' => 'form-control', 'id' => 'lot_no', 'readonly' => true)) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="from"><strong>From:<span class="required">*</span></strong></label>
					<div class="col-sm-7">
						{!! Form::select('country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'country_id', 'class' => 'form-control']) !!}
						@if ($errors->has('country_id'))
							<span class="required">
								<strong>{{ $errors->first('country_id') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="from"></label>
					<div class="col-sm-7">
						{!! Form::select('state_id', ['' => 'Select State'] + $states->toArray(), null, ['id'=>'state_id', 'class' => 'form-control']) !!}
						@if ($errors->has('state_id'))
							<span class="required">
								<strong>{{ $errors->first('state_id') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="from"><strong>Payment:<span class="required">*</span></strong></label>
					<div class="col-sm-7">
						{!! Form::select('payment', ['' => 'Select Payment'] + Config::get('myVars.Payment'), null, ['id'=>'payment', 'class' => 'form-control']) !!}
						@if ($errors->has('payment'))
							<span class="required">
								<strong>{{ $errors->first('payment') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->
			</div>
		</div>

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
							<th width="80px">Unit </th>
							<th width="80px">Quantity</th>
							<th width="120px">Amount</th>
						</tr>
					</thead>

					<tbody>
						<?php $j = 0; ?>
						@for($i = 0; $i < 5; $i++)
							<tr id="row{{ $j }}">
								<td>{{ $j+1 }}</td>
								<td>
									{!! Form::text('lots['.$j.'][item_name]', null, array('placeholder' => 'Enter Item Name','class' => 'form-control item_name', 'id' => 'itemname-'.$j)) !!}
									@if ($errors->has("lots.$j.item_name"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.item_name") }}</strong>
										</span>
									@endif
								</td>
								<td>
									{!! Form::text('lots['.$j.'][barcode]', null, array('placeholder' => 'Enter Barcode','class' => 'form-control barcode', 'id' => 'barcode-'.$j)) !!}
									@if ($errors->has("lots.$j.barcode"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.barcode") }}</strong>
										</span>
									@endif
								</td>
								<td>
									{!! Form::select('lots['.$j.'][price_id]', ['' => 'Select Type'] + $priceList->toArray(), null, ['class' => 'form-control price_id', 'id' => 'priceid-'.$j]) !!}
									@if ($errors->has("lots.$j.price_id"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.price_id") }}</strong>
										</span>
									@endif
								</td>
								<td>
									{!! Form::text('lots['.$j.'][unit_price]', null, array('placeholder' => 'Enter Unit Price','class' => 'form-control unit_price', 'readonly' => true, 'id' => 'unitprice-'.$j)) !!}
									@if ($errors->has("lots.$j.unit_price"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.unit_price") }}</strong>
										</span>
									@endif
								</td>
								<td>
									{!! Form::text('lots['.$j.'][unit]', null, array('placeholder' => 'Enter Unit','class' => 'form-control unit', 'id' => 'unit-'.$j)) !!}
									@if ($errors->has("lots.$j.unit"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.unit") }}</strong>
										</span>
									@endif
								</td>
								<td>
									{!! Form::text('lots['.$j.'][quantity]', null, array('placeholder' => 'Enter Quantity','class' => 'form-control quantity', 'id' => 'quantity-'.$j)) !!}
									@if ($errors->has("lots.$j.quantity"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.quantity") }}</strong>
										</span>
									@endif
								</td>
								<td>
									{!! Form::text('lots['.$j.'][amount]', null, array('placeholder' => 'Enter Amount','class' => 'form-control amount', 'id' => 'amount-'.$j, 'readonly' => true)) !!}
									@if ($errors->has("lots.$j.amount"))
										<span class="required">
											<strong>{{ $errors->first("lots.$j.amount") }}</strong>
										</span>
									@endif
								</td>
							</tr>
							<?php $j++; ?>
						@endfor

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
								{{ Form::hidden('subtotal', null, ['id' => 'subtotal']) }}
								{{ Form::hidden('item_count', $j, ['id' => 'itm-count']) }}
							</td>
							<td class="right" id="subtotal-1"></td>
						</tr>

						<tr>
							<td colspan="2">Member Discount (-):</td>
							<td></td>
							<td colspan="3" class="right">Other Discount</td>
							<td class="right" id="discount-0">
								-10%
								{{ Form::hidden('discount', null, ['id' => 'discount']) }}
							</td>
							<td class="right" id="discount-1"></td>
						</tr>

						<tr>
							<td colspan="6" class="right">Service Charge:</td>
							<td class="right" id="scharge-0">
								10%
								{{ Form::hidden('service', null, ['id' => 'service']) }}
							</td>
							<td class="right" id="scharge-1"></td>
						</tr>
						<tr>
							<td colspan="6" class="right">GST</td>
							<td class="right" id="gst-0">
								7%
								{{ Form::hidden('gst', null, ['id' => 'gst']) }}
							</td>
							<td class="right" id="gst-1"></td>
						</tr>
						<tr>
							<td colspan="6" class="right">Total</td>
							<td class="right" id="total-10">
								{{ Form::hidden('total', null, ['id' => 'total']) }}
							</td>
							<td class="right" id="total-1"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		{!! Form::close() !!}

	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			@permission('lotin-create')
				<div class="menu-icon">
					<a href="#" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('lotin-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="#" id="delete">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('lotin-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
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
		$(document).ready(function(){
			var date_input=$('input[name="date"]'); //our date input has the name "date"
			var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			});

			$("a#noadd").bind('click', function () {
				$('#address-input').show();
				$('#address-list').hide();

				$('#r_contact_no').val('');
				$('#r_contact_no').attr('readonly', false);

				$('#to_state_id').val('');
				$('#to_state_id').attr('readonly', false);
				$('#to-add').attr('readonly', false);

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

			$('#address-list').hide();

			$("#country_id").select2();

			$("#payment").select2();

			$('#country_id').change(function() {
				$('#select2-state_id-container').text('Select State');
				$('#state_id').val('');
			});

			$("#state_id").select2({
				ajax: {
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var countryId = $('#country_id').val();
						return {
							search: params.term,
							countryId: countryId
						};
					},
					processResults: function (data, params) {
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$("#nric_code").select2();

			$("#nric_township").select2({
				ajax: {
					url: "{{ url('nrictownships/nric-township') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var nricCodeId = $('#nric_code').val();
						return {
							search: params.term,
							nricCodeId: nricCodeId
						};
					},
					processResults: function (data, params) {
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$("#r_nric_code").select2();

			$("#r_nric_township").select2({
				ajax: {
					url: "{{ url('nrictownships/nric-township') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var nricCodeId = $('#r_nric_code').val();
						return {
							search: params.term,
							nricCodeId: nricCodeId
						};
					},
					processResults: function (data, params) {
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$('#s_contact_no').keyup (function() {
				var contactNo = $('#s_contact_no').val();
				var memberNo = $('#member_no').val();

				$.ajax({
					url: "{{ url('receivers/search-address-member') }}",
					dataType: 'json',
					delay: 250,
					data: {
						contactNo: contactNo,
						memberNo: memberNo
					},
					success: function(data) {

						if(!data) {
							$('input').attr('readonly', false);
							$("form select").attr('disabled', false);
							$('#lot_no').attr('readonly', true);
							$('#address-input').show();
							$('#address-list').hide();

							$('#member_no').val('');

							$('#sender-name').val('');
							$('#sender-name').attr('readonly', false);

							$('#nric_code').val('');
							$('#select2-nric_code-container').text('Code');

							$('#nric_township').val('');
							$('#select2-nric_township-container').text('Township');

							$('#nric_no').val('');
							$('#nric_no').attr('readonly', false);
						} else {
							$('#member_no').val(data.member_no);
							$('#member_no').attr('readonly', true);

							$('#sender-name').val(data.s_name);
							$('#sender-name').attr('readonly', true);

							$('#nric_code').val(data.s_nric_code_id);
							$('#select2-nric_code-container').text(data.s_nric_code_id);

							$('#nric_township').val(data.s_nric_tp_id);
							$('#select2-nric_township-container').text(data.s_township);

							$('#nric_no').val(data.s_nric_no);
							$('#nric_no').attr('readonly', true);

							// $("form select").attr('disabled', true);
							// $("input").attr('readonly', true);
							$('#lot_no').attr('readonly', true);

							$('#address').attr('disabled', false);
							$('#country_id').attr('disabled', false);
							$('#state_id').attr('disabled', false);
							$('#date').attr('readonly', false);
							$('#s_contact_no').attr('readonly', false);

							$('#address-list').show();
							$('#address-input').hide();
						}
					}
				});
			});

			$('#member_no').keyup (function() {
				var contactNo = $('#s_contact_no').val();
				var memberNo = $('#member_no').val();

				$.ajax({
					url: "{{ url('receivers/search-address-member') }}",
					dataType: 'json',
					delay: 250,
					data: {
						contactNo: contactNo,
						memberNo: memberNo
					},
					success: function(data) {

						if(!data) {
							$('input').attr('readonly', false);
							$("form select").attr('disabled', false);
							$('#lot_no').attr('readonly', true);
							$('#address-input').show();
							$('#address-list').hide();

							// $('#s_contact_no').val('');

							$('#sender-name').val('');
							$('#sender-name').attr('readonly', false);

							$('#nric_code').val('');
							$('#select2-nric_code-container').text('Code');

							$('#nric_township').val('');
							$('#select2-nric_township-container').text('Township');

							$('#nric_no').val('');
							$('#nric_no').attr('readonly', false);
						} else {
							$('#s_contact_no').val(data.s_contact_no);
							$('#s_contact_no').attr('readonly', true);

							$('#sender-name').val(data.s_name);
							$('#sender-name').attr('readonly', true);

							$('#nric_code').val(data.s_nric_code_id);
							$('#select2-nric_code-container').text(data.s_nric_code_id);

							$('#nric_township').val(data.s_nric_tp_id);
							$('#select2-nric_township-container').text(data.s_township);

							$('#nric_no').val(data.s_nric_no);
							$('#nric_no').attr('readonly', true);

							// $("form select").attr('disabled', true);
							// $("input").attr('readonly', true);
							$('#lot_no').attr('readonly', true);

							$('#address').attr('disabled', false);
							$('#country_id').attr('disabled', false);
							$('#state_id').attr('disabled', false);
							$('#date').attr('readonly', false);
							$('#s_contact_no').attr('readonly', false);

							$('#address-list').show();
							$('#address-input').hide();
						}
					}
				});
			});


			$('#address').change(function() {

				var address = $(this).val();

				$.ajax({
					url: "{{ url('lotins/search-receiver') }}",
					dataType: 'json',
					delay: 250,
					data: {
						address: address,
					},
					success: function(data) {
						if(!data) {
							$('input').attr('readonly', false);
							$("form select").attr('disabled', false);
							$('#lot_no').attr('readonly', true);
							$('#address-input').show();
							$('#address-list').hide();

							$('#r_contact_no').val('');
							$('#r_contact_no').attr('readonly', false);

							$('#r_name').val('');
							$('#r_name').attr('readonly', false);

							$('#r_nric_code').val('');
							$('#select2-r_nric_code-container').text('Code');

							$('#nric_township').val('');
							$('#select2-r_nric_township-container').text('Township');

							$('#r_nric_no').val('');
							$('#r_nric_no').attr('readonly', false);

						} else {
							$('#r_contact_no').val(data.contact_no);
							$('#r_contact_no').attr('readonly', true);

							$('#r_name').val(data.name);
							$('#r_name').attr('readonly', true);

							$('#r_nric_code').val(data.nric_code_id);
							$('#select2-r_nric_code-container').text(data.nric_code_id);

							$('#r_nric_township').val(data.s_nric_tp_id);
							$('#select2-r_nric_township-container').text(data.r_township);

							$('#r_nric_no').val(data.nric_no);
							$('#r_nric_no').attr('readonly', true);

							// $("form select").attr('disabled', false);
							$('#lot_no').attr('readonly', true);
							$('#address-list').show();
							$('#address-input').hide();
						}
					}
				});
			});

			$("#address").select2({
				ajax: {
					url: "{{ url('receivers/search-address') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var contactNo = $('#s_contact_no').val();
						var memberNo = $('#member_no').val();
						return {
							search: params.term,
							contactNo: contactNo,
							memberNo: memberNo
						};
					},
					processResults: function (data, params) {
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$('.table .price_id').on('change', function() {
				var priceId = $(this).val();
				var classes = this.id.split('-');

				$.ajax({
					url: "{{ url('lotins/search-unitprice') }}",
					dataType: 'json',
					delay: 250,
					data: {
						priceId: priceId,
					},
					success: function(data) {
						$('#unitprice-' + classes[1]).val(parseFloat(data.unit_price).toFixed(2));
						$('#unitprice-' + classes[1]).attr('readonly', true);
					}
				});
			});


			$('.unit').keyup(function() {
				var classes = this.id.split('-');
				var unit = parseFloat($(this).val()).toFixed(2);

				var unitprice = $('#unitprice-' + classes[1]).val();
				unitprice = parseFloat(unitprice).toFixed(2);

				var amt = unit * unitprice;
				amt = parseFloat(amt).toFixed(2);

				$('#amount-' + classes[1]).val(amt);

				var subTotal = 0;
				$('.amount').each(function( index2 ) {
					subTotal = subTotal + $(this).val();
					subTotal = parseFloat(subTotal).toFixed(2);
				});
				subTotal = parseFloat(subTotal).toFixed(2);
				$('#subtotal-1').text(subTotal);

				var discount = parseFloat((subTotal * 0.1)).toFixed(2);
				var scharge = parseFloat((subTotal * 0.1)).toFixed(2);
				var gst = parseFloat((subTotal * 0.07)).toFixed(2);
				var total = parseFloat((subTotal - discount - scharge - gst)).toFixed(2);

				$('#discount').val(discount);
				$('#discount-1').text(discount);
				$('#service').val(scharge);
				$('#scharge-1').text(scharge);
				$('#gst').val(gst);
				$('#gst-1').text(gst);
				$('#total').val(total);
				$('#total-1').text(total);
			});

			$('.quantity').keyup(function() {
				var classes = this.id.split('-');
				var quantity = parseFloat($(this).val()).toFixed(2);
				var unit = $('#unit-' + classes[1]).val();
				unit = parseFloat(unit).toFixed(2);
				var unitprice = $('#unitprice-' + classes[1]).val();
				unitprice = parseFloat(unitprice).toFixed(2);

				var amt = quantity * unit * unitprice;
				amt = parseFloat(amt).toFixed(2);
				$('#amount-' + classes[1]).val(amt);

				var subTotal = 0;
				$('.amount').each(function( index2 ) {
					subTotal = subTotal + $(this).val();
					subTotal = parseFloat(subTotal).toFixed(2);
				});
				subTotal = parseFloat(subTotal).toFixed(2);
				$('#subtotal-1').text(subTotal);

				var discount = parseFloat((subTotal * 0.1)).toFixed(2);
				var scharge = parseFloat((subTotal * 0.1)).toFixed(2);
				var gst = parseFloat((subTotal * 0.07)).toFixed(2);
				var total = parseFloat((subTotal - discount - scharge - gst)).toFixed(2);

				$('#discount').val(discount);
				$('#discount-1').text(discount);
				$('#service').val(scharge);
				$('#scharge-1').text(scharge);
				$('#gst').val(gst);
				$('#gst-1').text(gst);
				$('#total').val(total);
				$('#total-1').text(total);
			});

			/*$("a#add-item").bind('click', function () {
				var cnt = $('#itm-count').val();
				var lrow = cnt-1;

				alert('hi'+cnt)

				var clone = $("#row"+lrow).clone();
				clone.find('td').each(function(){
					var el = $(this).find(':first-child');
					var id = el.attr('id') || null;
					var name = el.attr('name') || null;
					if(id) {
						var i = id.substr(id.length-1);
						var idprefix = id.substr(0, (id.length-1));
						var nameprefix = name.split('[');
						var nameids = nameprefix[1];
						var nameid = nameids.split(']');
						var ids = parseInt(nameid[0]) + 1;
						var txtname = nameprefix[0] + "[" + ids + "]" + "[" + nameprefix[2];
						console.log(txtname)
						el.attr('id', idprefix+(+i+1));
						el.attr('name', txtname);
					}
				});
				$("#row"+lrow).after(clone);
				clone.find('td:first-child').text(parseInt(cnt)+1)
			});*/




			/*$(".editboxes").change(function() {
				var $el = $(this);
				if ($el.is(":checked")) {
					$('.editboxes').attr('disabled', true);
					$el.attr("disabled", false);
				}
				else {
					$('.editboxes').attr('disabled', false);
				}
			});

			$("#edit").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{{ url('users/ajax/id/edit') }}",
							type: 'GET',
							data: { id: id },
							success: function(data)
							{
								window.location.replace(data.url);
							}
						});
					}
				});
			});

			$("#delete").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{!! url('users/"+ id +"') !!}",
							type: 'DELETE',
							data: {_token: '{!! csrf_token() !!}'},
							dataType: 'JSON',
							success: function (data) {
								window.location.replace(data.url);
							}
						});
					}
				});
			});*/
		});


	</script>
@stop
