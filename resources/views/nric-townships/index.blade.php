@extends('layouts.layout')

@section('page-title')
	NRIC Township
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
			<li class="active">
				<strong>NRIC Township Management</strong>
			</li>
		</ol>

		<h2>NRIC Township Management</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries
				</div>

				<div class="panel-options">
					@permission('nric-township-create')
						<a href="{{ url('nric-townships/create') }}" title="Create">
							<i class="entypo-plus-squared"></i>
							New
						</a>
						&nbsp;|&nbsp;
					@endpermission
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body with-table">
				{!! Form::open(array('route' => 'nric-townships.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

					<div class="form-group">
						<label class="col-sm-7  control-label">&nbsp;</label>

						<div class="col-sm-3">
							<div class="input-group minimal">
								<div class="input-group-addon">
									<i class="entypo-search"></i>
								</div>
								{!! Form::select('nric_code_id', ['' => 'Select NRIC Code'] + $nricCodeList->toArray(), null, ['class' => 'form-control select2', 'autocomplete' => 'off']) !!}
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
							<th>Region/State</th>
							<th>Township Name</th>
							<th>Short Name</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($townships as $key => $township)
						<tr>
							<td>{{ ++$i }}</td>
							<td>
								{{ $nricCodeList[$township->nric_code_id] }}
							</td>
							<td>{{ $township->township }}</td>
							<td>{{ $township->short_name }}</td>
							<td>
								<a href="{{ url('nric-townships/'. $township->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								@if(Auth::user()->hasRole('administrator'))
									@permission('nric-township-edit')
										<a href="{{ url('nric-townships/'. $township->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
											<i class="entypo-pencil"></i>
										</a>
									@endpermission

									@permission('nric-township-delete')
										<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $township->id }}" title="Delete">
											<i class="entypo-trash"></i>
										</a>
									@endpermission
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $townships->render() !!}
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
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('nric-townships/"+ id +"') !!}",
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

