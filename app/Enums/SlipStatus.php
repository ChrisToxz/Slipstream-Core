<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static STATUS_PENDING()
 * @method static static STATUS_PROCESSING()
 * @method static static STATUS_FINISHED()
 * @method static static STATUS_FAILED()
 */
final class SlipStatus extends Enum
{
    const PENDING = 'pending';
    const PROCESSING = 'processing';
    const FINISHED = 'finished';
    const FAILED = 'failed';
}
