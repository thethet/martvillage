<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Lotin</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="{{ asset('assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/font-icons/entypo/css/entypo.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/neon-core.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" media="all" />

	<link rel="stylesheet" href="{{ asset('assets/css/font-icons/font-awesome/css/font-awesome.min.css') }}" media="all" />
</head>
<body class="zawgyi"">
<body class="zawgyi" onload="window.print()">
	{{-- <div class="zawgyi"> --}}
			<table class="zawgyi mt20-ml10">
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
						******************************************************
					</td>
				</tr>

				<tr>
					<td class="noborder" width="15%"><br>Lotin Date</td>

					<td class="noborder"><br>{{ $lotinData->date }}</td>
				</tr>

				<tr>
					<td class="noborder">Lot No</td>
					<td class="noborder">{{ $lotinData->lot_no }}</td>
				</tr>

				<tr>
					<td class="noborder">Location</td>
					<td class="noborder">{{ $stateList[$lotinData->from_state] }} ~ {{ $stateList[$lotinData->to_state] }}</td>
				</tr>

				<tr>
					<td class="noborder">Member No</td>
					<td class="noborder">
						@if($sender->member_no)
						{{ $sender->member_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Sender Name</td>
					<td class="noborder">
						@if($sender->name)
							{{ $sender->name }}
						@else
							{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Contact No</td>
					<td class="noborder">
						@if($sender->contact_no)
						{{ $sender->contact_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Sender NRIC</td>
					<td class="noborder">
						@if($sender->nric_code_id != 0 && $sender->nric_township_id != 0)
						{{ $nricCodeList[$sender->nric_code_id] }} / {{ $nricTownshipList[$sender->nric_township_id] }} {{ $sender->nric_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Receiver Name</td>
					<td class="noborder">
						@if($receiver->name)
						{{ $receiver->name }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Contact No</td>
					<td class="noborder">
						@if($receiver->contact_no)
						{{ $receiver->contact_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Receiver NRIC</td>
					<td class="noborder">
						@if($receiver->nric_code_id != 0 && $receiver->nric_township_id != 0)
						{{ $nricCodeList[$receiver->nric_code_id] }} / {{ $nricTownshipList[$receiver->nric_township_id] }} {{ $receiver->nric_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td class="noborder">Payment</td>
					<td class="noborder">
						{{ $lotinData->payment }}
					</td>
				</tr>

				<tr>
					<td colspan="2" class="text-center noborder">
						********************************
					</td>
				</tr>

				<tr>
					<td colspan="2" class="text-center noborder">
						<h4>Thank You!</h4>
						{{ date("Y-m-d") }}
					</td>
				</tr>
			</table>

	</div>

	<style>
		@page {
			/*size: 500pt 500pt;*/
			margin: 5px;
			font-size: 12px;
		}
		body {
			/*margin: -25px -30px;*/
		}

		/* .mt20-ml10 {
			margin-top: -20px;
			margin-left: -10px;
		} */
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
			padding: 3px !important;
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
{{-- {{die}} --}}
