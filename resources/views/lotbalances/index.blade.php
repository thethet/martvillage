@extends('layouts.layout')

@section('page-title')
	lotbalance
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong>lotbalance Management</strong>
			</li>
		</ol>

		<h2>lotbalance Management</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		@if($lotinList)
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
					<div class="panel panel-primary" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">
								{{ date('d M Y', strtotime($startDate)) }}
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
										<th>Lot No.</th>
										<th>Sender Name</th>
										<th>Sender Contact No.</th>
										<th>Reciever Name</th>
										<th>Receiver Contact No.</th>
										<th>From - To</th>
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
												<td>{{ $j++ }}</td>
												<td>{{ $lotin->lot_no }}</td>
												<td>{{ $senderList[$lotin->sender_id] }}</td>
												<td>{{ $senderContactList[$lotin->sender_id] }}</td>
												<td>{{ $receiverList[$lotin->receiver_id] }}</td>
												<td>{{ $receiverContactList[$lotin->receiver_id] }}</td>
												<td>
													{{ $stateList[$lotin->from_state] }} <=> {{ $stateList[$lotin->to_state] }}
												</td>
												<td>{{ $item->barcode }}</td>
												<td>{{ $item->unit }} {{ $categoryList[$item->category_id] }}</td>
												@if(Auth::user()->hasRole('administrator'))
													<td>
														{{ $companyList[$lotin->company_id] }}
													</td>
												@endif
											</tr>
										@endforeach
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				@endif
			@endfor
		@endif

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
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>
@stop

