<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Administration
			@show
		</title>
		<meta name="keywords" content="your, awesome, keywords, here" />
		<meta name="author" content="Jon Doe" />
		<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->		
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">

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

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap-datetimepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap-datetimepicker.pt-vi.js') }}"></script>
		<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('assets/js/admin.js') }}"></script>

	</head>

	<body>
		<!-- Container -->
		<div class="container">

			<!-- Notifications -->
			@include('frontend/notifications')

			<!-- Content -->
			<div style="padding-top: 5px;">				
			    <!--Body content-->
				@yield('content')
			</div>
		</div>

		<script type="text/javascript">
		</script>
	</body>
</html>
