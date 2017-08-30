@extends('layouts.layout')
@section('main')
{!! Form::open(array('route' => 'roles.store','method'=>'POST', 'id' => 'role-form')) !!}
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2>Create New Role</h2>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div>
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Name:</strong>
					{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Display Name:</strong>
					{!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Description:</strong>
					{!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Permission:</strong>
					<br/>
					@foreach($permission as $value)
						<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
						{{ $value->display_name }}</label>
						<br/>
					@endforeach
				</div>
			</div>

			<!-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
			</div> -->


		</div>
	</div>

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('role-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div>

			<div class="menu-icon">
				<a href="{{ route('roles.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Save">
					Back
				</a>
			</div>
		</div>
	</div>
@stop
{!! Form::close() !!}
