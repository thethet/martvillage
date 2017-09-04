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
					{!! Form::checkbox('edit', $user->id, null, ['class' => 'editboxes']) !!}
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

			@permission('user-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('user-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission
		</div>
	</div><!-- .footer-menu -->
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".editboxes").change(function() {
				var $el = $(this);
				if ($el.is(":checked")) {
					$('.editboxes').attr('disabled', true);
					$el.attr("disabled", false);
				}
				else {
					$('.editboxes').attr('disabled', false);
				}
			});

			$("#edit").on("click",function(){
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{{ url('companies/ajax/'"+ id +"'/edit') }}",
							type: 'GET',
							data: { id: id },
							success: function(data)
							{
								window.location.replace(data.url);
							}
						});
					}
				});
			});

			$("#delete").on("click",function(){
				alert('hi')
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();

						$.ajax({
							url: "{!! url('companies/"+ id +"') !!}",
							type: 'DELETE',
							data: {_token: '{!! csrf_token() !!}'},
							dataType: 'JSON',
							success: function (data) {
								alert('hey')
								window.location.replace(data.url);
							}
						});
						// window.location.reload();
					}
				});
			});
		});
	</script>
@stop
