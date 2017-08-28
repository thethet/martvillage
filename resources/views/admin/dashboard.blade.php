@extends('layout.layout')

@section('main-content')
	<div class="main-content">
		<div class="row">
			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/profile.png') }}" alt="Profile">
						Profile
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/lot-in.png') }}" alt="Lot-in">
						Lot-in
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="tracking-icon" src="{{ asset('assets/img/tracking-icon.png') }}" alt="Tracking">
						Tracking
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="profile-icon" src="{{ asset('assets/img/collection.jpg') }}" alt="Collection">
						Collection
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img src="{{ asset('assets/img/lot-balance.png') }}" alt="Lot Balance">
						Lot Balance
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('setting') }}">
					<div class="card">
						<img class="setting-icon" src="{{ asset('assets/img/Settings-icon.png') }}" alt="Setting">
						Setting
					</div>
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="message-icon" src="{{ asset('assets/img/message-new.png') }}" alt="">
						Message
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="report-icon" src="{{ asset('assets/img/report-icon.png') }}" alt="">
						Report
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="member-icon" src="{{ asset('assets/img/member.png') }}" alt="">
						Member
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="outgoing-icon" src="{{ asset('assets/img/outgoing.png') }}" alt="">
						Out Going
					</div>
				</a>
			</div>

			<div class="col-md-2">
				<a href="{{ url('/') }}">
					<div class="card">
						<img class="incoming-icon" src="{{ asset('assets/img/incoming.png') }}" alt="">
						Incoming
					</div>
				</a>
			</div>
		</div>
	</div>
@stop
