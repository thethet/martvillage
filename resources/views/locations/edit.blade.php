@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Location">
	</div>
	<div class="col-md-8 site-header">Location List</div>
@stop

@section('main')
	<div class="main-content">
		<!-- <div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Permission Management</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div>.row -->

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			<div class="col-lg-5 country-list">
				<div class="table-cont country-tbl">
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th colspan="3" class="center">Country List</th>
							</tr>

							<tr>
								<th>No</th>
								<th>Country Name</th>
								<th>Number of City</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($countries as $key => $country)
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $country->country_name }}</td>
									<td>{{ $country->total_cities }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{-- {!! $countries->render() !!} --}}

				{!! Form::open(array('route' => 'locations.country.store','method'=>'POST', 'id' => 'country-form', 'class' => 'form-horizontal')) !!}
					{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
					<div class="form-group" style="margin-bottom: 0;">
						<label class="control-label col-sm-3" for="name">
							<strong>Country:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::text('country_name', null, array('placeholder' => 'Country Name','class' => 'form-control')) !!}
						</div>
						<div class="col-sm-3">
							<a href="#" id="add" onclick="document.getElementById('country-form').submit();">
								<div class="addbtn">
									<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
										Add
								</div>
							</a>
						</div>
					</div><!-- .form-group -->
					@if ($errors->has('country_name'))
						<span class="required">
							<strong>{{ $errors->first('country_name') }}</strong>
						</span>
					@endif

				{!! Form::close() !!}
			</div>

			<div class="col-lg-6 city-add">
					{!! Form::model($countryCity, ['method' => 'PATCH','route' => ['locations.update', $countryCity->id], 'id' => 'city-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
					<div class="form-group"></div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
							<strong>City Name:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::text('state_name', null, array('placeholder' => 'City Name','class' => 'form-control')) !!}
							@if ($errors->has('state_name'))
								<span class="required">
									<strong>{{ $errors->first('state_name') }}</strong>
								</span>
							@endif
						</div>
					</div><!-- .form-group -->

					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
							<strong>Country:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::select('country_id', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'country_id', 'class' => 'form-control']) !!}
							@if ($errors->has('country_id'))
								<span class="required">
									<strong>{{ $errors->first('country_id') }}</strong>
								</span>
							@endif
						</div>
					</div><!-- .form-group -->
					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
						</label>
						<div class="col-sm-6">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
						</label>
						<div class="col-sm-6">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
						</label>
						<div class="col-sm-6">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
						</label>
						<div class="col-sm-6">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="name">
						</label>
						<div class="col-sm-6">
						</div>
						<div class="col-sm-3">
							<a href="#" id="add" onclick="document.getElementById('city-form').submit();">
								<div class="addbtn">
									<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
										Update
								</div>
							</a>
						</div>
					</div><!-- .form-group -->
				{!! Form::close() !!}
			</div>

		</div>

		<div class="row country-city">
			<div class="table-cont">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							@foreach($countriesLists as $clist)
								<th width="8px">&nbsp;&nbsp;&nbsp;</th>
								<th>{{ $clist->country_name }}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach($citiesLists as $cities)
							<tr>
								@foreach($countriesLists as $countlist)
									@if(array_key_exists($countlist->country_name, $cities))
									<td>
										{!! Form::checkbox('edit', $cities[$countlist->country_name]['id'], null, ['class' => 'editboxes', 'disabled' => true]) !!}
									</td>
									<td>{{ $cities[$countlist->country_name]['state_name'] }}</td>
									@else
										<td></td>
										<td></td>
									@endif
								@endforeach
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
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

			{{-- @permission('location-create')
				<div class="menu-icon">
					<a href="{{ route('permissions.create') }}">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('location-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('location-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			<div class="menu-icon">
				<a href="{{ url('locations') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.js') }}"></script>
	<script>
		$(document).ready(function(){
			$("#country_id").select2();

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
							url: "{{ url('locations/ajax/id/edit') }}",
							type: 'GET',
							data: {
								id: id,
								mode: 'edit'
							},
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
							url: "{!! url('locations/"+ id +"') !!}",
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
