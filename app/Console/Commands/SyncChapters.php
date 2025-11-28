<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comic;
use App\Services\ChapterService;

class SyncChapters extends Command
{
    protected $signature = 'sync:chapters {comicId} {--lang= : Language code (optional, e.g., en, id, zh, ja). Leave empty to sync all languages}';

    protected $description = 'Sync chapters for a specific MangaDex comic';

    public function handle(ChapterService $service)
    {
        $comicId = $this->argument('comicId');
        $lang = $this->option('lang');

        $comic = Comic::where('mangadex_id', $comicId)->first();

        if (!$comic) {
            $this->error("Comic tidak ditemukan di DB!");
            return Command::FAILURE;
        }

        $this->info("Sync chapters for: {$comic->title}");
        $this->info("MangaDex ID: $comicId");
        
        if ($lang) {
            $this->info("Language: $lang");
        } else {
            $this->info("Language: ALL (semua bahasa)");
        }
        
        $this->newLine();

        // Tampilkan progress bar
        $this->output->write("Syncing chapters...");

        $result = $service->syncChapters($comicId, $lang);

        if (!$result['success']) {
            $this->error("\n✖ Sync gagal!");
            return Command::FAILURE;
        }

        $this->newLine();
        $this->info("✔ Sync selesai!");
        $this->table(
            ['Metric', 'Count'],
            [
                ['Berhasil disync', $result['synced']],
                ['Gagal', $result['failed']],
                ['Total diproses', $result['total']],
            ]
        );

        // Tampilkan total chapter di database untuk comic ini
        $totalInDb = $comic->chapters()->count();
        $this->info("Total chapter di database: $totalInDb");

        return Command::SUCCESS;
    }
}