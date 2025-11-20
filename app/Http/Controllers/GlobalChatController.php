<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalChat;
use Illuminate\Support\Facades\Auth;

class GlobalChatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        GlobalChat::create([
            'user_id' => Auth::id(), // null kalau guest
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
