<?php

namespace App\Http\Controllers;

use App\Models\GlobalChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardGlobalChatController extends Controller
{
    public function index()
    {
        $chats = GlobalChat::with('user')->latest()->paginate(15);
        return view('dashboard.global-chats.index', compact('chats'));
    }

    public function create()
    {
        $users = User::all();
        return view('dashboard.global-chats.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        GlobalChat::create($validated);
        return redirect()->route('dashboard.global-chats.index')->with('success', 'Global chat berhasil ditambahkan!');
    }

    public function edit(GlobalChat $globalChat)
    {
        $users = User::all();
        return view('dashboard.global-chats.edit', compact('globalChat', 'users'));
    }

    public function update(Request $request, GlobalChat $globalChat)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $globalChat->update($validated);
        return redirect()->route('dashboard.global-chats.index')->with('success', 'Global chat berhasil diupdate!');
    }

    public function destroy(GlobalChat $globalChat)
    {
        $globalChat->delete();
        return redirect()->route('dashboard.global-chats.index')->with('success', 'Global chat berhasil dihapus!');
    }

    public function print()
    {
        $chats = GlobalChat::with('user')->latest()->get();
        return response()->json([
            'title' => 'Global Chats',
            'headers' => ['User', 'Message', 'Created'],
            'data' => $chats->map(function($chat) {
                return [
                    $chat->user->name ?? 'Unknown',
                    Str::limit($chat->message, 60),
                    $chat->created_at->format('M d, Y H:i')
                ];
            })
        ]);
    }
}

