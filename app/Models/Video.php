<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // TODO: CHECK
    protected $guarded = [];


    public function slip()
    {
        return $this->morphOne(Slip::class, 'mediable');
    }

}
