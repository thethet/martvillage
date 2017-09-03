@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>User Management</h3>
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

		<table class="table table-bordered table-responsive">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Contact No.</th>
				<th>Role</th>
				<th>Email</th>
				<th width="280px">Action</th>
			</tr>
			@foreach ($users as $key => $user)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ strtoupper($user->name) }}</td>
				<td>{{ $user->contact_no }}</td>
				<td>{{ $user->roles[0]->display_name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
					@permission('user-edit')
					<a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
					@endpermission
					@permission('user-delete')
					{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
					@endpermission
				</td>
			</tr>
			@endforeach
		</table>
		{!! $users->render() !!}
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			@permission('user-create')
				<div class="menu-icon">
						<a href="{{ route('users.create') }}">
							<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
							New
						</a>
				</div><!-- .menu-icon -->
			@endpermission
		</div>
	</div><!-- .footer-menu -->
@stop
