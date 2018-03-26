@extends('layouts.layout')

@section('page-title')
	Collection
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('collections') }}">Collection Management</a>
			</li>
			<li class="active">
				<strong>Item List for Return to Head Office</strong>
			</li>
		</ol>

		<h2>Item List for Return to Head Office</h2>
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
					@permission('lotin-create')
						<a href="{{ url('collections') }}">
							<i class="entypo-cancel"></i>
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
							<th>Lot No.</th>
							<th>Sender Name</th>
							<th>Sender Contact No.</th>
							<th>Member No.</th>
							<th>Reciever Name</th>
							<th>Receiver Contact No.</th>
							<th>From - To</th>
							<th>Delivery Date</th>
							<th>Landed Date</th>
							@if(Auth::user()->hasRole('administrator'))
							<th>Company Name</th>
							@endif
							<th width="5%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotins as $key => $lotin)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $lotin->lot_no }}</td>
							<td>{{ $lotin->sender_name }}</td>
							<td>{{ $lotin->sender_contact }}</td>
							<td>{{ $lotin->member_no }}</td>
							<td>{{ $lotin->receiver_name }}</td>
							<td>{{ $lotin->receiver_contact }}</td>
							<td>
								{{ $stateList[$lotin->from_state] }} <=> {{ $stateList[$lotin->to_state] }}
							</td>
							<td>{{ $lotin->date }}</td>
							<td>{{ $lotin->incoming_date }}</td>
							@if(Auth::user()->hasRole('administrator'))
								<td>
									{{ $companyList[$lotin->company_id] }}
								</td>
							@endif
							<td>
								<a href="{{ url('trackings/' . $lotin->id) }}" class="btn btn-info btn-sm">
									<i class="entypo-eye"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $lotins->render() !!}
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
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2-bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/js/select2/select2.css') }}">

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script src="{{ asset('assets/js/neon-chat.js') }}"></script>

	<script>
		$(document).ready(function(){
			$(".destroy").on("click", function(event){
				var confD = confirm('Are you sure to delete?');
				if (confD) {
					var id = $(this).attr('id');
					$.ajax({
						url: "{!! url('lotins/"+ id +"') !!}",
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

