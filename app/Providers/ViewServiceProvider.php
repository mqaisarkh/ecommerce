<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('global_settings', [
                'site_name' => Setting::get('site_name', 'Default Site'),
                'contact' => Setting::get('contact'),
                'address' => Setting::get('address'),
            ]);
        });
    }

    public function register()
    {
        //
    }
}
