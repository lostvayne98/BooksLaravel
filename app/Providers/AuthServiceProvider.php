<?php

namespace App\Providers;

use App\Http\Controllers\User\CommentController;
use App\Models\Comment;
use App\Models\User;
use App\Policies\CommentControllerPolicy;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Laravel\Passport\Passport;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Comment::class => CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('protected-comment',function (User $user,Comment $comment) {

          return $user->id === $comment->user_id;
        });

        Passport::routes();
    }
}
