<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a href="/admin" class="accordion-toggle">
          <span class="glyphicon glyphicon-home"></span> Dashboard
        </a>
      </h4>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          <span class="glyphicon glyphicon-pencil"></span> Bài viết
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse  {{ ((Request::is('admin/news*') || Request::is('admin/categories*') || Request::is('admin/tags*') || Request::is('admin/comments*')) ? ' show' : 'collapse') }}">
      <div class="panel-body">
      	  @if ( Sentry::getUser()->hasAnyAccess(['news','news.create']) )
		  	<a href="{{ route('create/news') }}" class="{{ (Request::is('admin/news/create') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Đăng bài mới</a>
		  @endif
		  <a href="{{ URL::to('admin/news') }}" class="{{ (Request::is('admin/news') ? ' active"' : '') }}"><i class="icon-chevron-right"></i> Danh sách bài</a></a>
		  <a href="{{ URL::to('admin/categories') }}" class="{{ (Request::is('admin/categories*') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Chuyên mục</a>
		  <a href="{{ URL::to('admin/tags') }}" class="{{ (Request::is('admin/tags*') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Chủ đề</a>
		  <a href="{{ URL::to('admin/comments') }}" class="{{ (Request::is('admin/comments*') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Bình luận</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          <span class="glyphicon glyphicon-cloud-upload"></span> Thư viện
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse  {{ (Request::is('admin/medias*') ? ' show' : 'collapse') }}">
      <div class="panel-body">
      	<a href="{{ URL::to('admin/medias/upload') }}" class="{{ (Request::is('admin/medias/upload') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Tải tệp tin</a>
      	<a href="{{ URL::to('admin/medias') }}" class="{{ (Request::is('admin/medias') || Request::is('admin/medias/my') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Thư viện</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          <span class="glyphicon glyphicon-book"></span> Trang thông tin
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse {{ (Request::is('admin/pages*') ? ' show' : 'collapse') }}">
      <div class="panel-body">
	      @if ( Sentry::getUser()->hasAnyAccess(['pages','pages.create']) )
		  	<a href="{{ route('create/page') }}" class="{{ (Request::is('admin/pages/create') ? ' active' : '') }}"><i class="icon-chevron-right"></i> Tạo mới</a>
		  @endif
		  <a href="{{ URL::to('admin/pages') }}" class="{{ (Request::is('admin/pages') ? ' active"' : '') }}"><i class="icon-chevron-right"></i> Danh sách trang</a></a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          <span class="glyphicon glyphicon-user"></span> Người dùng
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse {{ (Request::is('admin/users*') || Request::is('admin/groups*') ? ' show' : 'collapse') }}">
      <div class="panel-body">
      	<a href="{{ URL::to('admin/users') }}" class="{{ (Request::is('admin/users*') ? ' active' : '') }}"><i class="icon-user"></i> Người dùng</a>
      	<a href="{{ URL::to('admin/groups') }}" class="{{ (Request::is('admin/groups*') ? ' active' : '') }}"><i class="icon-user"></i> Nhóm người dùng</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
          <span class="glyphicon glyphicon-cog"></span> Thiết lập
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse">
      <div class="panel-body">
      </div>
    </div>
  </div>
</div>