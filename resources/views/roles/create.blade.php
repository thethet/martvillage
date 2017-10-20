@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/roleicon.png') }}" alt="Role">
	</div>
	<div class="col-md-8 site-header">New Role</div>
@stop

@section('main')
{!! Form::open(array('route' => 'roles.store','method'=>'POST', 'id' => 'role-form', 'class' => 'form-horizontal')) !!}
	<div class="main-content">
		{{-- <div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3 class="page-title">Create New Role</h3>
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
			{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="name">
				<strong>Name:</strong>
			</label>
			<div class="col-sm-4">
				{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
				@if ($errors->has('name'))
					<span class="required">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>
		</div><!-- .form-group -->

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

		<div class="form-group">
			<label class="control-label col-sm-2" for="permission">
				<strong>Permission: <span class="required">*</span></strong>
			</label>
			<div class="col-sm-3">
				{!! Form::checkbox('select_all', null, null, ['id' => 'select-all']) !!} &nbsp;
				<span id="select-unselect">Select All</span>
				@if ($errors->has('permission'))
					<span class="required">
						<strong>{{ $errors->first('permission') }}</strong>
					</span>
				@endif
			</div>

		</div><!-- .form-group -->

		<div class="form-group">

			@foreach($permission as $value)
				<div class="col-sm-3">
					<label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'permission-name')) }}
					{{ $value->display_name }}</label>
					<br/>
				</div>
			@endforeach
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
				<a href="#" id="reset" onclick="document.getElementById('role-form').reset();">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ route('roles.index') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('role-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
{!! Form::close() !!}
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.js') }}"></script>
	<script>
		$(document).ready(function(){

			$("#select-all").change(function(){
				if($(this).is(':checked')){
					$("#select-unselect").text('Unselect All');
					$(".permission-name").each(function() {
						$(this).prop("checked", true);
					});
				}else{
					$("#select-unselect").text('Select All');
					$(".permission-name").each(function() {
						$(this).prop("checked", false);
					});
				}
			});
		});

	</script>
@stop
