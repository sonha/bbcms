@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Quản lý bình luận ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<h3>
    	<span class="glyphicon glyphicon-pencil"></span> Bình luận
    </h3>
    <div>    	
	    <ul class="nav nav-tabs">
		  <li {{ $status=='' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/comments') }}">Tất cả</a></li>
		  <li {{ $status=='on' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/comments?status=on') }}">Hiển thị</a></li>
		  <li {{ $status=='off' ? 'class="active"' : '' }}><a href="{{ URL::to('admin/comments?status=off') }}">Xét duyệt</a></li>
		</ul>
    </div><br />
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th width="30">#</th>
				<th class="span5">Nội dung</th>
				<th width="200">Người gửi</th>
				<th width="90">Trạng thái</th>
				<th width="100">Gửi lúc</th>
				<th width="60">@lang('table.actions')</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($comments as $comment)
			<tr>
				<td>{{ $comment->id }}</td>
				<td>
					<div>{{ $comment->content }}</div>
					<div style="font-size: 11px; color: #76797c; padding-top: 4px;"><strong>Trong bài:</strong> {{ $comment->post ? $comment->post->title : '' }}</div>
				</td>
				<td>{{ $comment->author ? $comment->author->first_name. ' ' .$comment->author->last_name .'<br />'. $comment->author->email : '' }}</td>
				<td>{{ $comment->status }}</td>
				<td>{{ $comment->created_at->diffForHumans() }}</td>
				<td>
					@if ( Sentry::getUser()->hasAnyAccess(['news','news.editcomment']) )
						<a href="{{ route('update/comment', $comment->id) }}" class="btn btn-default btn-xs">@lang('button.edit')</a>
					@endif
					<!-- <a href="{{ route('delete/comment', $comment->id) }}" class="btn btn-danger btn-xs">@lang('button.delete')</a> -->
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $comments->links() }}
@stop
