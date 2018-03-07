@extends('layouts.layout')

@section('page-title')
	Township
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3">
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('locations') }}">Location</a>
			</li>
			<li class="active">
				<strong>Township Management</strong>
			</li>
		</ol>

		<h2>Township Management</h2>
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

		<h4><strong>All Townships List</strong></h4>
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $a + 1 }} to @if($allCurrentPage == $allLastPage) {{ $allLastItem }} @else {{ $a + $allPerPage }} @endif of {{ $allTotal }} entries
				</div>

				<div class="panel-options">
					@if(Auth::user()->hasRole('administrator'))
						@permission('township-create')
							<a href="{{ url('townships/create') }}" title="Create">
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
				{!! Form::open(array('route' => 'townships.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

					<div class="form-group">
						<label class="col-sm-7  control-label">&nbsp;</label>

						<div class="col-sm-3">
							<div class="input-group minimal">
								<div class="input-group-addon">
									<i class="entypo-search"></i>
								</div>
								{!! Form::select('all_state_id', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'all_state_id', 'class' => 'select2', 'autocomplete' => 'off']) !!}
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
							<th>Township Name</th>
							<th>Township Code</th>
							<th>Description</th>
							<th>State/City</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allTownships as $key => $township)
						<tr>
							<td>{{ ++$a }}</td>
							<td>{{ $township->township_name }}</td>
							<td>{{ $township->code }}</td>
							<td>{{ $township->description }}</td>
							<td>{{ $stateList[$township->state_id] }}</td>
							<td>
								<a href="{{ url('townships/'. $township->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								@if(Auth::user()->hasRole('administrator'))
									@permission('township-edit')
										<a href="{{ url('townships/'. $township->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
											<i class="entypo-pencil"></i>
										</a>
									@endpermission

									@permission('township-delete')
										<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $township->id }}" title="Delete">
											<i class="entypo-trash"></i>
										</a>
									@endpermission
								@else
									@permission('township-create')
										@if((!in_array($township->id, $townshipIdList)) && in_array($township->state_id, $stateIdList))
										<a href="{{ url('townships/create-by-company/' . $township->id ) }}" class="btn btn-success btn-sm" title="Add to List">
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
				{!! $allTownships->appends(['apage' => $allTownships->currentPage()])->links() !!}
			</div>
		</div>

		@if(!Auth::user()->hasRole('administrator'))
			<br>
			<h4><strong>My Township List</strong></h4>
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
					{!! Form::open(array('route' => 'townships.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

					<div class="form-group">
						<label class="col-sm-7  control-label">&nbsp;</label>

						<div class="col-sm-3">
							<div class="input-group minimal">
								<div class="input-group-addon">
									<i class="entypo-search"></i>
								</div>
								{!! Form::select('state_id', ['' => 'Select State'] + $stateList->toArray(), null, ['id'=>'state_id', 'class' => 'select2', 'autocomplete' => 'off']) !!}
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
								<th>Township Name</th>
								<th>Township Code</th>
								<th>Description</th>
								<th>State/City</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($townships as $key => $township)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $township->township_name }}</td>
								<td>{{ $township->code }}</td>
								<td>{{ $township->description }}</td>
								<td>{{ $stateList[$township->state_id] }}</td>
								<td>
									<a href="{{ url('townships/'. $township->id) }}" class="btn btn-info btn-sm" title="Detail">
										<i class="entypo-eye"></i>
									</a>

									@permission('township-delete')
										<a href="#" class="btn btn-danger btn-sm destroy-by-company" id="{{ $township->id }}" title="Delete">
											<i class="entypo-trash"></i>
										</a>
									@endpermission
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{!! $townships->render() !!}
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
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
			if (is_string($value)) {
				return trim($value);
			} else {
				return $value;
			}
		}, $request->all()));
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('townships/"+ id +"') !!}",
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
						url: "{!! url('townships/destroy-by-company/"+ id +"') !!}",
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

