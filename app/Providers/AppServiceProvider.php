<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Comment;
use App\Policies\CommentPolicy;

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
        // Nếu bạn muốn đăng ký policy ở đây (không khuyến nghị)
        // $this->app['config']->set('policies.' . Comment::class, CommentPolicy::class);
    }
}
