@extends('layouts.layout')

@section('page-title')
	Incoming
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
				<a href="{{ url('incomings') }}">Incoming Management</a>
			</li>
			<li class="active">
				<strong>Package List Form</strong>
			</li>
		</ol>

		<h2>Incoming Management</h2>
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
						<a href="#" class="btn btn-blue btn-icon" onclick="searchArriveListByBarCode();">
							Search
							<i class="entypo-search"></i>
						</a>
					</div>
				</div>
			</div>
		</form>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Package List Form</strong>
						</div>

						<div class="panel-options">
							<a href="{{ url('incomings') }}" title="Close"><i class="entypo-cancel"></i></a>
							&nbsp;|&nbsp;
							<a href="#" data-rel="collapse" title="Hide"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::open(array('route' => 'outgoings.packinglist.store','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'rootwizard')) !!}
						{!! Form::hidden('outgoing_id', $outgoing->id, ['class' => 'form-control']) !!}

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
									$k = 1;
								?>

								<div class="col-md-12" style="padding: 0;">
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

												<a href="#" data-rel="collapse" title="Hide"><i class="entypo-down-open"></i></a>
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
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													@foreach($packItemList as $item)
														<tr>
															<td>{{ $k++ }}</td>
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
															<td>
																@if($item->status == 1)
																	<a href="#" class="btn btn-green btn-icon arrive" id="{{ $item->id }}" title="Arrive">
																		Arrive
																		<i class="entypo-check"></i>
																	</a>
																@endif
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							@endfor

							<div class="form-group">
								<div class="col-sm-9">
									<a href="{{ route('incomings.index') }}" class="btn btn-black">
										Back
									</a>
								</div>
							</div><!-- .form-group -->

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
			$(".arrive").on("click", function(event){
				var id = $(this).attr('id');
				$.ajax({
					url: "{!! url('incomings/"+ id +"') !!}",
					type: 'PATCH',
					data: {_token: '{!! csrf_token() !!}'},
					dataType: 'JSON',
					success: function (data) {
						window.location.replace(data.url);
					}
				});
			});
		});

		function searchArriveListByBarCode() {
			var barcode = $('#sbarcode').val();
			$.ajax({
				url: "{!! url('incomings/arrive/"+ barcode +"') !!}",
				type: 'PATCH',
				data: {_token: '{!! csrf_token() !!}'},
				dataType: 'JSON',
				success: function (data) {
					window.location.replace(data.url);
				}
			});
		}
	</script>
@stop

