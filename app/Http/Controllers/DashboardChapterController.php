<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;

class DashboardChapterController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('comic')->latest()->paginate(15);
        return view('dashboard.chapters.index', compact('chapters'));
    }

    public function create()
    {
        $comics = Comic::all();
        return view('dashboard.chapters.create', compact('comics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'mangadex_id' => 'required|string',
            'title' => 'nullable|string|max:255',
            'chapter_number' => 'required|string',
            'volume' => 'nullable|string',
            'translated_language' => 'nullable|string',
            'external_url' => 'nullable|url',
            'is_unavailable' => 'boolean',
            'hash' => 'nullable|string',
            'data' => 'nullable|array',
            'data_saver' => 'nullable|array',
            'pages' => 'nullable|integer',
        ]);

        Chapter::create($validated);
        return redirect()->route('dashboard.chapters.index')->with('success', 'Chapter berhasil ditambahkan!');
    }

    public function edit(Chapter $chapter)
    {
        $comics = Comic::all();
        return view('dashboard.chapters.edit', compact('chapter', 'comics'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $validated = $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'mangadex_id' => 'required|string',
            'title' => 'nullable|string|max:255',
            'chapter_number' => 'required|string',
            'volume' => 'nullable|string',
            'translated_language' => 'nullable|string',
            'external_url' => 'nullable|url',
            'is_unavailable' => 'boolean',
            'hash' => 'nullable|string',
            'data' => 'nullable|array',
            'data_saver' => 'nullable|array',
            'pages' => 'nullable|integer',
        ]);

        $chapter->update($validated);
        return redirect()->route('dashboard.chapters.index')->with('success', 'Chapter berhasil diupdate!');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('dashboard.chapters.index')->with('success', 'Chapter berhasil dihapus!');
    }
}

