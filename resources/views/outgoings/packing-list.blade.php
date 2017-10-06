@extends('layouts.layout')

@section('site-title')
	<div class="col-md-4 site-icon">
		<img class="profile-icon" src="{{ asset('assets/img/outgoing.png') }}" alt="Outgoing">
	</div>
	<div class="col-md-8 site-header">Outgoing</div>
@stop

@section('main')
	<div class="main-content">

		@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif

		<div class="row">
			<div class="col-lg-6">
				<div class="col-sm-12 bdr">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="control-label col-sm-4">
								Passenger Name:
							</div>
							<div class="control-label col-sm-7">
								{{ $outgoing->passenger_name }}
							</div>
						</div><!-- .form-group -->

						<div class="form-group">
							<div class="col-sm-4">
								Phone:
							</div>
							<div class="col-sm-7">
								{{ $outgoing->contact_no }}
							</div>
						</div><!-- .form-group -->

						<div class="form-group">
							<div class="col-sm-4">
								From ~ To:
							</div>
							<div class="col-sm-7">
								{{ $outgoing->fromCity->state_name }} ~ {{ $outgoing->toCity->state_name }}
							</div>
						</div><!-- .form-group -->

						<div class="form-group">
							<div class="col-sm-4">
								Weight:
							</div>
							<div class="col-sm-7">
								{{ $outgoing->weight }}
							</div>
						</div><!-- .form-group -->

						<div class="form-group">
							<div class="col-sm-4">
								Quantity:
							</div>
							<div class="col-sm-7">
								{{ $outgoing->packing_list }} pcs
							</div>
						</div><!-- .form-group -->
					</div><!-- .form-horizontal -->
				</div>
			</div>

			<div class="col-lg-6">
				<div class="col-sm-12 bdr">
					<div class="form-horizontal">
						<div class="packing-list-group" id="accordion">
							<?php
								$start = date("Y-m-d", strtotime($outgoing->dept_date . "-30 day"));
							?>
							@for($k = 0; $k < 31; $k++)
							<?php
								$startDate = date("Y-m-d", strtotime($start . "+" . $k . " day"));
							?>
							@if(array_key_exists($startDate, $lotinList))
							<?php $lotins = $lotinList[$startDate]; ?>
							<div class="packing-list">
								<div class="packing-header">
									<h5 class="packing-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $k }}" class="collapsed">
											&nbsp;&nbsp;&nbsp;{{ date('d M Y', strtotime($startDate)) }}
										</a>
									</h5>
								</div>
								<div id="collapse{{ $k }}" class="panel-collapse collapse" >
									<div class="table-cont">
										<table class="table table-bordered table-responsive">
											<thead>
												<tr>
													<th></th>
													<th>Lot No.</th>
													<th>Unit(kg/ft<sup>3</sup>)</th>
													<th>Split</th>
												</tr>
											</thead>
											<tbody>
												@foreach($lotins as $lotin)
												<tr>
													<td>
														{!! Form::checkbox('topack', $lotin->id, null, ['class' => 'topack']) !!}
													</td>
													<td>{{ $lotin->lot_no }}</td>
													<td>3kg</td>
													<td>0</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
							@endif
							@endfor
						</div>

						<div class="form-group">
							<div class="col-sm-3">
								<a href="#" id="gopack">
									<div class="addbtn">
										{{-- <img src="{{ asset('assets/img/new-icon.png') }}" alt="Add"> --}}
											<<&nbsp;&nbsp;Pack
									</div>
								</a>
							</div>
						</div><!-- .form-group -->

						</div>

				</div>
			</div>
		</div>


	</div><!-- .main-content -->

	<div class="footer-menu">
		<div class="footer-content">
			<div class="menu-icon">
				<a href="{{ url('/dashboard') }}">
					<img src="{{ asset('assets/img/home-icon.jpeg') }}" alt="Go Home">
					Home
				</a>
			</div><!-- .menu-icon -->

			{{-- @permission('lotin-create')
				<div class="menu-icon">
					<a href="#" id="add-item">
						<img src="{{ asset('assets/img/new-icon.png') }}" alt="Add">
						New
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			{{-- @permission('lotin-edit')
				<div class="menu-icon">
					<a href="#" id="edit">
						<img src="{{ asset('assets/img/edit-icon.png') }}" alt="Edit">
						Edit
					</a>
				</div><!-- .menu-icon -->
			@endpermission --}}

			<div class="menu-icon">
				<a href="#" id="delete">
					<img src="{{ asset('assets/img/reset.png') }}" alt="Reset">
					Reset
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="{{ url('outgoings') }}" >
					<img src="{{ asset('assets/img/go-back.png') }}" alt="Back">
					Back
				</a>
			</div><!-- .menu-icon -->

			<div class="menu-icon">
				<a href="#" id="add" onclick="document.getElementById('lotin-form').submit();">
					<img src="{{ asset('assets/img/save-and-close.png') }}" alt="Save">
					Save&Exit
				</a>
			</div><!-- .menu-icon -->
		</div>
	</div><!-- .footer-menu -->
@stop

@section('my-script')
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.js') }}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"/>

	<script>
		$(document).ready(function(){
		});
	</script>
@stop
