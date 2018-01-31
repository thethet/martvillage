@extends('frontend.layout')

@section('main')
	<main>
		<div id="rev_slider_54_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="notgeneric1" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
			<div id="rev_slider_54_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
				<ul>
					<!-- SLIDE  -->
					<li data-index="rs-140" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="{{ asset('assets/front/about-us.png') }}" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="{{ asset('assets/front/about-us.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->
					</li>

					<!-- SLIDE  -->
					<li data-index="rs-141" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500" data-thumb="{{ asset('assets/front/how-to-use.png') }}" data-rotate="0" data-saveperformance="off" data-title="Chill" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="{{ asset('assets/front/how-to-use.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->
					</li>
				</ul>
				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
			</div>
		</div>
		<!-- END REVOLUTION SLIDER -->

		<div class="container margin_60">

			<div class="main_title">
				<h2>Top <span>{{ count($companies) }}</span> Agents</h2>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>

			<div class="row">

				@foreach($companies as $company)
					<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
						<div class="tour_container">
							<div class="ribbon_3 popular"><span>Popular</span></div>
							<div class="img_container">
								<a href="{{ url('/') }}">
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
			<!-- End row -->
			<p class="text-center add_bottom_30">
				<a href="{{ url('/agent-list') }}" class="btn_1 medium"><i class="icon-eye-7"></i>View all Agents ({{ count($companyList) }}) </a>
			</p>

			<hr>
		</div>
		<!-- End container -->
	</main>
@stop
