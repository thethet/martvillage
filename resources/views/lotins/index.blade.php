@extends('layouts.layout')

@section('page-title')
	Lotin
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
				<strong>Lotin Management</strong>
			</li>
		</ol>

		<h2>Lotin Management</h2>
		<br />

		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<strong>Well done!</strong> {{ $message }}
			</div>
		@endif

		{!! Form::open(array('route' => 'lotins.index','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-groups-bordered validate')) !!}

			<div class="form-group">
				<label class="col-sm-1 control-label">Lotin Date</label>
				<div class="col-sm-2">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
						</div>
						{!! Form::text('date', $date, ['placeholder' => 'Lotin Date','class' => 'form-control datepicker', 'id' => 'arrival_date', 'data-format' => 'yyyy-mm-dd', 'data-end-date' => '+1day', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				@if (Auth::user()->hasRole('administrator') || Auth::user()->hasRole('owner'))
				<label class="col-sm-2 control-label">From Location</label>

				<div class="col-sm-2">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-location"></i>
						</div>
						{!! Form::select('from_state', ['' => 'Select From Location'] + $stateList->toArray(), null, ['class' => 'select2', 'autocomplete' => 'off']) !!}
					</div>
				</div>
				@endif

				<label class="col-sm-1 control-label">To Location</label>
				<div class="col-sm-2">
					<div class="input-group minimal">
						<div class="input-group-addon">
							<i class="entypo-location"></i>
						</div>
						{!! Form::select('to_state', ['' => 'Select To Location'] + $stateList->toArray(), null, ['class' => 'select2', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="col-sm-1">
					<div class="input-group minimal">
						<button type="submit" class="btn btn-blue btn-icon">
							Search
							<i class="entypo-search"></i>
						</button>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
		<br />

		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Showing {{ $i + 1 }} to @if($currentPage == $lastPage) {{ $lastItem }} @else {{ $i + $perPage }} @endif of {{ $total }} entries
				</div>

				<div class="panel-options">
					@permission('lotin-create')
						<a href="{{ url('lotins/create') }}">
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
							<th>Lot No.</th>
							<th>Sender Name</th>
							<th>Sender Contact No.</th>
							<th>Member No.</th>
							<th>Reciever Name</th>
							<th>Receiver Contact No.</th>
							<th>From - To</th>
							@if(Auth::user()->hasRole('administrator'))
							<th>Company Name</th>
							@endif
							<th>
								Staff Name
							</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($lotinData as $key => $lotin)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $lotin->lot_no }}</td>

							<td>
								@if($lotin->getSender)
								{{ $lotin->getSender->name }}
								@endif
							</td>

							<td>
								@if($lotin->getSender)
								{{ $lotin->getSender->contact_no }}
								@endif
							</td>
							<td>
								@if($lotin->getSender)
								{{ $lotin->getSender->member_no }}
								@endif
							</td>
							<td>
								@if($lotin->getReceiver)
								{{ $lotin->getReceiver->name }}
								@endif
							</td>
							<td>
								@if($lotin->getReceiver)
								{{ $lotin->getReceiver->contact_no }}
								@endif
							</td>
							<td>
								@if($lotin->fromCity)
								{{ $lotin->fromCity->state_code }}
								@endif

								{{ ' <=> ' }}

								@if($lotin->toCity)
								{{ $lotin->toCity->state_code }}
								@endif
							</td>
							@if(Auth::user()->hasRole('administrator'))
								<td>
									@if($lotin->getCompany)
									{{ $lotin->getCompany->company_name }}
									@endif
								</td>
							@endif
							<td>
								@if($lotin->getUser)
								{{ $lotin->getUser->name }}
								@endif
							</td>
							<td>
								<a href="{{ url('lotins/'. $lotin->id) }}" class="btn btn-info btn-sm">
									<i class="entypo-eye"></i>
								</a>

								@if((Auth::user()->hasRole('administrator') || $lotin->company_id == Auth::user()->company_id) && ($lotin->outgoing_date == '0000-00-00'))
									@permission('lotin-edit')
									<a href="{{ url('lotins/'. $lotin->id .'/edit') }}" class="btn btn-success btn-sm">
										<i class="entypo-pencil"></i>
									</a>
									@endpermission

									{{-- @permission('lotin-delete')
									<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $lotin->id }}">
										<i class="entypo-trash"></i>
									</a>
									@endpermission --}}
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $lotinData->render() !!}
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
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
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

