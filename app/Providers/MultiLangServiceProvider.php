<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Language;
use Longman\LaravelMultiLang\MultiLangServiceProvider as BaseMultiLangServiceProvider;

use Blade;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Http\Request;
use Illuminate\Routing\Events\RouteMatched;
use Longman\LaravelMultiLang\Console\ExportCommand;
use Longman\LaravelMultiLang\Console\ImportCommand;
use Longman\LaravelMultiLang\Console\MigrationCommand;
use Longman\LaravelMultiLang\Console\TextsCommand;


class MultiLangServiceProvider extends BaseMultiLangServiceProvider
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
        // // Publish config files
        // $this->publishes(
        //     [
        //         __DIR__ . '/../../vendor/longman/laravel-multilang/src/config/config.php' => config_path('multilang.php'),
        //         __DIR__ . '/../../vendor/longman/laravel-multilang/src/views'             => base_path('resources/views/vendor/multilang'),
        //     ]
        // );

        // // Append the country settings
        // $this->mergeConfigFrom(
        //     __DIR__ . '/../../vendor/longman/laravel-multilang/src/config/config.php',
        //     'multilang'
        // );

        // // Register blade directives
        // Blade::directive('t', function ($expression) {
        //     return "<?php echo e(t({$expression}));  ";
        // });

        // $this->app['events']->listen(RouteMatched::class, function () {
        //     $scope = $this->app['config']->get('app.scope');
        //     if ($scope && $scope != 'global') {
        //         $this->app['multilang']->setScope($scope);
        //     }
        // });

        // $this->app['events']->listen(LocaleUpdated::class, function ($event) {
        //     $this->app['multilang']->setLocale($event->locale);
        // });

        // $this->loadViewsFrom(__DIR__ . '/../../vendor/longman/laravel-multilang/src/views', 'multilang');

    }
}
