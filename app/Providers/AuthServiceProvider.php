<?php

namespace App\Providers;

use App\User;
use App\Models\Core\Module;
use App\Models\Blog\Blog;
use App\Models\Portfolio\Portfolio;
use App\Models\Products\Product;
use App\Models\Gallery\Gallery;
use App\Models\ContactRequests\ContactRequest;
use App\Policies\UserPolicy;
use App\Policies\ModulePolicy;
use App\Policies\BlogPolicy;
use App\Policies\PortfolioPolicy;
use App\Policies\ProductPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\ContactRequestPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Module::class => ModulePolicy::class,
        Blog::class => BlogPolicy::class,
        Portfolio::class => PortfolioPolicy::class,
        Product::class => ProductPolicy::class,
        Gallery::class => GalleryPolicy::class,
        ContactRequest::class => ContactRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        Gate::define('admin-access', function ($user) {
            return $user->isSuperAdmin();
        });

        Gate::define('restricted-access', function ($user) {
            return !$user->isUser();
        });
    }
}
