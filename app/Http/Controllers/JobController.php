<?php

namespace App\Http\Controllers;

use App\Enums\SlipStatus;
use App\Models\Slip;
use Illuminate\Queue\Failed\FailedJobProviderInterface;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{

    /* TODO: Optimize this */
    public function requeue(Slip $slip)
    {

        $failedJobProvider = app(FailedJobProviderInterface::class);
        $failedJob = $failedJobProvider->find($slip->job_uuid);


        Queue::pushRaw($failedJob->payload);
        $slip->setStatus(SlipStatus::QUEUED);

        // Forget previous failed job
        $failedJobProvider->forget($slip->job_uuid);

        return Redirect()->back();
    }

    public function destroy(Slip $slip)
    {
        $failedJobProvider = app(FailedJobProviderInterface::class);

        $failedJob = $failedJobProvider->find($slip->job_uuid);
        $tmpPath = unserialize(json_decode($failedJob->payload)->data->command)->tmpPath;
        Storage::disk('local')->delete($tmpPath);
        $failedJobProvider->forget($slip->uuid);

        $slip->delete();
        return Redirect()->back();
    }
}
