<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Schema;
use Localization;
use App\Models\Core\Category;
use App\Models\Core\CategoryData;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {   
        if(Schema::hasTable('users')){

            view()->composer('templates.*', function($view) {
                $view->with('authUser', Auth::user())->with('lang', config('app.locale'))->with('suppLangs', Localization::getSupportedLocales())->with('appName', config('app.name'));
            });
            
            view()->composer('admin.*', function($view) {
                $view->with('authUser', Auth::user())->with('lang', config('app.locale'))->with('suppLangs', Localization::getSupportedLocales())->with('appName', config('app.name'));
            });

            view()->composer('auth.*', function($view) {
                $view->with('lang', config('app.locale'))->with('suppLangs', Localization::getSupportedLocales())->with('appName', config('app.name'));
            });

            view()->composer(['website.layout.navbar', 'website.layout.footer'], function($view) {

                $cr_cat = Category::where('id', '7')->first()->getChildsData();
                $cup_cat = Category::where('id', '8')->first()->getChildsData();

                $view->with('cr_cat', $cr_cat)->with('cup_cat', $cup_cat);
            });
        }
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
