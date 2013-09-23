@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Đổi thông tin cá nhân
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
	<h4>Đổi thông tin cá nhân</h4>
</div>

<form method="post" action="" class="form-horizontal" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- First Name -->
	<div class="form-group{{ $errors->first('first_name', ' has-error') }}">
		<label class="col-lg-3 control-label" for="first_name">Tên</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }}" />
			{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Last Name -->
	<div class="form-group{{ $errors->first('last_name', ' has-error') }}">
		<label class="col-lg-3 control-label" for="last_name">Họ</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}" />
			{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Website URL -->
	<div class="form-group{{ $errors->first('website', ' has-error') }}">
		<label class="col-lg-3 control-label" for="website">Trang chủ</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="website" id="website" value="{{ Input::old('website', $user->website) }}" />
			{{ $errors->first('website', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Country -->
	<div class="form-group{{ $errors->first('country', ' has-error') }}">
		<label class="col-lg-3 control-label" for="country">Quốc gia</label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="country" id="country" value="{{ Input::old('country', $user->country) }}" />
			{{ $errors->first('country', '<span class="help-block">:message</span>') }}
		</div>
	</div>

	<!-- Gravatar Email -->
	<div class="form-group{{ $errors->first('gravatar', ' has-error') }}">
		<label class="col-lg-3 control-label" for="gravatar">Gravatar Email <small>(Private)</small></label>
		<div class="col-lg-7">
			<input class="form-control" type="text" name="gravatar" id="gravatar" value="{{ Input::old('gravatar', $user->gravatar) }}" />
			{{ $errors->first('gravatar', '<span class="help-block">:message</span>') }}
			<hr />
			<div>
				<img src="//secure.gravatar.com/avatar/{{ md5(strtolower(trim($user->gravatar))) }}" width="30" height="30" />
				<a href="http://gravatar.com">Thay đổi hình đại diện tại Gravatar.com</a>.
			</div>
		</div>
	</div>

	<hr />

	<!-- Form actions -->
	<div class="form-group">
		<div class="col-lg-offset-3 col-lg-7">
			<button type="submit" class="btn">Cập nhật</button>
		</div>
	</div>
</form>
@stop
