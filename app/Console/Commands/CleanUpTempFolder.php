<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanUpTempFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:clean-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $disk = Storage::disk('tmp');

        $files = $disk->files();

        foreach ($files as $file) {
            $disk->delete($file);
        }

        $this->info('Temp folder cleaned up');
    }
}
