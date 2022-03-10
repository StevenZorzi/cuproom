<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        /* MODEL BINDING - AGGIUNTI PER RICONOSCIMENTO MODELLO AL PASSAGGIO DELL'ID */
        Route::model('user', \App\User::class);

        Route::model('module', \App\Models\Core\CategoryData::class);
        Route::model('category', \App\Models\Core\Category::class);
        Route::model('blog', \App\Models\Blog\Blog::class);
        Route::model('portfolio', \App\Models\Portfolio\Portfolio::class);
        Route::model('product', \App\Models\Products\Product::class);
        Route::model('variant', \App\Models\Products\Variant::class);
        Route::model('brand', \App\Models\Brands\Brand::class);
        Route::model('gallery', \App\Models\Gallery\Gallery::class);
        Route::model('request', \App\Models\ContactRequests\ContactRequest::class);

        /* MODEL BINDING - AGGIUNTI PER RICONOSCIMENTO MODELLO AL PASSAGGIO DELLO SLUG */
        Route::model('blogslug', \App\Models\Blog\BlogData::class);
        Route::model('portfolioslug', \App\Models\Portfolio\PortfolioData::class);
        Route::model('productslug', \App\Models\Products\ProductData::class);
        //Route::model('variant', App\Models\Products\VariantData::class);
        Route::model('brandslug', \App\Models\Brands\BrandData::class);
        Route::model('galleryslug', \App\Models\Gallery\GalleryData::class);


        Route::bind('blogtrash', function ($value) {
            return \App\Models\Blog\Blog::onlyTrashed()->where('id', $value)->first();
        });
        Route::bind('portfoliotrash', function ($value) {
            return \App\Models\Portfolio\Portfolio::onlyTrashed()->where('id', $value)->first();
        });
        Route::bind('producttrash', function ($value) {
            return \App\Models\Products\Product::onlyTrashed()->where('id', $value)->first();
        });
        Route::bind('brandtrash', function ($value) {
            return \App\Models\Brands\Brand::onlyTrashed()->where('id', $value)->first();
        });
        Route::bind('gallerytrash', function ($value) {
            return \App\Models\Gallery\Gallery::onlyTrashed()->where('id', $value)->first();
        });
        Route::bind('usertrash', function ($value) {
            return \App\User::onlyTrashed()->where('id', $value)->first();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
