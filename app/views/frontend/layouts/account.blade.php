@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="span3">
		<ul class="nav nav-pills">
			<li{{ Request::is('account/profile') ? ' class="active"' : '' }}><a href="{{ URL::route('profile') }}">Thông tin cá nhân</a></li>
			<li{{ Request::is('account/change-password') ? ' class="active"' : '' }}><a href="{{ URL::route('change-password') }}">Đổi mật khẩu</a></li>
			<li{{ Request::is('account/change-email') ? ' class="active"' : '' }}><a href="{{ URL::route('change-email') }}">Đổi Email</a></li>
		</ul>
	</div>
	<div class="span9">
		@yield('account-content')
	</div>
</div>
@stop
