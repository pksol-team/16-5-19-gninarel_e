<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $languageGet = Language::get();
        $newLanguage = [];

        if (count($languageGet) > 0) {
        
            foreach ($languageGet as $key => $language) {
                $newLanguage[$language->code] = [
                    'name' => $language->name,
                    'native_name' => $language->name,
                    'flag' => $language->code.'.svg',
                    'locale' => $language->code,
                    'canonical_locale' => $language->code.'_GB',
                    'full_locale' => $language->code.'_GB.UTF-8',
                ];
            }
           
        } else {
            $newLanguage['ar'] = [
                'name'             => 'Arabic',
                'native_name'      => 'Arabic',
                'flag'             => 'ar.svg',
                'locale'           => 'ar', // ISO 639-1
                'canonical_locale' => 'ar_GB', // ISO 3166-1
                'full_locale'      => 'ar_GB.UTF-8',
            ];
        }
        
        config(['multilang.locales' => $newLanguage]);

        $this->app['config']->get('multilang');

        Schema::defaultStringLength(191);
    }
}
