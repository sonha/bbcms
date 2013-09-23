@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	Có lỗi xảy ra, hãy kiểm tra lại các thông tin!
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	{{ $message }}
</div>
@endif
