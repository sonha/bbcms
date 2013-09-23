@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Quản lý chuyên mục ::
@parent
@stop

{{-- Page content --}}
@section('content')
	<h3>
    	<span class="glyphicon glyphicon-pencil"></span> Chuyên mục
    	@if ( Sentry::getUser()->hasAnyAccess(['news','news.createcategory']) )
    		<a href="{{ route('create/category') }}" class="btn btn-default btn-xs">Tạo chuyên mục</a>
    	@endif
    </h3>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="span6">Id</th>
				<th class="span6">Chuyên mục</th>		
				<th class="span2">Thứ tự Menu</th>
				<th class="span2">Thứ tự Homepage</th>
				<th class="span2">Trạng thái</th>
				<th class="span2">@lang('table.actions')</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $category)
				@if($category->parent_id == 0)
					<tr>
						<td>{{ $category->id }}</td>
						<td><strong>{{ $category->name }}</strong></td>
						<td>{{ $category->showon_menu }}</td>
						<td>{{ $category->showon_homepage }}</td>
						<td>{{ $category->status }}</td>
						<td>
							@if ( Sentry::getUser()->hasAnyAccess(['news','news.editcategory']) )
								<a href="{{ route('update/category', $category->id) }}" class="btn btn-default btn-xs">@lang('button.edit')</a>
							@endif
						</td>
					</tr>
					@foreach ($category->subscategories as $subcate)						
						<tr>
							<td>{{ $subcate->id }}</td>
							<td> - - {{ $subcate->name }}</td>
							<td>{{ $subcate->showon_menu }}</td>
							<td>{{ $subcate->showon_homepage }}</td>
							<td>{{ $subcate->status }}</td>
							<td>
								@if ( Sentry::getUser()->hasAnyAccess(['news','news.editcategory']) )
									<a href="{{ route('update/category', $category->id) }}" class="btn btn-default btn-xs">@lang('button.edit')</a>
								@endif
							</td>
						</tr>
					@endforeach
				@endif
			@endforeach
		</tbody>
	</table>
@stop
