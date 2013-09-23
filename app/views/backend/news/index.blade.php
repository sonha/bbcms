@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Quản lý tin ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<h3>
    	<span class="glyphicon glyphicon-pencil"></span> Bài viết
    	@if ( Sentry::getUser()->hasAnyAccess(['news','news.create']) )
    		<a href="{{ route('create/category') }}" class="btn btn-default btn-xs">Tạo bài viết</a>
    	@endif
    </h3>
    <div>    	
	    <ul class="nav nav-tabs">
		  <li {{ $status=='' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/news') }}">Tất cả</a></li>
		  <li {{ $status=='published' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/news?status=published') }}">Xuất bản</a></li>
		  <li {{ $status=='submitted' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/news?status=submitted') }}">Xét duyệt</a></li>
		  <li {{ $status=='draft' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/news?status=draft') }}">Bản nháp</a></li>
		</ul>
    </div><br />
  	<form method="get" action="{{ route('search/news') }}" autocomplete="off" role="form" class="form-horizontal">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
			<div class="col-lg-3">
				<select class="form-control" name="category_id">
					<option value="0">Tất cả</option>
					@foreach($categories as $category)
						@if($category->parent_id == 0)
							<option value="{{ $category->id }}" {{ (isset($category_id) && $category->id == $category_id) ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
							@foreach ($category->subscategories as $subcate)
								<option value="{{ $subcate->id }}" {{ (isset($category_id) && $subcate->id == $category_id) ? 'selected="selected"' : '' }}> - {{ $subcate->name }}</option>
							@endforeach
						@endif
					@endforeach
				</select>
			</div>
			<div class="col-lg-4">
				<input class="form-control pull-left" type="text" name="key" id="key" value="{{ Input::old('key', (isset($keyword) ? $keyword : '')) }}" placeholder="tìm kiếm" />
			</div>
			<div class="col-lg-1">
				<input type="submit" class="btn btn-default btn-info" name="search" value="Tìm" />
			</div>
		</div>
  	</form>
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="span6">@lang('admin/news/table.title')</th>
				<th class="span2">Người đăng</th>
				<th class="span2">Chuyên mục</th>
				<th width="80">Phản hồi</th>
				<th width="150">Ngày</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($posts as $post)
			<tr>
				<td>					
					@if ( Sentry::getUser()->hasAnyAccess(['news','news.edit']) )
						<a href="{{ route('update/news', $post->id) }}"><strong>{{ $post->title }}</strong></a>
					@else
						{{ $post->title }}
					@endif
				</td>
				<td>{{ $post->author->first_name }} {{ $post->author->last_name }}</td>
				<td>
					@if($post->category)
						<a href="{{ URL::to('admin/news/search?category_id='.$post->category->id) }}"> {{ $post->category->name }}</a>
					@endif
				<td>{{ $post->comment_count }} <span class="glyphicon glyphicon-comment" style="color:#76797c"></span></td>
				<td>
					@if($post->status == 'published')
						<span title="{{ $post->publish_date }}">{{ $post->publish_date }}</span>
					@else
						<span title="{{ $post->created_at }}">{{ $post->created_at->diffForHumans() }}</span>
					@endif
					<br />
					{{ $post->status }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@if(isset($keyword)) 
		{{ $posts->appends(array('category_id' => $category_id, 'key' => $keyword))->links() }}
	@else
		@if(isset($status)) 
			{{ $posts->appends(array('status' => $status))->links() }}
		@else
			{{ $posts->links() }}
		@endif	
	@endif	
@stop
