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
	<link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
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

	<!-- REVOLUTION LAYERS STYLES -->
	<style>
		.tp-caption.NotGeneric-Title,
		.NotGeneric-Title {
			color: rgba(255, 255, 255, 1.00);
			font-size: 70px;
			line-height: 70px;
			font-weight: 800;
			font-style: normal;
			text-decoration: none;
			background-color: transparent;
			border-color: transparent;
			border-style: none;
			border-width: 0px;
			border-radius: 0 0 0 0px
		}

		.tp-caption.NotGeneric-SubTitle,
		.NotGeneric-SubTitle {
			color: rgba(255, 255, 255, 1.00);
			font-size: 13px;
			line-height: 20px;
			font-weight: 500;
			font-style: normal;
			text-decoration: none;
			background-color: transparent;
			border-color: transparent;
			border-style: none;
			border-width: 0px;
			border-radius: 0 0 0 0px;
			letter-spacing: 4px
		}

		.tp-caption.NotGeneric-Icon,
		.NotGeneric-Icon {
			color: rgba(255, 255, 255, 1.00);
			font-size: 30px;
			line-height: 30px;
			font-weight: 400;
			font-style: normal;
			text-decoration: none;
			background-color: rgba(0, 0, 0, 0);
			border-color: rgba(255, 255, 255, 0);
			border-style: solid;
			border-width: 0px;
			border-radius: 0px 0px 0px 0px;
			letter-spacing: 3px
		}

		.tp-caption.NotGeneric-Button,
		.NotGeneric-Button {
			color: rgba(255, 255, 255, 1.00);
			font-size: 14px;
			line-height: 14px;
			font-weight: 500;
			font-style: normal;
			text-decoration: none;
			background-color: rgba(0, 0, 0, 0);
			border-color: rgba(255, 255, 255, 0.50);
			border-style: solid;
			border-width: 1px;
			border-radius: 0px 0px 0px 0px;
			letter-spacing: 3px
		}

		.tp-caption.NotGeneric-Button:hover,
		.NotGeneric-Button:hover {
			color: rgba(255, 255, 255, 1.00);
			text-decoration: none;
			background-color: transparent;
			border-color: rgba(255, 255, 255, 1.00);
			border-style: solid;
			border-width: 1px;
			border-radius: 0px 0px 0px 0px;
			cursor: pointer
		}
	</style>

	<!--[if lt IE 9]>
	  <script src="js/html5shiv.min.js"></script>
	  <script src="js/respond.min.js"></script>
	<![endif]-->
	@yield('my-style')

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
						{{-- <ul id="top_links">
							<li>
								<div class="dropdown dropdown-access">
									<a href="{{ url('admin') }}">Sign in</a>
								</div><!-- End Dropdown access -->
							</li>
							<li><a href="{{ url('/') }}" id="wishlist_link">Wishlist</a></li>
						</ul> --}}
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
						</div>
						<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
						<ul>
							<li>
								<a href="{{ url('/') }}" class="show-submenu">Home</a>
							</li>

							<li class="submenu">
								<a href="{{ url('/agent-list') }}" class="show-submenu">Agent Lists <i class="icon-down-open-mini"></i></a>
								<ul>
									@foreach($companyList as $comp)
										<li><a href="{{ url('/agent-list/' . $comp->id) }}">{{ $comp->company_name }} </a></li>
									@endforeach
								</ul>
							</li>

							<li>
								<a href="{{ url('/contact-us') }}" class="show-submenu">Contact Us</a>
							</li>

							<li>
								<a href="{{ url('/about-us') }}" class="show-submenu">About Us</i></a>
							</li>

							<li>
								<a href="{{ url('/how-to-use') }}" class="show-submenu">How To Use</a>
							</li>

							<li>
								<a href="{{ url('admin') }}">Sign in</a>
							</li>
						</ul>
					</div><!-- End main-menu -->
					<ul id="top_tools">
						<li>
							<div class="dropdown dropdown-search">
								<a href="#" class="search-overlay-menu-btn" data-toggle="dropdown"><i class="icon-search"></i>ဝန္ေဆာင္မွုအေျခေနၾကည့္ရွုရန္ (STATUS)</a>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div><!-- container -->
	</header><!-- End Header -->

	@yield('main')
	<!-- End main -->

	<footer class="revealed">
		<div class="container">
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

			<input value="" name="q" type="search" placeholder="Please Enter Lot No. (သင္၏ Lot No. ကိုရိုက္ထည့္၍ရွာေဖြပါ" />
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
			/*background-size: contain !important;*/
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

	{{-- <script src="js/notify_func.js"></script> --}}
	@yield('my-script')

</body>

</html>
