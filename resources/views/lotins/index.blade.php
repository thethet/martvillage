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
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Member No: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('member_no', null, array('placeholder' => 'Member No','class' => 'form-control', 'id' => 'member_no')) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Sender Name: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('sender_name', null, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'sender-name')) !!}
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
						{!! Form::text('nric_no', null, array('placeholder' => '(N) xxxxxx','class' => 'form-control', 'readonly' => true)) !!}
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
						{!! Form::text('to_state_id', null, array('placeholder' => 'Address','class' => 'form-control', 'readonly' => true)) !!}
					</div>
					<div class="col-sm-7" id="address-list">
						{!! Form::select('to_state_id', ['' => 'Address'] + $receiveAddress->toArray(), null, ['class' => 'form-control', 'id' => 'address', 'readonly' => true]) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Contact No: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('r_contact_no', null, array('placeholder' => 'Contact No','class' => 'form-control', 'readonly' => true)) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-5" for="currency">
						<strong>Receiver Name: <span class="required">*</span></strong>
					</label>
					<div class="col-sm-7">
						{!! Form::text('receiver_name', null, array('placeholder' => 'Name','class' => 'form-control', 'readonly' => true)) !!}
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
						{!! Form::text('r_nric_no', null, array('placeholder' => '(N) xxxxxx','class' => 'form-control', 'readonly' => true)) !!}
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
						@if ($errors->has('lot_no'))
							<span class="required">
								<strong>{{ $errors->first('lot_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="from"><strong>From:<span class="required">*</span></strong></label>
					<div class="col-sm-7">
						{!! Form::select('country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'country_id', 'class' => 'form-control']) !!}
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="from"></label>
					<div class="col-sm-7">
						{!! Form::select('state_id', ['' => 'Select State'] + $states->toArray(), null, ['id'=>'state_id', 'class' => 'form-control']) !!}
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
							<th>Item</th>
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
							<tr>
								<td>{{ $i+1 }}</td>
								<td>
									{!! Form::text('item_name[]', null, array('placeholder' => 'Enter Log No','class' => 'form-control item_name', 'id' => 'itemname-'.$j)) !!}
								</td>
								<td>
									{!! Form::text('barcode[]', null, array('placeholder' => 'Enter Barcode','class' => 'form-control barcode', 'id' => 'barcode-'.$j)) !!}
								</td>
								<td>
									{!! Form::select('price_id[]', ['' => 'Select Type'] + $priceList->toArray(), null, ['class' => 'form-control price_id', 'id' => 'priceid-'.$j]) !!}
								</td>
								<td>
									{!! Form::text('unit_price[]', null, array('placeholder' => 'Enter Unit Price','class' => 'form-control unit_price', 'readonly' => true, 'id' => 'unitprice-'.$j)) !!}
								</td>
								<td>
									{!! Form::text('unit[]', null, array('placeholder' => 'Enter Unit','class' => 'form-control unit', 'id' => 'unit-'.$j)) !!}
								</td>
								<td>
									{!! Form::text('quantity[]', null, array('placeholder' => 'Enter Quantity','class' => 'form-control quantity', 'id' => 'quantity-'.$j)) !!}
								</td>
								<td>
									{!! Form::text('amount[]', null, array('placeholder' => 'Enter Amount','class' => 'form-control amount', 'id' => 'amount-'.$j, 'readonly' => true)) !!}
								</td>
							</tr>
							<?php $j++; ?>
						@endfor
					</tbody>

					<tbody class="tbl-cal" style="font-weight: bold;">
						<tr>
							<td colspan="6" class="right">Sub Total</td>
							<td class="right" id="subtotal-0"></td>
							<td class="right" id="subtotal-1">
								{{ Form::hidden('subtotal', null, ['id' => 'subtotal']) }}
							</td>
						</tr>

						<tr>
							<td colspan="2">Member Discount (-):</td>
							<td></td>
							<td colspan="3" class="right">Other Discount</td>
							<td class="right" id="discount-0">-10%</td>
							<td class="right" id="discount-1">
								{{ Form::hidden('discount', null, ['id' => 'discount']) }}
							</td>
						</tr>

						<tr>
							<td colspan="6" class="right">Service Charge:</td>
							<td class="right" id="scharge-0">10%</td>
							<td class="right" id="scharge-1">
								{{ Form::hidden('service', null, ['id' => 'service']) }}
							</td>
						</tr>
						<tr>
							<td colspan="6" class="right">GST</td>
							<td class="right" id="gst-0">7%</td>
							<td class="right" id="gst-1">
								{{ Form::hidden('gst', null, ['id' => 'gst']) }}
							</td>
						</tr>
						<tr>
							<td colspan="6" class="right">Total</td>
							<td class="right" id="total-10"></td>
							<td class="right" id="total-1">
								{{ Form::hidden('total', null, ['id' => 'total']) }}
							</td>
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
					<a href="{{ route('users.create') }}">
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

			$('#address-list').hide();

			$("#country_id").select2();

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
						console.log(data)
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
						console.log(data)
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
						console.log(data)
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$('#sender-name').focus(function() {
				var contactNo = $('#s_contact_no').val();
				var memberNo = $('#member_no').val();

				$.ajax({
					method: "GET",
					url: "{{ url('receivers/search-address-member') }}",
					data: {
						contactNo: contactNo,
						memberNo: memberNo
					}
				}).done(function(msg) {
					console.log(msg)
					if (msg == 1) {
						$('input').attr('readonly', false);
						$("form select").attr('disabled', false);
						$('#lot_no').attr('readonly', true);
						$('#address-list').show();
						$('#address-input').hide();
					} else {
						$('input').attr('readonly', false);
						$("form select").attr('disabled', false);
						$('#lot_no').attr('readonly', true);
						$('#address-input').show();
						$('#address-list').hide();
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
						console.log(data)
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$('.price_id').on('change', function() {
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
						console.log(data);
						$('#unitprice-' + classes[1]).val(parseFloat(data.unit_price).toFixed(2));
						$('#unitprice-' + classes[1]).attr('readonly', true);
					}
				});
			});

			$('.unit').keyup(function() {
				var classes = this.id.split('-');
				var unit = parseFloat($(this).val()).toFixed(2);

				var unitprice = $('#unitprice-' + classes[1]).val();

				var amt = unit * unitprice;
				amt = parseFloat(amt).toFixed(2);

				$('#amount-' + classes[1]).val(amt);

				var subTotal = 0;
				$('.amount').each(function( index2 ) {
					subTotal = subTotal + $(this).val();
				});
				subTotal = parseFloat(subTotal).toFixed(2);
				$('#subtotal-1').text(subTotal);

				var discount = subTotal * 0.1;
				var scharge = subTotal * 0.1;
				var gst = subTotal * 0.07;
				var total = subTotal - discount - scharge - gst;

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
				var unitprice = $('#unitprice-' + classes[1]).val();

				var amt = quantity * unit * unitprice;
				amt = parseFloat(amt).toFixed(2);
				$('#amount-' + classes[1]).val(amt);

				var subTotal = 0;
				$('.amount').each(function( index2 ) {
					subTotal = subTotal + $(this).val();
				});
				subTotal = parseFloat(subTotal).toFixed(2);
				$('#subtotal-1').text(subTotal);

				var discount = subTotal * 0.1;
				var scharge = subTotal * 0.1;
				var gst = subTotal * 0.07;
				var total = subTotal - discount - scharge - gst;

				$('#discount').val(discount);
				$('#discount-1').text(discount);
				$('#service').val(scharge);
				$('#scharge-1').text(scharge);
				$('#gst').val(gst);
				$('#gst-1').text(gst);
				$('#total').val(total);
				$('#total-1').text(total);
			});




			$(".editboxes").change(function() {
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
			});
		});
	</script>
@stop
