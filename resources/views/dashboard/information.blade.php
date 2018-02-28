@extends('layouts.layout')

@section('page-title')
	Information
@stop

@section('main')
	<div class="main-content">
		@include('layouts.headerbar')
		<hr />

		<ol class="breadcrumb bc-3" >
			<li>
				<a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i>Home</a>
			</li>
			<li>
				<a href="{{ url('settings') }}">Settings</a>
			</li>
			<li class="active">
				<strong>Information</strong>
			</li>
		</ol>

		<div class="row">
			<a href="{{ url('sliders') }}">
				<div class="col-sm-2">
					<div class="tile-title tile-cyan">
						<div class="icon">
							<img src="{{ asset('assets/icons/slider.png') }}" alt="">
						</div>

						<div class="title">
							<h3>&nbsp;<br>SLIDER</h3>
							<p>&nbsp;</p>
						</div>
					</div>
				</div>
			</a>

			<a href="{{ url('tags') }}">
				<div class="col-sm-2">
					<div class="tile-title tile-purple">
						<div class="icon">
							<img src="{{ asset('assets/icons/tag.png') }}" alt="">
						</div>

						<div class="title">
							<h3>&nbsp;<br>TAG</h3>
							<p>&nbsp;</p>
						</div>
					</div>
				</div>
			</a>

			<a href="{{ url('posts') }}">
				<div class="col-sm-2">
					<div class="tile-title tile-pink">
						<div class="icon">
							<img src="{{ asset('assets/icons/post.png') }}" alt="">
						</div>

						<div class="title">
							<h3>&nbsp;<br>POST</h3>
							<p>&nbsp;</p>
						</div>
					</div>
				</div>
			</a>
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
