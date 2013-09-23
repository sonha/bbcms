@extends('backend/layouts/widget')

{{-- Page title --}}
@section('title')
Thư viện của tôi ::
@parent
@stop
{{-- Page content --}}
@section('content')
<div class=""  >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thêm bài viết vào chủ đề</h4>
      </div>
      <div class="modal-body">
		<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }} row">
			<div class="col-lg-3">
				<select class="form-control" name="category_id" id="categoryId">
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
				<input class="form-control pull-left" type="text" name="key" id="keyword" value="{{ Input::old('key', (isset($keyword) ? $keyword : '')) }}" placeholder="tìm kiếm" />
			</div>
			<div class="col-lg-1">
				<button class="btn btn-default btn-info" id="searchNews">Tìm</button>
			</div>
		</div>
		<form method="post" action="{{ URL::to('admin/tags/addposts') }}" autocomplete="off" role="form">
			<!-- CSRF Token -->
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<input type="hidden" name="tag_id" id="tagId" value="{{ $tag_id }}" />
			<table class="table table-hover" id="postList">
				<thead>
					<tr>
						<th width="40">
				            <input type="checkbox" id="checkAll" value="1" />
						</th>
						<th class="span6">@lang('admin/news/table.title')</th>
						<th class="span2">Chuyên mục</th>
						<th width="150">Ngày</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($posts as $post)
					<tr>
						<td>
				            <input type="checkbox" id="itemid{{ $post->id }}-toggle-0" name="postids[]" value="{{ $post->id }}" />
						</td>					
						<td>		
							{{ $post->title }}
						</td>
						<td>
							@if($post->category)
								{{ $post->category->name }}
							@endif
						<td>
							<span title="{{ $post->publish_date }}">{{ $post->publish_date }}</span>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<input type="submit" name="submit" value="Thêm" class="btn btn-success" />
		</form>
		@if(isset($keyword)) 
			{{ $posts->appends(array('category_id' => $category_id, 'key' => $keyword))->links() }}
		@else
			@if(isset($status)) 
				{{ $posts->appends(array('status' => $status))->links() }}
			@else
				{{ $posts->links() }}
			@endif	
		@endif	
	      	
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
