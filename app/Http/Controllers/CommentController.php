<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Menyimpan comment baru
    public function store(Request $request)
    {
        $request->validate([
            'comic_id' => 'required|exists:comics,id',
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'comic_id' => $request->comic_id,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
            'is_edited' => false
        ]);

        return redirect()->back()->with('success', 'Comment berhasil ditambahkan!');
    }

    // Update comment
    public function update(Request $request, Comment $comment)
    {
        // Cek apakah user adalah pemilik comment
        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit comment ini!');
        }

        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $comment->update([
            'comment' => $request->comment,
            'is_edited' => true
        ]);

        return redirect()->back()->with('success', 'Comment berhasil diupdate!');
    }

    // Delete comment
    public function destroy(Comment $comment)
    {
        // Cek apakah user adalah pemilik comment atau admin
        if ($comment->user_id !== Auth::id() && Auth::user()->level !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus comment ini!');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment berhasil dihapus!');
    }
}