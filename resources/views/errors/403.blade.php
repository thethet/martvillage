@extends('layouts.layout')

@section('page-title')
	Category
@stop

@section('main')

	<div class="main-content">
		<div class="page-error-404">


			<div class="error-symbol">
				<i class="entypo-attention"></i>
			</div>

			<div class="error-text">
				<h2>403</h2>
				<p>You don't have permission to access!</p>
			</div>

			<hr />

			<div class="error-text">

				<br />
				<br />

				<div class="input-group minimal">
					<a href="{{ url('dashboard') }}" class="btn btn-orange btn-icon">
						Back
						<i class="entypo-reply"></i>
					</a>
				</div>

			</div>

		</div>
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
@stop
