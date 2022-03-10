<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Route;
use Localization;

use App\Models\Core\Module;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogData;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioData;
use App\Models\Products\Product;
use App\Models\Products\ProductData;
use App\Models\Brands\Brand;
use App\Models\Brands\BrandData;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryData;
use App\Models\Core\Category;
use App\Models\Core\CategoryData;
use App\Lib\ImageData;

class WebsiteController extends Controller
{
    public $category;

    public function __construct(){


        $this->middleware(function ($request, $next) {

            return $next($request);
        });
    }

    public function showHomepage(){

        $news = BlogData::where('lang', config('app.locale'))->whereHas('base', function($query){
            $query->where('active', '1');
        })->orderBy('created_at', 'desc')->take(5)->get();


        $products = ProductData::where('lang', config('app.locale'))->whereHas('base', function($query){
            $query->where('active', '1');

            $query->where('fav', '1');

        })->with('base')->orderBy('created_at', 'desc')->get();


        return view('website.pages.home')->with('news', $news)->with('products', $products);
    }


    public function showCRclassic(){

        $products = ProductData::where('lang', config('app.locale'))->whereHas('base', function($query){
            $query->where('active', '1');

            $query->whereHas('categories', function ($query) {
                $query->where('categories.id', '7');
            });

        })->with('base')->inRandomOrder()->take(8)->get();

        return view('website.pages.classic')->with('products', $products);
    }


    public function showCuproom(){

        $products = ProductData::where('lang', config('app.locale'))->whereHas('base', function($query){
            $query->where('active', '1');

            $query->whereHas('categories', function ($query) {
                $query->where('categories.id', '8');
            });

        })->with('base')->inRandomOrder()->take(8)->get();

        return view('website.pages.cuproom')->with('products', $products);
    }



    public function listNews(){

        /*$cat = CategoryData::where('slug', $categoria)->whereHas('base', function ($query) {
                $query->where('parent_id', '1');
            })->first();
            
        if(is_null($cat)) abort ('404');*/
     

        $news = BlogData::where('lang', config('app.locale'))->whereHas('base', function($query){
            $query->where('active', '1');

            /*$categoryBase = $cat->base;

            $query->whereHas('categories', function ($query) use ($categoryBase) {
                $query->where('categories.id', $categoryBase->id);
            });*/

        })->orderBy('created_at', 'desc')->with('base')->paginate(9);

        return view('website.pages.news')->with('news', $news);
    }


    public function singleNews(BlogData $blogslug){

        $images = $blogslug->base->images;

        //ULTIME NEWS
        $news = BlogData::where('lang', config('app.locale'))->where('slug', '!=', $blogslug->slug)->whereHas('base', function($query){
            $query->where('active', '1');

        })->orderBy('created_at', 'desc')->take(6)->get();


        //SETTAGGIO URL PER SWITCH LINGUA
        $otherLang = otherLang();

        $url = url($otherLang."/".trans('website.news', [], otherLang()));
       
        $pdLang = $blogslug->base->getText($otherLang);
        if(!is_null($pdLang)){
            $url .= "/".$pdLang->slug;
        }

        $meta = $blogslug->metaTag();

        $meta_t = !is_null($meta) ? $meta->title : $blogslug->title;
        $meta_d = !is_null($meta) ? $meta->description : $blogslug->excerpt(300);

        return view('website.pages.single-news')->with('article', $blogslug)->with('images', $images)->with('news', $news)->with('url', $url)->with('meta_t', $meta_t)->with('meta_d', $meta_d);
    }



    public function listProductsCR(Request $request, $categoria = null){
        
        if(Module::find(3)->active == '0') abort('404');

        if(!is_null($categoria)){
            $cat = CategoryData::where('slug', $categoria)->whereHas('base', function ($query) {
                    $query->where('parent_id', '7');
                })->with('base')->first();
                
            if(is_null($cat)) abort ('404');
        }else{
            $cat = null;
        }

        $f = $request->f;

        $products = ProductData::where('lang', config('app.locale'))->whereHas('base', function ($query) use ($cat, $f){

            $query->where('active', '1');

            $query->whereHas('categories', function ($query){
                $query->where('categories.id', '7');
            });

            if(!is_null($cat)){
                $query->whereHas('categories', function ($query) use ($cat) {
                    
                   $query->where('categories.id', $cat->base->id);
                  
                });
            }

            if(!is_null($f))
                $query->where('color', 'like', '%"'.$f.'"%');
            
        })->orderBy('created_at', 'asc')->with('base')->paginate(10);


        $main_cat = Category::find(7);

        $categories = $main_cat->getChildsData();

        $finishes = colors();


        $data = array();


        //SETTAGGIO CANONICAL
        if($products->currentPage() != "1") 
            $pageC = $products->url($products->currentPage());
        else{
            if(is_null($cat))
                $pageC = route("website-products-classic");
            else
                $pageC = route("website-products-classic")."/".$cat->slug;
        }
        $canonical = "<link rel=\"canonical\" href=\"".$pageC."\">";


        //SETTAGGIO NEXT E PREV PAGINATION
        if($products->currentPage() > 1){
            
            $canonical .= "<link rel=\"prev\" href=\"".$products->appends(['f' => $f])->previousPageUrl()."\" />";
        }
        if($products->currentPage() < $products->lastPage()){

            $canonical .= "<link rel=\"next\" href=\"".$products->appends(['f' => $f])->nextPageUrl()."\" />";
        }

        $data['canonical'] = $canonical;


        //SETTAGGIO METATAG E DESCRIZIONE PAGINA
        if(!is_null($cat) && !is_null($cat->metaTag())){
            $meta = $cat->metaTag();
            $data['meta'] = $meta;
        }elseif(!is_null($main_cat->getText()->metaTag())){
            $meta = $main_cat->getText()->metaTag();
            $data['meta'] = $meta;
        }


        //SETTAGGIO URL PER SWITCH LINGUA
        $otherLang = otherLang();

        $cat = is_null($cat) ? new CategoryData() : $cat;
        
        $url = url($otherLang."/".trans('website.classic', [], otherLang())."/".trans('website.products', [], otherLang()));
        if(!is_null($cat)){
            $catBase = $cat->base;
            if(!is_null($catBase)){
                $catLang = $catBase->getText($otherLang);
                if(!is_null($catLang)){
                    $url .= "/".$catLang->slug;
                }
            }
        }
        if(!is_null($f)){
            $url .= "?f=".$f;
        }


        return view('website.pages.products-classic', $data)->with('main_cat', $main_cat)->with('cat', $cat)->with('products', $products)->with('categories', $categories)->with('finishes', $finishes)->with('f', $f)->with('url', $url);
    }


    public function listProductsCuproom(Request $request, $categoria = null){
        
        if(Module::find(3)->active == '0') abort('404');

        if(!is_null($categoria)){
            $cat = CategoryData::where('slug', $categoria)->whereHas('base', function ($query) {
                    $query->where('parent_id', '8');
                })->with('base')->first();
                
            if(is_null($cat)) abort ('404');
        }else{
            $cat = null;
        }

        $s = $request->s;

        $collection = $request->collection;

        $products = ProductData::where('lang', config('app.locale'))->whereHas('base', function ($query) use ($cat, $s, $collection){

            $query->where('active', '1');

            $query->whereHas('categories', function ($query){
                $query->where('categories.id', '8');
            });

            if(!is_null($cat)){
                $query->whereHas('categories', function ($query) use ($cat) {
                   $query->where('categories.id', $cat->base->id);
                });
            }

            if(!is_null($s)){
                $query->whereHas('categories', function ($query) use ($cat, $s) {
                   $query->where('categories.id', $s);
                });
            }

            if(!is_null($collection)){
                $query->where('collection', $collection);
            }
            
        })->orderBy('created_at', 'desc')->with('base')->paginate(10);


        $main_cat = Category::find(8);

        $categories = $main_cat->getChildsData();


        $data = array();


        //SETTAGGIO CANONICAL
        if($products->currentPage() != "1") 
            $pageC = $products->url($products->currentPage());
        else{
            if(is_null($cat))
                $pageC = route("website-products-cuproom");
            else
                $pageC = route("website-products-cuproom")."/".$cat->slug;
        }
        $canonical = "<link rel=\"canonical\" href=\"".$pageC."\">";


        //SETTAGGIO NEXT E PREV PAGINATION
        if($products->currentPage() > 1){
            
            $canonical .= "<link rel=\"prev\" href=\"".$products->appends(['s' => $s])->previousPageUrl()."\" />";
        }
        if($products->currentPage() < $products->lastPage()){

            $canonical .= "<link rel=\"next\" href=\"".$products->appends(['s' => $s])->nextPageUrl()."\" />";
        }

        $data['canonical'] = $canonical;


        //SETTAGGIO METATAG E DESCRIZIONE PAGINA
        if(!is_null($cat) && !is_null($cat->metaTag())){
            $meta = $cat->metaTag();
            $data['meta'] = $meta;
        }elseif(!is_null($main_cat->getText()->metaTag())){
            $meta = $main_cat->getText()->metaTag();
            $data['meta'] = $meta;
        }


        //SETTAGGIO URL PER SWITCH LINGUA
        $otherLang = otherLang();

        $cat = is_null($cat) ? new CategoryData() : $cat;


        $url = url($otherLang."/".trans('website.cuproom', [], otherLang())."/".trans('website.products', [], otherLang()));
        if(!is_null($cat)){
            $catBase = $cat->base;
            if(!is_null($catBase)){
                $catLang = $catBase->getText($otherLang);
                if(!is_null($catLang)){
                    $url .= "/".$catLang->slug;
                }
            }
        }
        if(!is_null($s)){
            $url .= "?s=".$s;
        }

        if(!is_null($collection)){
            $url .= "?collection=".$collection;
        }

        $param_collection = !is_null($collection) ? "?collection=".$collection : '';

        return view('website.pages.products-cuproom', $data)->with('main_cat', $main_cat)->with('cat', $cat)->with('products', $products)->with('categories', $categories)->with('s', $s)->with('collection', $collection)->with('url', $url)->with('param_collection', $param_collection);
    }


    public function singleProductCR($slug){
        

        if(Module::find(3)->active == '0') abort('404');

        $product = ProductData::where('slug', $slug)->where('lang', config('app.locale'))->whereHas('base', function ($query){
            $query->where('active', '1');

        })->first();

        if(is_null($product)) abort('404');

        $productBase = $product->base;

        $meta = $product->metaTag();
        $images = $productBase->images;
        $category = $productBase->categories()->where('parent_id', '7')->first();

        //$documents = $productBase->documents;
        //$brands = $productBase->brands()->with('data')->get();

        $related = $productBase->getRelated();


        //SETTAGGIO URL PER SWITCH LINGUA
        $otherLang = otherLang();

        $url = url($otherLang."/".trans('website.classic', [], otherLang()));
       
        $pdLang = $productBase->getText($otherLang);
        if(!is_null($pdLang)){
            $url .= "/".$pdLang->slug;
        }

        return view('website.pages.single-product-cr')->with('product', $product)->with('productBase', $productBase)->with('meta', $meta)->with('images', $images)->with('category', $category)->with('related', $related)->with('main_cat', $category->getText())->with('url', $url);
    
    }


    public function singleProductCuproom($slug){
        
        if(Module::find(3)->active == '0') abort('404');

        $product = ProductData::where('slug', $slug)->where('lang', config('app.locale'))->whereHas('base', function ($query){
            $query->where('active', '1');
        })->first();

        if(is_null($product)) abort('404');

        $productBase = $product->base;

        $meta = $product->metaTag();
        $images = $productBase->images;
        $categories = $productBase->categories()->where('categories.id', '!=', '8')->get();

        $documents = $productBase->documents;
        $brands = $productBase->brands()->with('data')->get();

        $related = $productBase->getRelated();

        $finishes = $productBase->colors();

        //SETTAGGIO URL PER SWITCH LINGUA
        $otherLang = otherLang();

        $url = url($otherLang."/".trans('website.cuproom', [], otherLang()));
       
        $pdLang = $productBase->getText($otherLang);
        if(!is_null($pdLang)){
            $url .= "/".$pdLang->slug;
        }

        return view('website.pages.single-product-cup')->with('product', $product)->with('productBase', $productBase)->with('meta', $meta)->with('images', $images)->with('categories', $categories)->with('related', $related)->with('brands', $brands)->with('documents', $documents)->with('finishes', $finishes)->with('url', $url);
    
    }

    public function designers(){

        $designers = BrandData::where('lang', config('app.locale'))->whereHas('base', function($query) {
            $query->where('active', '1')->whereDate('created_at', '<=', date('Y-m-d H:i:s'));
        })->orderBy('name', 'asc')->get();

        return view('website.pages.designers')->with('designers', $designers);
 
    }


    public function contactsPage(Request $request){

        $text = isset($request->p) ? trans('website-text.info_request').": ".trans('website-text.product')." \"".$request->p."\"" : "";

        return view('website.pages.contact')->with('url', url(otherLang()."/".trans('website.contact', [], otherLang())))->with('text', $text); 

    }


}
