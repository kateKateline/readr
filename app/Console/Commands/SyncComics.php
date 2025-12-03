<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ComicService;

class SyncComics extends Command
{
    protected $signature = 'sync:comics {limit=100}';
    protected $description = 'Sync comics from MangaDex API';

    public function handle(ComicService $service)
    {
        $limit = $this->argument('limit');

        $this->info("Syncing {$limit} comics...");

        $service->sync($limit);

        $this->info("Sync complete!");
    }
}
    