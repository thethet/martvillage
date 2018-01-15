<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
	<meta name="author" content="Ansonika">
	<title>Shwe Cargo - Cargo Management System powered by MSCT</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- Google web fonts -->
	<link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,400i,700,700i" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="{{ asset('assets/front/css/base.css') }}" rel="stylesheet">

	<!-- REVOLUTION SLIDER CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/rev-slider-files/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/rev-slider-files/fonts/font-awesome/css/font-awesome.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/front/rev-slider-files/css/settings.css') }}">

	<!--[if lt IE 9]>
	  <script src="js/html5shiv.min.js"></script>
	  <script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<!--[if lte IE 8]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

	<div id="preloader">
		<div class="sk-spinner sk-spinner-wave">
			<div class="sk-rect1"></div>
			<div class="sk-rect2"></div>
			<div class="sk-rect3"></div>
			<div class="sk-rect4"></div>
			<div class="sk-rect5"></div>
		</div>
	</div>
	<!-- End Preload -->

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
	<header>
		<div id="top_line">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-6"><i class="icon-phone"></i><strong>+95 9976477180 / +65 94308389</strong></div>

					<div class="col-md-6 col-sm-6 col-xs-6">
						<ul id="top_links">
							<li>
								<div class="dropdown dropdown-access">
									<a href="{{ url('admin') }}">Sign in</a>
								</div><!-- End Dropdown access -->
							</li>
							<li><a href="{{ url('/') }}" id="wishlist_link">Wishlist</a></li>
						</ul>
					</div>
				</div><!-- End row -->
			</div><!-- End container-->
		</div><!-- End top line-->

		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-3">
					<div id="logo_home">
						<a href="{{ url('/') }}">
							<img src="{{ asset('assets/front/img/logo.png') }}" alt="SHWE CARGO" width="60px">
							<span style="color: gold; font-weight: bold; font-size: 18px;">SHWE CARGO</span>
						</a>
					</div>
				</div>
				<nav class="col-md-9 col-sm-9 col-xs-9">
					<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
					<div class="main-menu">
						<div id="header_menu">
							<img src="img/logo_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
						</div>
						<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
						<ul>
							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Home <i class="icon-down-open-mini"></i></a>
								<ul>
									<li><a href="javascript:void(0);">Menu List 1</a>
										<ul>
											@for($x = 1; $x < 9; $x++)
											<li><a href="{{ url('/') }}">Sub Menu {{ $x }} </a></li>
											@endfor
										</ul>
									</li>

									@for($x = 2; $x < 13; $x++)
									<li><a href="{{ url('/') }}">Menu List {{ $x }} </a></li>
									@endfor
								</ul>
							</li>

							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Agents <i class="icon-down-open-mini"></i></a>
								<ul>
									@for($x = 1; $x < 6; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor

									<li><a href="javascript:void(0);">Agent 6</a>
										<ul>
											@for($x = 1; $x < 6; $x++)
											<li><a href="{{ url('/') }}">Sub Agent {{ $x }} </a></li>
											@endfor
										</ul>
									</li>
									@for($x = 7; $x < 11; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor
								</ul>
							</li>

							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Agents <i class="icon-down-open-mini"></i></a>
								<ul>
									@for($x = 1; $x < 6; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor

									<li><a href="javascript:void(0);">Agent 6</a>
										<ul>
											@for($x = 1; $x < 6; $x++)
											<li><a href="{{ url('/') }}">Sub Agent {{ $x }} </a></li>
											@endfor
										</ul>
									</li>
									@for($x = 7; $x < 11; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor
								</ul>
							</li>

							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Agents <i class="icon-down-open-mini"></i></a>
								<ul>
									@for($x = 1; $x < 6; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor

									<li><a href="javascript:void(0);">Agent 6</a>
										<ul>
											@for($x = 1; $x < 6; $x++)
											<li><a href="{{ url('/') }}">Sub Agent {{ $x }} </a></li>
											@endfor
										</ul>
									</li>
									@for($x = 7; $x < 11; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor
								</ul>
							</li>

							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Agents <i class="icon-down-open-mini"></i></a>
								<ul>
									@for($x = 1; $x < 6; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor

									<li><a href="javascript:void(0);">Agent 6</a>
										<ul>
											@for($x = 1; $x < 6; $x++)
											<li><a href="{{ url('/') }}">Sub Agent {{ $x }} </a></li>
											@endfor
										</ul>
									</li>
									@for($x = 7; $x < 11; $x++)
										<li><a href="{{ url('/') }}">Agent {{ $x }} </a></li>
									@endfor
								</ul>
							</li>

							 <li class="megamenu submenu">
								<a href="javascript:void(0);" class="show-submenu-mega">Bonus<i class="icon-down-open-mini"></i></a>
								<div class="menu-wrapper">
									<div class="col-md-4">
										<h3>Header styles</h3>
										<ul>
											<li><a href="{{ url('/') }}">Default transparent</a></li>
											<li><a href="{{ url('/') }}">Plain color</a></li>
											<li><a href="{{ url('/') }}">Plain color on scroll</a></li>
											<li><a href="{{ url('/') }}">With socials on top</a></li>
											<li><a href="{{ url('/') }}">With language selection</a></li>
											<li><a href="{{ url('/') }}">With lang and conversion</a></li>
											<li><a href="{{ url('/') }}">With full horizontal menu</a></li>
										</ul>
									</div>
									<div class="col-md-4">
										<h3>Footer styles</h3>
										<ul>
											<li><a href="{{ url('/') }}">Footer default</a></li>
											<li><a href="{{ url('/') }}">Footer style 2</a></li>
											<li><a href="{{ url('/') }}">Footer style 3</a></li>
											<li><a href="{{ url('/') }}">Footer style 4</a></li>
											<li><a href="{{ url('/') }}">Footer style 5</a></li>
											<li><a href="{{ url('/') }}">Footer style 6</a></li>
											<li><a href="{{ url('/') }}">Footer style 7</a></li>
										</ul>
									</div>
									<div class="col-md-4">
										<h3>Shop &amp; colors</h3>
										<ul>
											<li><a href="{{ url('/') }}">Shop</a></li>
											<li><a href="{{ url('/') }}">Shop single</a></li>
											<li><a href="{{ url('/') }}">Shop cart</a></li>
											<li><a href="{{ url('/') }}">Shop Checkout</a></li>
										</ul>
									</div>
								</div><!-- End menu-wrapper -->
							</li>
							<li class="megamenu submenu">
								<a href="javascript:void(0);" class="show-submenu-mega">Pages<i class="icon-down-open-mini"></i></a>
								<div class="menu-wrapper">
									<div class="col-md-4">
										<h3>Pages</h3>
										<ul>
											<li><a href="{{ url('/') }}">About us</a></li>
											<li><a href="{{ url('/') }}">General page</a></li>
											<li><a href="{{ url('/') }}">Tourist guide</a></li>
											<li><a href="{{ url('/') }}">Wishlist page</a></li>
											<li><a href="{{ url('/') }}">Faq</a></li>
											<li><a href="{{ url('/') }}">Faq smooth scroll</a></li>
											<li><a href="{{ url('/') }}">Pricing tables</a></li>
											<li><a href="{{ url('/') }}">Gallery 3 columns</a></li>
											<li><a href="{{ url('/') }}">Gallery 4 columns</a></li>
											<li><a href="{{ url('/') }}">Grid gallery</a></li>
											<li><a href="{{ url('/') }}">Grid gallery with filters</a></li>
										</ul>
									</div>
									<div class="col-md-4">
										<h3>Pages</h3>
										<ul>
											<li><a href="{{ url('/') }}">Contact us 1</a></li>
											<li><a href="{{ url('/') }}">Contact us 2</a></li>
											<li><a href="{{ url('/') }}">Blog</a></li>
											<li><a href="{{ url('/') }}">Blog left sidebar</a></li>
											<li><a href="{{ url('/') }}">Login</a></li>
											<li><a href="{{ url('/') }}">Register</a></li>
											<li><a href="{{ url('/') }}" target="_blank">Invoice</a></li>
											<li><a href="{{ url('/') }}">404 Error page</a></li>
											<li><a href="{{ url('/') }}">Site launch / Coming soon</a></li>
											<li><a href="{{ url('/') }}">Tour timeline</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-map"></i>  Full screen map</a></li>
										</ul>
									</div>
									<div class="col-md-4">
										<h3>Elements</h3>
										<ul>
											<li><a href="{{ url('/') }}"><i class="icon-columns"></i> Footer with working newsletter</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-columns"></i> Footer with Twitter feed</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-inbox-alt"></i> Icon pack 1 (1900)</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-inbox-alt"></i> Icon pack 2 (100)</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-inbox-alt"></i> Icon pack 3 (30)</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-inbox-alt"></i> Icon pack 4 (200)</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-inbox-alt"></i> Icon pack 5 (360)</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-tools"></i> Shortcodes</a></li>
											<li><a href="{{ url('/') }}" target="blank"><i class=" icon-mail"></i> Responsive email template</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-cog-1"></i>  Admin area</a></li>
											<li><a href="{{ url('/') }}"><i class="icon-light-up"></i>  Weather Forecast</a></li>
										</ul>
									</div>
								</div><!-- End menu-wrapper -->
							</li>
						</ul>
					</div><!-- End main-menu -->
					<ul id="top_tools">
						<li>
							<div class="dropdown dropdown-search">
								<a href="#" class="search-overlay-menu-btn" data-toggle="dropdown"><i class="icon-search"></i></a>
							</div>
						</li>
						<li>
							<div class="dropdown dropdown-cart">
								<ul class="dropdown-menu" id="cart_items">
									<li>
										<div class="image"><img src="img/thumb_cart_1.jpg" alt="image"></div>
										<strong>
										<a href="{{ url('/') }}">Louvre museum</a>1x $36.00 </strong>
										<a href="{{ url('/') }}" class="action"><i class="icon-trash"></i></a>
									</li>
									<li>
										<div class="image"><img src="img/thumb_cart_2.jpg" alt="image"></div>
										<strong>
										<a href="{{ url('/') }}">Versailles tour</a>2x $36.00 </strong>
										<a href="{{ url('/') }}" class="action"><i class="icon-trash"></i></a>
									</li>
									<li>
										<div class="image"><img src="img/thumb_cart_3.jpg" alt="image"></div>
										<strong>
										<a href="{{ url('/') }}">Versailles tour</a>1x $36.00 </strong>
										<a href="{{ url('/') }}" class="action"><i class="icon-trash"></i></a>
									</li>
									<li>
										<div>Total: <span>$120.00</span></div>
										<a href="{{ url('/') }}" class="button_drop">Go to cart</a>
										<a href="{{ url('/') }}" class="button_drop outline">Check out</a>
									</li>
								</ul>
							</div><!-- End dropdown-cart-->
						</li>
					</ul>
				</nav>
			</div>
		</div><!-- container -->
	</header><!-- End Header -->

	<main>

		<div class="white_bg">
			<div class="container margin_60">
				<br><br><br><br><br><br><br><br><br><br>
				<div class="row">
					<div class="col-md-12">
						{!! Form::open(array('route' => 'lot-search','method'=>'POST', 'role' => 'form', 'class' => 'form-horizontal form-wizard', 'id' => 'rootwizard')) !!}

							<?php
							$status = (int)$lotinData->status;
							$indicator = $status;
							$indicatorWidth = 25 * $indicator;
							?>

							<div class="form-group">
								<label class="col-sm-4">
									Contact No:
									@if($sender->contact_no)
										{{ $sender->contact_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									To:
									@if($receiver->address)
										{{ $receiver->address }} of {{ $receiverCount }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Date: {{ $lotinData->date }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Member No:
									@if($sender->member_no)
										{{ $sender->member_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Contact No:
									@if($receiver->contact_no)
										{{ $receiver->contact_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Lot No: {{ $lotinData->lot_no }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									Sender Name:
									@if($sender->name)
										{{ $sender->name }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									Receiver Name:
									@if($receiver->name)
										{{ $receiver->name }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									From: {{ $stateList[$lotinData->from_state] }}, {{ $countryList[$lotinData->from_country] }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">
									NRIC:
									@if($sender->nric_code_id != 0 && $sender->nric_township_id != 0)
										{{ $nricCodeList[$sender->nric_code_id] }} / {{ $nricTownshipList[$sender->nric_township_id] }} {{ $sender->nric_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									NRIC:
									@if($receiver->nric_code_id != 0 && $receiver->nric_township_id != 0)
										{{ $nricCodeList[$receiver->nric_code_id] }} / {{ $nricTownshipList[$receiver->nric_township_id] }} {{ $receiver->nric_no }}
									@else
										{{ '-' }}
									@endif
								</label>

								<label class="col-sm-4">
									To: {{ $stateList[$lotinData->to_state] }}, {{ $countryList[$lotinData->to_country] }}
								</label>
							</div>

							<div class="form-group">
								<label class="col-sm-4">&nbsp;</label>

								<label class="col-sm-4">&nbsp;</label>

								<label class="col-sm-4">
									Payment: {{ $lotinData->payment }}
								</label>
							</div>

							<br><br>
							<br><br>

							<div class="steps-progress" style="margin-left: 10%; margin-right: 10%;">
								<div class="progress-indicator"  style="width: {{ $indicatorWidth }}%"></div>
							</div>


							<ul>
								<li @if($status >= 0) class="completed" @endif>
									<a href="#tab1" data-toggle="tab">
										<span>1</span>Sender Office (Start Point)
									</a>
								</li>
								<li @if($status >= 1) class="completed" @elseif($status == 0) class="active" @endif>
									<a href="#tab2" data-toggle="tab">
										<span>2</span>On Boarding
									</a>
								</li>
								<li @if($status >= 2) class="completed" @elseif($status == 1) class="active" @endif>
									<a href="#tab3" data-toggle="tab">
										<span>3</span>Destination Office (Ready Collect)
									</a>
								</li>
								<li @if($status >= 3) class="completed" @elseif($status == 2) class="active" @endif>
									<a href="#tab4" data-toggle="tab">
										<span>4</span>Collected
									</a>
								</li>
								<li @if($status == 3) class="active" @endif>
									<a href="#tab5" data-toggle="tab">
										<span>5</span>Customer Received
									</a>
								</li>
							</ul>

							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<!-- End container -->
		</div>
		<!-- End white_bg -->

		<!-- End container -->
	</main>
	<!-- End main -->

	<footer class="revealed">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel://004542344599" id="phone">+95 9976477180 / +65 94308389</a>
					<a href="mailto:msctpteltd@gmail.com" id="email_footer">msctpteltd@gmail.com</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<h3>About</h3>
					<ul>
						<li><a href="{{ url('/') }}">About us</a></li>
						<li><a href="{{ url('/') }}">FAQ</a></li>
						<li><a href="{{ url('/') }}">Login</a></li>
						<li><a href="{{ url('/') }}">Register</a></li>
						 <li><a href="{{ url('/') }}">Terms and condition</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-3">
					<h3>Discover</h3>
					<ul>
						<li><a href="{{ url('/') }}">Community blog</a></li>
						<li><a href="{{ url('/') }}">ShweCargo guide</a></li>
						<li><a href="{{ url('/') }}">Wishlist</a></li>
						 <li><a href="{{ url('/') }}">Gallery</a></li>
					</ul>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>Settings</h3>
					<div class="styled-select">
						<select class="form-control" name="lang" id="lang">
							<option value="English" selected>English</option>
							<option value="French">French</option>
							<option value="Spanish">Spanish</option>
							<option value="Russian">Russian</option>
						</select>
					</div>
					<div class="styled-select">
						<select class="form-control" name="currency" id="currency">
							<option value="USD" selected>USD</option>
							<option value="EUR">EUR</option>
							<option value="GBP">GBP</option>
							<option value="RUB">RUB</option>
						</select>
					</div>
				</div>
			</div><!-- End row -->
			<div class="row">
				<div class="col-md-12">
					<div id="social_footer">
						<ul>
							<li><a href="{{ url('/') }}"><i class="icon-facebook"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-twitter"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-google"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-instagram"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-pinterest"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-vimeo"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-youtube-play"></i></a></li>
							<li><a href="{{ url('/') }}"><i class="icon-linkedin"></i></a></li>
						</ul>
						<p>© ShweCargo 2017</p>
					</div>
				</div>
			</div><!-- End row -->
		</div><!-- End container -->
	</footer><!-- End footer -->

	<div id="toTop"></div><!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		{!! Form::open(array('route' => 'lot-search','method'=>'POST', 'role' => 'search', 'class' => 'form-horizontal form-groups-bordered validate', 'id' => 'searchform')) !!}

			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon_set_1_icon-78"></i>
			</button>
		{!! Form::close() !!}
	</div><!-- End Search Menu -->

	<style>
		.tp-caption.NotGeneric-Title, .NotGeneric-Title {
			color: transparent;
		}
		.tp-caption.NotGeneric-SubTitle, .NotGeneric-SubTitle {
			color: transparent;
		}

		.defaultimg {
			background-size: contain !important;
		}
	</style>

	<!-- Common scripts -->
	<script src="{{ asset('assets/front/js/jquery-2.2.4.min.js') }}"></script>
	<script src="{{ asset('assets/front/js/common_scripts_min.js') }}"></script>
	<script src="{{ asset('assets/front/js/functions.js') }}"></script>

	<!-- SLIDER REVOLUTION SCRIPTS  -->
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/jquery.themepunch.tools.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/jquery.themepunch.revolution.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.actions.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.carousel.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.migration.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.navigation.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.parallax.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/front/rev-slider-files/js/extensions/revolution.extension.video.min.js') }}"></script>
	<script type="text/javascript">
		var tpj = jQuery;

		var revapi54;
		tpj(document).ready(function () {
			if (tpj("#rev_slider_54_1").revolution == undefined) {
				revslider_showDoubleJqueryError("#rev_slider_54_1");
			} else {
				revapi54 = tpj("#rev_slider_54_1").show().revolution({
					sliderType: "standard",
					jsFileLocation: "rev-slider-files/js/",
					sliderLayout: "fullwidth",
					dottedOverlay: "none",
					delay: 9000,
					navigation: {
							keyboardNavigation:"off",
							keyboard_direction: "horizontal",
							mouseScrollNavigation:"off",
							 mouseScrollReverse:"default",
							onHoverStop:"off",
							touch:{
								touchenabled:"on",
								touchOnDesktop:"off",
								swipe_threshold: 75,
								swipe_min_touches: 50,
								swipe_direction: "horizontal",
								drag_block_vertical: false
							}
							,
							arrows: {
								style:"uranus",
								enable:true,
								hide_onmobile:true,
								hide_under:778,
								hide_onleave:true,
								hide_delay:200,
								hide_delay_mobile:1200,
								tmp:'',
								left: {
									h_align:"left",
									v_align:"center",
									h_offset:20,
									v_offset:0
								},
								right: {
									h_align:"right",
									v_align:"center",
									h_offset:20,
									v_offset:0
								}
							}
						},
					responsiveLevels: [1240, 1024, 778, 480],
					visibilityLevels: [1240, 1024, 778, 480],
					gridwidth: [1240, 1024, 778, 480],
					gridheight: [700, 550, 860, 480],
					lazyType: "none",
					parallax: {
						type: "mouse",
						origo: "slidercenter",
						speed: 2000,
						levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50, 47, 48, 49, 50, 51, 55],
						disable_onmobile: "on"
					},
					shadow: 0,
					spinner: "off",
					stopLoop: "on",
					stopAfterLoops: 0,
					stopAtSlide: 1,
					shuffle: "off",
					autoHeight: "off",
					disableProgressBar: "on",
					hideThumbsOnMobile: "off",
					hideSliderAtLimit: 0,
					hideCaptionAtLimit: 0,
					hideAllCaptionAtLilmit: 0,
					debugMode: false,
					fallbacks: {
						simplifyAll: "off",
						nextSlideOnWindowFocus: "off",
						disableFocusListener: false,
					}
				});
			}
		}); /*ready*/
	</script>

	<script src="js/notify_func.js"></script>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/neon-forms.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/font-icons/font-awesome/css/font-awesome.min.css') }}">


	<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>

	<!-- Imported scripts on this page -->
	<script src="{{ asset('assets/js/jquery.bootstrap.wizard.min.js') }}"></script>

</body>

</html>
