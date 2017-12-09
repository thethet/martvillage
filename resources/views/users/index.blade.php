@extends('layouts.layout')

@section('page-title')
	User
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong>User Management</strong>
			</li>
		</ol>

		<h2>User Management</h2>
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
					@permission('user-create')
						<a href="{{ url('users/create') }}" title="Create">
							<i class="entypo-plus-squared"></i>
							New
						</a>
						&nbsp;|&nbsp;
					@endpermission
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body with-table">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Role</th>
							<th>Email</th>
							@if(Auth::user()->hasRole('administrator'))
								<th>Company Name</th>
							@endif
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $user)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ strtoupper($user->name) }}</td>
							<td>{{ $user->contact_no }}</td>
							<td>{{ $user->roles[0]->display_name }}</td>
							<td>{{ $user->email }}</td>
							@if(Auth::user()->hasRole('administrator'))
								<td>
									{{ $companyList[$user->company_id] }}
								</td>
							@endif
							<td>
								<a href="{{ url('users/'. $user->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								@if(Auth::user()->hasRole('administrator') || $user->company_id == Auth::user()->company_id)
									@permission('user-edit')
										<a href="{{ url('users/'. $user->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
											<i class="entypo-pencil"></i>
										</a>
									@endpermission

									@if($user->id != Auth::user()->id)
										@permission('user-delete')
											<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $user->id }}" title="Delete">
												<i class="entypo-trash"></i>
											</a>
										@endpermission
									@endif
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $users->render() !!}
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
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('users/"+ id +"') !!}",
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

