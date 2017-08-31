<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Company has been created in our system.</title>
</head>
<body>
	<table width='90%' align='center' >
		<tr >
			<td style='padding-bottom:10px'>
				Dear {{ $company->company_name }},
			</td>
		</tr>
		<tr >
			<td style='padding-bottom:10px'>
				Your company has been successfully created in our cargo management system.
				<br>
				Below are the details:
			</td>
		</tr>
		<tr >
			<td >
				<b>Email :</b> {{$company->email }}

			</td>
		</tr>
		<tr >
			<td style='padding-top:10px'>
				Thanks,
				<br>
				CARGO MANAGEMENT SYSTEM.
			</td>
		</tr>
	</table>
</body>
</html>
