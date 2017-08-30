@extends('layouts.layout')
@section('main')
{!! Form::open(array('route' => 'permissions.store','method'=>'POST', 'id' => 'permission-form')) !!}
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Create New Permission</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div><!-- .row -->

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

		<div class="small-10 columns">
			<p><b><span class="required">*</span> Fields are required</b></p>
		</div>

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Name: <span class="required">*</span></strong>
					{!! Form::text('name', null, array('placeholder' => 'Please Enter Name','class' => 'form-control')) !!}
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Display Name:</strong>
					{!! Form::text('display_name', null, array('placeholder' => 'Please Enter Display Name','class' => 'form-control')) !!}
				</div>
			</div>
		</div><!-- .row -->

		<div class="row">
			<div class="col-xs-5">
				<div class="form-group">
					<strong>Description:</strong>
					{!! Form::textarea('description', null, array('placeholder' => 'Please Enter Description','class' => 'form-control','style'=>'height:100px')) !!}
				</div>
			</div>
		</div><!-- .row -->
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('permission-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('permissions.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Save">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
{!! Form::close() !!}
@stop
