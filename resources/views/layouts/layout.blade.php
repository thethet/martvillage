
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">

	<title>MART VILLAGE</title>

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

	<div class="container">

		<!-- Static navbar -->
		<nav class="navbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Cargo Management System</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<div class="row">
						<div class="col-md-8">
							<div class="col-md-6">
								&nbsp;
							</div>
							<div class="col-md-2 navbar-right">
								{{ date('d F') }} <br>
								{{ date("h:i A") }}
							</div>
							<div class="col-md-3 navbar-right">
								Hi.... <br>
								{{ Auth::user()->name }}

							</div>
						</div>

						<div class="col-md-1">
							<ul class="nav navbar-nav navbar-right">
								<li class="tx-center">
									<a  href="{{ url('/logout') }}">
										<img src="{{ asset('assets/img/Lockout.png') }}" alt="singout" width="27px">
									</a>
									Logout
								</li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div><!--/.container-fluid -->
		</nav>

		<!-- Main component for a primary marketing message or call to action -->
		<div class="main">
			@yield('main')
		</div>

		{{-- @yield('footer') --}}

	</div> <!-- /container -->

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
