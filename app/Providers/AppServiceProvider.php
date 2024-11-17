<?php

namespace App\Providers;

use App\Models\Ad;
use App\Models\User;
use App\Models\Campaign;
use App\Observers\AdObserver;
use App\Observers\CampaignObserver;
use App\Observers\UserObserver;
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
       Campaign::observe(CampaignObserver::class);
       Ad::observe(AdObserver::class);
    }
}
