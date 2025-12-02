<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;

class ExploreController extends Controller
{
	/**
	 * Show comic search page and handle search/filter logic.
	 */
	public function search(Request $request)
	{
		$query = $request->input('search');
		$status = $request->input('status');
		$type = $request->input('type');
		$sort = $request->input('sort');
		$includeGenres = $request->input('include_genres', []);
		$excludeGenres = $request->input('exclude_genres', []);
		$minChapters = $request->input('min_chapters');
		$maxChapters = $request->input('max_chapters');

		$comics = Comic::query();

		// Search by title, author, artist
		if ($query) {
			$comics->where(function($q) use ($query) {
				$q->where('title', 'like', "%{$query}%")
				  ->orWhere('author', 'like', "%{$query}%");
			});
		}

		// Filter by status
		if ($status && $status !== 'Any') {
			$comics->where('status', $status);
		}

		// Filter by type
		if ($type && $type !== 'Any') {
			$comics->where('type', $type);
		}

		// Filter by included genres
		if (!empty($includeGenres)) {
			$comics->where(function($q) use ($includeGenres) {
				foreach ($includeGenres as $genre) {
					$q->orWhere('genre', 'like', "%{$genre}%");
				}
			});
		}

		// Filter by excluded genres
		if (!empty($excludeGenres)) {
			foreach ($excludeGenres as $genre) {
				$comics->where('genre', 'not like', "%{$genre}%");
			}
		}

		// Filter by chapter count
		if ($minChapters) {
			$comics->where('last_chapter', '>=', $minChapters);
		}
		if ($maxChapters) {
			$comics->where('last_chapter', '<=', $maxChapters);
		}

		// Sorting
		if ($sort === 'Popularity') {
			$comics->orderByDesc('rating_count');
		} elseif ($sort === 'Rating') {
			$comics->orderByDesc('rating');
		} else {
			$comics->orderByDesc('last_update'); // Default: Latest update
		}

		$comics = $comics->paginate(30)->appends($request->except('page'));

		// All genres for filter UI - extracted dynamically from database
		$allGenres = Comic::whereNotNull('genre')
			->distinct()
			->pluck('genre')
			->flatMap(function($genreString) {
				// Split comma-separated genres and trim whitespace
				return array_map('trim', explode(',', $genreString));
			})
			->unique()
			->sort()
			->values()
			->toArray();

		// Fallback to common genres if database is empty
		if (empty($allGenres)) {
			$allGenres = ['Action', 'Adventure', 'Comedy', 'Drama', 'Fantasy', 'Horror', 'Isekai', 'Romance', 'Sci-Fi', 'Slice of Life', 'Sports', 'Supernatural', 'Thriller', 'Mystery'];
		}

		// Total comics count for header badge
		$total = Comic::count();

		return view('explore.search', compact('comics', 'query', 'status', 'type', 'sort', 'includeGenres', 'excludeGenres', 'minChapters', 'maxChapters', 'allGenres', 'total'));
	}
}
