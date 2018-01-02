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
	<title>CITY TOURS - City tours and travel site template by Ansonika</title>

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
						{{-- <h1><a href="index.html" title="SHWE CARGO">SHWE CARGO</a></h1> --}}
						<img src="{{ asset('assets/front/img/logo.png') }}" alt="SHWE CARGO" width="60px">
						<span style="color: gold; font-weight: bold; font-size: 18px;">SHWE CARGO</span>
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
									<li><a href="javascript:void(0);">Revolution slider</a>
										<ul>
											<li><a href="{{ url('/') }}">Default slider</a></li>
											<li><a href="{{ url('/') }}">Advanced slider</a></li>
											<li><a href="{{ url('/') }}">Youtube Hero</a></li>
											<li><a href="{{ url('/') }}">Vimeo Hero</a></li>
											<li><a href="{{ url('/') }}">Youtube 4K</a></li>
											<li><a href="{{ url('/') }}">Carousel</a></li>
											<li><a href="{{ url('/') }}">Mailchimp Newsletter</a></li>
											<li><a href="{{ url('/') }}">Fixed Caption</a></li>
										</ul>
									</li>
									<li><a href="{{ url('/') }}">Layer slider</a></li>
									<li><a href="{{ url('/') }}">With Only tours</a></li>
									<li><a href="{{ url('/') }}">Single image</a></li>
									<li><a href="{{ url('/') }}">Header video</a></li>
									<li><a href="{{ url('/') }}">With search panel</a></li>
									<li><a href="{{ url('/') }}">With tabs</a></li>
									<li><a href="{{ url('/') }}">With map</a></li>
									<li><a href="{{ url('/') }}">With search bar</a></li>
									<li><a href="{{ url('/') }}">Search bar + Video</a></li>
									<li><a href="{{ url('/') }}">With Text Rotator</a></li>
									<li><a href="{{ url('/') }}">With Cookie Bar (EU law)</a></li>
									<li><a href="{{ url('/') }}">Popup Advertising</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Tours <i class="icon-down-open-mini"></i></a>
								<ul>
									<li><a href="all_tours_list.html">All tours list</a></li>
									<li><a href="all_tours_grid.html">All tours grid</a></li>
									<li><a href="all_tours_map_listing.html">All tours map listing</a></li>
									<li><a href="single_tour.html">Single tour page</a></li>
									<li><a href="single_tour_with_gallery.html">Single tour with gallery</a></li>
									<li><a href="javascript:void(0);">Single tour fixed sidebar</a>
										<ul>
											<li><a href="single_tour_fixed_sidebar.html">Single tour fixed sidebar</a></li>
											<li><a href="single_tour_with_gallery_fixed_sidebar.html">Single tour 2 Fixed Sidebar</a></li>
											<li><a href="cart_fixed_sidebar.html">Cart Fixed Sidebar</a></li>
											<li><a href="payment_fixed_sidebar.html">Payment Fixed Sidebar</a></li>
											<li><a href="confirmation_fixed_sidebar.html">Confirmation Fixed Sidebar</a></li>
										</ul>
									</li>
									<li><a href="single_tour_working_booking.php">Single tour working booking</a></li>
									<li><a href="single_tour_datepicker_v2.html">Date and time picker V2</a></li>
									<li><a href="cart.html">Single tour cart</a></li>
									<li><a href="payment.html">Single tour booking</a></li>
								</ul>
							</li>
							 <li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Hotels <i class="icon-down-open-mini"></i></a><ul>
									<li><a href="{{ url('/') }}">All hotels list</a></li>
									<li><a href="{{ url('/') }}">All hotels grid</a></li>
									<li><a href="{{ url('/') }}">All hotels map listing</a></li>
									<li><a href="{{ url('/') }}">Single hotel page</a></li>
									<li><a href="{{ url('/') }}">Single hotel datepicker adv</a></li>
									<li><a href="{{ url('/') }}">Date and time picker V2</a></li>
									<li><a href="{{ url('/') }}">Single hotel working booking</a></li>
									<li><a href="{{ url('/') }}">Single hotel contact working</a></li>
									<li><a href="{{ url('/') }}">Cart hotel</a></li>
									<li><a href="{{ url('/') }}">Booking hotel</a></li>
									<li><a href="{{ url('/') }}">Confirmation hotel</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Transfers <i class="icon-down-open-mini"></i></a>
								<ul>
									<li><a href="{{ url('/') }}">All transfers list</a></li>
									<li><a href="{{ url('/') }}">All transfers grid</a></li>
									<li><a href="{{ url('/') }}">Single transfer page</a></li>
									<li><a href="{{ url('/') }}">Date and time picker V2</a></li>
									<li><a href="{{ url('/') }}">>Cart transfers</a></li>
									<li><a href="{{ url('/') }}">Booking transfers</a></li>
									<li><a href="{{ url('/') }}">Confirmation transfers</a></li>
								</ul>
							</li>
							  <li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Restaurants <i class="icon-down-open-mini"></i></a>
								<ul>
									<li><a href="{{ url('/') }}">All restaurants list</a></li>
									<li><a href="{{ url('/') }}">All restaurants grid</a></li>
									<li><a href="{{ url('/') }}">All restaurants map listing</a></li>
									<li><a href="{{ url('/') }}">Single restaurant page</a></li>
									<li><a href="{{ url('/') }}">Date and time picker V2</a></li>
									<li><a href="{{ url('/') }}">Booking restaurant</a></li>
									<li><a href="{{ url('/') }}">Confirmation transfers</a></li>
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
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-basket-1"></i>Cart (0) </a>
								<ul class="dropdown-menu" id="cart_items">
									<li>
										<div class="image"><img src="img/thumb_cart_1.jpg" alt="image"></div>
										<strong>
										<a href="#">Louvre museum</a>1x $36.00 </strong>
										<a href="#" class="action"><i class="icon-trash"></i></a>
									</li>
									<li>
										<div class="image"><img src="img/thumb_cart_2.jpg" alt="image"></div>
										<strong>
										<a href="#">Versailles tour</a>2x $36.00 </strong>
										<a href="#" class="action"><i class="icon-trash"></i></a>
									</li>
									<li>
										<div class="image"><img src="img/thumb_cart_3.jpg" alt="image"></div>
										<strong>
										<a href="#">Versailles tour</a>1x $36.00 </strong>
										<a href="#" class="action"><i class="icon-trash"></i></a>
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
		<div id="rev_slider_54_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="notgeneric1" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
			<!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
			<div id="rev_slider_54_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
				<ul>
					<!-- SLIDE  -->
					<li data-index="rs-140" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="r{{ asset('assets/front/slider1.png') }}" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="{{ asset('assets/front/slider1.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->

						<!-- LAYER NR. 1 -->
						<div class="tp-caption NotGeneric-Title   tp-resizeme" id="slide-140-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['50','46','36','28']" data-lineheight="['46','46','36','28']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"split":"chars","split_direction":"forward","splitdelay":0.05,"speed":2000,"frame":"0","from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 50px; line-height: 46px; font-weight: 700;font-family:Montserrat;">WELCOME TO CITYTOURS </div>

						<!-- LAYER NR. 2 -->
						<div class="tp-caption NotGeneric-SubTitle   tp-resizeme" id="slide-140-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-weight: 400;font-family:Montserrat;">&nbsp;</div>

						<!-- LAYER NR. 3 -->
						<div class="tp-caption NotGeneric-Icon   tp-resizeme" id="slide-140-layer-8" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-68','-68','-68','-68']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;cursor:default;"><i class="pe-7s-compass"></i> </div>

						<!-- LAYER NR. 4 -->
						<div class="tp-caption NotGeneric-Button rev-btn " id="slide-140-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['124','124','124','123']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"jumptoslide","slide":"next","delay":""}]' data-responsive_offset="on" data-responsive="off" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(255, 255, 255, 1);bc:rgba(255, 255, 255, 1);bw:1 1 1 1;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[30,30,30,30]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[30,30,30,30]" style="z-index: 8; white-space: nowrap; font-weight: 400;font-family:Montserrat;border-color:rgba(255,255,255,0.50);border-width:1px 1px 1px 1px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">&nbsp;</div>

						<!-- LAYER NR. 5 -->
						<div class="tp-caption rev-scroll-btn " id="slide-140-layer-9" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['50','50','50','50']" data-width="35" data-height="55" data-whitespace="nowrap" data-visibility="['on','on','on','off']" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"0px","delay":"","speed":"300","ease":"Linear.easeNone"}]' data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9; min-width: 35px; max-width: 35px; max-width: 55px; max-width: 55px; white-space: nowrap; font-size: px; line-height: px; font-weight: 100; color: transparent;border-color:rgba(255, 255, 255, 0.5);border-style:solid;border-width:1px 1px 1px 1px;border-radius:23px 23px 23px 23px;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">
							<span></span>
						</div>
					</li>
					<!-- SLIDE  -->
					<li data-index="rs-141" data-transition="fadetotopfadefrombottom" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500" data-thumb="{{ asset('assets/front/slider2.png') }}" data-rotate="0" data-saveperformance="off" data-title="Chill" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
						<!-- MAIN IMAGE -->
						<img src="{{ asset('assets/front/slider2.png') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
						<!-- LAYERS -->

						<!-- LAYER NR. 6 -->
						<div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-3" id="slide-141-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['50','46','36','28']" data-lineheight="['46','46','36','28']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"split":"chars","split_direction":"forward","splitdelay":0.05,"speed":2000,"frame":"0","from":"y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[0,0,0,0]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 50px; line-height: 46px; font-weight: 700;font-family:Montserrat;">DISCOVER NICE PLACES </div>

						<!-- LAYER NR. 7 -->
						<div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-2" id="slide-141-layer-4" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-weight: 400;font-family:Montserrat;">&nbsp;/div>

						<!-- LAYER NR. 8 -->
						<div class="tp-caption NotGeneric-Icon   tp-resizeme rs-parallaxlevel-1" id="slide-141-layer-8" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-68','-68','-68','-68']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; white-space: nowrap;cursor:default;"><i class="pe-7s-mouse"></i> </div>

						<!-- LAYER NR. 9 -->
						<div class="tp-caption NotGeneric-Button rev-btn " id="slide-141-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['124','124','124','123']" data-fontweight="['400','500','500','500']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"jumptoslide","slide":"next","delay":""}]' data-responsive_offset="on" data-responsive="off" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(255, 255, 255, 1);bc:rgba(255, 255, 255, 1);bw:1 1 1 1;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[10,10,10,10]" data-paddingright="[30,30,30,30]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[30,30,30,30]" style="z-index: 8; white-space: nowrap; font-weight: 400;font-family:Montserrat;border-color:rgba(255,255,255,0.50);border-width:1px 1px 1px 1px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">NEXT GOODIE </div>

						<!-- LAYER NR. 10 -->
						<div class="tp-caption rev-scroll-btn " id="slide-141-layer-9" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['bottom','bottom','bottom','bottom']" data-voffset="['50','50','50','50']" data-width="35" data-height="55" data-whitespace="nowrap" data-visibility="['on','on','on','off']" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"0px","delay":"","speed":"300","ease":"Linear.easeNone"}]' data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":2000,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9; min-width: 35px; max-width: 35px; max-width: 55px; max-width: 55px; white-space: nowrap; font-size: px; line-height: px; font-weight: 100; color: transparent;border-color:rgba(255, 255, 255, 0.5);border-style:solid;border-width:1px 1px 1px 1px;border-radius:23px 23px 23px 23px;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">
							<span></span>
						</div>

						<!-- LAYER NR. 11 -->
						<div class="tp-caption   tp-resizeme rs-parallaxlevel-8" id="slide-141-layer-10" data-x="['left','left','left','left']" data-hoffset="['680','680','680','680']" data-y="['top','top','top','top']" data-voffset="['632','632','632','632']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="image" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;">
							<div class="rs-looped rs-pendulum" data-easing="linearEaseNone" data-startdeg="-20" data-enddeg="360" data-speed="35" data-origin="50% 50%"><img src="rev-slider-files/assets/blurflake4.png" alt="" data-ww="['240px','240px','240px','240px']" data-hh="['240px','240px','240px','240px']" data-no-retina> </div>
						</div>

						<!-- LAYER NR. 12 -->
						<div class="tp-caption   tp-resizeme rs-parallaxlevel-7" id="slide-141-layer-11" data-x="['left','left','left','left']" data-hoffset="['948','948','948','948']" data-y="['top','top','top','top']" data-voffset="['487','487','487','487']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="image" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;">
							<div class="rs-looped rs-wave" data-speed="20" data-angle="0" data-radius="50px" data-origin="50% 50%"><img src="rev-slider-files/assets/blurflake3.png" alt="" data-ww="['170px','170px','170px','170px']" data-hh="['170px','170px','170px','170px']" data-no-retina> </div>
						</div>

						<!-- LAYER NR. 13 -->
						<div class="tp-caption   tp-resizeme rs-parallaxlevel-4" id="slide-141-layer-12" data-x="['left','left','left','left']" data-hoffset="['719','719','719','719']" data-y="['top','top','top','top']" data-voffset="['200','200','200','200']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="image" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;">
							<div class="rs-looped rs-rotate" data-easing="Power2.easeInOut" data-startdeg="-20" data-enddeg="360" data-speed="20" data-origin="50% 50%"><img src="rev-slider-files/assets/blurflake2.png" alt="" data-ww="['50px','50px','50px','50px']" data-hh="['51px','51px','51px','51px']" data-no-retina> </div>
						</div>

						<!-- LAYER NR. 14 -->
						<div class="tp-caption   tp-resizeme rs-parallaxlevel-6" id="slide-141-layer-13" data-x="['left','left','left','left']" data-hoffset="['187','187','187','187']" data-y="['top','top','top','top']" data-voffset="['216','216','216','216']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="image" data-responsive_offset="on" data-frames='[{"delay":2000,"speed":1000,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;">
							<div class="rs-looped rs-wave" data-speed="4" data-angle="0" data-radius="10" data-origin="50% 50%"><img src="rev-slider-files/assets/blurflake1.png" alt="" data-ww="['120px','120px','120px','120px']" data-hh="['120px','120px','120px','120px']" data-no-retina> </div>
						</div>
					</li>
				</ul>
				<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
			</div>
		</div>
		<!-- END REVOLUTION SLIDER -->

		<div class="container margin_60">

			<div class="main_title">
				<h2>Paris <span>Top</span> Tours</h2>
				<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
			</div>

			<div class="row">

				<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
					<div class="tour_container">
						<div class="ribbon_3 popular"><span>Popular</span></div>
						<div class="img_container">
							<a href="single_tour.html">
								<img src="{{ asset('assets/front/img/800-533.jpg') }}" class="img-responsive" alt="image">
								<div class="short_info">
									<i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>39</span>
								</div>
							</a>
						</div>
						<div class="tour_title">
							<h3><strong>Arc Triomphe</strong> tour</h3>
							<div class="rating">
								<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
							</div>
							<!-- end rating -->
							<div class="wishlist">
								<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
							</div>
							<!-- End wish list-->
						</div>
					</div>
					<!-- End box tour -->
				</div>
				<!-- End col-md-4 -->

				<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.2s">
					<div class="tour_container">
						<div class="ribbon_3 popular"><span>Popular</span></div>
						<div class="img_container">
							<a href="single_tour.html">
								<img src="{{ asset('assets/front/img/800-533.jpg') }}" width="800" height="533" class="img-responsive" alt="image">
								<div class="short_info">
									<i class="icon_set_1_icon-43"></i>Churches<span class="price"><sup>$</sup>45</span>
								</div>
							</a>
						</div>
						<div class="tour_title">
							<h3><strong>Notredame</strong> tour</h3>
							<div class="rating">
								<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
							</div>
							<!-- end rating -->
							<div class="wishlist">
								<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
							</div>
							<!-- End wish list-->
						</div>
					</div>
					<!-- End box tour -->
				</div>
				<!-- End col-md-4 -->

				<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.3s">
					<div class="tour_container">
						<div class="ribbon_3 popular"><span>Popular</span></div>
						<div class="img_container">
							<a href="single_tour.html">
								<img src="{{ asset('assets/front/img/800-533.jpg') }}" width="800" height="533" class="img-responsive" alt="image">
								<div class="badge_save">Save<strong>30%</strong></div>
								<div class="short_info">
									<i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>48</span>
								</div>
							</a>
						</div>
						<div class="tour_title">
							<h3><strong>Versailles</strong> tour</h3>
							<div class="rating">
								<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
							</div>
							<!-- end rating -->
							<div class="wishlist">
								<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
							</div>
							<!-- End wish list-->
						</div>
					</div>
					<!-- End box tour -->
				</div>
				<!-- End col-md-4 -->

				<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.4s">
					<div class="tour_container">
						<div class="ribbon_3"><span>Top rated</span></div>
						<div class="img_container">
							<a href="single_tour.html">
								<img src="{{ asset('assets/front/img/800-533.jpg') }}" width="800" height="533" class="img-responsive" alt="image">
								<div class="badge_save">Save<strong>20%</strong></div>
								<div class="short_info">
									<i class="icon_set_1_icon-30"></i>Walking tour<span class="price"><sup>$</sup>36</span>
								</div>
							</a>
						</div>
						<div class="tour_title">
							<h3><strong>Pompidue</strong> tour</h3>
							<div class="rating">
								<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
							</div>
							<!-- end rating -->
							<div class="wishlist">
								<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
							</div>
							<!-- End wish list-->
						</div>
					</div>
					<!-- End box tour -->
				</div>
				<!-- End col-md-4 -->

				<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.5s">
					<div class="tour_container">
						<div class="ribbon_3"><span>Top rated</span></div>
						<div class="img_container">
							<a href="single_tour.html">
								<img src="{{ asset('assets/front/img/800-533.jpg') }}" width="800" height="533" class="img-responsive" alt="image">
								<div class="short_info">
									<i class="icon_set_1_icon-28"></i>Skyline tours<span class="price"><sup>$</sup>42</span>
								</div>
							</a>
						</div>
						<div class="tour_title">
							<h3><strong>Tour Eiffel</strong> tour</h3>
							<div class="rating">
								<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
							</div>
							<!-- end rating -->
							<div class="wishlist">
								<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
							</div>
							<!-- End wish list-->
						</div>
					</div>
					<!-- End box tour -->
				</div>
				<!-- End col-md-4 -->

				<div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.6s">
					<div class="tour_container">
						<div class="ribbon_3"><span>Top rated</span></div>
						<div class="img_container">
							<a href="single_tour.html">
								<img src="{{ asset('assets/front/img/800-533.jpg') }}" width="800" height="533" class="img-responsive" alt="image">
								<div class="short_info">
									<i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>40</span>
								</div>
							</a>
						</div>
						<div class="tour_title">
							<h3><strong>Pantheon</strong> tour</h3>
							<div class="rating">
								<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
							</div>
							<!-- end rating -->
							<div class="wishlist">
								<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
							</div>
							<!-- End wish list-->
						</div>
					</div>
					<!-- End box tour -->
				</div>
				<!-- End col-md-4 -->

			</div>
			<!-- End row -->
			<p class="text-center add_bottom_30">
				<a href="all_tours_list.html" class="btn_1 medium"><i class="icon-eye-7"></i>View all tours (144) </a>
			</p>

			<hr>
		</div>
		<!-- End container -->

		<div class="white_bg">
			<div class="container margin_60">
				<div class="main_title">
					<h2>Other <span>Popular</span> tours</h2>
					<p>
						Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
					</p>
				</div>
				<div class="row add_bottom_45">
					<div class="col-md-4 other_tours">
						<ul>
							<li><a href="#"><i class="icon_set_1_icon-3"></i>Tour Eiffel<span class="other_tours_price">$42</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-30"></i>Shopping tour<span class="other_tours_price">$35</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-44"></i>Versailles tour<span class="other_tours_price">$20</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-3"></i>Montparnasse skyline<span class="other_tours_price">$26</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-44"></i>Pompidue<span class="other_tours_price">$26</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-3"></i>Senna River tour<span class="other_tours_price">$32</span></a>
							</li>
						</ul>
					</div>
					<div class="col-md-4 other_tours">
						<ul>
							<li><a href="#"><i class="icon_set_1_icon-1"></i>Notredame<span class="other_tours_price">$48</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-4"></i>Lafaiette<span class="other_tours_price">$55</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-30"></i>Trocadero<span class="other_tours_price">$76</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-3"></i>Open Bus tour<span class="other_tours_price">$55</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-30"></i>Louvre museum<span class="other_tours_price">$24</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-3"></i>Madlene Cathedral<span class="other_tours_price">$24</span></a>
							</li>
						</ul>
					</div>
					<div class="col-md-4 other_tours">
						<ul>
							<li><a href="#"><i class="icon_set_1_icon-37"></i>Montparnasse<span class="other_tours_price">$36</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-1"></i>D'Orsey museum<span class="other_tours_price">$28</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-50"></i>Gioconda Louvre musuem<span class="other_tours_price">$44</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-44"></i>Tour Eiffel<span class="other_tours_price">$56</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-50"></i>Ladefanse<span class="other_tours_price">$16</span></a>
							</li>
							<li><a href="#"><i class="icon_set_1_icon-44"></i>Notredame<span class="other_tours_price">$26</span></a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End row -->

				<div class="banner colored">
					<h4>Discover our Top tours <span>from $34</span></h4>
					<p>
						Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in.
					</p>
					<a href="single_tour.html" class="btn_1 white">Read more</a>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-6 text-center">
						<p>
							<a href="#"><img src="{{ asset('assets/front/img/800-450.jpg') }}" alt="Pic" class="img-responsive"></a>
						</p>
						<h4><span>Sightseen tour</span> booking</h4>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
						</p>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<p>
							<a href="#"><img src="{{ asset('assets/front/img/800-450.jpg') }}" alt="Pic" class="img-responsive"></a>
						</p>
						<h4><span>Transfer</span> booking</h4>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
						</p>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<p>
							<a href="#"><img src="{{ asset('assets/front/img/800-450.jpg') }}" alt="Pic" class="img-responsive"></a>
						</p>
						<h4><span>Tour guide</span> booking</h4>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
						</p>
					</div>
					<div class="col-md-3 col-sm-6 text-center">
						<p>
							<a href="#"><img src="{{ asset('assets/front/img/800-450.jpg') }}" alt="Pic" class="img-responsive"></a>
						</p>
						<h4><span>Hotel</span> booking</h4>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
						</p>
					</div>
				</div>
				<!-- End row -->
			</div>
			<!-- End container -->
		</div>
		<!-- End white_bg -->

		<section class="promo_full">
			<div class="promo_full_wp magnific">
				<div>
					<h3>BELONG ANYWHERE</h3>
					<p>
						Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
					</p>
					<a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video"><i class="icon-play-circled2-1"></i></a>
				</div>
			</div>
		</section>
		<!-- End section -->

		<div class="container margin_60">

			<div class="main_title">
				<h2>Some <span>good</span> reasons</h2>
				<p>
					Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
				</p>
			</div>

			<div class="row">

				<div class="col-md-4 wow zoomIn" data-wow-delay="0.2s">
					<div class="feature_home">
						<i class="icon_set_1_icon-41"></i>
						<h3><span>+120</span> Premium tours</h3>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
						</p>
						<a href="about.html" class="btn_1 outline">Read more</a>
					</div>
				</div>

				<div class="col-md-4 wow zoomIn" data-wow-delay="0.4s">
					<div class="feature_home">
						<i class="icon_set_1_icon-30"></i>
						<h3><span>+1000</span> Customers</h3>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
						</p>
						<a href="about.html" class="btn_1 outline">Read more</a>
					</div>
				</div>

				<div class="col-md-4 wow zoomIn" data-wow-delay="0.6s">
					<div class="feature_home">
						<i class="icon_set_1_icon-57"></i>
						<h3><span>H24 </span> Support</h3>
						<p>
							Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
						</p>
						<a href="about.html" class="btn_1 outline">Read more</a>
					</div>
				</div>

			</div>
			<!--End row -->

			<hr>

			<div class="row">
				<div class="col-md-8 col-sm-6 hidden-xs">
					<img src="{{ asset('assets/front/img/laptop.png') }}" alt="Laptop" class="img-responsive laptop">
				</div>
				<div class="col-md-4 col-sm-6">
					<h3><span>Get started</span> with CityTours</h3>
					<p>
						Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
					</p>
					<ul class="list_order">
						<li><span>1</span>Select your preferred tours</li>
						<li><span>2</span>Purchase tickets and options</li>
						<li><span>3</span>Pick them directly from your office</li>
					</ul>
					<a href="all_tour_list.html" class="btn_1">Start now</a>
				</div>
			</div>
			<!-- End row -->

		</div>
		<!-- End container -->
	</main>
	<!-- End main -->

	<footer class="revealed">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel://004542344599" id="phone">+45 423 445 99</a>
					<a href="mailto:help@citytours.com" id="email_footer">help@citytours.com</a>
				</div>
				<div class="col-md-3 col-sm-3">
					<h3>About</h3>
					<ul>
						<li><a href="#">About us</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Login</a></li>
						<li><a href="#">Register</a></li>
						 <li><a href="#">Terms and condition</a></li>
					</ul>
				</div>
				<div class="col-md-3 col-sm-3">
					<h3>Discover</h3>
					<ul>
						<li><a href="#">Community blog</a></li>
						<li><a href="#">Tour guide</a></li>
						<li><a href="#">Wishlist</a></li>
						 <li><a href="#">Gallery</a></li>
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
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-google"></i></a></li>
							<li><a href="#"><i class="icon-instagram"></i></a></li>
							<li><a href="#"><i class="icon-pinterest"></i></a></li>
							<li><a href="#"><i class="icon-vimeo"></i></a></li>
							<li><a href="#"><i class="icon-youtube-play"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
						</ul>
						<p>© Citytours 2015</p>
					</div>
				</div>
			</div><!-- End row -->
		</div><!-- End container -->
	</footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon_set_1_icon-78"></i>
			</button>
		</form>
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

</body>

</html>