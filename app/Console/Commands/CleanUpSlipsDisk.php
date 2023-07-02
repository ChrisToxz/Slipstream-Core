<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class CleanUpSlipsDisk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:cleanslips {--migrate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all `slips` in Slips file disk';

    /**
     * Execute the console command.
     */

    // TODO: Check if Slip contains in DB as well, and remove, for now will ask to just do a `migrate:fresh`
    public function handle()
    {
        if ($this->option('migrate') || $this->confirm('Do you want to run `migrate:fresh` as well?', true)) { // Temporary just default yes
            Artisan::call('migrate:fresh');
            $this->info('`migrate:fresh` ran successfully');
        }

        $disk = Storage::disk('slips');

        $dirs = $disk->directories();

        $deleted = 0;
        foreach ($dirs as $dir) {
            $disk->deleteDirectory($dir);
            $this->info('Deleted directory: ' . $dir);
            $deleted++;
        }

        $this->info('Disk cleanup completed, deleted ' . $deleted . ' directories');
    }
}
