@extends('layouts.layout')

@section('page-title')
	Dashboard
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

				<strong>Dashboard</strong>
			</li>
		</ol>

		<div class="row">
			<div class="col-sm-2">
				<a href="{{ url('settings') }}">
					<div class="tile-title tile-primary" style="border-radius: 5px !important;">
						<div class="icon">
							<img src="{{ asset('assets/icons/settings.png') }}" alt="">
						</div>

						<div class="title">
							<h3>&nbsp;<br>SETTING</h3>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			</div>

			@permission('user-list')
				<div class="col-sm-2">
					<a href="{{ url('/users') }}">
						<div class="tile-title tile-red">
							<div class="icon">
								<img src="{{ asset('assets/icons/user.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>USERS</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('member-list')
				<div class="col-sm-2">
					<a href="{{ url('/members') }}">
						<div class="tile-title tile-aqua">
							<div class="icon">
								<img src="{{ asset('assets/icons/members.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>MEMBERS</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('lotin-list')
				<div class="col-sm-2">
					<a href="{{ url('/lotins') }}">
						<div class="tile-title tile-blue">
							<div class="icon">
								<img src="{{ asset('assets/icons/lotin.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>LOTIN</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('lotbalance-list')
				<div class="col-sm-2">
					<a href="{{ url('/lotbalances') }}">
						<div class="tile-title tile-cyan">
							<div class="icon">
								<img src="{{ asset('assets/icons/lotbalance.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>LOT BALANCE</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('tracking-list')
				<div class="col-sm-2">
					<a href="{{ url('/trackings') }}">
						<div class="tile-title tile-gray">
							<div class="icon">
								<img src="{{ asset('assets/icons/tracking.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>TRACKING</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('outgoing-list')
				<div class="col-sm-2">
					<a href="{{ url('/outgoings') }}">
						<div class="tile-title tile-purple">
							<div class="icon">
								<img src="{{ asset('assets/icons/outgoing.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>OUTGOING</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('incoming-list')
				<div class="col-sm-2">
					<a href="{{ url('/incomings') }}">
						<div class="tile-title tile-pink">
							<div class="icon">
								<img src="{{ asset('assets/icons/incoming.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>INCOMING</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			@permission('collection-list')
				<div class="col-sm-2">
					<a href="{{ url('/collections') }}">
						<div class="tile-title tile-orange">
							<div class="icon">
								<img src="{{ asset('assets/icons/collection.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>COLLECTIONS</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission

			{{-- @permission('message-list')
				<div class="col-sm-2">
					<a href="{{ url('/messages') }}">
						<div class="tile-title tile-brown">
							<div class="icon">
								<img src="{{ asset('assets/icons/message.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>MESSAGES</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
			@endpermission --}}

			@permission('report-list')
				<div class="col-sm-2">
					<a href="{{ url('/reports') }}">
						<div class="tile-title tile-green">
							<div class="icon">
								<img src="{{ asset('assets/icons/report.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>REPORT</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</a>
				</div>
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
			padding-top: 5px;
		}
		.tile-title .title p {
			padding-bottom: 5px;
		}
		.tile-title .icon img {
			height: 100px;
		}
	</style>
@stop
