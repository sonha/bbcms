@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
	<div class="jumbotron">
	  <div class="container">
	    <h1>BBCMS! <small> - Editor version - </small></h1>
	    <p>
	    	<h4>Simple is best - free cms!</h4>
	    	<hr />
	    </p>
	    <p align="center">	    	
	    	<a class="btn btn-danger btn-lg" href="https://github.com/binhbeer/bbcms" target="_blank">DOWNLOAD BBCMS</a><br />
	    	<small>v1.0 beta</small>
	    </p>
	  </div>
	</div>
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

    <div>
    	<div class="fb-like-box" data-href="https://www.facebook.com/bbcmsvn" data-width="750" data-height="185" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
    </div>
@stop
