@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h3>Company Management</h3>
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
				<th>Company Name</th>
				<th>Email</th>
				<th>Contact No.</th>
				<th>Address</th>
				<th>Expiry Date</th>
				<th width="280px">Action</th>
			</tr>
			@foreach ($companies as $key => $company)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ strtoupper($company->company_name) }}</td>
				<td>{{ $company->email }}</td>
				<td>{{ $company->contact_no }}</td>
				<td>{{ $company->address }}</td>
				<td>{{ $company->expiry_date }}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('companies.show',$company->id) }}">Show</a>
					@permission('company-edit')
					<a class="btn btn-primary btn-sm" href="{{ route('companies.edit',$company->id) }}">Edit</a>
					@endpermission
					@permission('company-delete')
					{!! Form::open(['method' => 'DELETE','route' => ['companies.destroy', $company->id],'style'=>'display:inline']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
					@endpermission
				</td>
			</tr>
			@endforeach
		</table>
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
				<div class="menu-icon">
						<a href="{{ route('companies.create') }}">
							<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
							New
						</a>
				</div><!-- .menu-icon -->
			@endpermission
		</div>
	</div><!-- .footer-menu -->
@stop
