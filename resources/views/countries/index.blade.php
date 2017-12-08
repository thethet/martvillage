@extends('layouts.layout')

@section('page-title')
	Country
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3">
			<li>
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('locations') }}">Location</a>
			</li>
			<li class="active">
				<strong>Country Management</strong>
			</li>
		</ol>

		<h2>Country Management</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		@if ($message = Session::get('unsuccess'))
			<div class="alert alert-danger">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		<h4><strong>All Countries List</strong></h4>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $a + 1 }} to @if($allCurrentPage == $allLastPage) {{ $allLastItem }} @else {{ $a + $allPerPage }} @endif of {{ $allTotal }} entries
				</div>

				<div class="panel-options">
					@if(Auth::user()->hasRole('administrator'))
						@permission('country-create')
							<a href="{{ url('countries/create') }}" title="Create">
								<i class="entypo-plus-squared"></i>
								New
							</a>
							&nbsp;|&nbsp;
						@endpermission
					@endif
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body with-table">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Country Name</th>
							<th>Country Code</th>
							<th>Description</th>
							<th>Total State/Cities</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allCountries as $key => $country)
						<tr>
							<td>{{ ++$a }}</td>
							<td>{{ $country->country_name }}</td>
							<td>{{ $country->country_code }}</td>
							<td>{{ $country->description }}</td>
							<td>{{ $country->total_cities }}</td>
							<td>
								<a href="{{ url('countries/'. $country->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								@if(Auth::user()->hasRole('administrator'))
									@permission('country-edit')
										<a href="{{ url('countries/'. $country->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
											<i class="entypo-pencil"></i>
										</a>
									@endpermission

									@if($country->total_cities == 0)
										@permission('country-delete')
											<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $country->id }}" title="Delete">
												<i class="entypo-trash"></i>
											</a>
										@endpermission
									@endif
								@else
									@permission('country-create')
										@if(!in_array($country->id, $countryIdList))
										<a href="{{ url('countries/create-by-company/' . $country->id ) }}" class="btn btn-success btn-sm" title="Add to List">
											<i class="entypo-list-add"></i>
										</a>
										@endif
									@endpermission
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $allCountries->appends(['apage' => $allCountries->currentPage()])->links() !!}
			</div>
		</div>

		@if(!Auth::user()->hasRole('administrator'))
			<br>
			<h4><strong>My Countries List</strong></h4>
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">
						Showing {{ $i + 1 }} to @if($allCurrentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries
					</div>

					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>

				<div class="panel-body with-table">
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th width="5%">SNo.</th>
								<th>Country Name</th>
								<th>Country Code</th>
								<th>Description</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($countries as $key => $country)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $country->country_name }}</td>
								<td>{{ $country->country_code }}</td>
								<td>{{ $country->description }}</td>
								<td>
									<a href="{{ url('countries/'. $country->id) }}" class="btn btn-info btn-sm" title="Detail">
										<i class="entypo-eye"></i>
									</a>

									@permission('country-delete')
										<a href="#" class="btn btn-danger btn-sm destroy-by-company" id="{{ $country->id }}" title="Delete">
											<i class="entypo-trash"></i>
										</a>
									@endpermission
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{!! $countries->render() !!}

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

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('countries/"+ id +"') !!}",
						type: 'DELETE',
						data: {_token: '{!! csrf_token() !!}'},
						dataType: 'JSON',
						success: function (data) {
							window.location.replace(data.url);
						}
					});
				}
			});

			$(".destroy-by-company").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('countries/destroy-by-company/"+ id +"') !!}",
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
	</script>

@stop

