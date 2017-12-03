@extends('layouts.layout')

@section('page-title')
	Location
@stop

@section('main')
	<div class="main-content">

			@include('layouts.headerbar')
			<hr />

			<ol class="breadcrumb bc-3" >
				<li>
					<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
				</li>
				<li>
					<a href="{{ url('settings') }}">Settings</a>
				</li>
				<li class="active">
					<strong>Location Management</strong>
				</li>
			</ol>

			<h2>Location Management</h2>
			<br />

			<h4><strong>Country Management</strong></h4>
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">
						<strong>Country List</strong>
					</div>

					<div class="panel-options">
						@permission('permission-create')
						<a href="{{ url('countries/create') }}" class="bg">
							<i class="entypo-plus-circled"></i>
							Create New &nbsp;
						</a>
						@endpermission
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
						{{-- <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> --}}
						{{-- <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> --}}
					</div>
				</div>

				<div class="panel-body with-table">
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th width="5%">SNo.</th>
								<th>Country Name</th>
								<th>Number of City</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($countries as $key => $country)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $country->country_name }} ({{ $country->country_code }})</td>
								<td>{{ $country->total_cities }}</td>
								<td>
									@if(Auth::user()->hasRole('administrator') || $country->company_id == Auth::user()->company_id)

										<a href="{{ url('countries/'. $country->id .'/edit') }}" class="btn btn-default btn-sm">
											<i class="entypo-pencil"></i>
										</a>

										<a href="{{ url('countries/'. $country->id .'/destroy') }}" class="btn btn-danger btn-sm">
											<i class="entypo-trash"></i>
										</a>

										<a href="{{ url('countries/'. $country->id) }}" class="btn btn-info btn-sm">
											<i class="entypo-eye"></i>
										</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{!! $countries->render() !!}
				</div>
			</div>

			@if(count($citiesLists) > 0)
				<br>
				<h4><strong>City Management</strong></h4>
				<div class="panel panel-primary" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">
							<strong>City List</strong>
						</div>

						<div class="panel-options">
							@permission('permission-create')
							<a href="{{ url('countries/create') }}" class="bg">
								<i class="entypo-plus-circled"></i>
								Create New &nbsp;
							</a>
							@endpermission
							<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
							{{-- <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a> --}}
							{{-- <a href="#" data-rel="close"><i class="entypo-cancel"></i></a> --}}
						</div>
					</div>

					<div class="panel-body with-table">
						<table class="table table-bordered responsive">
							<thead>
								<tr>
									@foreach($countriesLists as $clist)
									<th width="5%">SNo.</th>
									<th>{{ $clist->country_name }} ({{ $clist->country_code }})</th>
									<th width="3%">Action</th>
									@endforeach
								</tr>
							</thead>
							<tbody>
									<?php $k = 0; ?>
								@foreach($citiesLists as $cities)
									<tr>
										@foreach($countriesLists as $countlist)
											<?php $j = 1; ?>
											@if(array_key_exists($countlist->country_name, $cities))
												<td>{{ $k + $j }}</td>
												<td>
													{{ $cities[$countlist->country_name]['state_name'] }} ({{ $cities[$countlist->country_name]['state_code'] }})
												</td>
												<td>
													@if(Auth::user()->hasRole('administrator') || $country->company_id == Auth::user()->company_id)

														<a href="{{ url('countries/'. $cities[$countlist->country_name]['id'] .'/edit') }}">
															<i class="entypo-pencil"></i>
														</a>

														<a href="{{ url('countries/'. $cities[$countlist->country_name]['id'] .'/destroy') }}">
															<i class="entypo-trash"></i>
														</a>

														<a href="{{ url('countries/'. $cities[$countlist->country_name]['id']) }}">
															<i class="entypo-eye"></i>
														</a>
													@endif
												</td>
											@else
												<td></td>
												<td></td>
												<td></td>
											@endif
										@endforeach
									</tr>
									<?php $k++; ?>
								@endforeach
							</tbody>
						</table>

						{{-- {!! $countries->render() !!} --}}
					</div>
				</div>
			@endif


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
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

@stop

