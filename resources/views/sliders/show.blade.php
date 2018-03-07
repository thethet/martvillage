@extends('layouts.layout')

@section('page-title')
	Slider
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('informations') }}">Information</a>
			</li>
			<li>
				<a href="{{ url('sliders') }}">Slider Management</a>
			</li>
			<li class="active">
				<strong>Detail Form</strong>
			</li>
		</ol>

		<h2>Slider Management</h2>
		<br />

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>Detail Form</strong>
						</div>

						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						</div>
					</div>

					<div class="panel-body">
						{!! Form::model($slider, ['method' => 'GET', 'route' => ['sliders.index', $slider->id], 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered']) !!}

							<div class="form-group">
								<label class="col-sm-3 control-label">Slider Name</label>

								<div class="col-sm-5">
									<div class="input-group minimal">
										<span class="input-group-addon"><i class="entypo-picture"></i></span>
										{!! Form::text('slider_name', null, ['placeholder' => 'Slider Name','class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Company Logo</label>

								<div class="col-sm-5">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 800px; height: 300px;" data-trigger="fileinput">
											@if($slider->slider_img == null)
												<img src="http://placehold.it/800x300" alt="...">
											@else
												<img src="{{ asset('uploads/sliders/'. $slider->slider_img) }}" alt="ID PHOTO">
											@endif
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"></label>

								<div class="col-sm-5">
									<a href="{{ route('sliders.index') }}" class="btn btn-orange btn-icon">
										Back
										<i class="entypo-reply"></i>
									</a>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

@section('my-script')
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{ asset('assets/js/datatables/datatables.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
			if (is_string($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>
@stop

