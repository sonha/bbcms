@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Sửa tin ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<h3>
    	<span class="glyphicon glyphicon-pencil"></span> Sửa bài viết
    </h3>
	<!-- Tabs -->
	<ul class="nav nav-tabs" style="margin: 15px 0">
		<li class="active"><a href="#tab-general" data-toggle="tab">Thông tin chung</a></li>
		<li><a href="#tab-meta-data" data-toggle="tab">Thẻ Meta</a></li>
	</ul>

	<form method="post" action="" autocomplete="off" role="form">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<div class="row">
			<div class="col-md-9" style="border-right: 1px solid #cccccc">
				<!-- Tabs Content -->
				<div class="tab-content">
					<!-- General tab -->
					<div class="tab-pane active" id="tab-general">
						<!-- Post Title -->
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label class="control-label" for="title">Tiêu đề</label>
							<input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title', $post->title) }}" />
						</div>

						<!-- excerpt -->
						<div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
							<label class="control-label" for="excerpt">Tóm tắt</label>
							<textarea class="form-control" name="excerpt" id="excerpt" value="excerpt" rows="3">{{ Input::old('excerpt', $post->excerpt) }}</textarea>
						</div>
						<hr />
						<!-- Content -->
						<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
							<div style="padding-bottom: 4px;">
								<label class="control-label" for="textareabox">Nội dung</label>
								<span class="pull-right"><a data-toggle="modal" href="#modal_updateMedia" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-cloud-upload"></i> Thêm ảnh</a></span>
							</div>
							<textarea class="form-control" name="content" id="textareabox" value="content" rows="40">{{ Input::old('content', $post->content) }}</textarea>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Luồng sự kiện</div>
							<div class="panel-body">
								<div id="topicList">
									@foreach($topics as $topic)
										<p><a href="javascript:void(0)" onclick="removeTaginPost('topic', '{{ $topic->id }}', this)" class="btn btn-default btn-xs">X</a> {{ $topic->name}}</p>
									@endforeach
								</div>
								<hr />
								<a data-toggle="modal" href="{{ URL::to('admin/tags/listpopup') }}" data-target="#modal_taglist" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus"></span> Thêm</a>

								<input type="hidden" name="topics" id="topicIds" value="{{ implode(',', $topicIds) }}" />
							</div>
						</div>
						<hr />
						<!-- Post Slug -->
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label class="control-label" for="slug">Đường dẫn</label>
							<div class="input-group">
							  <span class="input-group-addon">{{ str_finish(URL::to('/'), '/') }}</span>
							  <input class="form-control" type="text" name="slug" id="slug" value="{{ Input::old('slug', $post->slug) }}">
							</div>
						</div>
					</div>

					<!-- Meta Data tab -->
					<div class="tab-pane" id="tab-meta-data">
						<!-- Meta Title -->
						<div class="form-group {{ $errors->has('meta-title') ? 'has-error' : '' }}">
							<label class="control-label" for="meta-title">Meta Title</label>
							<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{ Input::old('meta-title', $post->meta_title) }}" />
						</div>

						<!-- Meta Description -->
						<div class="form-group {{ $errors->has('meta-description') ? 'has-error' : '' }}">
							<label class="control-label" for="meta-description">Meta Description</label>
							<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{ Input::old('meta-description', $post->meta_description) }}" />
						</div>

						<!-- Meta Keywords -->
						<div class="form-group {{ $errors->has('meta-keywords') ? 'has-error' : '' }}">
							<label class="control-label" for="meta-keywords">Meta Keywords</label>
							<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{ Input::old('meta-keywords', $post->meta_keywords) }}" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 colright">
				<!-- Form actions -->
				<div>
					<div class="panel panel-default">
						<div class="panel-heading">Xuất bản</div>
						<div class="panel-body">
							<div class="pull-left">
								<select name="status" class="form-control">
									@if ( Sentry::getUser()->hasAnyAccess(['news','news.publish']) )
										<option value="draft" {{ $post->status=='draft' ? 'selected="selected"' : '' }}>Bản nháp</option>
										<option value="submitted" {{ $post->status=='submitted' ? 'selected="selected"' : '' }}>Xét duyệt</option>									
										<option value="published" {{ $post->status=='published' ? 'selected="selected"' : '' }}>Xuất bản</option>
									@elseif ( $post->status=='published' )
										<option value="published" {{ $post->status=='published' ? 'selected="selected"' : '' }}>Xuất bản</option>
									@else
										<option value="draft" {{ $post->status=='draft' ? 'selected="selected"' : '' }}>Bản nháp</option>
										<option value="submitted" {{ $post->status=='submitted' ? 'selected="selected"' : '' }}>Xét duyệt</option>
									@endif
								</select>
							</div>
							<div class="controls pull-right">
								<button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> Lưu</button>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<div class="panel panel-default">
					<div class="panel-heading">Ngày đăng</div>
					<div class="panel-body">
		                <div class="form-group {{ $errors->has('publish_date') ? 'has-error' : '' }}">
			                <div id="datetimepicker" class="date input-group">
								<span class="input-group-addon" style="padding: 6px 9px;"><i data-time-icon="icon-time" data-date-icon="icon-calendar" class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" readonly type="text" name="publish_date" id="publish_date" value="{{ Input::old('publish_date', $post->publish_date) }}" />
			                </div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Chuyên mục</div>
					<div class="panel-body">
						<div id="category-list">
							@foreach($categories as $category)
								@if($category->parent_id == 0)
									<div class="checkbox">
									  <label id="category-id-{{ $category->id }}" {{ $category->id == $post->category_id ? 'style="font-weight: bold;"' : '' }}>
									    <input name="categories[]" type="checkbox" value="{{ $category->id}}" {{ in_array($category->id, $catIds) ? 'checked="checked"' : ''}}> {{ $category->name}} 
									    <a href="javascript:void(0)" onclick="setPrimaryCat('{{ $post->id }}', '{{ $category->id }}')" style="display: none">set</a>
									  </label>
									</div>
									@foreach ($category->subscategories as $subcate)
										<div class="checkbox">
										  <label id="category-id-{{ $subcate->id }}" {{ $subcate->id == $post->category_id ? 'style="font-weight: bold;"' : '' }}>
										    <input name="categories[]" type="checkbox" value="{{ $subcate->id}}" {{ in_array($subcate->id, $catIds) ? 'checked="checked"' : ''}}> - {{ $subcate->name}} 
										    <a href="javascript:void(0)" onclick="setPrimaryCat('{{ $post->id }}', '{{ $subcate->id }}')" style="display: none">set</a>
										  </label>
										</div>
									@endforeach
								@endif
							@endforeach
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Ảnh đại diện</div>
					<div class="panel-body">
					  <div class="form-group">
					    <p class="help-block" id="cover-image">
					    	@if($media)
					    		<img src="{{ asset($media->mpath . '/180x100_crop/' . $media->mname) }}" width="175" />
					    		<a class="label label-default" href="javascript:void(0)" onclick="removeNewsCover()" >Bỏ ảnh</a>
					    	@else
					    		Chưa có ảnh đại diện
					    	@endif
					    </p>
					    <input type="hidden" name="media_id" value="{{ $post->media_id }}" id="media-cover-id" />
					  </div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Tags</div>
					<div class="panel-body">
						<div style="margin-bottom: 5px; padding-bottom: 5px; border-bottom: 1px solid #eeeeee">
							<input type="text" name="tagname" id="tagName" class="form-control" value="" />
						</div>
						<div id="tagList">
							@foreach($tags as $tag)
								<p><a href="javascript:void(0)" onclick="removeTaginPost('tag', '{{ $tag->id }}', this)" class="btn btn-default btn-xs">X</a> {{ $tag->name}}</p>
							@endforeach
							<input type="hidden" name="tags" id="tagIds" value="{{ implode(',', $tagIds) }}" />
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Tùy chọn thêm</div>
					<div class="panel-body">
						<div class="checkbox">
							<label><input type="checkbox" name="is_featured" value="1" {{ $post->is_featured ? 'checked="checked"' : ''}}> Nổi bật</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="is_popular" value="1" {{ $post->is_popular ? 'checked="checked"' : ''}}> Tin nhanh</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="showon_homepage" value="1" {{ $post->showon_homepage ? 'checked="checked"' : ''}}> Hiện ngoài trang chủ</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="allow_comments" value="1" {{ $post->allow_comments ? 'checked="checked"' : ''}}> Cho phép bình luận</label>
						</div>
					</div>
				</div>
				@if ( $post->status=='published' && Sentry::getUser()->hasAnyAccess(['news','news.editpublish']) || Sentry::getUser()->hasAnyAccess(['news','news.delete']) )
					<a onclick="confirmDelete(this); return false;" href="{{ route('delete/news', $post->id) }}" class="btn btn-danger btn-xs">@lang('button.delete')</a>
				@endif
			</div>
		</div>

	</form>

<div class="modal fade" id="modal_taglist" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="modalTagList" ></div>
<!-- Upload image -->
<div class="modal fade" id="modal_updateMedia" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Thư viện</h4>
      </div>
      <div class="modal-body">
        <iframe frameborder="0" hspace="0" src="<?=url('medias/upload')?>" id="TB_iframeContent" name="TB_iframeContent131" style="height: 480px; width: 100%">This feature requires inline frames. You have iframes disabled or your browser does not support them.</iframe>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
