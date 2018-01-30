@extends('frontend.layout')

@section('main')
	<main>
		<div class="container margin_60">
			<br><br><br><br><br><br>
			<div class="row">
				<div class="col-md-12">
					<div class="box_style_1">
						<div class="post nopadding">
							@if($company->logo == null)
								<img src="http://placehold.it/1090x400" alt="..." style="height: 400px; width: 100%; object-fit: contain; border: 2px solid #f8f8f8; padding: 2px;">
							@else
								<img src="{{ asset('uploads/logos/'. $company->logo) }}" alt="ID PHOTO" style="height: 400px; width: 100%; object-fit: contain; border: 2px solid #f8f8f8; padding: 2px;">
							@endif

							<h2>{{ strtoupper($company->company_name) }}</h2>

							<blockquote class="styled" style="border-left: none;">
								<p>
									<i class="icon-mail"></i> <span>{{ $company->email }}</span>
									<br>
									<i class="icon-phone"></i> <span>{{ $company->contact_no }}</span>
									<br>
									<i class="icon-location"></i>
									<span>
										{{ $company->address }}
										@if($company->township_id > 0 && count($townshipList))
											{{ $townshipList[$company->township_id] }}
										@endif
										@if($company->state_id > 0 && count($stateList))
											, {{ $stateList[$company->state_id] }}
										@endif
										@if($company->country_id > 0 && count($countryList))
											, {{ $countryList[$company->country_id] }}
										@endif
									</span>
								</p>

								<small>© ShweCargo 2017</small>
							</blockquote>
						</div>
						<!-- end post -->
					</div>
					<!-- end box_style_1 -->
				</div>
				<!-- End col-md-12-->
			</div>
			<hr>

		</div>
		<!-- End container -->
	</main>
@stop
