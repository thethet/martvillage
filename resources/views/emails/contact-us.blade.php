<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $data['subject'] }}</title>
</head>
<body>
	Dear Sir/Madam,
	<br>
	<p>
		{{ $data['message'] }}
	</p>

	<br>
	<br>
	Thanks,
	<br>
	{{ $data['first_name'] }} {{ $data['last_name'] }}
</body>
</html>
