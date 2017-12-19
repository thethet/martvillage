<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Sales Report By Trip</title>
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
						<h4>Sales Report By Trip</h4>
					</td>

					<td class="text-right noborder">
						Date: {{ date('Y-m-d') }}
					</td>
				</tr>
			</table>

			@for ($t = 0; $t < count($tripList); $t++)
				<h5>DEPARTURE DATE: {{ $deptDate }}</h5>
				<h5>TRIP: {{ $tripList[$t] }}</h5>
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Departure Time</th>
							<th>Vessel No.</th>
							<th>MAHTATHA</th>
							<th>Toll Fees</th>
							<th>FOC</th>
							<th>Discount</th>
							<th>Income</th>
							<th>Net Income</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$totalDiscount = $totalIncome = $totalNetSales = 0;
						?>
						@for($rp = 0; $rp < count($tripReportLists[$tripList[$t]]); $rp++)
							<tr>
								<td>{{ $rp + 1 }}</td>
								<td>
									{{ $tripReportLists[$tripList[$t]][$rp]->dept_time }}
								</td>
								<td>
									{{ $tripReportLists[$tripList[$t]][$rp]->vessel_no }}
								</td>
								<td>{{ '-' }}</td>
								<td>{{ '-' }}</td>
								<td>{{ '-' }}</td>
								<td class="text-right">
									{{ number_format($tripReportLists[$tripList[$t]][$rp]->total_discount, 2) }}
								</td>
								<td class="text-right">
									{{ number_format($tripReportLists[$tripList[$t]][$rp]->total_income, 2) }}
								</td>
								<td class="text-right">
									{{ number_format($tripReportLists[$tripList[$t]][$rp]->net_income, 2) }}
								</td>
							</tr>
							<?php
								$totalDiscount  += $tripReportLists[$tripList[$t]][$rp]->total_discount;
								$totalIncome    += $tripReportLists[$tripList[$t]][$rp]->total_income;
								$totalNetSales  += $tripReportLists[$tripList[$t]][$rp]->net_income;
							?>
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
							<td></td>
						</tr>
						<tr>
							<td colspan="3" class="text-right"><b>TOTAL</b></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right">{{ number_format($totalDiscount, 2) }}</td>
							<td class="text-right">{{ number_format($totalIncome, 2) }}</td>
							<td class="text-right">{{ number_format($totalNetSales, 2) }}</td>
						</tr>
					</tbody>
				</table>
			@endfor

			<br><br>
			<table class="table noborder">
				<tr>
					<td class="noborder text-center" width="10%">&nbsp;</td>
					<td class="noborder text-center" width="30%"><b>Prepared By</b></td>
					<td class="noborder text-center" width="30%"><b>Check By</b></td>
					<td class="noborder text-center" width="30%"><b>Approved By</b></td>
				</tr>

				<tr>
					<td class="noborder">Sign</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
					<td class="noborder">&nbsp;</td>
				</tr>

				<tr>
					<td class="noborder">Name</td>
					<td class="noborder"></td>
					<td class="noborder"></td>
					<td class="noborder"></td>
				</tr>

				<tr>
					<td class="noborder">Post</td>
					<td class="noborder"></td>
					<td class="noborder"></td>
					<td class="noborder"></td>
				</tr>
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
