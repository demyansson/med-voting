<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('sidebar', function (\Illuminate\View\View $view) {
            $votingService = resolve('App\Services\VotingService');

            $view->with([
                'votings' => $votingService->getTop()
            ]);
        });
    }
}
