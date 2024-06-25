<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\ParentCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Session;
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
        if (request()->is('admin*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        } else {
            config(['session.cookie' => config('session.cookie')]);
        }

        View::composer('layouts.navigation', function ($view) {
            $parent_categories = ParentCategory::all();
            $child_categories = ChildCategory::all();

            $view->with('parent_categories', $parent_categories)
                ->with('child_categories', $child_categories);
        });
    }
}
