@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/lot-balance.png') }}" alt="LotBalance">
	</div>
	<div class="col-md-8 site-header">LotBalance</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			@if($lotinList)
				<div class="col-lg-12">
					<div class="col-sm-12 bdr">
						<div class="form-horizontal">
							<div class="packing-list-group" id="accordion">
								<?php
									$today = date("Y-m-d");
									$start = date("Y-m-d", strtotime($today . "-30 day"));
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
																<th>Location</th>
																<th>Barcode</th>
																<th>Unit(kg/ft<sup>3</sup>)</th>
																<th>Split</th>
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
																			{{ $j++ }}
																		</td>
																		<td>
																			{{ $lotin->sender_name }}
																		</td>
																		<td>
																			{{ $lotin->receiver_name }}
																		</td>
																		<td>
																			{{ $lotin->fstate_name }} ~ {{ $lotin->tstate_name }}
																		</td>
																		<td>
																			{{ $item->barcode }}
																		</td>
																		<td>
																			<?php
																			$unitSymbol =  App\Category::where('id', $item->category_id)->pluck('unit');
																			?>
																			{{ $item->unit }} {{ $unitSymbol[0] }}
																		</td>
																		<td>
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


			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
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
		});
	</script>
@stop
