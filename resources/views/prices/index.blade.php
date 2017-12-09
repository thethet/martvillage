@extends('layouts.layout')

@section('page-title')
	Price
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3">
			<li>
				<a href="{{ url('dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('pricing-setup') }}">Pricing Setup</a>
			</li>
			<li class="active">
				<strong>Price Management</strong>
			</li>
		</ol>

		<h2>Price Management</h2>
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
					@permission('price-create')
						<a href="{{ url('prices/create') }}" title="Create">
							<i class="entypo-plus-squared"></i>
							New
						</a>
						&nbsp;|&nbsp;
					@endpermission
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body with-table">
				<div class="table-cont">
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th width="5%"></th>
								<th></th>
								@foreach($currencyTitleList as $title)
									<th colspan="{{ $title['total_sub_title'] * 2 }}" class="center">
										{{ $title['type'] }}
										<br>
										From {{ $title['country'] }}
									</th>
								@endforeach
							</tr>
							<tr>
								<th width="5%">SNo.</th>
								<th>Price Title</th>
								@foreach($currencyTitleList as $title)
									@if(array_key_exists($title['country'], $subTitleList))
										@foreach($subTitleList[$title['country']] as $sub)
											<th width="10%">{{ $sub }}</th>
											<th width="13%">Action</th>
										@endforeach
									@else
										<th width="10%">&nbsp;</th>
										<th width="13%">Action</th>
									@endif
								@endforeach
							</tr>
						</thead>
						<tbody>
							<?php $j = $i; ?>
							@foreach($priceLists as $key => $prices)
								<tr>
									<td>{{ ++$j }}</td>
									<td width="240px">
										{{ $key }}
									</td>
									@foreach($currencyTitleList as $title)
										@if(array_key_exists($title['country'], $subTitleList))
											@foreach($subTitleList[$title['country']] as $sub)
												<td>
													@if(array_key_exists($title['country'], $prices))
														@if(array_key_exists($sub, $prices[$title['country']]))
															@if($prices[$title['country']][$sub]['id'] != 0)
																{{ number_format($prices[$title['country']][$sub]['unit_price'], 2) }}
															@endif
														@endif
													@endif
												</td>

												<td>
													@if(array_key_exists($title['country'], $prices))
														@if(array_key_exists($sub, $prices[$title['country']]))
															@if($prices[$title['country']][$sub]['id'] != 0)
																<a href="{{ url('prices/'. $prices[$title['country']][$sub]['id']) }}" class="btn btn-info btn-sm" title="Detail">
																	<i class="entypo-eye"></i>
																</a>

																@if(Auth::user()->hasRole('administrator'))
																	@permission('price-edit')
																		<a href="{{ url('prices/'. $prices[$title['country']][$sub]['id'] .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
																			<i class="entypo-pencil"></i>
																		</a>
																	@endpermission

																	@permission('price-delete')
																		<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $prices[$title['country']][$sub]['id'] }}" title="Delete">
																			<i class="entypo-trash"></i>
																		</a>
																	@endpermission
																@endif
															@endif
														@endif
													@endif
												</td>
											@endforeach
										@else
											<td></td>
											<td></td>
										@endif
									@endforeach
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				{{-- {!! $prices->render() !!} --}}

				{!! $priceLists->appends(['page' => $priceLists->currentPage()])->links() !!}
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
						url: "{!! url('prices/"+ id +"') !!}",
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

	<style>
		.table-cont {
			max-width: 100%;
			overflow: auto;
		}
	</style>
@stop
