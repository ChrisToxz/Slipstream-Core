<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use Illuminate\Console\Command;
use Log;

class Version extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get current version, but also check for new version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Checking for new version at '.now());

        $this->info('Current version is '.AppHelper::getVersion());

        if ($new_version = AppHelper::checkForNewerVersion()) {
            $this->alert("$new_version is now available!");
            $this->info('run `docker image pull` to update');
        } else {
            $this->info('This is the latest version of Slipstream');
        }
    }
}
