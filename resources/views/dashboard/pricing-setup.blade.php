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
					<div class="col-sm-3">
						<div class="tile-stats tile-cyan">
							<div class="icon"><i class="fa fa-balance-scale"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>CATEGORY</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('currency-list')
				<a href="{{ url('currencies') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-purple">
							<div class="icon"><i class="fa fa-usd"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>CURRENCY</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
						</div>
					</div>
				</a>
			@endpermission

			@permission('price-list')
				<a href="{{ url('prices') }}">
					<div class="col-sm-3">
						<div class="tile-stats tile-pink">
							<div class="icon"><i class="fa fa-money"></i></div>
							<div class="num">
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							</div>

							<h3>PRICE</h3>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
							<p>&nbsp;</p>
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

