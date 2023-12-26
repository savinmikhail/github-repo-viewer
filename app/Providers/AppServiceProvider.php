<?php

namespace App\Providers;

use App\Services\GitHub\GitHubService;
use App\Services\GitHub\GitHubServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GitHubServiceInterface::class, GitHubService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
