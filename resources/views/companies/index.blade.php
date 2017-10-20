@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/company.png') }}" alt="Company">
	</div>
	<div class="col-md-8 site-header">Company List</div>
@stop

@section('main')
	<div class="main-content">
		<!-- <div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Company Management</h3>
				</div>
				<div class="pull-right">
				</div>
			</div>
		</div>.row -->

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="table-cont">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>No</th>
						<th>Company Name</th>
						<th>Email</th>
						<th>Contact No.</th>
						<th>Address</th>
						<th>Expiry Date</th>
						<th width="20px">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($companies as $key => $company)
					<tr>
						<td>{{ ++$i }}</td>
						<td>{{ strtoupper($company->company_name) }}</td>
						<td>{{ $company->email }}</td>
						<td>{{ $company->contact_no }}</td>
						<td>{{ $company->address }}</td>
						<td>{{ $company->expiry_date }}</td>
						<td>
							{!! Form::checkbox('edit', $company->id, null, ['class' => 'editboxes']) !!}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{!! $companies->render() !!}
	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			@permission('company-create')
				@if(Auth::user()->hasRole('administrator'))
					<div class="menu-icon">
						<a href="{{ route('companies.create') }}">
							<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
							New
						</a>
					</div><!-- .menu-icon -->
				@endif
			@endpermission

			@permission('company-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission

			@permission('company-delete')
				@if(Auth::user()->hasRole('administrator'))
					<div class="menu-icon">
						<a href="#" id="delete">
							<img src="{{ asset('assets/img/trash-icon.png') }}" alt="Delete">
							Delete
						</a>
					</div><!-- .menu-icon -->
				@endif
			@endpermission

			<div class="menu-icon">
				<a href="{{ url('settings') }}" >
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
							url: "{{ url('companies/ajax/id/edit') }}",
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
				var x = confirm("Are you sure you want to delete?");
				if(x) {
					$(".editboxes").each(function() {
						if ($(this).is(":checked")) {
							var id = $(this).val();
							$.ajax({
								url: "{!! url('companies/"+ id +"') !!}",
								type: 'DELETE',
								data: {_token: '{!! csrf_token() !!}'},
								dataType: 'JSON',
								success: function (data) {
									window.location.replace(data.url);
								}
							});
						}
					});
				} else {
					window.location.reload();
					$('.editboxes').attr('checked', false);
				}
			});
		});
	</script>
@stop
