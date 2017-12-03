@extends('layouts.layout')

@section('page-title')
	Permission
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
				<strong>Permission Management</strong>
			</li>
		</ol>

		<h2>Permission Management</h2>
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
					@permission('permission-create')
					<a href="{{ url('permissions/create') }}" class="bg">
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
							<th>Name</th>
							<th>Description</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($permissions as $key => $permission)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $permission->display_name }}</td>
							{{-- <td>{{ $permission->name }}</td> --}}
							<td>{{ $permission->description }}</td>
							<td>
								@if(Auth::user()->hasRole('administrator') || $permission->company_id == Auth::user()->company_id)
									@permission('permission-edit')
									<a href="{{ url('permissions/'. $permission->id .'/edit') }}" class="btn btn-default btn-sm">
										<i class="entypo-pencil"></i>
									</a>
									@endpermission

									@permission('permission-delete')
									<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $permission->id }}">
										<i class="entypo-trash"></i>
									</a>
									@endpermission

									<a href="{{ url('permissions/'. $permission->id) }}" class="btn btn-info btn-sm">
										<i class="entypo-eye"></i>
									</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $permissions->render() !!}
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

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var id = $(this).attr('id');
				$.ajax({
					url: "{!! url('permissions/"+ id +"') !!}",
					type: 'DELETE',
					data: {_token: '{!! csrf_token() !!}'},
					dataType: 'JSON',
					success: function (data) {
						window.location.replace(data.url);
					}
				});

			});
		});
	</script>

@stop

