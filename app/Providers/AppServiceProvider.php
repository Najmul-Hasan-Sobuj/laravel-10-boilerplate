<?php

namespace App\Providers;

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
        $breadcrumbs = collect(request()->segments())->map(function ($segment, $key) {
            return [
                'url' => '/' . implode('/', array_slice(request()->segments(), 0, $key + 1)),
                'name' => ucfirst($segment),
            ];
        })->toArray();

        View::share('breadcrumbs', $breadcrumbs);
    }
}
