<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.application-logo'));
        });
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.auth-session-status'));
        });
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.danger-button'));
        });
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.dropdown'));
        });
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.dropdown-link'));
        });
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.input-error'));
        });
        view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.input-label'));
        });
              view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.modal'));
        });
              view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.nav-link'));
        });      view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.primary-button'));
        });
              view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.responsive-nav-link'));
        });
              view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.secondary-button'));
        });
              view()->composer('auth.*', function ($view) {
            $view->with('alert', view('components.text-input'));
        });


        Paginator::useBootstrap();

    }
}
