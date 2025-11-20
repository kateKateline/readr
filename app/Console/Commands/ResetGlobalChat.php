<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GlobalChat;

class ResetGlobalChat extends Command
{
    protected $signature = 'globalchat:reset';
    protected $description = 'Hapus semua chat global yang lebih dari 3 hari';

    public function handle()
    {
        $deleted = GlobalChat::where('created_at', '<', now()->subDays(3))->delete();
        $this->info("Berhasil menghapus {$deleted} chat global yang lebih dari 3 hari.");
    }
}
