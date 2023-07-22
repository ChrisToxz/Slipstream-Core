<?php

namespace App\Console\Commands;

use App\Models\Slip;
use Illuminate\Console\Command;
use Storage;

class CrossCheckSlips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ss:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cross check Slips records and Slips folders';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $choice = $this->choice('Check Slips, folders or both?', ['both', 'slips', 'folders'], 0);

        $slips = Slip::all();
        $folders = collect(Storage::disk('slips')->directories());

        $invalid_folders = [];
        $invalid_slips = [];

        if ($choice === 'slips' or $choice === 'both') {
            $this->info('Checking Slips...');
            foreach ($slips as $slip) {
                if (!$folders->contains($slip->token)) {
                    $invalid_slips[] = $slip->token;
                }
            }
        }

        if ($choice === 'folders' or $choice === 'both') {
            $this->info('Checking Folders...');
            foreach ($folders as $folder) {
                if (!$slips->contains(function ($key) use ($folder) {
                    return $key->token === $folder;
                })) {
                    $invalid_folders[] = $folder;
                }
            }
        }

        $count_folders = count($invalid_folders);
        $count_slips = count($invalid_slips);


        if ($count_folders or $count_slips > 0) {
            $this->alert('Slips and/or folders not matching');
            $this->error("{$count_slips} folder(s) not found (Slip found, but no folder in database)");
            $this->line(implode(",", $invalid_slips));
            $this->error("{$count_folders} slip(s) not found (Folder found, but no Slip in database)");
            $this->line(implode(",", $invalid_folders));


            if ($this->confirm('Do you want to clean up those Slips and/or folders?',
                false)) {
                foreach ($invalid_folders as $folder) {
                    $this->info("Deleting folder {$folder}");
                    Storage::disk('slips')->deleteDirectory($folder);
                }

                foreach ($invalid_slips as $slip) {
                    $this->info("Deleting slip {$slip}");
                    Slip::where('token', $slip)->delete();
                }
                $this->alert('Cleaned!');
            }
        } else {
            $this->info('All Slips and Folders are matching, nothing to clean up!');
        }

    }
}
