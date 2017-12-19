<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Packing List </title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	{{-- <link rel="stylesheet" href="{{ asset('/path/to/your/pdf.css') }}" media="all" /> --}}

	<link rel="stylesheet" href="{{ asset('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/font-icons/entypo/css/entypo.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/neon-core.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" media="all" />

	<link rel="stylesheet" href="{{ asset('assets/css/font-icons/font-awesome/css/font-awesome.min.css') }}" media="all" />
</head>
<body>
	<script type="text/php">
		if ( isset($pdf) ) {
			die;
			$font = $fontMetrics->getFont("helvetica", "bold");
			$pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
		}
	</script>

	<div class="row zawgyi">
		<div class="col-sm-11">
			<table class="table noborder">
				<tr>
					<td class="text-center noborder">
						<h3>{{ $myCompany->company_name }}</h3>
						{{ $myCompany->address }}
						@if($myCompany->township_id > 0)
							{{ $townshipList[$myCompany->township_id] }}
						@endif
						@if($myCompany->state_id > 0)
							, {{ $stateList[$myCompany->state_id] }}
						@endif
						@if($myCompany->country_id > 0)
							, {{ $countryList[$myCompany->country_id] }}
						@endif
						<br>
						TEL: {{ $myCompany->contact_no }}
						<br>
						******************************************************
					</td>
				</tr>

				<tr>
					<td class="noborder">
						<br>
						<strong>Passenger Name: </strong>
						@if($outgoing->passenger_name)
							{{ $outgoing->passenger_name }}
						@else
							{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">
						<b>Contact No: </b>
						@if($outgoing->contact_no)
							{{ $outgoing->contact_no }}
						@else
							{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">
						<b>Location: </b>
						{{ $outgoing->fromCity->state_name }} ~ {{ $outgoing->toCity->state_name }}
					</td>
				</tr>

				<tr>
					<td class="noborder">
						<b>Departure Time: </b>
						{{ $outgoing->dept_date }} [ {{ date('g:i A', strtotime($outgoing->dept_time)) }} ]
					</td>
				</tr>

				<tr>
					<td class="noborder">
						<b>Vassel No: </b>
						@if($outgoing->vessel_no)
							{{ $outgoing->vessel_no }}
						@else
							{{ '-' }}
						@endif
					</td>
				</tr>

			</table>

			<?php
				$amount = 0;
				$totalAmount = 0;
			?>
			<table class="table table-bordered responsive zawgyi">
				<thead>
					<tr>
						<th class="zawgyi">Description</th>
						<th width="5%" class="zawgyi">Unit</th>
						<th width="5%" class="zawgyi">Qty</th>
						<th width="15%" class="zawgyi">Price</th>
						<th width="15%" class="zawgyi">Amount</th>
					</tr>
				</thead>
				<tbody>
					@foreach($itemList as $key => $item)
						<?php
							$amount = $item->unit * $item->quantity * $item->unit_price;
							$totalAmount += $amount;
						?>
						<tr>
							<td>{{ $item->item_name }}</td>
							<td class="text-right">{{ $item->unit }}</td>
							<td class="text-right">{{ $item->quantity }}</td>
							<td class="text-right">{{ number_format($item->unit_price, 2) }}</td>
							<td class="text-right">{{ number_format($amount, 2) }}</td>
						</tr>
					@endforeach
					<tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4" class="text-right">TOTAL</td>
						<td class="text-right">{{ number_format($totalAmount, 2) }}</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>

	<style>
		body {
			margin: -25px -30px;
		}
		@font-face {
			font-family: zawgyi;
			src: url('{{ asset('assets/fonts/zawgyi.ttf') }}') format('truetype');
		}
		.zawgyi {
			font-family:zawgyi !important;
		}
		.noborder {
			border: 0 !important;
		}

		td, th {
			line-height: 1 !important;
			padding: 5px !important;
			color: #333;
		}

		.table-bordered {
			border: 1px solid #333;
		}
		.table-bordered > thead > tr > th,
		.table-bordered > tbody > tr > th,
		.table-bordered > tfoot > tr > th,
		.table-bordered > thead > tr > td,
		.table-bordered > tbody > tr > td,
		.table-bordered > tfoot > tr > td {
			border: 1px solid #333;
		}

		.table-bordered th {
			background-color: #333 !important;
			color: #fff !important;
			border-color: #333;
			border: 1px solid #fff;
		}

		h4, h3 {
			margin: 0 !important;
		}

		.headborder {
			border-top: 3px double #333 !important;
			border-bottom: 3px double #333 !important;
		}
	</style>

	<script type="text/php">
		if ( isset($pdf) ) {
			$font = $fontMetrics->getFont("helvetica", "bold");
			$pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
		}
	</script>
</body>
</html>
