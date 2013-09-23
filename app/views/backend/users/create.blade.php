@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Tạo người dùng ::
@parent
@stop

{{-- Page content --}}
@section('content')
<h3>
	<span class="glyphicon glyphicon-user"></span> Tạo người dùng mới
</h3>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">Thông tin cơ bản</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">Phân quyền</a></li>
</ul>

<form class="form-horizontal"role="form"  method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content" style="padding-top: 30px;">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- First Name -->
			<div class="form-group {{ $errors->has('first_name') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="first_name">Tên</label>
				<div class="col-lg-2">
					<input class="form-control" type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
					{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Last Name -->
			<div class="form-group {{ $errors->has('last_name') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="last_name">Tên đệm</label>
				<div class="col-lg-2">
					<input class="form-control" type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
					{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Email -->
			<div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="email">Email</label>
				<div class="col-lg-4">
					<input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email') }}" />
					{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password -->
			<div class="form-group {{ $errors->has('password') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="password">Mật khẩu</label>
				<div class="col-lg-4">
					<input class="form-control" type="password" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password Confirm -->
			<div class="form-group {{ $errors->has('password_confirm') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="password_confirm">Xác nhận mật khẩu</label>
				<div class="col-lg-4">
					<input class="form-control" type="password" name="password_confirm" id="password_confirm" value="" />
					{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Activation Status -->
			<div class="form-group {{ $errors->has('activated') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="activated">Kích hoạt</label>
				<div class="col-lg-2">
					<select class="form-control" name="activated" id="activated">
						<option value="1">@lang('general.yes')</option>
						<option value="0">@lang('general.no')</option>
					</select>
					{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Groups -->
			<div class="form-group {{ $errors->has('groups') ? 'error' : '' }}">
				<label class="control-label col-lg-2" for="groups">Nhóm</label>
				<div class="col-lg-3">
					<select class="form-control" name="groups[]" id="groups[]" multiple>
						@foreach ($groups as $group)
						<option value="{{ $group->id }}">{{ $group->name }}</option>
						@endforeach
					</select>

					<span class="help-block">
						Chọn nhóm để gán quyền cho người dùng, mỗi người dùng chỉ có quyền hạn trên các nhóm mà họ được gán quyền.
					</span>
				</div>
			</div>
		</div>

		<!-- Permissions tab -->
		<div class="tab-pane" id="tab-permissions">
			<br />
			<br />
			<div class="row">
			  <div class="col-md-3"></div>
			  <div class="col-md-3"><span class="label label-success">Cho phép</span></div>
			  <div class="col-md-3"><span class="label label-danger">Từ chối</span></div>
			  <div class="col-md-3"><span class="label label-warning">Kế thừa</span></div>
			</div>
			<br />
			<div class="control-group">
				<div class="controls">

					@foreach ($permissions as $area => $permissions)
					<fieldset>
						<legend>{{ $area }}</legend>

						@foreach ($permissions as $permission)
						<div class="row">
						  <div class="col-md-3">{{ $permission['label'] }}</div>
						  <div class="col-md-3"><input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}></div>
						  <div class="col-md-3"><input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}></div>						  
						  <div class="col-md-3">@if ($permission['can_inherit'])<input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>@endif</div>
						</div>

						@endforeach

					</fieldset>
					@endforeach

				</div>
			</div>
		</div>
	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('users') }}">Hủy</a>
			<button type="submit" class="btn btn-success">Cập nhật</button>
		</div>
	</div>
</form>
@stop
