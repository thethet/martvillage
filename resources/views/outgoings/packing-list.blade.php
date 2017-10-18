@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/outgoing.png') }}" alt="Outgoing">
	</div>
	<div class="col-md-8 site-header">Outgoing</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			<div class="col-lg-6">
				<div class="col-sm-12 bdr pad3 padb15">
					{!! Form::open(array('route' => 'outgoings.packinglist.store','method'=>'POST', 'id' => 'packing-form', 'class' => 'form-horizontal')) !!}
						{!! Form::hidden('outgoing_id', $outgoing->id, ['class' => 'form-control']) !!}
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
												->where('i.outgoing_id', $outgoing->id)->where('i.packing_id', $x)->get();

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

										<tr>
											<td>
												<div class="packing-header">
													<h5 class="packing-title mr0">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapses{{ $outgoing->packing_list + 1 }}" class="collapsed">
															&nbsp;&nbsp;&nbsp;&nbsp; Package List {{  $outgoing->packing_list + 1 }}
														</a>
													</h5>
												</div>
											</td>
											<th width="70px" class="bdr center">
												<span id="kg">0</span> kg
											</th>
											<th width="70px" class="bdr center">
												<span id="ft">0</span> ft<sup>3</sup>
											</th>
											<th width="70px" class="bdr center">
												<span id="ins">0</span> Ins
											</th>
											<th width="70px" class="bdr center">
												<span id="docs">0</span> Docs
											</th>
										</tr>
										<tr>
											<td colspan="5" class="bdr0">
												<div class="packing-list">
													<div id="collapses{{ $outgoing->packing_list + 1 }}" class="panel-collapse collapse" >
														<div class="table-cont">
															<table class="table table-bordered table-responsive" id="mypackage{{ $outgoing->packing_list + 1 }}">
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
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</thead>
								</table>
							</div>
						</div>


						<div class="form-group">
							<div class="col-sm-9"></div>
							<div class="col-sm-3">
								<a href="#" id="unpack">
									<div class="addbtn" id="move-pack-right">
										{{-- <img src="{{ asset('assets/img/new-icon.png') }}" alt="Add"> --}}
											Un-Pack&nbsp;&nbsp;>>
									</div>
								</a>
							</div>
						</div><!-- .form-group -->
					{!! Form::close() !!}
				</div>
			</div>

			@if($lotinList)
				<div class="col-lg-6">
					<div class="col-sm-12 bdr">
						<div class="form-horizontal">
							<div class="packing-list-group" id="accordion">
								<?php
									$start = date("Y-m-d", strtotime($outgoing->dept_date . "-30 day"));
								?>
								@for($k = 0; $k < 31; $k++)
									<?php
										$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
									?>
									@if(array_key_exists($startDate, $lotinList))
										<?php $lotins = $lotinList[$startDate]; ?>
										<div class="packing-list">
											<div class="packing-header">
												<h5 class="packing-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $k }}" class="collapsed">
														&nbsp;&nbsp;&nbsp;{{ date('d M Y', strtotime($startDate)) }}
													</a>
												</h5>
											</div>
											<div id="collapse{{ $k }}" class="panel-collapse collapse" >
												<div class="table-cont">
													<table class="table table-bordered table-responsive">
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
															@foreach($lotins as $lotin)
																<?php
																$items = App\Item::where('lotin_id', $lotin->id)->get();
																?>
																@foreach($items as $item)
																	<tr>
																		<td>
																			{!! Form::checkbox('topack', $item->id, null, ['class' => 'move-item-left', 'id' => 'move-item-left'.$item->id]) !!}
																		</td>
																		<td>
																			{{ $lotin->sender_name }}
																			{!! Form::hidden('sender', $lotin->sender_name, ['class' => 'form-control', 'id' => 'left-sender'.$item->id]) !!}
																		</td>
																		<td>
																			{{ $lotin->receiver_name }}
																			{!! Form::hidden('receiver', $lotin->receiver_name, ['class' => 'form-control', 'id' => 'left-receiver'.$item->id]) !!}
																		</td>
																		<td>
																			{{ $item->barcode }}
																			{!! Form::hidden('barcode', $item->barcode, ['class' => 'form-control', 'id' => 'left-barcode'.$item->id]) !!}
																		</td>
																		<td>
																			<?php
																			$unitSymbol =  App\Category::where('id', $item->category_id)->pluck('unit');
																			?>
																			{{ $item->unit }} {{ $unitSymbol[0] }}
																			{!! Form::hidden('unit', $item->unit, ['class' => 'form-control', 'id' => 'left-unit'.$item->id]) !!}
																			{!! Form::hidden('symbol', $unitSymbol[0], ['class' => 'form-control', 'id' => 'left-symbol'.$item->id]) !!}
																		</td>
																		<td>
																			{{-- {!! Form::select('split_no', ['' => 'Split'] + Config::get('myVars.SplitNo'), null, ['id'=>'split_no', 'class' => 'form-control split_no']) !!} --}}
																			{!! Form::hidden('split_no', 0, ['class' => 'form-control', 'id' => 'left-split'.$item->id]) !!}
																			0
																		</td>
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
							</div>

							<div class="form-group">
								<div class="col-sm-3">
									<a href="#" id="gopack">
										<div class="addbtn" id="move-pack-left">
											{{-- <img src="{{ asset('assets/img/new-icon.png') }}" alt="Add"> --}}
												<<&nbsp;&nbsp;Pack
										</div>
									</a>
								</div>
							</div><!-- .form-group -->

						</div>

					</div>
				</div>
			@endif
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

			{{-- @permission('lotin-create')
				<div class="menu-icon">
					<a href="#" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			{{-- @permission('lotin-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			<div class="menu-icon">
				<a href="#" id="delete">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('outgoings') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('packing-form').submit();">
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"/>

	<script>
		$(document).ready(function(){
			$(".split_no").select2();

			$("#move-pack-right").hide();

			$("#move-pack-left").on("click",function(){

				var totalKg   = $('#kg').text();
				var totalFt   = $('#ft').text();
				var totalDocs = $('#docs').text();
				var totalIns  = $('#ins').text();

				$(".move-item-left:checked").each(function(i) {
					console.log($(this).val())
					var no       = $(this).val();
					var sender   = $('#left-sender' + no).val();
					var receiver = $('#left-receiver' + no).val();
					var barcode  = $('#left-barcode' + no).val();
					var unit     = $('#left-unit' + no).val();
					var symbol   = $('#left-symbol' + no).val();
					var splitNo  = $('#left-split' + no).val();


					if(symbol == 'kg') {
						totalKg = parseFloat(totalKg) + parseFloat(unit);
					} else if(symbol == 'ft3') {
						totalFt = parseFloat(totalFt) + parseFloat(unit);
					} else if(symbol == 'pcs') {
						totalDocs = parseFloat(totalDocs) + parseFloat(unit);
					} else {
						totalIns = parseFloat(totalIns) + parseFloat(unit);
					}

					var html = "<tr><td><input type='checkbox' name='itemId' value='"  + no + "' id='move-item-right"  + no + "' class='move-item-right'><input type='hidden' name='itemIds[]' value='"  + no + "'></td><td>" + sender + "<input type='hidden' name='senders[]' value='" + sender + "' id='right-sender"  + no + "'></td><td>" + receiver + "<input type='hidden' name='receivers[]' value='" + receiver + "' id='right-receiver"  + no + "'></td><td>" + barcode + "<input type='hidden' name='barcodes[]' value='" + barcode + "' id='right-barcode"  + no + "'></td><td>" + unit + " " + symbol + "<input type='hidden' name='units[]' value='" + unit + "' id='right-unit"  + no + "'><input type='hidden' name='symbols[]' value='" + symbol + "' id='right-symbol"  + no + "'></td><td>" + splitNo + "<input type='hidden' name='split_nos[]' value='" + splitNo + "' id='right-split-no"  + no + "'></td></tr>";

					console.log()
					var pno = {{  $outgoing->packing_list + 1 }};
					$("#mypackage"+pno).append(html);
					$(this).prop('checked',false);
					$(this).attr("disabled", true);
				});

				$('#kg').text(totalKg);
				$('#ft').text(totalFt);
				$('#docs').text(totalDocs);
				$('#ins').text(totalIns);
				$("#move-pack-right").show();
			});

			$("#move-pack-right").on("click",function(){
				var totalKg = $('#kg').text();
				var totalFt = $('#ft').text();
				var totalDocs = $('#docs').text();
				var totalIns = $('#ins').text();

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
					} else if(symbol == 'pcs') {
						totalDocs = parseFloat(totalDocs) - parseFloat(unit);
					} else {
						totalIns = parseFloat(totalIns) - parseFloat(unit);
					}

					$(this).closest("tr").remove();

					$('#move-item-left' + no).attr("disabled", false);
				});
				$('#kg').text(totalKg);
				$('#ft').text(totalFt);
				$('#docs').text(totalDocs);
				$('#ins').text(totalIns);
			});
		});
	</script>
@stop
