
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Shwe Cargo Admin Panel" />
	<meta name="author" content="TTA" />
	<link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

	<title>SHWECARGO</title>

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="{{ asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="{{ asset('assets/css/navbar.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/sticky-footer.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<script src="js/ie-emulation-modes-warning.js') }}"></script>
	@yield('my-style')

	</head>

	<body>

		@yield('content')
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="{{ asset('assets/js/vendor/jquery.min.js') }}"><\/script>')</script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="{{ asset('assets/js/ie10-viewport-bug-workaround.js') }}"></script>
		@yield('my-script')
	</body>
</html>
