<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('jira', function() {
            return new \App\Services\Jira;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('okta', \SocialiteProviders\Okta\Provider::class);
        });

        Blade::directive('handleize', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::slug($expression); ?>";
        });
    }
}
