@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/permission.png') }}" alt="Permission">
	</div>
	<div class="col-md-8 site-header">Edit Permission</div>
@stop

@section('main')
{!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id], 'id' => 'permission-form', 'class' => 'form-horizontal']) !!}
	<div class="main-content">
		{{-- <div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Edit Permission</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div> --}}<!-- .row -->

		{{-- @if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif --}}

		<div class="small-10 columns">
			<p><b><span class="required">*</span> Fields are required</b></p>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="display name">
				<strong>Display Name: <span class="required">*</span></strong>
			</label>
			<div class="col-sm-4">
				{!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
				@if ($errors->has('display_name'))
					<span class="required">
						<strong>{{ $errors->first('display_name') }}</strong>
					</span>
				@endif
			</div>
		</div><!-- .form-group -->

		<div class="form-group">
			<label class="control-label col-sm-2" for="description">
				<strong>Description: <span class="required">*</span></strong>
			</label>
			<div class="col-sm-4">
				{!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
				@if ($errors->has('description'))
					<span class="required">
						<strong>{{ $errors->first('description') }}</strong>
					</span>
				@endif
			</div>
		</div><!-- .form-group -->
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="reset" onclick="document.getElementById('permission-form').reset();">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('permissions.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('permission-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
{!! Form::close() !!}

@endsection
