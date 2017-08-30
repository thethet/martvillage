@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Role Management</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div>
		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif
		<table class="table table-bordered">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Description</th>
				<th width="280px">Action</th>
			</tr>
			@foreach ($roles as $key => $role)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ $role->display_name }}</td>
				<td>{{ $role->description }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
					@permission('role-edit')
					<a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
					@endpermission
					@permission('role-delete')
					{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
					@endpermission
				</td>
			</tr>
			@endforeach
		</table>
		{!! $roles->render() !!}
	</div>

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				@permission('role-create')
					<a href="{{ route('roles.create') }}">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				@endpermission
			</div>
		</div>
	</div>
@stop
