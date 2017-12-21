@extends('layouts.layout')

@section('page-title')
	Pricing Setup
@stop

@section('main')
	<div class="main-content">

		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li class="active">

				<strong>Pricing Setup</strong>
			</li>
		</ol>


		<div class="row">
			@permission('category-list')
				<a href="{{ url('categories') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-cyan">
							<div class="icon">
								<img src="{{ asset('assets/icons/category.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>CATEGORY</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('currency-list')
				<a href="{{ url('currencies') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-purple">
							<div class="icon">
								<img src="{{ asset('assets/icons/currency.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>CURRENCY</h3>
								<p>&nbsp;</p>
							</div>
						</div>
					</div>
				</a>
			@endpermission

			@permission('price-list')
				<a href="{{ url('prices') }}">
					<div class="col-sm-2">
						<div class="tile-title tile-pink">
							<div class="icon">
								<img src="{{ asset('assets/icons/price.png') }}" alt="">
							</div>

							<div class="title">
								<h3>&nbsp;<br>PRICE</h3>
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

