@extends('layouts.layout')

@section('main')
	<div class="main-content">
		<div class="row">
			@permission('user-list')
			<div class="col-md-2">
				<a href="{{ url('/users') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/profile.png') }}" alt="Profile">
						<p>Profile</p>
					</div>
				</a>
			</div>
			@endpermission

			{{-- @permission('lotin-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/lotins') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/lot-in.png') }}" alt="Lot-in">
						<p>Lot-in</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('tracking-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/trackings') }}">
					<div class="card">
						<img class="tracking-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Tracking">
						<p>Tracking</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('collection-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/collections') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/collection.png') }}" alt="Collection">
						<p>Collection</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('lotbalance-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/lotbalances') }}">
					<div class="card">
						<img src="{{ asset('assets/img/lot-balance.png') }}" alt="Lot Balance">
						<p>Lot Balance</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('setting-list') --}}
			<div class="col-md-2">
				<a href="{{ url('settings') }}">
					<div class="card">
						<img class="setting-icon" src="{{ asset('assets/img/Settings-icon.png') }}" alt="Setting">
						<p>Setting</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}
		</div>

		<div class="row">
			{{-- @permission('message-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/messages') }}">
					<div class="card">
						<img class="message-icon" src="{{ asset('assets/img/message-new.png') }}" alt="">
						<p>Message</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('report-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/reports') }}">
					<div class="card">
						<img class="report-icon" src="{{ asset('assets/img/report-icon.png') }}" alt="">
						<p>Report</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('member-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/members') }}">
					<div class="card">
						<img class="member-icon" src="{{ asset('assets/img/member.png') }}" alt="">
						<p>Member</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('outgoing-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/outgoings') }}">
					<div class="card">
						<img class="outgoing-icon" src="{{ asset('assets/img/outgoing.png') }}" alt="">
						<p>Out Going</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}

			{{-- @permission('incoming-list') --}}
			<div class="col-md-2">
				<a href="{{ url('/incomings') }}">
					<div class="card">
						<img class="incoming-icon" src="{{ asset('assets/img/incoming.png') }}" alt="">
						<p>Incoming</p>
					</div>
				</a>
			</div>
			{{-- @endpermission --}}
		</div>
	</div>
@stop
