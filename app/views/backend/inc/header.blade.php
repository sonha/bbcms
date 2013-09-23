<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<div>
				<div class="col-md-8">
					<ul class="nav navbar-nav">
						<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{ URL::to('admin') }}"><i class="glyphicon glyphicon-tree-conifer"></i> <strong>BBCMS</strong></a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="nav navbar-nav" style="float: right">
						<li><a href="{{ URL::to('/') }}">Xem trang chủ</a></li>
						<li class="divider-vertical"></li>
						<li><a href="{{ route('logout') }}">Thoát</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>