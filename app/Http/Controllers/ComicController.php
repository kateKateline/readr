<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    public function show($slug)
    {
        // Cari data comic sesuai slug
        // Coba beberapa variasi slug untuk toleransi (raw, urldecoded, slugified)
        $decoded = urldecode($slug);
        $slugified = Str::slug($slug);

        Log::info('ComicController@show requested slug', ['slug' => $slug, 'decoded' => $decoded, 'slugified' => $slugified]);

        $comic = Comic::where('slug', $slug)
                      ->orWhere('slug', $decoded)
                      ->orWhere('slug', $slugified)
                      ->first();

        if (!$comic) {
            // Jika tidak ditemukan by slug kolom, coba fallback: cocokkan dengan slugified title dari setiap record.
            // Ini berguna ketika slug tidak disimpan di DB tetapi dibuat sementara di HomeController untuk URL.
            $all = Comic::all();
            foreach ($all as $c) {
                if (Str::slug($c->title) === $slug) {
                    $comic = $c;
                    Log::info('Comic found by fallback matching slugified title', ['requested' => $slug, 'matched_id' => $c->id, 'title' => $c->title]);
                    break;
                }
            }
        }

        if (!$comic) {
            // Berikan pesan 404 yang membantu — ini membantu debugging slug yang dikirim
            Log::warning('Comic not found for slug variations', ['slug' => $slug, 'decoded' => $decoded, 'slugified' => $slugified]);
            abort(404, "Comic not found for slug: {$slug}");
        }

        // Tentukan type dari model (safe fallback to 'show' view)
        $typeFromModel = $comic->type ?? null;
        $viewPath = $typeFromModel ? 'comics.' . strtolower($typeFromModel) . '.show' : 'comics.show';

        // Jika file view tidak ditemukan, fallback ke 'comics.show' umum
        if (!view()->exists($viewPath)) {
            $viewPath = 'comics.show';
        }

        return view($viewPath, compact('comic'));
    }
}
