@extends('layouts.layout')
@section('my-style')
	<!-- css files -->
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" media="all">
	<!-- //css files -->

	<!-- online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Ropa+Sans:400,400i&amp;subset=latin-ext" rel="stylesheet">
@stop

@section('main')
<div class="main-content">
	<div class="w3-main">
		<div class="agile-info">
			<h3>SORRY</h3>
			<h2>4<img src="{{ asset('assets/img/confused.gif') }}" alt="image">5</h2>
			{{-- <p>Method is not allowed for the requested route.</p> --}}
			<p>The resource you are looking for could not be found.</p>

			<a href="{{ URL::previous() }}">go back</a>
		</div>
	</div>
</div>
@stop

@section('my-script')
	<script type="application/x-javascript">
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){
			window.scrollTo(0,1);
		}
	</script>
@stop
