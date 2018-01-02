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
			<li class="active">

				<strong>Collection Management</strong>
			</li>
		</ol>


		<div class="row">
			@permission('collection-list')
				<a href="{{ url('/collections/ready-collect') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-cyan">
							<div class="icon">
								<img src="{{ asset('assets/icons/collection.png') }}" alt="">
							</div>

							<div class="title">
								<h3>READY TO COLLECT</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('collection-list')
				<a href="{{ url('collections/return') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-purple">
							<div class="icon">
								<img src="{{ asset('assets/icons/returncollect.png') }}" alt="">
							</div>

							<div class="title">
								<h3>RETURN TO HEAD OFFICE</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission
		</div>

		<!-- Footer -->
		<footer class="main">
			Copyright &copy; 2017 All Rights Reserved. <strong>MSCT Co.Ltd</strong>
		</footer>
	</div>
@stop

@section('my-style')
	<style type="text/css" media="screen">
		.tile-title .title h3 {
			padding-top: 20px;
		}
		.tile-title .title p {
			padding-bottom: 5px;
		}
		.tile-title .icon img {
			height: 100px;
		}
	</style>
@stop
