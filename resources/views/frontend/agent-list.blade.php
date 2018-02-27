@extends('frontend.layout')

@section('main')
	<main>
		<div class="container margin_60">
			<br><br><br><br><br><br>
			<div class="main_title">
				<h2><span> All </span> Agents</h2>
				<p>
					{{-- Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat. --}}&nbsp;
				</p>
			</div>

			<div class="row">

				@foreach($companies as $company)
					<?php
						$totalRating = ($totalRating > 0) ? $totalRating : 5;
						$rating = ($company->rating / $totalRating) * 5;
						$empty = 5 - $rating;
					?>
					<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
						<div class="tour_container">
							<div @if($rating >= 3.5) class="ribbon_3" @elseif($rating >= 2.5 && $rating < 3.5) class="ribbon_3 popular" @else @endif>
								@if($rating >= 3.5)
									<span>Top Rated</span>
								@elseif($rating >= 2.5 && $rating < 3.5)
									<span>Popular</span>
								@else
								@endif
							</div>
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
								<br />
								<div class="rating">
									@for($r = $rating; $r >= 1; $r--)
										<i class="icon-star voted"></i>
									@endfor

									@if($r > 0)
										@if($r >= 0.5)
											<i class="icon-star-half voted"></i>
										@else
											<i class="icon-star-empty"></i>
										@endif
									@endif

									@for($e = $empty; $e >= 1; $e--)
										<i class="icon-star-empty"></i>
									@endfor
									<small>({{ number_format($rating, 1) }})</small>
								</div>
								<!-- end rating -->
								<div class="wishlist">
									<a class="tooltip_flip tooltip-effect-1" href="{{ url('/agent-rating/' . $company->id) }}">+<span class="tooltip-content-flip"><span class="tooltip-back">Rate This</span></span></a>
								</div>
								<!-- End wish list-->
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
