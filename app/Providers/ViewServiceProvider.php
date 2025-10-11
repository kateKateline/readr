<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = null;

            if (Session::has('user_id')) {
                $user = User::find(Session::get('user_id'));
            }

            $view->with('user', $user);
        });
    }
}
