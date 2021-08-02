<?php

namespace publicity\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        view()->composer('admin.layout.master', function($view){
            $profile = json_decode(Storage::get('resources.json'));
            $view->with('profile', $profile->company_info);
        });

        view()->composer('layouts.master', function($view){
            $profile = json_decode(Storage::get('resources.json'));
            $view->with('profile', $profile->company_info);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
