<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
          
    Gate::define('update-comment', function ($user, Comment $comment) {
        return $user->id === $comment->user_id || $user->isAdmin(); 
    });

    Gate::define('delete-comment', function ($user, Comment $comment) {
        return $user->id === $comment->user_id || $user->isAdmin(); 
    });
    }
}
