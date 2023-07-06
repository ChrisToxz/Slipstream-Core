<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class CleanAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:cleanall';

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
        Artisan::call('ss:clean-temp');
        $this->info(Artisan::output());
        Artisan::call('ss:cleanslips --migrate');
        $this->info(Artisan::output());
    }
}
