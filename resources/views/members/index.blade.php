@extends('layouts.layout')

@section('page-title')
	Member
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong>Member Management</strong>
			</li>
		</ol>

		<h2>Member Management</h2>
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
					@permission('member-create')
						<a href="{{ url('members/create') }}">
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
							<th>Member No</th>
							<th>Email</th>
							<th>Discount Type</th>
							<th>Contact</th>
							<th>Address</th>
							@if(Auth::user()->hasRole('administrator'))
							<th>Company Name</th>
							@endif
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($members as $key => $member)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ strtoupper($member->name) }}</td>
							<td>{{ $member->member_no }}</td>
							<td>{{ $member->email }}</td>
							<td>{{ $offerList[$member->member_offers_id] }}</td>
							<td>{{ $member->contact_no }}</td>
							<td>{{ $member->address }}</td>
							@if(Auth::user()->hasRole('administrator'))
								<td>
									{{ $companyList[$member->company_id] }}
								</td>
							@endif
							<td>
								<a href="{{ url('members/'. $member->id) }}" class="btn btn-info btn-sm">
									<i class="entypo-eye"></i>
								</a>

								@if(Auth::user()->hasRole('administrator') || $member->company_id == Auth::user()->company_id)
									@permission('member-edit')
									<a href="{{ url('members/'. $member->id .'/edit') }}" class="btn btn-success btn-sm">
										<i class="entypo-pencil"></i>
									</a>
									@endpermission

									@permission('member-delete')
									<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $member->id }}">
										<i class="entypo-trash"></i>
									</a>
									@endpermission
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $members->render() !!}
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
	</script>
@stop

