@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Thư viện ::
@parent
@stop

{{-- Page content --}}
@section('content')
<h3>
  <span class="glyphicon glyphicon-cloud-upload"></span> Thư viện

  @if ( Sentry::getUser()->hasAnyAccess(['group','group.create']) )
    <a href="{{ route('upload/media') }}" class="btn btn-xs btn-default"><i class="icon-plus-sign icon-white"></i> Tải tệp tin</a>
  @endif
</h3>
  <div>     
    <ul class="nav nav-tabs">
    <li {{ Request::is('admin/medias') ? 'class="active"' : '' }}><a href="{{ URL::to('admin/medias') }}">Tất cả</a></li>
    <li {{ Request::is('admin/medias/my') ? 'class="active"' : '' }}><a href="{{ URL::to('admin/medias/my') }}">Tôi</a></li>
  </ul>
  </div><br />
<div class="row" style="padding-left: 25px;">
    @foreach ($images as $image)
      <div rel="{{ $image->id }}" style="width: 110px; float: left; margin: 5px 5px; ">
        <div class="thumbnail">
          <div style="height:100px;">
            <img src="{{ asset($image->mpath .'/100x100_crop/'. $image->mname ) }}" width="100" />
          </div>
          <div class="caption">
            <div class="action_buttons">
              @if ( Sentry::getUser()->hasAnyAccess(['medias','medias.delete']) )
                <a onclick="confirmDelete(this); return false;" href="{{ route('delete/media', $image->id) }}" class="btn btn-danger btn-xs">@lang('button.delete')</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach
</div>
{{ $images->links() }}
@stop
