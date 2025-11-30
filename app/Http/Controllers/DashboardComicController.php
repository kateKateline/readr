<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;

class DashboardComicController extends Controller
{
    public function index()
    {
        $comics = Comic::latest()->paginate(15);
        return view('dashboard.comics.index', compact('comics'));
    }

    public function create()
    {
        return view('dashboard.comics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mangadex_id' => 'required|string|unique:comics,mangadex_id',
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'is_sensitive' => 'boolean',
            'rating' => 'nullable|numeric',
            'rating_count' => 'nullable|integer',
        ]);

        Comic::create($validated);
        return redirect()->route('dashboard.comics.index')->with('success', 'Comic berhasil ditambahkan!');
    }

    public function edit(Comic $comic)
    {
        return view('dashboard.comics.edit', compact('comic'));
    }

    public function update(Request $request, Comic $comic)
    {
        $validated = $request->validate([
            'mangadex_id' => 'required|string|unique:comics,mangadex_id,' . $comic->id,
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'nullable|string',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'is_sensitive' => 'boolean',
            'rating' => 'nullable|numeric',
            'rating_count' => 'nullable|integer',
        ]);

        $comic->update($validated);
        return redirect()->route('dashboard.comics.index')->with('success', 'Comic berhasil diupdate!');
    }

    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('dashboard.comics.index')->with('success', 'Comic berhasil dihapus!');
    }
}

