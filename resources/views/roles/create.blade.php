@extends('layouts.layout')
@section('main')
{!! Form::open(array('route' => 'roles.store','method'=>'POST', 'id' => 'role-form')) !!}
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Create New Role</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div><!-- .row -->

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

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Name: <span class="required">*</span></strong>
					{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
					@if ($errors->has('name'))
						<span class="required">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Display Name: <span class="required">*</span></strong>
					{!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
					@if ($errors->has('display_name'))
						<span class="required">
							<strong>{{ $errors->first('display_name') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Description: <span class="required">*</span></strong>
					{!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
					@if ($errors->has('description'))
						<span class="required">
							<strong>{{ $errors->first('description') }}</strong>
						</span>
					@endif
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Permission: <span class="required">*</span></strong>
					@if ($errors->has('permission'))
						<br>
						<span class="required">
							<strong>{{ $errors->first('permission') }}</strong>
						</span>
					@endif
					<br/>
					@foreach($permission as $value)
						<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
						{{ $value->display_name }}</label>
						<br/>
					@endforeach
				</div>
			</div>
		</div>
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('role-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('roles.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Save">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
{!! Form::close() !!}
@stop
