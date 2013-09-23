@extends('backend/layouts/medias')

{{-- Page title --}}
@section('title')
Thư viện của tôi ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row" style="padding-left: 25px;">
    @foreach ($images as $image)
      <div rel="{{ $image->id }}" style="width: 110px; float: left; margin: 5px 5px; ">
        <div class="thumbnail">
          <div style="height:100px;">
            <img src="{{ asset($image->mpath .'/100x100_crop/'. $image->mname ) }}" width="100" />
          </div>
          <div class="caption">
            <div class="action_buttons">
              <a class="delete_toggler label label-info" rel="{{ $image->id }}" onclick="parent.image_send_to_editor('{{ $image->mpath.'/520x500/'.$image->mname }}');">Thêm</a>

              <a class="delete_toggler label label-important" rel="{{ $image->id }}">Xóa</a>
              <a class="label label-default" href="javascript:void(0);" onclick="setNewsCover('', '{{ $image->id }}')">Ảnh đại diện</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
</div>
{{ $images->links() }}
@stop
