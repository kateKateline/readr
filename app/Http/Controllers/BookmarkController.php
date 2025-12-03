<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Menampilkan semua bookmark milik user yang login
     */
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->with('comic')
            ->latest()
            ->paginate(20);

        return view('bookmark.booksmark', compact('bookmarks'));
    }

    /**
     * Menambahkan bookmark baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'comic_id' => 'required|exists:comics,id',
        ]);

        // Cek apakah sudah di-bookmark sebelumnya
        $existingBookmark = Bookmark::where('user_id', Auth::id())
            ->where('comic_id', $request->comic_id)
            ->first();

        if ($existingBookmark) {
            return back()->with('error', 'Comic sudah ada di bookmark Anda.');
        }

        Bookmark::create([
            'user_id' => Auth::id(),
            'comic_id' => $request->comic_id,
        ]);

        return back()->with('success', 'Comic berhasil ditambahkan ke bookmark.');
    }

    /**
     * Menghapus bookmark
     */
    public function destroy(Bookmark $bookmark)
    {
        // Pastikan bookmark milik user yang login
        if ($bookmark->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menghapus bookmark ini.');
        }

        $bookmark->delete();

        return back()->with('success', 'Bookmark berhasil dihapus.');
    }

    /**
     * Cek apakah comic sudah di-bookmark oleh user
     */
    public function check($comicId)
    {
        $isBookmarked = Bookmark::where('user_id', Auth::id())
            ->where('comic_id', $comicId)
            ->exists();

        return response()->json(['is_bookmarked' => $isBookmarked]);
    }
}

