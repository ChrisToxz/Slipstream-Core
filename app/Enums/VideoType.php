<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Original()
 * @method static static X264()
 * @method static static HLS()
 */
final class VideoType extends Enum
{
    const Original =   1;
    const X264 =   2;
    const HLS = 3;
}
