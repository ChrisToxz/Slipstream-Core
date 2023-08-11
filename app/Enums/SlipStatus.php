<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static STATUS_QUEUED()
 * @method static static STATUS_STARTING()
 * @method static static STATUS_PROCESSING()
 * @method static static STATUS_FINISHED()
 * @method static static STATUS_FAILED()
 */
final class SlipStatus extends Enum
{
    const QUEUED = 'queued';

    const STARTING = 'starting';
    const PROCESSING = 'processing';
    const FINISHED = 'finished';
    const FAILED = 'failed';
}
