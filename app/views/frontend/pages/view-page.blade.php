@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
{{ $page->title }} ::
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
<h3>{{ $page->title }}</h3>

<p><strong>{{ $page->excerpt }}</strong></p>
<p>{{ $page->content }}</p>

<div>
	<span class="badge badge-info" title="{{ $page->created_at }}">Posted {{ $page->created_at->diffForHumans() }}</span>
</div>

@stop