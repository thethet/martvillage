<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Sales Report By Credit</title>
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
	<div class="row zawgyi">
		<div class="col-sm-11">
			<table class="table noborder">
				<tr>
					<td colspan="2" class="text-center noborder">
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
						**********************************************************************************************************
					</td>
				</tr>

				<tr>
					<td class="noborder">
						<h4>Daily Sales Report By Credit</h4>
					</td>

					<td class="text-right noborder">
						Date: {{ $date }}
					</td>
				</tr>

			</table>

			<?php
				$i = 1;
				$totalSalesCredit = $totalDiscountCredit = $totalNetSalesCredit = 0;
			?>
			<table class="table table-bordered responsive zawgyi">
				<thead>
					<tr>
						<th width="5%" class="zawgyi">SNo.</th>
						<th class="zawgyi">Description</th>
						<th width="15%" class="zawgyi">Sales</th>
						<th width="15%" class="zawgyi">Discount</th>
						<th width="15%" class="zawgyi">Net Sales</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lotinsByCredit as $key => $byCredit)
						<tr>
							<td>{{ $i++ }}</td>
							<td>Cargo (Credit) [{{ $key }}]</td>
							<td class="text-right">{{ number_format($byCredit['total_sales'], 2) }}</td>
							<td class="text-right">{{ number_format($byCredit['total_dis'], 2) }}</td>
							<td class="text-right">{{ number_format($byCredit['net_sales'], 2) }}</td>
						</tr>
						<?php
							$totalSalesCredit    += $byCredit['total_sales'];
							$totalDiscountCredit += $byCredit['total_dis'];
							$totalNetSalesCredit += $byCredit['net_sales'];
						?>
					@endforeach
					<tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2" class="text-right">TOTAL INCOME</td>
						<td class="text-right">{{ number_format($totalSalesCredit, 2) }}</td>
						<td class="text-right">{{ number_format($totalDiscountCredit, 2) }}</td>
						<td class="text-right">{{ number_format($totalNetSalesCredit, 2) }}</td>
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
</body>
</html>
