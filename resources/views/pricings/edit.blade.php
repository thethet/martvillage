@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/price-tag.png') }}" alt="Pricing">
	</div>
	<div class="col-md-8 site-header">Pricing List</div>
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
								<th colspan="3" class="center">Categories</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $key => $category)
								<tr>
									<td width="8px">{{ ++$i }}</td>
									<td>{{ $category->name }}</td>
									<td>{{ $category->unit }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{-- {!! $categories->render() !!} --}}

				{!! Form::open(array('route' => 'prices.currency.store','method'=>'POST', 'id' => 'currency-form', 'class' => 'form-horizontal')) !!}
					{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}
					<div class="form-group">
						<label class="control-label col-sm-3" for="currency">
							<strong>Currency: <span class="required">*</span></strong>
						</label>
						<div class="col-sm-6">
							{!! Form::text('type', null, array('placeholder' => 'Currency','class' => 'form-control', 'disabled' => true)) !!}
						</div>
					</div><!-- .form-group -->

					<div class="form-group" style="margin-bottom: 0;">
						<label class="control-label col-sm-3" for="from">
							<strong>From: <span class="required">*</span></strong>
						</label>
						<div class="col-sm-6">
							{!! Form::select('from_location', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'from_location', 'class' => 'form-control', 'disabled' => true]) !!}
						</div>
						<div class="col-sm-3">
							<a href="#" id="add">
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
				{!! Form::model($prices, ['method' => 'PATCH','route' => ['prices.update', $prices->id], 'id' => 'price-form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
					{!! Form::hidden('company_id', Auth::user()->company_id, ['class' => 'form-control']) !!}

					<div class="form-group" style="margin-bottom: 8px; margin-top: 10px;">
						<label class="control-label col-sm-3" for="name">
							<strong>Title Name:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::text('title_name', null, array('placeholder' => 'Title Name','class' => 'form-control', 'readonly' => true)) !!}
							@if ($errors->has('title_name'))
								<span class="required">
									<strong>{{ $errors->first('title_name') }}</strong>
								</span>
							@endif
						</div>
					</div><!-- .form-group -->

					<div class="form-group" style="margin-bottom: 8px;">
						<label class="control-label col-sm-3" for="category">
							<strong>Category:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::select('category_id', ['' => 'Select Category'] + $categoryList->toArray(), null, ['id'=>'category_id', 'class' => 'form-control']) !!}
							@if ($errors->has('category_id'))
								<span class="required">
									<strong>{{ $errors->first('category_id') }}</strong>
								</span>
							@endif
						</div>
					</div><!-- .form-group -->

					<div class="form-group" style="margin-bottom: 8px;">
						<label class="control-label col-sm-3" for="fromlocation">
							<strong>From Location:</strong>
						</label>
						<div class="col-sm-4">
							{!! Form::select('from_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'from_country', 'class' => 'form-control']) !!}
						</div>

						<div class="col-sm-4">
							{!! Form::select('from_state', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'from_state', 'class' => 'form-control']) !!}
						</div>
					</div>

					<div class="form-group" style="margin-bottom: 8px;">
						<label class="control-label col-sm-3" for="tolocation">
							<strong>To Location:</strong>
						</label>
						<div class="col-sm-4">
							{!! Form::select('to_country', ['' => 'Select Country'] + $countryList->toArray(), null, ['id'=>'to_country', 'class' => 'form-control']) !!}
						</div>

						<div class="col-sm-4">
							{!! Form::select('to_state', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'to_state', 'class' => 'form-control']) !!}
						</div>
					</div>

					<div class="form-group" style="margin-bottom: 8px;">
						<label class="control-label col-sm-3" for="name">
							<strong>Currency Type:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::select('currency_id', ['' => 'Select Currency'] + $currencyList->toArray(), null, ['id'=>'currency_id', 'class' => 'form-control']) !!}
						</div>
					</div>

					<div class="form-group" style="margin-bottom: 8px;">
						<label class="control-label col-sm-3" for="name">
							<strong>Price:</strong>
						</label>
						<div class="col-sm-6">
							{!! Form::text('unit_price', null, array('placeholder' => 'Price','class' => 'form-control')) !!}
						</div>
						<div class="col-sm-3">
							<a href="#" id="add" onclick="document.getElementById('price-form').submit();">
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

		@if(count($pricingLists) > 0)
		<div class="row country-city">
			<div class="table-cont">
				<table class="table table-bordered table-responsive">

					<thead>
						<tr>
							<th colspan="{{ $totalCol }}" class="center">Pricing</th>
						</tr>

						<tr>
							<th width="8px">&nbsp;&nbsp;&nbsp;</th>
							<th></th>
							@foreach($currencyTitleList as $title)
								<th colspan="{{ $title['total_sub_title'] }}">
									{{ $title['type'] }}
									<br>
									From {{ $title['country'] }}
								</th>
							@endforeach

						</tr>

						<tr>
							<th width="8px">&nbsp;&nbsp;&nbsp;</th>
							<th></th>
							@foreach($currencyTitleList as $title)
								@if(array_key_exists($title['country'], $subTitleList))
									@foreach($subTitleList[$title['country']] as $sub)
										<th>{{ $sub }}</th>
									@endforeach
								@else
									<th></th>
								@endif
							@endforeach
						</tr>
					</thead>
					<tbody>
						<?php $j = 1; ?>
						@foreach($priceLists as $key => $prices)
							<tr>
								<td>{{ $j++ }}</td>
								<td>
									{{ $key }}
								</td>
								@foreach($currencyTitleList as $title)
									@if(array_key_exists($title['country'], $subTitleList))
										@foreach($subTitleList[$title['country']] as $sub)
											<td>
												{{-- {{dd($prices[$title['country']])}} --}}
												@if(array_key_exists($title['country'], $prices))
													@if(array_key_exists($sub, $prices[$title['country']]))
														@if($prices[$title['country']][$sub]['id'] != 0)
															{!! Form::checkbox('edit', $prices[$title['country']][$sub]['id'], null, ['class' => 'editboxes', 'disabled' => true]) !!}
															&nbsp;
															{{ $prices[$title['country']][$sub]['unit_price'] }}
														@endif
													@endif
												@endif
											</td>
										@endforeach
									@else
										<td></td>
									@endif
								@endforeach
							</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			{{-- @permission('price-create')
				<div class="menu-icon">
					<a href="{{ route('prices.create') }}">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			{{-- @permission('price-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			{{-- @permission('price-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			<div class="menu-icon">
				<a href="{{ url('prices') }}" >
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
			$("#from_location").select2();
			$("#category_id").select2();
			$("#currency_id").select2();

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
							url: "{{ url('prices/ajax/id/edit') }}",
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

			$("#from_country").select2();
			$("#from_state").select2({
				ajax: {
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var countryId = $('#from_country').val();
						return {
							search: params.term,
							countryId: countryId
						};
					},
					processResults: function (data, params) {
						console.log(data)
						return {
							results: data.items
						};
					},
					cache: true
				},
			});

			$("#to_country").select2();
			$("#to_state").select2({
				ajax: {
					url: "{{ url('states/search-state-country') }}",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						var countryId = $('#to_country').val();
						return {
							search: params.term,
							countryId: countryId
						};
					},
					processResults: function (data, params) {
						console.log(data)
						return {
							results: data.items
						};
					},
					cache: true
				},
			});
		});
	</script>
@stop
