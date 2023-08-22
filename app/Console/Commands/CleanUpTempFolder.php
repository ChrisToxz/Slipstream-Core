<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;

class CleanUpTempFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:clean-temp {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all files in temp folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force')) {
            $this->alert('Make sure no Slips are being queued, this will delete the temporary files.');
        }

        if ($this->option('force') || confirm('Do you really want to continue?', false)) {
            $disk = Storage::disk('tmp');

            $files = $disk->files();

            foreach ($files as $file) {
                $disk->delete($file);
            }
            info('Temp folder cleaned up');
        }


    }
}
