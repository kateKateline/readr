<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardComicController extends Controller
{
    public function index()
    {
        // optional: redirect to main dashboard which contains tabs
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('dashboard.comics.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'nullable|in:manga,manhwa,manhua',
            'slug' => 'nullable|string|max:255|unique:comics,slug',
            'desc' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'release_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        Comic::create($data);

        return redirect()->route('dashboard')->with('success', 'Comic created successfully.');
    }

    public function edit(Comic $comic)
    {
        return view('dashboard.comics.edit', compact('comic'));
    }

    public function update(Request $request, Comic $comic)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'nullable|in:manga,manhwa,manhua',
            'slug' => "nullable|string|max:255|unique:comics,slug,{$comic->id}",
            'desc' => 'nullable|string',
            'genre' => 'nullable|string|max:255',
            'release_date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $comic->update($data);

        return redirect()->route('dashboard')->with('success', 'Comic updated successfully.');
    }

    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('dashboard')->with('success', 'Comic deleted successfully.');
    }
}
