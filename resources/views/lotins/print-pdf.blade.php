<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Innomaid</title>
	<meta name="generator" content="Bootply" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body class="zawgyi">
	<div class="row zawgyi">
		<div class="col-sm-11">
			<table class="table zawgyi">
				<tr>
					<td colspan="2" class="text-center">
						<h3>{{ $myCompany->company_name }}</h3>
					</td>
				</tr>

				<tr>
					<td>Lotin Date</td>

					<td>{{ $lotinData->date }}</td>
				</tr>

				<tr>
					<td>Lot No</td>
					<td>{{ $lotinData->lot_no }}</td>
				</tr>

				<tr>
					<td>Location</td>
					<td>{{ $stateList[$lotinData->from_state] }} ~ {{ $stateList[$lotinData->to_state] }}</td>
				</tr>

				<tr>
					<td>Member No</td>
					<td>
						@if($sender->member_no)
						{{ $sender->member_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Sender Name</td>
					<td>
						@if($sender->name)
							{{ $sender->name }}
						@else
							{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Contact No</td>
					<td>
						@if($sender->contact_no)
						{{ $sender->contact_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Sender NRIC</td>
					<td>
						@if($sender->nric_code_id != 0 && $sender->nric_township_id != 0)
						{{ $nricCodeList[$sender->nric_code_id] }} / {{ $nricTownshipList[$sender->nric_township_id] }} {{ $sender->nric_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Receiver Name</td>
					<td>
						@if($receiver->name)
						{{ $receiver->name }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Contact No</td>
					<td>
						@if($receiver->contact_no)
						{{ $receiver->contact_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Receiver NRIC</td>
					<td>
						@if($receiver->nric_code_id != 0 && $receiver->nric_township_id != 0)
						{{ $nricCodeList[$receiver->nric_code_id] }} / {{ $nricTownshipList[$receiver->nric_township_id] }} {{ $receiver->nric_no }}
						@else
						{{ '-' }}
						@endif
					</td>
				</tr>

				<tr>
					<td>Payment</td>
					<td>
						{{ $lotinData->payment }}
					</td>
				</tr>

				<tr>
					<td colspan="2" class="tex-center" style="border-bottom: 1px dashed #000;">&nbsp;</td>
				</tr>

				<tr>
					<td colspan="2" class="text-center">
						<h4>Thank You!</h4>
						{{ date("Y-m-d") }}
					</td>
				</tr>
			</table>
		</div>

	</div>

	<style>
		html {
			font-family: sans-serif;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}
		body {
			margin: 0;
			margin-top: -20px;
		}

		b,
		strong {
			font-weight: bold;
		}

		h1 {
			font-size: 2em;
			margin: 0.67em 0;
		}

		small {
			font-size: 80%;
		}
		sub,
		sup {
			font-size: 75%;
			line-height: 0;
			position: relative;
			vertical-align: baseline;
		}
		sup {
			top: -0.5em;
		}
		sub {
			bottom: -0.25em;
		}
		img {
			border: 0;
		}

		hr {
			box-sizing: content-box;
			height: 0;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		td,
		th {
			padding: 0;
		}
		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		*:before,
		*:after {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		html {
			font-size: 10px;
			-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
		}
		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-size: 12px;
			line-height: 1.42857143;
			color: #333;
			background-color: #fff;
		}
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.h1,
		.h2,
		.h3,
		.h4,
		.h5,
		.h6 {
			font-family: inherit;
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-weight: 500;
			line-height: 1.1;
			color: #373e4a;
		}
		h1,
		.h1,
		h2,
		.h2,
		h3,
		.h3 {
			margin-top: 17px;
			margin-bottom: 8.5px;
		}
		h4,
		.h4,
		h5,
		.h5,
		h6,
		.h6 {
			margin-top: 8.5px;
			margin-bottom: 8.5px;
		}
		h1,
		.h1 {
			font-size: 31px;
		}
		h2,
		.h2 {
			font-size: 25px;
		}
		h3,
		.h3 {
			font-size: 21px;
		}
		h4,
		.h4 {
			font-size: 15px;
			margin: 0;
		}
		h5,
		.h5 {
			font-size: 12px;
		}
		h6,
		.h6 {
			font-size: 11px;
		}
		p {
			margin: 0 0 8.5px;
		}
		.text-left {
			text-align: left;
		}
		.text-right {
			text-align: right;
		}
		.text-center {
			text-align: center;
		}
		.text-justify {
			text-align: justify;
		}
		.text-nowrap {
			white-space: nowrap;
		}
		.text-lowercase {
			text-transform: lowercase;
		}
		.text-uppercase {
			text-transform: uppercase;
		}
		.text-capitalize {
			text-transform: capitalize;
		}
		.text-muted {
			color: #999999;
		}
		.text-primary {
			color: #949494;
		}
		.text-success {
			color: #045702;
		}
		.text-info {
			color: #2c7ea1;
		}
		.text-warning {
			color: #574802;
		}
		.text-danger {
			color: #ac1818;
		}
		.bg-primary {
			color: #fff;
			background-color: #949494;
		}
		.bg-success {
			background-color: #bdedbc;
		}
		.bg-info {
			background-color: #c5e8f7;
		}
		.bg-warning {
			background-color: #ffefa4;
		}
		.bg-danger {
			background-color: #ffc9c9;
		}
		.page-header {
			padding-bottom: 7.5px;
			margin: 34px 0 17px;
			border-bottom: 1px solid #333;
		}
		ul,
		ol {
			margin-top: 0;
			margin-bottom: 8.5px;
		}
		ul ul,
		ol ul,
		ul ol,
		ol ol {
			margin-bottom: 0;
		}
		.list-unstyled {
			padding-left: 0;
			list-style: none;
		}
		.list-inline {
			padding-left: 0;
			list-style: none;
			margin-left: -5px;
		}
		.list-inline > li {
			display: inline-block;
			padding-left: 5px;
			padding-right: 5px;
		}
		.container-fluid {
			margin-right: auto;
			margin-left: auto;
			padding-left: 15px;
			padding-right: 15px;
		}
		.row {
			margin-left: -15px;
			margin-right: -15px;
		}
		table {
			background-color: transparent;
		}
		caption {
			padding-top: 8px;
			padding-bottom: 8px;
			color: #999999;
			text-align: left;
		}
		th {
			text-align: left;
			background-color: #555;
			color: #fff;
		}
		.table {
			width: 100%;
			max-width: 100%;
			margin-bottom: 17px;
		}
		.table > thead > tr > th,
		.table > tbody > tr > th,
		.table > tfoot > tr > th,
		.table > thead > tr > td,
		.table > tbody > tr > td,
		.table > tfoot > tr > td {
			padding: 0px;
			/*line-height: 1.42857143;*/
			vertical-align: top;
			/*border-top: 1px solid #333;*/
		}
		.table > thead > tr > th {
			vertical-align: bottom;
			/*border-bottom: 2px solid #333;*/
		}
		.table > caption + thead > tr:first-child > th,
		.table > colgroup + thead > tr:first-child > th,
		.table > thead:first-child > tr:first-child > th,
		.table > caption + thead > tr:first-child > td,
		.table > colgroup + thead > tr:first-child > td,
		.table > thead:first-child > tr:first-child > td {
			border-top: 0;
		}
		.table > tbody + tbody {
			/*border-top: 2px solid #333;*/
		}
		.table .table {
			background-color: #fff;
		}
		table col[class*="col-"] {
			position: static;
			float: none;
			display: table-column;
		}
		table td[class*="col-"],
		table th[class*="col-"] {
			position: static;
			float: none;
			display: table-cell;
		}
		.table > thead > tr > td.active,
		.table > tbody > tr > td.active,
		.table > tfoot > tr > td.active,
		.table > thead > tr > th.active,
		.table > tbody > tr > th.active,
		.table > tfoot > tr > th.active,
		.table > thead > tr.active > td,
		.table > tbody > tr.active > td,
		.table > tfoot > tr.active > td,
		.table > thead > tr.active > th,
		.table > tbody > tr.active > th,
		.table > tfoot > tr.active > th {
			background-color: #f5f5f5;
		}
		.table > thead > tr > td.success,
		.table > tbody > tr > td.success,
		.table > tfoot > tr > td.success,
		.table > thead > tr > th.success,
		.table > tbody > tr > th.success,
		.table > tfoot > tr > th.success,
		.table > thead > tr.success > td,
		.table > tbody > tr.success > td,
		.table > tfoot > tr.success > td,
		.table > thead > tr.success > th,
		.table > tbody > tr.success > th,
		.table > tfoot > tr.success > th {
			background-color: #bdedbc;
		}
		.table > thead > tr > td.info,
		.table > tbody > tr > td.info,
		.table > tfoot > tr > td.info,
		.table > thead > tr > th.info,
		.table > tbody > tr > th.info,
		.table > tfoot > tr > th.info,
		.table > thead > tr.info > td,
		.table > tbody > tr.info > td,
		.table > tfoot > tr.info > td,
		.table > thead > tr.info > th,
		.table > tbody > tr.info > th,
		.table > tfoot > tr.info > th {
			background-color: #c5e8f7;
		}
		.table > thead > tr > td.warning,
		.table > tbody > tr > td.warning,
		.table > tfoot > tr > td.warning,
		.table > thead > tr > th.warning,
		.table > tbody > tr > th.warning,
		.table > tfoot > tr > th.warning,
		.table > thead > tr.warning > td,
		.table > tbody > tr.warning > td,
		.table > tfoot > tr.warning > td,
		.table > thead > tr.warning > th,
		.table > tbody > tr.warning > th,
		.table > tfoot > tr.warning > th {
			background-color: #ffefa4;
		}
		.table > thead > tr > td.danger,
		.table > tbody > tr > td.danger,
		.table > tfoot > tr > td.danger,
		.table > thead > tr > th.danger,
		.table > tbody > tr > th.danger,
		.table > tfoot > tr > th.danger,
		.table > thead > tr.danger > td,
		.table > tbody > tr.danger > td,
		.table > tfoot > tr.danger > td,
		.table > thead > tr.danger > th,
		.table > tbody > tr.danger > th,
		.table > tfoot > tr.danger > th {
			background-color: #ffc9c9;
		}
		.table-responsive {
			overflow-x: auto;
			min-height: 0.01%;
		}
		@font-face {
			font-family: zawgyi;
			src: url('{{ asset('assets/fonts/zawgyi.ttf') }}') format('truetype')း
		}
		.zawgyi {
			font-family:zawgyi !important;
		}
		b {
			font-weight: bold;
		}
	</style>
</body>
</html>
