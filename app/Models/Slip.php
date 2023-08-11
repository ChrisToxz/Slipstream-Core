<?php

namespace App\Models;

use App\Enums\SlipStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Storage;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Slip newModelQuery()
 * @method static Builder|Slip newQuery()
 * @method static Builder|Slip query()
 * @method static Builder|Slip whereCreatedAt($value)
 * @method static Builder|Slip whereDescription($value)
 * @method static Builder|Slip whereId($value)
 * @method static Builder|Slip whereMediableId($value)
 * @method static Builder|Slip whereMediableType($value)
 * @method static Builder|Slip whereThumb($value)
 * @method static Builder|Slip whereTitle($value)
 * @method static Builder|Slip whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Slip extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'thumb'];
    protected $appends = ['thumb'];


    public function getRouteKeyName()
    {
        return 'token';
    }

    public function mediable()
    {
        return $this->morphTo();
    }


    protected function thumb(): Attribute
    {
        return new Attribute(
            get: fn() => Storage::disk('slips')->url($this->token.'/thumb.jpg')
        );
    }

    public function setJobUuid($uuid)
    {
        $this->job_uuid = $uuid;
        $this->save();
    }


    public function setStatus($status)
    {

        if (in_array($status, SlipStatus::getValues())) {
            $this->status = $status;
            $this->save();
        }

        return $this;
    }

    public static function booted()
    {
        // TODO: Make sure its unique!
        static::creating(function ($slip) {
            $slip->token = Str::random(6);
        });
    }

}
