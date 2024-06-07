<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        Paginator::useBootstrapFive();


        // \Debugbar::disable();
        
        // User::observe(UserObserver::class);

        $topUsers = cache::remember('topUsers', now()->addMinutes(5), function () {
            return User::withCount('ideas')
                ->orderBy('ideas_count', 'DESC')
                ->take(10)->get();
        });

        View::share(
            'topUsers',
            $topUsers
        );
    }
}
