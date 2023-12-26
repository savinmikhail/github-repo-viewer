<?php

namespace App\Providers;

use App\Services\GitHub\GitHubService;
use App\Services\GitHub\GitHubServiceInterface;
use App\Services\Owner\OwnerServiceInterface;
use App\Services\Owner\OwnerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GitHubServiceInterface::class, GitHubService::class);
        $this->app->bind(OwnerServiceInterface::class, OwnerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
