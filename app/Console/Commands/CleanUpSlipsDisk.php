<?php

namespace App\Console\Commands;

use App\Models\Slip;
use App\Services\SlipService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\confirm;

use function Laravel\Prompts\info;
use function Laravel\Prompts\warning;

class CleanUpSlipsDisk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:clean-slips {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all `slips` in Slips file disk';

    /**
     * Execute the console command.
     */
    public function handle(SlipService $slipService)
    {
        if (!$this->option('force')) {
            $this->alert('This command will delete all `slips` and related files');
        }


        if ($this->option('force') || confirm(
                'Are you sure you want to continue?',
                false
            )) {

            $deleted = 0;
            $slips = Slip::all();

            foreach ($slips as $slip) {
                $slipService->delete($slip);
                $deleted++;
            }
            info("Done! {$deleted} slips deleted");

            $folders = collect(Storage::disk('slips')->directories());

            if ($folders->count()) {
                $deleted = 0;
                warning('For some reasons we noticed there are still files in the `Slip` storage');
                if ($this->option('force') || confirm('Do you want to delete those too?', true)) {
                    foreach ($folders as $folder) {
                        Storage::disk('slips')->deleteDirectory($folder);
                        $deleted++;
                    }
                    info("Done! {$deleted} additional folders deleted");
                }
            }
        }
    }
}
