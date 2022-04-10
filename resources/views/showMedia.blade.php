@if($tag->isVideo)
<video controls>
    <source src="{{url('storage/media/'.$tag->tag.'/'.$tag->media->original)}}" type="video/mp4">
</video>
@elseif($tag->isImage)
<img src="{{url('storage/media/'.$tag->tag.'/'.$tag->media->original)}}"/>
@endif
