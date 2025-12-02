<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Comic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'comic', 'parent'])->latest()->paginate(15);
        return view('dashboard.comments.index', compact('comments'));
    }

    public function create()
    {
        $users = User::all();
        $comics = Comic::all();
        $parentComments = Comment::whereNull('parent_id')->get();
        return view('dashboard.comments.create', compact('users', 'comics', 'parentComments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'comic_id' => 'required|exists:comics,id',
            'parent_id' => 'nullable|exists:comments,id',
            'comment' => 'required|string|max:1000',
            'is_edited' => 'boolean',
        ]);

        Comment::create($validated);
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment berhasil ditambahkan!');
    }

    public function edit(Comment $comment)
    {
        $users = User::all();
        $comics = Comic::all();
        $parentComments = Comment::whereNull('parent_id')->where('id', '!=', $comment->id)->get();
        return view('dashboard.comments.edit', compact('comment', 'users', 'comics', 'parentComments'));
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'comic_id' => 'required|exists:comics,id',
            'parent_id' => 'nullable|exists:comments,id',
            'comment' => 'required|string|max:1000',
            'is_edited' => 'boolean',
        ]);

        $comment->update($validated);
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment berhasil diupdate!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('dashboard.comments.index')->with('success', 'Comment berhasil dihapus!');
    }

    public function print()
    {
        $comments = Comment::with(['user', 'comic'])->latest()->get();
        return response()->json([
            'title' => 'Comments',
            'headers' => ['User', 'Comment', 'Comic', 'Type'],
            'data' => $comments->map(function($comment) {
                return [
                    $comment->user->name ?? 'Unknown',
                    Str::limit($comment->comment, 50),
                    $comment->comic->title ?? 'Unknown',
                    $comment->parent_id ? 'Reply' : 'Comment'
                ];
            })
        ]);
    }
}

