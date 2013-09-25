<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Admin CP
			@show
		</title>
		<meta name="keywords" content="bbcms" />
		<meta name="author" content="BinhBEER" />
		<meta name="description" content="Content management system." />

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
		<script src="{{ asset('assets/js/bootstrap/typeahead.min.js') }}"></script>
		<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('assets/js/admin.js') }}"></script>		
	</head>

	<body>
		<!-- Container -->
		<div class="container">
			<!-- Header -->
			@include('backend/inc/header')

			<div class="row">
				<div class="col-md-2 sidebar">
					<!-- Nav -->
					@include('backend/inc/nav')
				</div>
				<div class="col-md-10">
					<!-- Notifications -->
					@include('frontend/notifications')
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
		        <div class="col-md-3" align="center">
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

			    jQuery('input#tagName').typeahead({
				  name: 'tagname',
				  local: ['Bình BEER', 'BBCMS'],
				  valueKey: 'name',
				  remote: {
				  	url: '/admin/tags/ajaxlist?keyword=%QUERY',
				  }
				});

			    CKEDITOR.replace('textareabox',{ toolbar:'CusToolbar', height: '400px'} );

			    $("#category-list").mouseleave(function(){
			        $("#category-list a").css("display", "none");
			    });

			    $("#category-list label").hover(function() {        
			        $("#category-list label a").css("display", "none");
			        $(this).children("a").css("display", "inline-block");
			    });
			});
		</script>
		
		<style>
		@section('styles')
		body {
			padding: 60px 0;
		}
		@show
		</style>
	</body>
</html>
