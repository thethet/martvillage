@extends('layouts.layout')

@section('page-title')
	State/City
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
				<strong>State/City Management</strong>
			</li>
		</ol>

		<h2>State/City Management</h2>
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

		<h4><strong>All States/Cities List</strong></h4>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $a + 1 }} to @if($allCurrentPage == $allLastPage) {{ $allLastItem }} @else {{ $a + $allPerPage }} @endif of {{ $allTotal }} entries
				</div>

				<div class="panel-options">
					@if(Auth::user()->hasRole('administrator'))
						@permission('state-create')
							<a href="{{ url('states/create') }}" title="Create">
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
				{!! Form::open(array('route' => 'states.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

					<div class="form-group">
						<label class="col-sm-7  control-label">&nbsp;</label>

						<div class="col-sm-3">
							<div class="input-group minimal">
								<div class="input-group-addon">
									<i class="entypo-search"></i>
								</div>
								{!! Form::select('all_country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'all_country_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
							</div>
						</div>

						<div class="col-sm-2">
							<div class="input-group minimal">
								<button type="submit" class="btn btn-blue btn-icon">
									Search
									<i class="entypo-search"></i>
								</button>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
				<br>

				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>State/City Name</th>
							<th>State/City Code</th>
							<th>Description</th>
							<th>Total Townships</th>
							<th>Country</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allStates as $key => $state)
						<tr>
							<td>{{ ++$a }}</td>
							<td>{{ $state->state_name }}</td>
							<td>{{ $state->state_code }}</td>
							<td>{{ $state->description }}</td>
							<td>{{ $state->total_townships }}</td>
							<td>{{ $countries[$state->country_id] }}</td>
							<td>
								<a href="{{ url('states/'. $state->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								@if(Auth::user()->hasRole('administrator'))
									@permission('state-edit')
										<a href="{{ url('states/'. $state->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
											<i class="entypo-pencil"></i>
										</a>
									@endpermission

									@if($state->total_townships == 0)
										@permission('state-delete')
											<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $state->id }}" title="Delete">
												<i class="entypo-trash"></i>
											</a>
										@endpermission
									@endif
								@else
									@permission('state-create')
										@if((!in_array($state->id, $stateIdList)) && in_array($state->country_id, $countryIdList))
										<a href="{{ url('states/create-by-company/' . $state->id ) }}" class="btn btn-success btn-sm" title="Add to List">
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

				{!! $allStates->appends(['apage' => $allStates->currentPage()])->links() !!}
			</div>
		</div>

		@if(!Auth::user()->hasRole('administrator'))
			<br>
			<h4><strong>My States/Cities List</strong></h4>
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">
						Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries
					</div>

					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					</div>
				</div>

				<div class="panel-body with-table">
					{!! Form::open(array('route' => 'states.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

					<div class="form-group">
						<label class="col-sm-8  control-label">&nbsp;</label>

						<div class="col-sm-2">
							<div class="input-group minimal">
								<div class="input-group-addon">
									<i class="entypo-search"></i>
								</div>
								{!! Form::select('country_id', ['' => 'Select Country'] + $countries->toArray(), null, ['id'=>'country_id', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
							</div>
						</div>

						<div class="col-sm-2">
							<div class="input-group minimal">
								<button type="submit" class="btn btn-blue btn-icon">
									Search
									<i class="entypo-search"></i>
								</button>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
				<br>

					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th width="5%">SNo.</th>
								<th>State/City Name</th>
								<th>State/City Code</th>
								<th>Description</th>
								<th>Country</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($states as $key => $state)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $state->state_name }}</td>
								<td>{{ $state->state_code }}</td>
								<td>{{ $state->description }}</td>
								<td>{{ $countries[$state->country_id] }}</td>
								<td>
									<a href="{{ url('states/'. $state->id) }}" class="btn btn-info btn-sm" title="Detail">
										<i class="entypo-eye"></i>
									</a>

									@permission('state-delete')
										<a href="#" class="btn btn-danger btn-sm destroy-by-company" id="{{ $state->id }}" title="Delete">
											<i class="entypo-trash"></i>
										</a>
									@endpermission
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{!! $states->render() !!}
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
						url: "{!! url('states/"+ id +"') !!}",
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
						url: "{!! url('states/destroy-by-company/"+ id +"') !!}",
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

