<?php


use Illuminate\Support\Facades\DB;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        static $settings = null;

        if ($settings === null) {
            $settings = DB::table('settings')->pluck('value', 'key')->toArray();
        }

        return $settings[$key] ?? env(strtoupper($key), $default);
    }
}
