@extends('backend/layouts/default')

{{-- Web site Title --}}
@section('title')
Sửa nhóm người dùng ::
@parent
@stop

{{-- Content --}}
@section('content')
<h3>
	<span class="glyphicon glyphicon-user"></span> Sửa nhóm người dùng

	@if ( Sentry::getUser()->hasAnyAccess(['group','group.create']) )
		<a href="{{ route('create/group') }}" class="btn btn-xs btn-default"><i class="icon-plus-sign icon-white"></i> Tạo mới</a>
	@endif
</h3>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="row">
		<!-- General tab -->
		<div class="col-md-3" id="tab-general">
			<br /><br />
			<!-- Name -->
			<div class="{{ $errors->has('name') ? 'error' : '' }}">
				<label class="control-label" for="name">Tên nhóm</label>
				<input class="form-control" type="text" name="name" id="name" value="{{ Input::old('name', $group->name) }}" />
				{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
			</div>
			<!-- Form Actions --><br />
			<div>
				<div class="controls">
					<a class="btn btn-link" href="{{ route('groups') }}">Hủy</a>

					<button type="submit" class="btn btn-success btn-sm">Cập nhật</button>
				</div>
			</div>
		</div>
		<!-- Permissions tab -->
		<div class="col-md-8" id="tab-permissions">
			<br />
			<br />
			<div class="row">
			  <div class="col-md-4"></div>
			  <div class="col-md-4"><span class="label label-success">Cho phép</span></div>
			  <div class="col-md-4"><span class="label label-danger">Từ chối</span></div>
			</div>
			<br />
			<div class="controls">
				<div class="control-group">
					@foreach ($permissions as $area => $permissions)
					<fieldset>
						<legend>{{ $area }}</legend>

						@foreach ($permissions as $permission)

						<div class="row">
						  <div class="col-md-4">{{ $permission['label'] }}</div>
						  <div class="col-md-4"><input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($groupPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}></div>
						  <div class="col-md-4"><input type="radio" value="0" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($groupPermissions, $permission['permission']) ? ' checked="checked"' : '') }}></div>
						</div>
						@endforeach
					</fieldset>
					<br />
					<br />
					@endforeach

				</div>
			</div>
		</div>

	</div>

</form>
@stop
