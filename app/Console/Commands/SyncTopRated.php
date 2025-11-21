<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ComicService;

class SyncTopRated extends Command
{
    protected $signature = 'sync:toprated {limit=20}';
    protected $description = 'Sync top rated comics from MangaDex API';

    public function handle(ComicService $service)
    {
        $limit = $this->argument('limit');

        $this->info("Syncing {$limit} top rated comics...");

        $service->syncTopRated($limit);

        $this->info("Top rated sync complete!");
    }
}