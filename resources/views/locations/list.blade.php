@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Location">
	</div>
	<div class="col-md-8 site-header">Location List</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			<div class="col-lg-3 pad0 bdr m030">
				<div class="table-cont country-tbl">
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th colspan="2" class="center">All Country List</th>
							</tr>

							<tr>
								<th width="10px">
									{{-- {!! Form::checkbox('all_country_edit', null, null, ['id' => 'all-country-editboxes']) !!} --}}
								</th>
								<th>Country Name</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($countries as $key => $country)
								<tr>
									<td>
										{!! Form::checkbox('country_edit', $country->id, null, ['class' => 'country-editboxes']) !!}
									</td>
									<td>{{ $country->country_name }} ({{ $country->country_code }})</td>
								</tr>
							@endforeach

							@if(count($countries) <= 0)
								@for($i = 0; $i < 5; $i++)
									<tr>
										<td width="8px">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
								@endfor
							@endif
						</tbody>
					</table>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="name">
					</label>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4">
						<a href="#" id="store">
							<div class="addbtn">
								<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
									Add
							</div>
						</a>
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="name">
					</label>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4">
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="name">
					</label>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4">
					</div>
				</div><!-- .form-group -->
			</div>

			@if($countriesLists)
			<div class="col-lg-8 pad0 bdr">
				<div class="table-cont country-tbl">
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th colspan="{{ (count($countriesLists) * 2) }}" class="center">
									All City List
								</th>
							</tr>
							<tr>
								@foreach($countriesLists as $clist)
									<th width="8px">&nbsp;&nbsp;&nbsp;</th>
									<th>{{ $clist->country_name }} ({{ $clist->country_code }})</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach($citiesLists as $cities)
								<tr>
									@foreach($countriesLists as $countlist)
										@if(array_key_exists($countlist->country_name, $cities))
										<td>
											{!! Form::checkbox('city_edit', $cities[$countlist->country_name]['id'], null, ['class' => 'city-editboxes']) !!}
										</td>
										<td>
											{{ $cities[$countlist->country_name]['state_name'] }} ({{ $cities[$countlist->country_name]['state_code'] }})
										</td>
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

				<div class="form-group">
					<label class="control-label col-sm-3" for="name">
					</label>
					<div class="col-sm-7">
					</div>
					<div class="col-sm-2">
						<a href="#" id="city-store">
							<div class="addbtn">
								<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
									Add
							</div>
						</a>
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="name">
					</label>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4">
					</div>
				</div><!-- .form-group -->

				<div class="form-group">
					<label class="control-label col-sm-3" for="name">
					</label>
					<div class="col-sm-4">
					</div>
					<div class="col-sm-4">
					</div>
				</div><!-- .form-group -->
			</div>
			@endif
		</div>

		@if(count($myCitiesLists) > 0)
			<div class="row country-city">
				<div class="table-cont country-city-tbl">
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th colspan="{{ (count($mycountriesLists) * 2) }}" class="center">
									My Country and City
								</th>
							</tr>
							<tr>
								@foreach($mycountriesLists as $myclist)
									<th width="8px">&nbsp;&nbsp;&nbsp;</th>
									<th>{{ $myclist->country_name }} ({{ $myclist->country_code }})</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach($myCitiesLists as $mycities)
								<tr>
									@foreach($mycountriesLists as $mcountlist)
										@if(array_key_exists($mcountlist->country_name, $mycities))
										<td>
											{!! Form::checkbox('edit', $mycities[$mcountlist->country_name]['id'], null, ['class' => 'editboxes']) !!}
										</td>
										<td>
											{{ $mycities[$mcountlist->country_name]['state_name'] }} ({{ $mycities[$mcountlist->country_name]['state_code'] }})
										</td>
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

			{{-- @permission('location-create')
				<div class="menu-icon">
					<a href="{{ route('locations.create') }}">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			{{-- @permission('location-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			@permission('location-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="{{ url('settings') }}" >
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

			$("#all-country-editboxes").change(function(){
				if($(this).is(':checked')){
					$("input:checkbox[class=country-editboxes]").each(function() {
						$(this).attr('checked', true);
					});
				}else{
					$("input:checkbox[class=country-editboxes]").each(function() {
						$(this).attr('checked', false);
					});
				}
			});


			$("#store").on("click",function(){
				var countryIds = [];
				$(".country-editboxes:checked").each(function(i) {
					countryIds[i] = $(this).val();
				});

				$.ajax({
					url: "{{ url('locations/ajax/id/custom-country') }}",
					type: 'GET',
					data: {
						countryIds: countryIds,
						mode: 'add'
					},
					success: function(data)
					{
						window.location.replace(data.url);
					}
				});
			});

			$("#city-store").on("click",function(){
				var stateIds = [];
				$(".city-editboxes:checked").each(function(i) {
					stateIds[i] = $(this).val();
				});

				$.ajax({
					url: "{{ url('locations/ajax/id/custom-city') }}",
					type: 'GET',
					data: {
						stateIds: stateIds,
						mode: 'add'
					},
					success: function(data)
					{
						window.location.replace(data.url);
					}
				});
			});

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
