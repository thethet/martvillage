@extends('layouts.default')

<!-- Main Content -->
@section('content')
	<div class="login-container">
		<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<div class="loginbox panel panel-info" >
				<div class="headingbox panel-heading">
					<div class="panel-title">Reset Password</div>
				</div>

				<div style="padding-top:30px" class="panel-body" >
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
								</button>
								<a class="btn btn-link txt-white" href="{{ url('/') }}">Login</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
