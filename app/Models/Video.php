<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = '';
    protected $morphClass = 'Video';

    protected $casts = [
        'info' => 'object'
    ];

    public function tag()
    {
        return $this->morphOne(Tag::class, 'taggable');
    }
}
