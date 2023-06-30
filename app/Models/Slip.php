<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

/**
 * App\Models\Slip
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $thumb
 * @property string $mediable_type
 * @property int $mediable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Slip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereMediableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereMediableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slip whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slip extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'thumb'];

    public function getRouteKeyName()
    {
        return 'token';
    }

//    public static function create(array $attributes = []): Model|\Illuminate\Database\Eloquent\Builder
//    {
//        // TODO: improve, make sure its unique too.
//        $attributes['token'] = Str::random(6);
//
//        $model = static::query()->create($attributes);
//
//        return $model;
//    }
    public static function booted()
    {
        static::creating(function ($slip) {
            $slip->token = Str::random(6);
        });
    }

}
