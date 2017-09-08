@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/member.png') }}" alt="Member">
	</div>
	<div class="col-md-8 site-header">Member List</div>
@stop

@section('main')
	<div class="main-content">
		{{-- <div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Member Management</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div> --}}<!-- .row -->

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="table-cont">
			<table class="table table-bordered table-responsive">
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Contact No.</th>
					<th>Member No.</th>
					<th>Email</th>
					<th width="20px">Action</th>
				</tr>
				@foreach ($members as $key => $member)
				<tr>
					<td>{{ ++$i }}</td>
					<td>{{ strtoupper($member->name) }}</td>
					<td>{{ $member->contact_no }}</td>
					<td>{{ $member->member_no }}</td>
					<td>{{ $member->email }}</td>
					<td>
						{!! Form::checkbox('edit', $member->id, null, ['class' => 'editboxes']) !!}
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{!! $members->render() !!}
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			@permission('member-create')
				<div class="menu-icon">
					<a href="{{ route('members.create') }}">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('member-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('member-delete')
				<div class="menu-icon">
					<a href="#" id="delete">
						<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
						Delete
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			<div class="menu-icon">
				<a href="{{ url('dashboard') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->
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
							url: "{{ url('members/ajax/id/edit') }}",
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
				$(".editboxes").each(function() {
					if ($(this).is(":checked")) {
						var id = $(this).val();
						$.ajax({
							url: "{!! url('members/"+ id +"') !!}",
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
		});
	</script>
@stop
