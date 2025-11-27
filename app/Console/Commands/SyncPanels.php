<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PanelBuilderService;

class SyncPanels extends Command
{
    protected $signature = 'sync:panels {mangaId}';
    protected $description = 'Generate chapter panels for a specific manga';

    public function handle(PanelBuilderService $service)
    {
        $mangaId = $this->argument('mangaId');

        $this->info("Memproses panel untuk manga $mangaId ...");

        $count = $service->buildPanelsForManga($mangaId);

        $this->info("✔ Panel selesai dibuat untuk $count chapter.");
    }
}
