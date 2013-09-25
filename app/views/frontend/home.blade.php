@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
	<h2>Tin mới</h2>
	<hr />
	@foreach ($posts as $post)
	<div class="row">
		<div class="span8">

			<!-- Post Content -->
			<div class="row">
				<div class="col-md-4">
					<a href="{{ $post->url() }}" class="thumbnail">					
						<img src="{{ asset($post->thumbnail->mpath . '/220x280_crop/' . $post->thumbnail->mname) }}" width="220" />
					</a>
				</div>
				<div class="col-md-8">
					<h4><strong><a href="{{ $post->url() }}">{{ $post->title }}</a></strong></h4>
					<blockquote>
						<small>
							<i class="icon-user"></i> Đăng bởi <span class="muted">{{ $post->author->first_name }} {{ $post->author->last_name }}</span>
							| <i class="icon-calendar"></i> {{ $post->created_at->diffForHumans() }}
							| <i class="icon-comment"></i> <a href="{{ $post->url() }}#comments">{{ $post->comments()->count() }} phản hồi</a>
						</small>
					</blockquote>
					<p>
						{{ $post->excerpt }}
					</p>
					<p><a class="btn btn-xs btn-info" href="{{ $post->url() }}">Đọc thêm...</a></p>
				</div>
			</div>

		</div>
	</div>

	<hr />
	@endforeach

	{{ $posts->links() }}
@stop
