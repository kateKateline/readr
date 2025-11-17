<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Manga;

class SyncManga extends Command
{
    protected $signature = 'manga:sync';
    protected $description = 'Ambil manga dari API Mangadex dan simpan ke database';

    public function handle()
    {
        $url = "https://api.mangadex.org/manga?limit=20&includes[]=cover_art&order[followedCount]=desc";
        $response = Http::get($url);

        if ($response->failed()) {
            $this->error("Gagal mengambil data");
            return;
        }

        $data = $response->json()['data'] ?? [];

        foreach ($data as $item) {

            $attr = $item['attributes'];

            $title = $attr['title']['en']
                ?? $attr['title']['ja']
                ?? $attr['title']['jp']
                ?? 'No Title';

            $type = $attr['originalLanguage'] ?? 'Unknown';

            // ambil cover
            $cover = collect($item['relationships'])
                ->firstWhere('type', 'cover_art');

            $coverFile = $cover['attributes']['fileName'] ?? null;

            Manga::updateOrCreate(
                ['manga_id' => $item['id']],
                [
                    'title'      => $title,
                    'type'       => $type,
                    'cover_file' => $coverFile
                ]
            );
        }

        $this->info("Berhasil sync manga!");
    }
}
