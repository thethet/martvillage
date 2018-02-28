@extends('layouts.layout')

@section('page-title')
	Sliders
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3">
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li>
				<a href="{{ url('informations') }}">Information</a>
			</li>
			<li class="active">
				<strong>Slider Management</strong>
			</li>
		</ol>

		<h2>Slider Management</h2>
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
					<a href="{{ url('sliders/create') }}" title="Create">
						<i class="entypo-plus-squared"></i>
						New
					</a>
					&nbsp;|&nbsp;
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body with-table">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th width="5%">SNo.</th>
							<th>Name</th>
							<th>Image</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sliders as $key => $slider)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $slider->slider_name }}</td>
							<td>
								<div class="col-sm-5">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 100px; height: 75px;" data-trigger="fileinput">
											@if($slider->slider_img == null)
												<img src="http://placehold.it/100x75" alt="...">
											@else
												<img src="{{ asset('uploads/sliders/'. $slider->slider_img) }}" alt="ID PHOTO">
											@endif
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
									</div>
								</div>
							</td>
							<td>
								<a href="{{ url('sliders/'. $slider->id) }}" class="btn btn-info btn-sm" title="Detail">
									<i class="entypo-eye"></i>
								</a>

								<a href="{{ url('sliders/'. $slider->id .'/edit') }}" class="btn btn-success btn-sm" title="Edit">
									<i class="entypo-pencil"></i>
								</a>

								<a href="#" class="btn btn-danger btn-sm destroy" id="{{ $slider->id }}" title="Delete">
									<i class="entypo-trash"></i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $sliders->render() !!}
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
						url: "{!! url('sliders/"+ id +"') !!}",
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

