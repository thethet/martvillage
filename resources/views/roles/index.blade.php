@extends('layouts.layout')

@section('page-title')
	Roles
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

					<strong>Role Management</strong>
				</li>
			</ol>

			<h2>Role Management</h2>
			<br />

			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title">
						Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries
					</div>

					<div class="panel-options">
						<a href="{{ url('roles/create') }}" class="bg">
							<i class="entypo-plus-circled"></i>
							Create New &nbsp;
						</a>
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
								<th>Name</th>
								<th>Description</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($roles as $key => $role)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $role->name }}</td>
								<td>{{ $role->description }}</td>
								<td>
									@if(Auth::user()->hasRole('administrator') || $role->company_id == Auth::user()->company_id)
										@permission('role-edit')
											<a href="{{ url('roles/'. $role->id .'/edit') }}" class="btn btn-default btn-sm btn-icon icon-left">
												<i class="entypo-pencil"></i>
												Edit
											</a>
										@endpermission

										@permission('role-edit')
											<a href="{{ url('roles/'. $role->id .'/destroy') }}" class="btn btn-danger btn-sm btn-icon icon-left">
												<i class="entypo-cancel"></i>
												Delete
											</a>
										@endpermission

										@permission('role-edit')
											<a href="{{ url('roles/'. $role->id) }}" class="btn btn-info btn-sm btn-icon icon-left">
												<i class="entypo-eye"></i>
												View
											</a>
										@endpermission
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{!! $roles->render() !!}
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
	<script src="{{ asset('assets/js/datatables/datatables.js') }}"></script>
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

@stop

