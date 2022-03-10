<?php
/*
ROUTES PROTETTE CON CSRF
*/
use App\Models\Core\Module;

//URL DISPONIBILI IN MODALITA' DEBUG

Route::group(['middleware' => 'debug'], function () {

	// PAGINA DI TEST
	Route::get('/test', function (){
    	return view('test');
	});

	// PAGINA DI INSTALLAZIONE DATABASE 
	Route::get("/install", function () {
	    return view('install.install');
	})->name('install')->middleware('debug');
	
	// ARTISAN MIGRATION
	Route::post("/artisan/migrate", 'HomeController@artisanMigrate')->name('artisan-migrate');

});



//BACK-END


Route::group(['prefix' => Localization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect']], function() { 
	

	Auth::routes();
			

	Route::group(['prefix' => config('paths.back_path'), 'middleware' => 'auth'], function () {
			

		Route::get("/", function () { return redirect()->route('dashboard'); });
		Route::get("/dashboard", 'HomeController@index')->name('dashboard');


		//ARTISAN - GESTIONE MODALITA' MANUTENZIONE
		Route::post("/artisan/maintenance", 'HomeController@artisanMaintenance')->name('artisan-maintenance');


		//SETTINGS
		Route::get("/settings", 'HomeController@showSettings')->name('settings');

		Route::post("/settings/languages/add", 'HomeController@addLanguage')->name('add-settings-language');
		Route::post("/settings/languages/update", 'HomeController@updateLanguage')->name('update-settings-language');
		Route::post("/settings/languages/delete", 'HomeController@deleteLanguage')->name('delete-settings-language');
		Route::post("/settings/languages/reorder", 'HomeController@reorderLanguages')->name('reorder-settings-languages');

		Route::post("/settings/modules/update", 'HomeController@updateModules')->name('update-settings-modules');

		Route::get("favorites", 'HomeController@getFavorites')->name('favorites');
		Route::post("favorites/{table}/update", 'HomeController@updateFavorites')->name('favorites.update');

		
		// RESTFUL URL MODULI & MODELLI

		//CATEGORIE
		Route::resource('{module}/categories', 'CategoriesController');
		Route::post('{table}/check-slug', 'CategoriesController@checkSlug')->name('categories-check-slug');


		//BLOG
		Route::get('blog/deleted', 'BlogController@deleted')->name('blog-index-deleted');
		Route::resource('blog', 'BlogController');
		Route::post('blog/{blogtrash}/restore', 'BlogController@restore')->name('blog-restore');
		Route::post('blog/{blogtrash}/destroy', 'BlogController@forceDestroy')->name('blog-destroy');

		Route::post('blog/{blog}/upload-img', 'BlogController@uploadImg')->name('blog-upload-img');
		Route::get('blog/{blog}/get-img', 'BlogController@getImg')->name('blog-get-img');
		Route::post('blog/{blog}/delete-img', 'BlogController@deleteImg')->name('blog-delete-img');
		Route::post('blog/{blog}/check-slug', 'BlogController@checkSlug')->name('blog-check-slug');

		


		//PORTFOLIO
		Route::get('portfolio/deleted', 'PortfolioController@deleted')->name('portfolio-index-deleted');
		Route::resource('portfolio', 'PortfolioController');
		Route::post('portfolio/{portfoliotrash}/restore', 'PortfolioController@restore')->name('portfolio-restore');
		Route::post('portfolio/{portfoliotrash}/destroy', 'PortfolioController@forceDestroy')->name('portfolio-destroy');

		Route::post('portfolio/{portfolio}/upload-img', 'PortfolioController@uploadImg')->name('portfolio-upload-img');
		Route::get('portfolio/{portfolio}/get-img', 'PortfolioController@getImg')->name('portfolio-get-img');
		Route::post('portfolio/{portfolio}/delete-img', 'PortfolioController@deleteImg')->name('portfolio-delete-img');
		Route::post('portfolio/{portfolio}/upload-fls', 'PortfolioController@uploadFls')->name('portfolio-upload-fls');
		Route::get('portfolio/{portfolio}/get-fls', 'PortfolioController@getFls')->name('portfolio-get-fls');
		Route::post('portfolio/{portfolio}/delete-fls', 'PortfolioController@deleteFls')->name('portfolio-delete-fls');
		Route::post('portfolio/{portfolio}/check-slug', 'PortfolioController@checkSlug')->name('portfolio-check-slug');

		
		//PRODOTTI
		Route::get('products/deleted', 'ProductsController@deleted')->name('products-index-deleted');
		Route::resource('products', 'ProductsController');
		Route::post('products/{producttrash}/restore', 'ProductsController@restore')->name('products-restore');
		Route::post('products/{producttrash}/destroy', 'ProductsController@forceDestroy')->name('products-destroy');

		Route::post('products/{product}/upload-img', 'ProductsController@uploadImg')->name('products-upload-img');
		Route::get('products/{product}/get-img', 'ProductsController@getImg')->name('products-get-img');
		Route::post('products/{product}/delete-img', 'ProductsController@deleteImg')->name('products-delete-img');
		Route::post('products/{product}/upload-fls', 'ProductsController@uploadFls')->name('products-upload-fls');
		Route::get('products/{product}/get-fls', 'ProductsController@getFls')->name('products-get-fls');
		Route::post('products/{product}/delete-fls', 'ProductsController@deleteFls')->name('products-delete-fls');
		Route::post('products/{product}/check-slug', 'ProductsController@checkSlug')->name('products-check-slug');

		//VARIANTI
		Route::resource('products/rel/variants', 'VariantsController');
		Route::post('products/rel/variants/reorder-sizes', 'VariantsController@reorderSizes')->name('reorder-sizes');
		Route::post('products/rel/variants/reorder-colors', 'VariantsController@reorderColors')->name('reorder-colors');
		Route::post('products/rel/variants/upload-img/{variant}', 'VariantsController@uploadImg')->name('variants-upload-img');
		Route::get('products/rel/variants/get-img/{variant}', 'VariantsController@getImg')->name('variants-get-img');
		Route::post('products/rel/variants/delete-img/{variant}', 'VariantsController@deleteImg')->name('variants-delete-img');


		//BRAND
		Route::get('brands/deleted', 'BrandsController@deleted')->name('brands-index-deleted');
		Route::resource('brands', 'BrandsController');
		Route::post('brands/{brandtrash}/restore', 'BrandsController@restore')->name('brands-restore');
		Route::post('brands/{brandtrash}/destroy', 'BrandsController@forceDestroy')->name('brands-destroy');

		Route::post('brands/{brand}/upload-img', 'BrandsController@uploadImg')->name('brands-upload-img');
		Route::get('brands/{brand}/get-img', 'BrandsController@getImg')->name('brands-get-img');
		Route::post('brands/{brand}/delete-img', 'BrandsController@deleteImg')->name('brands-delete-img');
		Route::post('brands/{brand}/check-slug', 'BrandsController@checkSlug')->name('brands-check-slug');
		

		//GALLERY
		Route::get('gallery/deleted', 'GalleryController@deleted')->name('gallery-index-deleted');
		Route::resource('gallery', 'GalleryController');
		Route::post('gallery/{gallerytrash}/restore', 'GalleryController@restore')->name('gallery-restore');
		Route::post('gallery/{gallerytrash}/destroy', 'GalleryController@forceDestroy')->name('gallery-destroy');
		
		Route::post('gallery/{gallery}/upload-img', 'GalleryController@uploadImg')->name('gallery-upload-img');
		Route::get('gallery/{gallery}/get-img', 'GalleryController@getImg')->name('gallery-get-img');
		Route::post('gallery/{gallery}/delete-img', 'GalleryController@deleteImg')->name('gallery-delete-img');
		Route::post('gallery/{gallery}/check-slug', 'GalleryController@checkSlug')->name('gallery-check-slug');
		

		//RICHIESTE
		Route::resource('requests', 'ContactRequestsController', ['except' => ['store']]);


		Route::post("images/reorder", 'HomeController@reorderImages')->name('reorder-images');
		Route::post("images/getinfo", 'HomeController@getImagesInfo')->name('get-img-info');
		Route::post("images/updateinfo", 'HomeController@updateImagesInfo')->name('update-img-info');


		//UTENTI
		Route::get('users/deleted', 'UsersController@deleted')->name('user-index-deleted');
		Route::resource('users', 'UsersController');
		Route::post('users/{usertrash}/restore', 'UsersController@restore')->name('user-restore');
		/*Route::post('users/{usertrash}/destroy', 'UsersController@forceDestroy')->name('user-destroy');*/
		
		Route::post('users/{user}/upload-img', 'UsersController@uploadImg')->name('user-upload-img');
		Route::get('users/{user}/get-img', 'UsersController@getImg')->name('user-get-img');
		Route::post('users/{user}/delete-img', 'UsersController@deleteImg')->name('user-delete-img');
		Route::post('users/{user}/check-email', 'UsersController@checkEmail')->name('user-check-email');

		//Route::post('users/restore', 'UsersController@restoreProfile');

		//cambia password
		Route::post('users/{user}/change-password', 'UsersController@changePassword')->name('user-change-password');
		Route::post('users/{user}/mail-password', 'UsersController@mailPassword')->name('user-mail-password');

	});

	Route::resource('requests', 'ContactRequestsController', ['only' => ['store']]);

});


//FRONT-END

Route::group(['prefix' => Localization::setLocale(), 'middleware' => ['localize','localeSessionRedirect', 'localizationRedirect']], function() { 


		Route::get('/', 'WebsiteController@showHomepage')->name('website-home');

		// ABOUT US
		Route::get(trans("website.about"), function () { 
			return view('website.pages.about')->with('url', url(otherLang()."/".trans('website.about', [], otherLang()))); 
		})->name('website-about'); 

		// SQUADRA
		Route::get(trans("website.team"), function () { 
			return view('website.pages.team')->with('url', url(otherLang()."/".trans('website.team', [], otherLang()))); 
		})->name('website-team'); 

		// SQUADRA
		Route::get(trans("website.how-we-work"), function () { 
			return view('website.pages.how-we-work')->with('url', url(otherLang()."/".trans('website.how-we-work', [], otherLang()))); 
		})->name('website-how-we-work'); 

		// PROGETTI
		Route::get(trans("website.projects"), function () { 
			return view('website.pages.projects')->with('url', url(otherLang()."/".trans('website.projects', [], otherLang()))); 
		})->name('website-projects'); 

		// CELATO RITO - CLASSIC
		Route::get(trans("website.classic"), 'WebsiteController@showCRclassic')->name('website-classic');

		// CUPROOM
		Route::get(trans("website.cuproom"), 'WebsiteController@showCuproom')->name('website-cuproom'); 

		// DESIGNERS
		//Route::get(trans("website.designers"), function () { return view('website.pages.designers'); })->name('website-designers');  
		Route::get(trans("website.designers"), 'WebsiteController@designers')->name('website-designers');

		// NEWS
		Route::get(trans("website.news"), 'WebsiteController@listNews')->name('website-news'); 
		Route::get(trans("website.news")."/{blogslug}", 'WebsiteController@singleNews')->name('website-single-news');


		// CR CLASSIC PRODOTTI
		Route::get(trans("website.classic")."/".trans("website.products")."/{categoria?}", 'WebsiteController@listProductsCR')->name('website-products-classic');
		Route::get(trans("website.classic")."/{slug}", 'WebsiteController@singleProductCR')->name('website-single-product-cr');

		// CUPROOM PRODOTTI
		Route::get(trans("website.cuproom")."/".trans("website.products")."/{categoria?}", 'WebsiteController@listProductsCuproom')->name('website-products-cuproom');
		Route::get(trans("website.cuproom")."/{slug}", 'WebsiteController@singleProductCuproom')->name('website-single-product-cup'); 

		//PAGINA SHOP ONLINE
		Route::get("shop-online", function () { 
			return view('website.pages.external-shop');
		})->name('website-shop-online');

		Route::get("finishes", function () { 
			return view('website.pages.finishes');
		})->name('website-finishes');


		Route::get("promo-bags", function () { 
			return view('website.pages.promo-bags');
		})->name('website-promo');


		// CONTACT PAGE
		Route::get(trans('website.contact'), 'WebsiteController@contactsPage')->name('website-contact'); 

		// RICHIESTA DATI
		Route::get('my-data', function () { 
			return view('website.pages.my-data');
		})->name('website-mydata'); 

	
});


