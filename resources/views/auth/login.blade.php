@extends('layout.default')

@section('content')
	<div class="login-container">
		<div class="login-header login-caret">
			<div class="login-content">
				<span class="description">
					<img src="{{ asset('assets/images/shwe-cargo.png') }}" width="120" alt="" />
				</span>
				<p class="description">Dear user, log in to access the admin area!</p>
				@if ($message = Session::get('error'))
					<p class="text-danger"><strong>{{ $message }}</strong></p>
				@endif
			</div>
		</div>

		<div class="login-progressbar">
			<div></div>
		</div>

		<div class="login-form">
			<div class="login-content">
				<div class="form-login-error">
					<h3>Invalid login</h3>
					<p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
				</div>

				<form class="form-horizontal" role="form" method="POST" id="form_login" action="{{ url('/login') }}">
					{{ csrf_field() }}

					<div class="form-group">
						<div class="input-group {{ $errors->has('email') ? ' validate-has-error' : '' }}">
							<div class="input-group-addon">
								<i class="entypo-user"></i>
							</div>

							<input type="email" class="form-control" name="email" id="username" placeholder="Username" autocomplete="off" />

							@if ($errors->has('email'))
								<label id="username-error" class="error" for="username">{{ $errors->first('email') }}</label>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="input-group {{ $errors->has('password') ? ' validate-has-error' : '' }}">
							<div class="input-group-addon">
								<i class="entypo-key"></i>
							</div>

							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
							@if ($errors->has('password'))
								<label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
							@endif
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-login">
							<i class="entypo-login"></i>
							Login In
						</button>
					</div>
				</form>

				<div class="login-bottom-links">
					{{-- <a href="extra-forgot-password.html" class="link">Forgot your password?</a> --}}
					<br />
					<a href="#">Copyright © 2017 All Rights Reserved. MSCT Co.Ltd </a>  - <a href="#">Privacy Policy</a>
				</div>
			</div>
		</div>
	</div>
@endsection
