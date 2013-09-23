@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Đăng tin mới ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<h3>
    	<span class="glyphicon glyphicon-pencil"></span> Đăng bài viết mới
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
			<div class="col-md-9">
				<!-- Tabs Content -->
				<div class="tab-content">
					<!-- General tab -->
					<div class="tab-pane active" id="tab-general">
						<!-- Post Title -->
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label class="control-label" for="title">Tiêu đề</label>
							<input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title') }}" />
						</div>

						<!-- excerpt -->
						<div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
							<label class="control-label" for="excerpt">Tóm tắt</label>
							<textarea class="form-control" name="excerpt" id="excerpt" value="excerpt" rows="3">{{ Input::old('excerpt') }}</textarea>
						</div>
						<hr />
						<!-- Content -->
						<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
							<div>
								<label class="control-label" for="textareabox">Nội dung</label>
								<span class="pull-right"><a data-toggle="modal" href="#modal_updateMedia" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-cloud-upload"></i> Thêm ảnh</a></span>
							</div>
							<textarea class="form-control" name="content" id="textareabox" value="content" rows="40">{{ Input::old('content') }}</textarea>
						</div>
						<hr />
						<!-- Post Slug -->
						<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							<label class="control-label" for="slug">Đường dẫn</label>
							<div class="input-group">
							  <span class="input-group-addon">{{ str_finish(URL::to('/'), '/') }}</span>
							  <input class="form-control" type="text" name="slug" id="slug" value="{{ Input::old('slug') }}">
							</div>
						</div>
					</div>

					<!-- Meta Data tab -->
					<div class="tab-pane" id="tab-meta-data">
						<!-- Meta Title -->
						<div class="form-group {{ $errors->has('meta-title') ? 'has-error' : '' }}">
							<label class="control-label" for="meta-title">Meta Title</label>
							<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{ Input::old('meta-title') }}" />
						</div>

						<!-- Meta Description -->
						<div class="form-group {{ $errors->has('meta-description') ? 'has-error' : '' }}">
							<label class="control-label" for="meta-description">Meta Description</label>
							<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{ Input::old('meta-description') }}" />
						</div>

						<!-- Meta Keywords -->
						<div class="form-group {{ $errors->has('meta-keywords') ? 'has-error' : '' }}">
							<label class="control-label" for="meta-keywords">Meta Keywords</label>
							<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{ Input::old('meta-keywords') }}" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<!-- Form actions -->
				<div>
					<div class="panel panel-default">
						<div class="panel-heading">Xuất bản</div>
						<div class="panel-body">
							<div class="pull-left">
								<select name="status" class="form-control">
									<option value="draft">Bản nháp</option>
									<option value="Submitted">Xét duyệt</option>
									<option value="published">Xuất bản</option>
								</select>
							</div>
							<div class="controls pull-right">
								<button type="submit" class="btn btn-success btn-sm">Lưu</button>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Ngày đăng</div>
					<div class="panel-body">
		                <div class="form-group {{ $errors->has('publish_date') ? 'has-error' : '' }}">
			                <div id="datetimepicker" class="date input-group">
								<span class="input-group-addon" style="padding: 6px 9px;"><i data-time-icon="icon-time" data-date-icon="icon-calendar" class="glyphicon glyphicon-calendar"></i></span>
								<input class="form-control" readonly type="text" name="publish_date" id="publish_date" value="{{ Input::old('publish_date') }}" />
			                </div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Chuyên mục</div>
					<div class="panel-body">
						@foreach($categories as $category)
							@if($category->parent_id == 0)
								<div class="checkbox">
								  <label>
								    <input name="categories[]" type="checkbox" value="{{ $category->id}}"> {{ $category->name}}
								  </label>
								</div>
								@foreach ($category->subscategories as $subcate)
									<div class="checkbox">
									  <label>
									    <input name="categories[]" type="checkbox" value="{{ $subcate->id}}">  - {{ $subcate->name}}
									  </label>
									</div>
								@endforeach
							@endif
						@endforeach
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Ảnh đại diện</div>
					<div class="panel-body">
					  <div class="form-group">
					    <p class="help-block" id="cover-image">Chưa có ảnh đại diện</p>
					    <input type="hidden" name="media_id" value="" id="media-cover-id" />
					  </div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Tùy chọn thêm</div>
					<div class="panel-body">
						<div class="checkbox">
							<label><input type="checkbox" name="is_featured" value="1"> Nổi bật</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="is_popular" value="1"> Tin nhanh</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="showon_homepage" value="1"> Hiện ngoài trang chủ</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="allow_comments" value="1"> Cho phép bình luận</label>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form>

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
