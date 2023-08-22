<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;

class CleanAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:clean-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean all Slips and temp files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->alert('This will delete all temporary files and Slips!');
        if (confirm('Are you sure you want to continue?', false)) {
            Artisan::call('ss:clean-temp --force');
            $this->info(Artisan::output());
            Artisan::call('ss:clean-slips --force');
            $this->info(Artisan::output());
        }

    }
}
