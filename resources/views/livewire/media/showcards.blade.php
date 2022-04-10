<div class="grid gap-8 self-center mx-20 mt-8 lg:grid-cols-3 md:grid-cols-2"><!-- Videocards -->
    @foreach($tags as $tag)
        <x-videocard :tag="$tag" message="media/stock1.jpg" />
    @endforeach
</div>
