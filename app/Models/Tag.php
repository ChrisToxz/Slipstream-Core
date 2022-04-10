<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = '';

    public function taggable(){
        return $this->morphTo();
    }

    public function media(){
        // Stupid fix..
        return $this->taggable();
    }

    public static function create(array $attributes = []): Model|\Illuminate\Database\Eloquent\Builder
    {
        // TODO: improve
        $attributes['tag'] = Str::random(4);

        $model = static::query()->create($attributes);

        return $model;
    }

    public function thumb()
    {
        if($this->taggable_type == Video::class){
            return $this->tag.'/thumb.jpg';
        }
        if($this->taggable_type == Image::class){
            return $this->tag.'/'.$this->media['original'];
        }
    }
}
