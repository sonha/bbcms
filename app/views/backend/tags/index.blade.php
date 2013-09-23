@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Quản lý Chủ đề ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<h3>
    	<span class="glyphicon glyphicon-pencil"></span> Chủ đề 
    	@if ( Sentry::getUser()->hasAnyAccess(['news','news.createtag']) )
    		<a href="{{ route('create/tag') }}" class="btn btn-default btn-xs">Tạo mới</a>
    	@endif
    </h3>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="span6">Tiêu đề</th>
				<th class="span2"></th>
				<th class="span2">Trạng thái</th>
				<th class="span2">Kiểu</th>
				<th class="span2">Số bài</th>
				<th class="span2">Ngày</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($tags as $tag)
				<tr>
					<td>
						@if ( Sentry::getUser()->hasAnyAccess(['news','news.edittag']) )
							<a href="{{ route('update/tag', $tag->id) }}"><strong>{{ $tag->name }}</strong></a>
						@else
							{{ $tag->name }}
						@endif
					</td>
					<td>{{ $tag->slug }}</td>
					<td>{{ $tag->status }}</td>
					<td>{{ $tag->type }}</td>
					<td>{{ $tag->news_count }}</td>
					<td>{{ $tag->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
