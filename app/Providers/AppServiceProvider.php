<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // AGGIUNTA MAPPATURA NOMI CUSTOM TABELLE PER RELAZIONI POLIMORFICHE
        Relation::morphMap([
            'users' => 'App\User',
            'blog' => 'App\Models\Blog\Blog',
            'portfolio' => 'App\Models\Portfolio\Portfolio',
            'products' => 'App\Models\Products\Product',
            'variants' => 'App\Models\Products\Variant',
            'brands' => 'App\Models\Brands\Brand',
            'gallery' => 'App\Models\Gallery\Gallery',
            'requests' => 'App\Models\ContactRequests\ContactRequest',
            'categories_assoc' => 'App\Models\Core\CategoryAssoc',

            'blog_data' => 'App\Models\Blog\BlogData',
            'portfolio_data' => 'App\Models\Portfolio\PortfolioData',
            'products_data' => 'App\Models\Products\ProductData',
            'brands_data' => 'App\Models\Brands\BrandData',
            'gallery_data' => 'App\Models\Gallery\GalleryData',
            'categories_data' => 'App\Models\Core\CategoryData',

        ]);
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
