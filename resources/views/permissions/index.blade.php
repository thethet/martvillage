@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Permission Management</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div><!-- .row -->

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
			@foreach ($permissions as $key => $permission)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ $permission->display_name }}</td>
				<td>{{ $permission->description }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('permissions.show',$permission->id) }}">Show</a>
					@permission('permission-edit')
					<a class="btn btn-primary btn-sm" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
					@endpermission
					@permission('permission-delete')
					{!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
					@endpermission
				</td>
			</tr>
			@endforeach
		</table>
		{!! $permissions->render() !!}
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			@permission('permission-create')
				<div class="menu-icon">
						<a href="{{ route('permissions.create') }}">
							<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
							New
						</a>
				</div><!-- .menu-icon -->
			@endpermission
		</div>
	</div><!-- .footer-menu -->
@stop
