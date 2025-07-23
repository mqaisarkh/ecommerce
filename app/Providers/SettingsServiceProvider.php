<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
{
    config([
        // General Settings
        'app.name' => setting('site_name', env('APP_NAME', 'Laravel')),

        'app.logo' => setting('site_logo', env('APP_LOGO', '')),
        'app.favicon' => setting('favicon', env('APP_FAVICON', '')),

        // Mail Configuration
        'mail.default' => setting('mailer', env('MAIL_MAILER')),
        'mail.mailers.smtp.host' => setting('host', env('MAIL_HOST')),
        'mail.mailers.smtp.port' => setting('port', env('MAIL_PORT')),
        'mail.mailers.smtp.username' => setting('username', env('MAIL_USERNAME')),
        'mail.mailers.smtp.password' => setting('password', env('MAIL_PASSWORD')),
        'mail.mailers.smtp.encryption' => setting('mail_encryption', env('MAIL_ENCRYPTION')),

        // Stripe Configuration
        'services.stripe.key' => setting('stripe_key', env('STRIPE_KEY')),
        'services.stripe.secret' => setting('stripe_secret', env('STRIPE_SECRET')),
    ]);
}
}
