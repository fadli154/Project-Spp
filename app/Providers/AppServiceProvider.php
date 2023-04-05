<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PaginationPaginator::useBootstrapFive();

        Gate::define('administrator', function (User $user) {
            return $user->level === 'administrator';
        });

        Gate::define('wali', function (User $user) {
            return $user->level === 'wali';
        });

        Gate::define('petugas', function (User $user) {
            return $user->level === 'petugas';
        });

        Gate::define('entri-pembayaran', function (User $user) {
            return $user->level === 'administrator' || $user->level === 'petugas';
        });
    }
}
