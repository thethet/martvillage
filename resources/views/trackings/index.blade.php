@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Tracking">
	</div>
	<div class="col-md-8 site-header">Tracking List</div>
@stop

@section('main')
	{!! Form::open(array('route' => 'trackings.search','method'=>'POST', 'id' => 'tracking-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) !!}
	<div class="main-content">
		<div class="row">
			<div class="form-group"></div>
			<div class="form-group"></div>
		</div>
		<div class="row">
			<div class="col col-md-2"></div>
			<div class="col col-md-6 loginbox">
				<div class="form-group"></div>

				<div class="form-group center lottitle">
					<b>Please Enter Your Lot No.</b>
				</div><!-- .form-group -->

				<div class="form-group"></div>
				<div class="form-group center">
					@if ($message = Session::get('success'))
					<span class="required">
						<strong>{{ $message }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3" for="lotNo"></label>
					<div class="col-sm-6">
						{!! Form::text('lot_no', null, array('placeholder' => 'Please Enter Lot Number','class' => 'form-control')) !!}
						@if ($errors->has('lot_no'))
							<span class="required">
								<strong>{{ $errors->first('lot_no') }}</strong>
							</span>
						@endif
					</div>
				</div><!-- .form-group -->

				<div class="form-group"></div>
				<div class="form-group"></div>
				<div class="form-group">
					<div class="form-group" style="margin-bottom: 0;">
						<label class="control-label col-sm-3" for="from"></label>
						<div class="col-sm-4"></div>
						<div class="col-sm-3">
							<a href="#" id="add" onclick="document.getElementById('tracking-form').submit();">
								<div class="addbtn">
									<img src="{{ asset('assets/img/Search.png') }}" alt="Search">
										Search
								</div>
							</a>
						</div>
						<div class="col-sm-2"></div>
					</div><!-- .form-group -->
				</div>
			</div>
			<div class="col col-md-3"></div>
		</div>

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
				<a href="{{ url('dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Save">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
{!! Form::close() !!}
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".editboxes").change(function() {
				var $el = $(this);
				if ($el.is(":checked")) {
					$('.editboxes').attr('disabled', true);
					$el.attr("disabled", false);
				}
				else {
					$('.editboxes').attr('disabled', false);
				}
			});

			$("#edit").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{{ url('permissions/ajax/id/edit') }}",
							type: 'GET',
							data: { id: id },
							success: function(data)
							{
								window.location.replace(data.url);
							}
						});
					}
				});
			});

			$("#delete").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{!! url('permissions/"+ id +"') !!}",
							type: 'DELETE',
							data: {_token: '{!! csrf_token() !!}'},
							dataType: 'JSON',
							success: function (data) {
								window.location.replace(data.url);
							}
						});
					}
				});
			});
		});
	</script>
@stop
