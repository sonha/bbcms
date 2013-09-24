<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			BBCMS v1.0
			@show
		</title>
		<meta name="keywords" content="bbcms" />
		<meta name="author" content="BinhBEER" />
		<meta name="description" content="Content Management System." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/frontend.css') }}" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
		<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
	</head>

	<body>
		<div id="fb-root"></div>
		<!-- Container -->
		<div class="container">
			<!-- Navbar -->
			<nav class="navbar navbar-danger" role="navigation" style="border-bottom: 1px solid #eee">
			  <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			      <span class="sr-only">Toggle navigation</span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			    </button>
			    <a class="navbar-brand" href="/">BBCMS</a>
			  </div>

			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse navbar-ex1-collapse">
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="/">Trang chủ</a></li>
			      <li class="dropdown">
			        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Chuyên mục <b class="caret"></b></a>
			        <ul class="dropdown-menu">
			        	@foreach( $categories as $category )
			        		@if($category->parent_id == 0)
				          		<li><a href="#">{{ $category->name }}</a></li>
				          		@foreach ($category->subscategories as $subcate)
				          			<li><a href="#"> - {{ $subcate->name }}</a></li>
								@endforeach
							@endif
			        	@endforeach
			        </ul>
			      </li>
				  
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			      @if (Sentry::check())
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Chào, {{ Sentry::getUser()->first_name }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
							@if(Sentry::getUser()->hasAccess('admin'))
								<li><a href="{{ route('admin') }}"><i class="icon-cog"></i> Quản trị</a></li>
							@endif
							<li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}"><i class="icon-user"></i> Thông tin cá nhân</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('logout') }}"><i class="icon-off"></i> Thoát</a></li>
						</ul>
					</li>
			      @else			      	
					<li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">Đăng nhập</a></li>
					<li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">Đăng kí</a></li>
			      @endif
			    </ul>
			  </div><!-- /.navbar-collapse -->
			</nav>
			<!-- Notifications -->
			@include('frontend/notifications')

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<!-- Content -->
					@yield('content')
				</div>
			</div>

			<hr />

			<!-- Footer -->
			<footer>
				<div class="col-md-9">
					<ul class="footer-links">
			          <li>
			          	BBCMS 1.0 &copy; {{ date('Y') }}<br />
			          	by <a href="http://cms.binhbeer.com" target="_blank">BinhBEER</a>
			          </li>
			          <li class="muted">·</li>
			          <li><a href="{{ route('view-page', 'gioi-thieu') }}"><i class="icon-file icon-white"></i> Giới thiệu</a></li>
			          <li class="muted">·</li>
			          <li><a href="{{ route('lien-he') }}"><i class="icon-file icon-white"></i> Liên hệ</a></li>
			        </ul>
		        </div>
		        <div class="col-md-3">
		        	Give me some beer to keep updating ... <hr />
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
						">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
		        </div>
			</footer>
		</div>

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>

		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=461580803910206";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-44253565-1', 'binhbeer.com');
		  ga('send', 'pageview');

		</script>
	</body>
</html>
