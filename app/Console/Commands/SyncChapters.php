<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Comic;
use App\Services\ChapterService;

class SyncChapters extends Command
{
    protected $signature = 'sync:chapters {comicId} {--lang=en}';

    protected $description = 'Sync chapters for a specific MangaDex comic';

    public function handle(ChapterService $service)
    {
        $comicId = $this->argument('comicId');
        $lang = $this->option('lang');

        $comic = Comic::where('mangadex_id', $comicId)->first();

        if (!$comic) {
            $this->error("Comic tidak ditemukan di DB!");
            return;
        }

        $this->info("Sync chapters for: {$comic->title}");
        $this->info("MangaDex ID: $comicId");

        $service->syncChapters($comicId, $lang);

        $count = $comic->chapters()->count();
        $this->info("✔ Sync selesai! Total chapter: $count");
    }
}
