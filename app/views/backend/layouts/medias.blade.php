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
			<ul class="nav nav-tabs" id="mediaTab" style="padding-top:10px; width: 100%">
			  <li {{ (Request::is('medias/upload') ? ' class="active"' : '') }}><a href="{{ URL::to('medias/upload') }}">Tải tệp tin</a></li>
			  <li {{ (Request::is('medias/my') ? ' class="active"' : '') }}><a href="{{ URL::to('medias/my') }}">Thư viện của bạn</a></li>
			  <li {{ (Request::is('medias/index') ? ' class="active"' : '') }}><a href="{{ URL::to('medias/index') }}">Tất cả</a></li>
			</ul>
			<div style="padding-top: 15px;">				
			    <!--Body content-->
				@yield('content')
			</div>
		</div>

		<script type="text/javascript">
			function image_send_to_editor(photo_url) {
				var htmlContent = '<p align="center"><img src="/'+ photo_url +'" style="padding: 10px 0; width: 500px; text-align: center" /></p>';

				CKEDITOR.instances.textareabox.insertHtml(htmlContent);
				$('#modal_updateMedia').modal('hide');
			}
			
			$(document).ready(function(){
			    jQuery('#datetimepicker').datetimepicker({
			    	format: 'yyyy-MM-dd hh:mm:ss ',
			    	language: 'pt-BR'
			    });

			    CKEDITOR.replace('textareabox',{ toolbar:'CusToolbar', height: '500px'} );

			    $("#category-list").mouseleave(function(){
			        $("#category-list a").css("display", "none");
			    });

			    $("#category-list label").hover(function() {        
			        $("#category-list label a").css("display", "none");
			        $(this).children("a").css("display", "inline-block");
			    });
			});
		</script>
	</body>
</html>
