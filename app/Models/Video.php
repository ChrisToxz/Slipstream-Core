<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // TODO: CHECK
    protected $guarded = [];
    protected $appends = ['path', 'local_path', 'formatted_duration'];

    public function slip()
    {
        return $this->morphOne(Slip::class, 'mediable');
    }

    protected function path(): Attribute
    {
        return new Attribute(
            get: fn() => \Storage::disk('slips')->url($this->slip->token . '/' . $this->file)
        );
    }

    protected function localPath(): Attribute
    {
        return new Attribute(
            get: fn() => $this->slip->token . '/' . $this->file
        );
    }

    protected function formattedDuration(): Attribute
    {
        return new Attribute(
            get: fn() => gmdate("i:s", $this->duration)
        );
    }
}
