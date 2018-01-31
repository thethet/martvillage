@extends('layouts.layout')

@section('page-title')
	Outgoing
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
				<a href="{{ url('outgoings') }}">Outgoing Management</a>
			</li>
			<li class="active">
				<strong>Package List Form</strong>
			</li>
		</ol>

		<h2>Outgoing Management</h2>
		<br />

		<form action="#" method="post" role="form" id="packing_form" class="form-horizontal form-groups-bordered validate" >

			<div class="form-group">
				<label class="col-sm-2  control-label">&nbsp;</label>

				<div class="col-sm-3">
					&nbsp;
				</div>

				<label class="col-sm-2  control-label">Barcode</label>
				<div class="col-sm-3">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="fa fa-barcode"></i>
						</div>
						{!! Form::text('barcode', null, ['placeholder' => 'Barcode','class' => 'form-control', 'id' => 'sbarcode', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="col-sm-2">
					<div class="input-group minimal">
						<a href="#" class="btn btn-blue btn-icon" onclick="searchBarCode();">
							Search
							<i class="entypo-search"></i>
						</a>
					</div>
				</div>
			</div>
		</form>
		<br />

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Package List Form</strong>
						</div>

						<div class="panel-options">
							<a href="{{ url('outgoings') }}"><i class="entypo-cancel"></i></a>
							&nbsp;|&nbsp;
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::open(array('route' => 'outgoings.packinglist.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'rootwizard')) !!}
						{!! Form::hidden('outgoing_id', $outgoing->id, ['class' => 'form-control', 'id' => 'outgoing_id']) !!}

							<div class="form-group">
								<label class="col-sm-4">
									Company Name
								</label>

								<label class="col-sm-8">
									@if($outgoing->company_id)
										{{ $companyList[$outgoing->company_id] }}
									@else
										{{ '-' }}
									@endif
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Passenger Name
								</label>

								<label class="col-sm-8">
									@if($outgoing->passenger_name)
										{{ $outgoing->passenger_name }}
									@else
										{{ '-' }}
									@endif
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Phone
								</label>

								<label class="col-sm-8">
									@if($outgoing->contact_no)
										{{ $outgoing->contact_no }}
									@else
										{{ '-' }}
									@endif
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									From ~ To
								</label>

								<label class="col-sm-8">
									{{ $outgoing->fromCity->state_name }} ~ {{ $outgoing->toCity->state_name }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Weight
								</label>

								<label class="col-sm-8">
									@if($outgoing->weight)
										{{ $outgoing->weight }} kg
									@else
										{{ '-' }}
									@endif
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Quantity
								</label>

								<label class="col-sm-8">
									{{ $outgoing->packing_list }} pcs
								</label>
							</div>
							<br>

							<div class="form-group" id="unpack-code">
								<div class="col-sm-6">
									<div class="input-group minimal">
										<div class="input-group-addon">
											<i class="fa fa-barcode"></i>
										</div>
										{!! Form::text('barcode', null, ['placeholder' => 'Barcode','class' => 'form-control', 'id' => 'unpack-barcode', 'autocomplete' => 'off']) !!}
									</div>
								</div>

								<div class="col-sm-2">
									<div class="input-group minimal">
										<a href="#" class="btn btn-blue btn-icon" onclick="unpackByBarCode();">
											Un-Pack
											<i class="entypo-forward"></i>
										</a>
									</div>
								</div>
							</div>

							@for($x = 1; $x <= $outgoing->packing_list; $x++)
								<?php
									$packingIdList = explode(", ", $outgoing->packing_id_list);
									$packItemList =DB::table('items as i')
										->select('i.*', 'l.sender_id', 'l.receiver_id', 'l.company_id', 'l.from_state', 'l.to_state')
										->leftJoin('lotins as l', 'l.id', '=', 'i.lotin_id')
										->where('i.outgoing_id', $outgoing->id)
										->where('i.packing_id', $packingIdList[$x-1])->get();
									$myCategory = array();

									foreach($categories as $category) {
										$unit = App\Item::select(DB::raw('sum(unit) as total_unit'))->where('outgoing_id', $outgoing->id)->where('packing_id', $packingIdList[$x-1])->where('category_id', $category->id)->first();

										$myCategory[$category->id] = ($unit->total_unit) ? $unit->total_unit : 0 ;
									}
								?>

								<div class="row" style="padding: 0;">
									<div class="panel panel-primary" data-collapsed="0">
										<div class="panel-heading">
											<div class="panel-title text-primary">
												<b>
													Package List {{ $x }}
												</b>
											</div>

											<div class="panel-options">
												@foreach($categories as $category)
													{{ $myCategory[$category->id] }}
													@if($categoryList[$category->id] == '%')
														{{ 'Ins' }}
													@elseif($categoryList[$category->id] == 'ft3')
														{{ 'ft' }}<sup>3</sup>
													@else
														{{ $categoryList[$category->id] }}
													@endif
													&nbsp;|&nbsp;
												@endforeach

												<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
											</div>
										</div>

										<div class="panel-body with-table">
											<table class="table table-bordered responsive">
												<thead>
													<tr>
														<th width="5%">SNo.</th>
														<th>Sender Name</th>
														<th>Sender Contact No.</th>
														<th>Reciever Name</th>
														<th>Receiver Contact No.</th>
														{{-- <th>From - To</th> --}}
														<th>Barcode</th>
														<th>Unit(kg/ft<sup>3</sup>)</th>
														@if(Auth::user()->hasRole('administrator'))
														<th>Company Name</th>
														@endif
													</tr>
												</thead>
												<tbody>
													@foreach($packItemList as $item)
														<tr>
															<td></td>
															<td>{{ $senderList[$item->sender_id] }}</td>
															<td>{{ $senderContactList[$item->sender_id] }}</td>
															<td>{{ $receiverList[$item->receiver_id] }}</td>
															<td>{{ $receiverContactList[$item->receiver_id] }}</td>
															{{-- <td>
																{{ $stateList[$lotin->from_state] }} <=> {{ $stateList[$lotin->to_state] }}
															</td> --}}
															<td>{{ $item->barcode }}</td>
															<td>{{ $item->unit }} {{ $categoryList[$item->category_id] }}</td>
															@if(Auth::user()->hasRole('administrator'))
																<td>
																	{{ $companyList[$item->company_id] }}
																</td>
															@endif
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							@endfor

							<div class="row" style="padding: 0;">
								<div class="panel panel-primary" data-collapsed="0">
									<div class="panel-heading">
										<div class="panel-title text-primary">
											<b>
												Package List {{  $outgoing->packing_list + 1 }}
											</b>
										</div>

										<div class="panel-options">

											@foreach($categories as $category)
												@if($categoryList[$category->id] == '%')
													<span id="ins">0</span> {{ 'Ins' }}
												@elseif($categoryList[$category->id] == 'ft3')
													<span id="ft">0</span> {{ 'ft' }}<sup>3</sup>
												@else
													<span id="{{ $categoryList[$category->id] }}">0</span> {{ $categoryList[$category->id] }}
												@endif
												&nbsp;|&nbsp;
											@endforeach

											<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										</div>
									</div>

									<div class="panel-body with-table">
										<table class="table table-bordered responsive" id="mypackage{{ $outgoing->packing_list + 1 }}">
											<thead>
												<tr>
													<th width="5%">SNo.</th>
													<th>Sender Name</th>
													<th>Sender Contact No.</th>
													<th>Reciever Name</th>
													<th>Receiver Contact No.</th>
													{{-- <th>From - To</th> --}}
													<th>Barcode</th>
													<th>Unit(kg/ft<sup>3</sup>)</th>
													@if(Auth::user()->hasRole('administrator'))
													<th>Company Name</th>
													@endif
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-9">
									<button type="submit" class="btn btn-success btn-icon" id="save-btn">
										Save
										<i class="entypo-floppy"></i>
									</button>

									<a href="{{ route('outgoings.index') }}" class="btn btn-black">
										Back
									</a>
									{!! Form::hidden('icount', 0, ['id' => 'icount']) !!}
								</div>

								<div class="col-sm-3">
									<a href="#" id="move-pack-right" class="btn btn-blue btn-icon">
										Un-Pack
										<i class="entypo-forward"></i>
									</a>
								</div>
							</div><!-- .form-group -->

						{!! Form::close() !!}
					</div>
				</div>
			</div>

			<div class="col-md-6">
				@if($lotinList)
					<?php
						$start = date("Y-m-d", strtotime($outgoing->dept_date . "-30 day"));
					?>
					@for($k = 0; $k < 31; $k++)
						<?php
							$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
						?>
						@if(array_key_exists($startDate, $lotinList))
							<?php $lotins = $lotinList[$startDate]; ?>
							<div class="col-md-12" style="padding: 0;">
								<div class="panel panel-primary" data-collapsed="0">
									<div class="panel-heading">
										<div class="panel-title text-primary">
											<b>
												{{ date('d M Y', strtotime($startDate)) }}
											</b>
										</div>

										<div class="panel-options">
											<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
										</div>
									</div>

									<div class="panel-body with-table">
										<table class="table table-bordered responsive">
											<thead>
												<tr>
													<th width="5%">SNo.</th>
													<th>Sender Name</th>
													<th>Sender Contact No.</th>
													<th>Reciever Name</th>
													<th>Receiver Contact No.</th>
													{{-- <th>From - To</th> --}}
													<th>Barcode</th>
													<th>Unit(kg/ft<sup>3</sup>)</th>
													@if(Auth::user()->hasRole('administrator'))
													<th>Company Name</th>
													@endif
												</tr>
											</thead>
											<tbody>
												@foreach($lotins as $lotin)
													<?php
													$items = App\Item::where('lotin_id', $lotin->id)->where('status', 0)->get();
													$j = 1;
													?>
													@foreach($items as $item)
														<tr>
															<td>
																{!! Form::checkbox('topack', $item->id, null, ['class' => 'move-item-left', 'id' => 'move-item-left'.$item->id]) !!}
															</td>
															<td>
																{{ $senderList[$lotin->sender_id] }}
																{!! Form::hidden('sender', $senderList[$lotin->sender_id], ['class' => 'form-control', 'id' => 'left-sender'.$item->id]) !!}
															</td>
															<td>
																{{ $senderContactList[$lotin->sender_id] }}
																{!! Form::hidden('sender_contact', $senderContactList[$lotin->sender_id], ['class' => 'form-control', 'id' => 'left-sender-contact'.$item->id]) !!}
															</td>
															<td>
																{{ $receiverList[$lotin->receiver_id] }}
																{!! Form::hidden('receiver', $receiverList[$lotin->receiver_id], ['class' => 'form-control', 'id' => 'left-receiver'.$item->id]) !!}
															</td>
															<td>
																{{ $receiverContactList[$lotin->receiver_id] }}
																{!! Form::hidden('receiver_contact', $receiverContactList[$lotin->receiver_id], ['class' => 'form-control', 'id' => 'left-receiver-contact'.$item->id]) !!}
															</td>
															{{-- <td>
																{{ $stateList[$lotin->from_state] }} <=> {{ $stateList[$lotin->to_state] }}
															</td> --}}
															<td>
																{{ $item->barcode }}
																{!! Form::hidden('barcode', $item->barcode, ['class' => 'form-control', 'id' => 'left-barcode'.$item->id]) !!}
															</td>
															<td>
																{{ $item->unit }} {{ $categoryList[$item->category_id] }}
																{!! Form::hidden('unit', $item->unit, ['class' => 'form-control', 'id' => 'left-unit'.$item->id]) !!}
																{!! Form::hidden('symbol', $categoryList[$item->category_id], ['class' => 'form-control', 'id' => 'left-symbol'.$item->id]) !!}
															</td>
															@if(Auth::user()->hasRole('administrator'))
																<td>
																	{{ $companyList[$lotin->company_id] }}
																	{!! Form::hidden('company', $companyList[$lotin->company_id], ['class' => 'form-control', 'id' => 'left-company'.$item->id]) !!}
																</td>
															@endif
														</tr>
													@endforeach
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						@endif
					@endfor

					<div class="form-group">
						<div class="col-sm-3">
							<a href="#" id="move-pack-left" class="btn btn-blue btn-icon icon-left">
								<i class="entypo-reply"></i>
								Pack
							</a>
						</div>
					</div><!-- .form-group -->
				@endif
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

	<style>
		.text-white {
			color: #fff !important;
		}

		.text-danger {
			color: #f00 !important;
		}

		.text-primary {
			color: #0275d8 !important;
		}

		.text-warning {
			color: #f0ad4e !important;
		}

		.text-success {
			color: #5cb85c !important
		}

		.bg-danger {
			background: #B22222 !important;
		}

		.bg-default {
			background: grey !important;
		}

		.bg-warning {
			background-color: #f0ad4e !important;
		}

		.bg-primary {
			background-color: #0275d8 !important;
		}

		td {
			cursor: pointer;
		}
	</style>

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/jquery.bootstrap.wizard.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.inputmask.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-switch.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.multi-select.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13) {
					event.preventDefault();
					return false;
				}
			});

			$("#move-pack-right").hide();
			$("#unpack-code").hide();
			$('#save-btn').hide();

			$("#move-pack-left").on("click",function(){
				var totalKg   = $('#kg').text();
				var totalFt   = $('#ft').text();
				var totalDocs = $('#docs').text();
				var totalIns  = $('#ins').text();
				var totalPcs = $('#pcs').text();

				$(".move-item-left:checked").each(function(i) {
					var no       = $(this).val();
					var sender   = $('#left-sender' + no).val();
					var scontact   = $('#left-sender-contact' + no).val();
					var receiver = $('#left-receiver' + no).val();
					var rcontact = $('#left-receiver-contact' + no).val();
					var barcode  = $('#left-barcode' + no).val();
					var unit     = $('#left-unit' + no).val();
					var symbol   = $('#left-symbol' + no).val();
					var splitNo  = $('#left-split' + no).val();
					var company  = $('#left-company' + no).val();

					if(symbol == 'kg') {
						totalKg = parseFloat(totalKg) + parseFloat(unit);
					} else if(symbol == 'ft3') {
						totalFt = parseFloat(totalFt) + parseFloat(unit);
					} else if(symbol == 'docs') {
						totalDocs = parseFloat(totalDocs) + parseFloat(unit);
					} else if(symbol == 'pcs') {
						totalPcs = parseFloat(totalPcs) + parseFloat(unit);
					} else {
						totalIns = parseFloat(totalIns) + parseFloat(unit);
					}

					var html = "<tr>";

					var numHtml = "<td><input type='checkbox' name='itemId' value='"  + no + "' id='move-item-right"  + no + "' class='move-item-right'><input type='hidden' name='itemIds[]' value='"  + no + "'></td>";

					var senderHtml = "<td>" + sender + "<input type='hidden' name='senders[]' value='" + sender + "' id='right-sender"  + no + "'></td>";

					var scontactHtml = "<td>" + scontact + "<input type='hidden' name='scontacts[]' value='" + scontact + "' id='right-sender-contact"  + no + "'></td>";

					var receiverHtml = "<td>" + receiver + "<input type='hidden' name='receivers[]' value='" + receiver + "' id='right-receiver"  + no + "'></td>";

					var rcontactHtml = "<td>" + rcontact + "<input type='hidden' name='rcontacts[]' value='" + rcontact + "' id='right-receiver-contact"  + no + "'></td>";

					var barHtml = "<td>" + barcode + "<input type='hidden' name='barcodes[]' value='" + barcode + "' id='right-barcode"  + no + "'></td>";

					var unitHtml = "<td>" + unit + " " + symbol + "<input type='hidden' name='units[]' value='" + unit + "' id='right-unit"  + no + "'><input type='hidden' name='symbols[]' value='" + symbol + "' id='right-symbol"  + no + "'></td>";

					var companyHtml = "";
					if(company) {
						var companyHtml = "<td>" + company + "<input type='hidden' name='companys[]' value='" + company + "' id='right-company"  + no + "'></td>";
					}

					html += numHtml + senderHtml + scontactHtml + receiverHtml + rcontactHtml + barHtml + unitHtml + companyHtml + "</tr>";

					var pno = {{  $outgoing->packing_list + 1 }};
					$("#mypackage"+pno).append(html);
					$(this).prop('checked',false);
					$(this).attr("disabled", true);

					var icount = parseFloat($('#icount').val());
					$('#icount').val(icount + 1);
				});

				$('#kg').text(totalKg);
				$('#ft').text(totalFt);
				$('#docs').text(totalDocs);
				$('#ins').text(totalIns);
				$('#pcs').text(totalPcs);
				$("#move-pack-right").show();
				$("#unpack-code").show();
				$('#save-btn').show();
			});

			$("#move-pack-right").on("click",function(){
				var totalKg = $('#kg').text();
				var totalFt = $('#ft').text();
				var totalDocs = $('#docs').text();
				var totalIns = $('#ins').text();
				var totalPcs = $('#pcs').text();

				var icount = parseFloat($('#icount').val());

				$(".move-item-right:checked").each(function(i) {
					var no = $(this).val();
					var barcode = $('#right-barcode' + no).val();
					var unit = $('#right-unit' + no).val();
					var symbol = $('#right-symbol' + no).val();
					var splitNo = $('#right-split' + no).val();

					if(symbol == 'kg') {
						totalKg = parseFloat(totalKg) - parseFloat(unit);
					} else if(symbol == 'ft3') {
						totalFt = parseFloat(totalFt) - parseFloat(unit);
					} else if(symbol == 'docs') {
						totalDocs = parseFloat(totalDocs) - parseFloat(unit);
					} else if(symbol == 'pcs') {
						totalPcs = parseFloat(totalPcs) - parseFloat(unit);
					} else {
						totalIns = parseFloat(totalIns) - parseFloat(unit);
					}

					$(this).closest("tr").remove();

					$('#move-item-left' + no).attr("disabled", false);

					icount = icount - 1;
					$('#icount').val(icount);
				});

				$('#kg').text(totalKg);
				$('#ft').text(totalFt);
				$('#docs').text(totalDocs);
				$('#ins').text(totalIns);
				$('#pcs').text(totalPcs);

				if(icount == 0) {
					$("#move-pack-right").hide();
					$("#unpack-code").hide();
					$('#save-btn').hide();
				}
			});
		});

		function searchBarCode() {
			// Fetch the preselected item, and add to the control
			var barcode = $('#sbarcode').val();

			var totalKg   = $('#kg').text();
			var totalFt   = $('#ft').text();
			var totalDocs = $('#docs').text();
			var totalIns  = $('#ins').text();
			var totalPcs = $('#pcs').text();

			/*$("input:checkbox[class=move-item-left]").each(function () {
				console.log("Id: " + $(this).attr("id") + " Value: " + $(this).val() + " Checked: " + $(this).is(":checked"));
			});*/

			$.ajax({
				type: 'GET',
				url: "{{ url('outgoings/search-packing-by-barcode') }}",
				dataType: 'json',
				delay: 250,
				data: {
					lotinIdList: "{{ json_encode($lotinIdList) }}",
					barcode: barcode
				}
				,
			}).then(function (data) {
				$('#sbarcode').val('');
				if(data.items.length > 0) {
					$("input:checkbox[class=move-item-left]").each(function () {
						for (var i = 0, len = data.items.length; i < len; ++i) {
							if($(this).val() == data.items[i]['id']) {
								$(this).attr("disabled", true);

								var no       = data.items[i]['id'];
								var sender   = $('#left-sender' + no).val();
								var scontact = $('#left-sender-contact' + no).val();
								var receiver = $('#left-receiver' + no).val();
								var rcontact = $('#left-receiver-contact' + no).val();
								var barcode  = $('#left-barcode' + no).val();
								var unit     = $('#left-unit' + no).val();
								var symbol   = $('#left-symbol' + no).val();
								var splitNo  = $('#left-split' + no).val();
								var company  = $('#left-company' + no).val();

								var html = "<tr>";

								var numHtml = "<td><input type='checkbox' name='itemId' value='"  + no + "' id='move-item-right"  + no + "' class='move-item-right'><input type='hidden' name='itemIds[]' value='"  + no + "'></td>";

								var senderHtml = "<td>" + sender + "<input type='hidden' name='senders[]' value='" + sender + "' id='right-sender"  + no + "'></td>";

								var scontactHtml = "<td>" + scontact + "<input type='hidden' name='scontacts[]' value='" + scontact + "' id='right-sender-contact"  + no + "'></td>";

								var receiverHtml = "<td>" + receiver + "<input type='hidden' name='receivers[]' value='" + receiver + "' id='right-receiver"  + no + "'></td>";

								var rcontactHtml = "<td>" + rcontact + "<input type='hidden' name='rcontacts[]' value='" + rcontact + "' id='right-receiver-contact"  + no + "'></td>";

								var barHtml = "<td>" + barcode + "<input type='hidden' name='barcodes[]' value='" + barcode + "' id='right-barcode"  + no + "'></td>";

								var unitHtml = "<td>" + unit + " " + symbol + "<input type='hidden' name='units[]' value='" + unit + "' id='right-unit"  + no + "'><input type='hidden' name='symbols[]' value='" + symbol + "' id='right-symbol"  + no + "'></td>";

								var companyHtml = "";
								if(company) {
									var companyHtml = "<td>" + company + "<input type='hidden' name='companys[]' value='" + company + "' id='right-company"  + no + "'></td>";
								}

								html += numHtml + senderHtml + scontactHtml + receiverHtml + rcontactHtml + barHtml + unitHtml + companyHtml + "</tr>";


								if ($('#move-item-right'+data.items[i]['id']).length == 0) {
									var icount = parseFloat($('#icount').val());
									if(symbol == 'kg') {
										totalKg = parseFloat(totalKg) + parseFloat(unit);
									} else if(symbol == 'ft3') {
										totalFt = parseFloat(totalFt) + parseFloat(unit);
									} else if(symbol == 'docs') {
										totalDocs = parseFloat(totalDocs) + parseFloat(unit);
									} else if(symbol == 'pcs') {
										totalPcs = parseFloat(totalPcs) + parseFloat(unit);
									} else {
										totalIns = parseFloat(totalIns) + parseFloat(unit);
									}

									var pno = {{  $outgoing->packing_list + 1 }};
									$("#mypackage"+pno).append(html);
									$(this).prop('checked',false);
									$(this).attr("disabled", true);

									$('#icount').val(icount + 1);
								}
							}
						}
					});

					$('#kg').text(totalKg);
					$('#ft').text(totalFt);
					$('#docs').text(totalDocs);
					$('#ins').text(totalIns);
					$('#pcs').text(totalPcs);

					$("#move-pack-right").show();
					$("#unpack-code").show();
					$('#save-btn').show();
				}

			});
		}

		function unpackByBarCode() {
			var unpackBarcode = $('#unpack-barcode').val();

			var totalKg   = $('#kg').text();
			var totalFt   = $('#ft').text();
			var totalDocs = $('#docs').text();
			var totalIns  = $('#ins').text();
			var totalPcs = $('#pcs').text();



			console.log('unpackByBarCode: ' + unpackBarcode)

			var icount = parseFloat($('#icount').val());
			$("input:checkbox[class=move-item-right]").each(function () {
				var no = $(this).val();
				var barcode = $('#right-barcode' + no).val();

				console.log('BarCode: ' + barcode)

				if(unpackBarcode == barcode) {
					var barcode = $('#right-barcode' + no).val();
					var unit = $('#right-unit' + no).val();
					var symbol = $('#right-symbol' + no).val();
					var splitNo = $('#right-split' + no).val();

					if(symbol == 'kg') {
						totalKg = parseFloat(totalKg) - parseFloat(unit);
					} else if(symbol == 'ft3') {
						totalFt = parseFloat(totalFt) - parseFloat(unit);
					} else if(symbol == 'docs') {
						totalDocs = parseFloat(totalDocs) - parseFloat(unit);
					} else if(symbol == 'pcs') {
						totalPcs = parseFloat(totalPcs) - parseFloat(unit);
					} else {
						totalIns = parseFloat(totalIns) - parseFloat(unit);
					}

					$(this).closest("tr").remove();

					$('#move-item-left' + no).attr("disabled", false);

					icount = icount - 1;
					$('#icount').val(icount);
				}


			});
			$('#unpack-barcode').val('');
			$('#kg').text(totalKg);
			$('#ft').text(totalFt);
			$('#docs').text(totalDocs);
			$('#ins').text(totalIns);
			$('#pcs').text(totalPcs);

			if(icount == 0) {
				$("#move-pack-right").hide();
				$("#unpack-code").hide();
				$('#save-btn').hide();
			}
		}
	</script>
@stop

