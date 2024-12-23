<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Comment permissions
        Gate::define('update-comment', function ($user, $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('delete-comment', function ($user, $comment) {
            return $user->id === $comment->user_id || $user->isAdmin();
        });

        // User permissions
        Gate::define('update-profile', function ($user, $profile) {
            return $user->id === $profile->id;
        });

        Gate::define('view-profile', function ($user, $profile) {
            return true; // Mọi người đều có thể xem profile
        });

        // Admin permissions
        Gate::define('access-admin', function ($user) {
            return $user->isAdmin();
        });

        // Post permissions
        Gate::define('create-post', function ($user) {
            return $user->isAdmin() || $user->isAuthor();
        });

        Gate::define('update-post', function ($user, $post) {
            return $user->id === $post->user_id || $user->isAdmin();
        });

        Gate::define('delete-post', function ($user, $post) {
            return $user->id === $post->user_id || $user->isAdmin();
        });

        // Authentication related permissions
        Gate::define('reset-password', function ($user) {
            return true; // Mọi user đều có thể reset password
        });

        Gate::define('verify-email', function ($user) {
            return !$user->hasVerifiedEmail();
        });

        // Comment moderation
        Gate::define('moderate-comments', function ($user) {
            return $user->isAdmin() || $user->isModerator();
        });

        // User management
        Gate::define('manage-users', function ($user) {
            return $user->isAdmin();
        });

        // General permissions
        Gate::define('access-protected-content', function ($user) {
            return $user->hasVerifiedEmail() && $user->isActive();
        });
    }
}
