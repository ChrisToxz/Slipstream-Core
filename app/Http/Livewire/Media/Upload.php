<?php

namespace App\Http\Livewire\Media;

use App\Helpers;
use App\Models\Image;
use App\Models\Tag;
use App\Models\Video;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class Upload extends ModalComponent
{

    use WithFileUploads;

    public $media; //file
    public $title, $description; //fields

    public function updatedMedia()
    {
        //TODO: If video -> Create thumb for preview
        $this->validate([
            'media' => 'required|file|mimetypes:video/mp4,video/mpeg,image/jpeg,image/png,image/bmp',
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

    }

    public function upload()
    {
        $title  = $this->title ?? $this->media->getClientOriginalName();
        $hash   = $this->media->hashName();

        $tag = Tag::create([
            'title' => $title,
            'description' => $this->description,
        ]);

        if(Helpers\Media::isVideo($this->media->path())){
            $ffmpeg = FFMpeg::openUrl($this->media->path());

            $media = Video::create([
                'original' => $hash,
                'info'      => [
                    'size'              => round($this->media->getSize()/1000000), // to MB
                    'extension'         => $this->media->extension(),
                    'codec_name'        => $ffmpeg->getVideoStream()->get('codec_name'),
                    'codec_long_name'   => $ffmpeg->getVideoStream()->get('codec_long_name'),
                    'bit_rate'          => $ffmpeg->getVideoStream()->get('bit_rate'),
                    'width'             => $ffmpeg->getVideoStream()->get('width'),
                    'height'            => $ffmpeg->getVideoStream()->get('height'),
                    'r_frame_rate'      => $ffmpeg->getVideoStream()->get('r_frame_rate'),
                    'avg_frame_rate'    => $ffmpeg->getVideoStream()->get('avg_frame_rate'),
                    'tags'              => $ffmpeg->getVideoStream()->get('tags'),]
            ]);

            $ffmpeg->getFrameFromSeconds(0.1)->export()->toDisk('media')->save($tag->tag.'/thumb.jpg');


        }

        if(Helpers\Media::isImage($this->media->path())){
            list($w, $h) = getimagesize($this->media->path());

            $media = Image::create([
                'original' => $hash,
                'info' => [
                    'size'  => round($this->media->getSize()/1000000), // to MB
                    'width' => $w,
                    'height' => $h
                ]
            ]);
        }

        $this->media->storeAs($tag->tag, $hash, 'media');
        $media->tag()->save($tag);

        $this->dispatchBrowserEvent('resetform');
        $this->emit('refreshTags');
        toastr()->livewire()->addSuccess('Media uploaded!');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.media.upload');
    }
}
