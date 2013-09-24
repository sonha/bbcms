@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
{{ $post->title }} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')

@parent
@stop

{{-- Update the Meta Description --}}
@section('meta_description')

@parent
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')

@parent
@stop

{{-- Page content --}}
@section('content')
<h3>{{ $post->title }}</h3>

<p><strong>{{ $post->excerpt }}</strong></p>
<p>{{ $post->content }}</p>

<div>
	<span class="badge badge-info" title="{{ $post->created_at }}">Đăng {{ $post->created_at->diffForHumans() }}</span>
</div>

<hr />

<a id="comments"></a>
<h4>{{ $comments->count() }} Phản hồi</h4>

@if ($comments->count())
@foreach ($comments as $comment)
<div class="row">
	<div class="col-lg-2">
		<img class="thumbnail" src="{{ $comment->author->gravatar() }}" alt="">
	</div>
	<div class="col-lg-10">
		<div class="row">
			<div class="span11">
				<div class="comment-info">
					<span class="muted"><strong>{{ $comment->author->fullName() }}</strong></span>
					&bull;
					<span title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>
				</div>
				<p>{{ $comment->content() }}</p>
			</div>
		</div>
	</div>
</div>
<hr />
@endforeach
@else
<hr />
@endif

@if ( ! Sentry::check())
Bạn cần phải <a href="{{ route('signin') }}">đăng nhập</a> để gửi phản hồi.
@else
<h4 align="center">Gửi phản hồi</h4>
<form method="post" action="{{ route('view-post', array($post->category->slug, $post->slug)) }}">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Comment -->
	<div class="form-group{{ $errors->first('comment', ' error') }}">
		<textarea class="input-block-level form-control" rows="4" name="comment" id="comment">{{ Input::old('comment') }}</textarea>
		{{ $errors->first('comment', '<span class="help-inline">:message</span>') }}
	</div>

	<!-- Form actions -->
	<div class="form-group">
		<div class="controls">
			<input type="submit" class="btn" id="submit" value="Gửi" />
		</div>
	</div>
</form>
@endif
@stop
