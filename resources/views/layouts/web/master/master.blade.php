<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>LESKU</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<!-- Form -->
	<!-- Bootstrap-CSS -->
	<link href="{{ url('') }}/assets/css_1/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Font-awesome-CSS -->
	<link href="{{ url('') }}/assets/css_1/font-awesome.css" rel="stylesheet">
	<!-- Flex-slider-CSS -->
	<link rel="stylesheet" href="{{ url('') }}/assets/css_1/flexslider.css" type="text/css" media="screen" property="" />
	<!-- Owl-carousel-CSS -->
	<link href="{{ url('') }}/assets/css_1/owl.carousel.css" rel="stylesheet">
	<!-- Index-Page-CSS -->
	<link href="{{ url('') }}/assets/css_1/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- //Custom-Stylesheet-Links -->
	<!--web-fonts-->
	<!-- Headings-font -->
	<link href="//fonts.googleapis.com/css?family=Hind+Vadodara:300,400,500,600,700" rel="stylesheet">
	<!-- Body-font -->
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<!--//web-fonts-->
	<!--//fonts-->
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ url('/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
	<!-- js -->
</head>

<body>
	<!-- banner -->
	<div class="banner" id="home">
		<div class="banner-overlay-agileinfo">
			<div class="top-header-agile">
				<h1><a class="col-md-4 navbar-brand" href="/">LESKU<span>Education for everyone</span></a></h1>
				<div class="col-md-4 top-header-agile-right">
					<ul>
						<!-- <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
						<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<!-- <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li> -->
					</ul>
				</div>
        @if (Route::has('login'))
				<div class="col-md-4 top-header-agile-left" style="text-align : right">
					<ul class="num-w3ls" style="margin-left:3em">
            @auth
						<li class="dropdown menu__item">
							<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" data-hover="Pages" role="button"
							 aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span>{{ Auth::user()->username }}</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="/profile">Profile</a></li>
								<li>
									<a href="{{ route('logout') }}"
											onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">Logout
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
									</form>
								</li>
							</ul>
						</li>
            @else
						<li>
							<a href="{{ route('login') }}">
								<span class="fa fa-unlock-alt" style="margin-left:20px" aria-hidden="true"></span> Sign In </a>
						</li>
            @if (Route::has('register'))
						<li>
							<a href="{{ route('register') }}">
								<span class="fa fa-pencil-square-o" style="margin-left:20px" aria-hidden="true"></span> Sign Up </a>
						</li>
            @endif
            @endauth
					</ul>
				</div>
        @endif
				<div class="clearfix"></div>
			</div>
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav class="link-effect-3" id="link-effect-3">
							<ul class="col-md-12 nav navbar-nav">
                <li><a href="/" data-hover="Home">Home</a></li>
								<li><a href="/about" data-hover="About Us">Tentang Kami</a></li>
								<li><a href="/product" data-hover="Services">Produk Kami</a></li>
								<!-- <li class="dropdown menu__item">
									<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" data-hover="Pages" role="button"
									 aria-haspopup="true" aria-expanded="false">Pages<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="codes.html">Short Codes</a></li>
										<li><a href="icons.html">Icons</a></li>
									</ul>
								</li> -->
								<li><a href="/contact" data-hover="Mail Us">Bantuan</a></li>
								<li><a href="/contact" data-hover="Mail Us">Kontak Kami</a></li>
							</ul>

						</nav>
					</div>
				</nav>
				<div class="w3l_banner_info">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<div class="wthree_banner_info_grid">
										<h3><span>Genius</span>Welcome to <br>LESKU</h3>
										<p>Your child can be a genius</p>
									</div>
								</li>
								<li>
									<div class="wthree_banner_info_grid">
										<h3><span>Genius</span>Education <br>for everyone</h3>
										<p>Your child can be a genius</p>
									</div>
								</li>
								<li>
									<div class="wthree_banner_info_grid">
										<h3><span>Genius</span>Welcome to <br>LESKU</h3>
										<p>Your child can be a genius</p>
									</div>
								</li>
								<li>
									<div class="wthree_banner_info_grid">
										<h3><span>Genius</span>Education <br>for everyone</h3>
										<p>Your child can be a genius</p>
									</div>
								</li>
							</ul>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	<!-- //banner -->
	@yield('content')
	<!-- //Register -->
	<!--footer-->
	<div class="footer w3layouts">
		<div class="container">
			<div class="footer-row w3layouts-agile">
				<div class="col-md-4 footer-grids w3l-agileits">
					<h6><a href="index.html">LESKU</a></h6>
					<p class="footer-one-w3ls">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pulvinar tellus sed
						mauvehicula tempor. </p>
					<div class="top-header-agile-right">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-2 footer-grids w3l-agileits">
					<h6><a href="#">MENU</a></h6>
					<ul class="b-nav">
            <li><a href="/" data-hover="Home">Home</a></li>
            <li><a href="/about" data-hover="About Us">Tentang Kami</a></li>
            <li><a href="/product" data-hover="Services">Produk Kami</a></li>
						<li><a href="/contact" data-hover="Mail Us">Bantuan</a></li>
						<li><a href="/contact" data-hover="Mail Us">Kontak Kami</a></li>
					</ul>
				</div>
				<div class="col-md-4 footer-grids w3l-agileits">
					<h6><a href="/contact">CONTACT</a></h6>
					<p>Virginia, USA</p>
					<p>+0 097 338 004</p>
					<p>El Montee RV, Sterling USA</p>
					<p><a href="mailto:info@example.com">mail@example.com</a></p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--//footer-->
	<!-- copy-right -->
	<div class="copyright-wthree">
		<p>&copy; 2018 LESKU . All Rights Reserved | Design by <a href="http://mawait.mawadrata.com/"> MAWA IT SOLUTION </a></p>
	</div>
	<!-- //copy-right -->

	<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- //smooth scrolling -->


	<script type="text/javascript" src="{{ url('') }}/assets/js_1/jquery-2.1.4.min.js"></script>
	<!-- datepicker -->
	<script src="{{ url ('/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<!-- flexSlider -->
	<script defer src="{{ url('') }}/assets/js_1/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				start: function (slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>
	<!-- //flexSlider -->
	<!-- requried-jsfiles-for owl -->
	<script src="{{ url('') }}/assets/js_1/owl.carousel.js"></script>
	<script>
		$(document).ready(function () {
			$("#owl-demo2").owlCarousel({
				items: 1,
				lazyLoad: false,
				autoPlay: true,
				navigation: false,
				navigationText: false,
				pagination: true,
			});
		});
	</script>
	<!-- //requried-jsfiles-for owl -->
	<!-- Countdown-Timer-JavaScript -->
	<script src="{{ url('') }}/assets/js_1/simplyCountdown.js"></script>
	<script>
		var d = new Date(new Date().getTime() + 948 * 120 * 120 * 2000);

		// default example
		simplyCountdown('.simply-countdown-one', {
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate()
		});

		// inline example
		simplyCountdown('.simply-countdown-inline', {
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate(),
			inline: true
		});

		//jQuery example
		$('#simply-countdown-losange').simplyCountdown({
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate(),
			enableUtc: false
		});
	</script>
	<!-- //Countdown-Timer-JavaScript -->


	<!--search-bar-->
	<script src="{{ url('') }}/assets/js_1/main.js"></script>
	<!--//search-bar-->


	<!-- start-smoth-scrolling -->
	<script type="text/javascript" src="assets/js_1/move-top.js"></script>
	<script type="text/javascript" src="assets/js_1/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //here ends scrolling icon -->
	<!--js for bootstrap working-->
	<!-- <script src="assets/js_1/bootstrap.min.js"></script> -->
	<script src="{{ url('') }}/assets/js_1/bootstrap.js"></script>
	<!-- //for bootstrap working -->
</body>

</html>
