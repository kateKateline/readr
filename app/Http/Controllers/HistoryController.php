<?php

namespace App\Http\Controllers;

use App\Models\Histories;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Menampilkan semua history milik user yang login
     */
    public function index()
    {
        $histories = Histories::where('user_id', Auth::id())
            ->with(['comic', 'chapter'])
            ->latest('updated_at')
            ->paginate(20);

        return view('history.history', compact('histories'));
    }

    /**
     * Menyimpan atau update history saat membaca chapter
     */
    public function store(Request $request)
    {
        $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'chapter_id' => 'required|exists:chapters,id',
            'page' => 'nullable|integer|min:1',
        ]);

        // Cek apakah chapter milik comic yang sesuai
        $chapter = Chapter::findOrFail($request->chapter_id);
        if ($chapter->comic_id != $request->comic_id) {
            return response()->json(['error' => 'Chapter tidak sesuai dengan comic'], 400);
        }

        // Cari atau buat history
        $history = Histories::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'comic_id' => $request->comic_id,
            ],
            [
                'last_viewed_chapter' => $request->chapter_id,
                'last_viewed_page' => $request->page ?? 1,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'History berhasil disimpan',
            'history' => $history
        ]);
    }

    /**
     * Update history (untuk update page saat membaca)
     */
    public function update(Request $request, Histories $history)
    {
        // Pastikan history milik user yang login
        if ($history->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengupdate history ini.');
        }

        $request->validate([
            'page' => 'nullable|integer|min:1',
            'chapter_id' => 'nullable|exists:chapters,id',
        ]);

        if ($request->has('chapter_id')) {
            $history->last_viewed_chapter = $request->chapter_id;
        }

        if ($request->has('page')) {
            $history->last_viewed_page = $request->page;
        }

        $history->save();

        return response()->json([
            'success' => true,
            'message' => 'History berhasil diupdate'
        ]);
    }

    /**
     * Menghapus history
     */
    public function destroy(Histories $history)
    {
        // Pastikan history milik user yang login
        if ($history->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menghapus history ini.');
        }

        $history->delete();

        return back()->with('success', 'History berhasil dihapus.');
    }

    /**
     * Menghapus semua history user
     */
    public function clearAll()
    {
        Histories::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Semua history berhasil dihapus.');
    }
}

