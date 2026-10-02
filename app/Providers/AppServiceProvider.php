<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    // auth rules
    public function boot(): void
    {
        // check is user has permission to view screen. if they are signed in, they auto have perms

        // "give us a user if you have one but its okay if not"
        // Gate::define('view-admin', function (?User $user) {


            // if user = 1, they have admin perms. otherwise return access not found
            // if ($user->id== 2) {
            //     return Response::allow();
            // }

            // // may return as 404
            // return Response::denyAsNotFound();


            // return if admin is admin
            // return $user->isAdmin() ? Response::allow() : Response::denyAsNotFound();
        // });
    }
}
