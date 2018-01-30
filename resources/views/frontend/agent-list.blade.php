@extends('frontend.layout')

@section('main')
	<main>
		<div class="container margin_60">
			<br><br><br><br><br><br>
			<div class="main_title">
				<h2><span> All </span> Agents</h2>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>

			<div class="row">

				@foreach($companies as $company)
					<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
						<div class="tour_container">
							<div class="ribbon_3 popular"><span>Popular</span></div>
							<div class="img_container">
								<a href="{{ url('/agent-list/' . $company->id) }}">
									@if($company->logo == null)
										<img src="http://placehold.it/358X238" alt="...">
									@else
										<img src="{{ asset('uploads/logos/'. $company->logo) }}" alt="ID PHOTO">
									@endif

								</a>
							</div>
							<div class="tour_title">
								<h3><strong>{{ $company->company_name }}</strong></h3>
								<div class="rating">
									<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><small>(75)</small>
								</div>
							</div>
						</div>
						<!-- End box tour -->
					</div>
					<!-- End col-md-4 -->
				@endforeach

			</div>
			<hr>

			<div class="text-center">
				{!! $companies->render() !!}
			</div>
			<!-- end pagination-->
		</div>
		<!-- End container -->
	</main>
@stop
