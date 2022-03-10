<?php

namespace App\Http\Controllers;

use \Artisan;
use App;
use Symfony\Component\Console\Output\StreamOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Lib\Language;
use App\Lib\Image;
use App\Lib\ImageData;
use App\Models\Core\Module;
use App\Models\Core\Category;
use App\Models\Core\CategoryData;

use App\Models\Blog\Blog;
use App\Models\Portfolio\Portfolio;
use App\Models\Products\Product;
use App\Models\Brands\Brand;
use App\Models\Gallery\Gallery;
use App\Models\ContactRequests\ContactRequest;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function test()
    {
        echo App::getLocale();
        //return view('admin.pages.test');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = array();
        $data = array();

        $module = App\Models\Core\Module::find(1);
        $actives = Blog::where('active', '1');

        $data['module'] = $module;
        $data['icon'] = "fa fa-newspaper-o icon-fw";
        $data['color'] = "panel-primary";
        $data['text'] = $module->getText();
        $data['actives'] = $actives->get();
        $data['count_a'] = $actives->count();
        $data['count_i'] = Blog::where('active','0')->count();
        $data['table'] = $actives->first() ? $actives->first()->getTable() : '';
        
        $modules[$module->id] = $data;


        $module = App\Models\Core\Module::find(2);
        $actives = Portfolio::where('active', '1');

        $data['module'] = $module;
        
        $data['icon'] = "ion-clipboard icon-fw";
        $data['color'] = "panel-warning";
        $data['text'] = $module->getText();
        $data['actives'] = $actives->get();
        $data['count_a'] = $actives->count();
        $data['count_i'] = Portfolio::where('active','0')->count();
        $data['table'] = $actives->first() ? $actives->first()->getTable() : '';
        
        $modules[$module->id] = $data;


        $module = App\Models\Core\Module::find(3);
        $actives = Product::where('active', '1');

        $data['module'] = $module;
        $data['icon'] = "ion-tshirt-outline icon-fw";
        $data['color'] = "panel-purple";
        $data['text'] = $module->getText();
        $data['actives'] = $actives->get();
        $data['count_a'] = $actives->count();
        $data['count_i'] = Product::where('active','0')->count();
        $data['table'] = $actives->first() ? $actives->first()->getTable() : '';
        
        $modules[$module->id] = $data;


        $module = App\Models\Core\Module::find(4);
        $actives = Gallery::where('active', '1');

        $data['module'] = $module;
        $data['icon'] = "ion-images icon-fw";
        $data['color'] = "panel-info";
        $data['text'] = $module->getText();
        $data['actives'] = $actives->get();
        $data['count_a'] = $actives->count();
        $data['count_i'] = Gallery::where('active','0')->count();
        $data['table'] = $actives->first() ? $actives->first()->getTable() : '';
        
        $modules[$module->id] = $data;


        $module = App\Models\Core\Module::find(6);
        $actives = Brand::where('active', '1');

        $data['module'] = $module;
        $data['icon'] = "ion-ios-color-filter-outline icon-fw";
        $data['color'] = "panel-danger";
        $data['text'] = $module->getText();
        $data['actives'] = $actives->get();
        $data['count_a'] = $actives->count();
        $data['count_i'] = Brand::where('active','0')->count();
        $data['table'] = $actives->first() ? $actives->first()->getTable() : '';
        
        $modules[$module->id] = $data;


        $module = App\Models\Core\Module::find(5);
        $actives = ContactRequest::where('response', '1');
        $data['module'] = $module;
        
        $data['icon'] = "psi-mail icon-fw";
        $data['color'] = "panel-mint";
        $data['text'] = $module->getText();
        $data['actives'] = $actives->get();
        $data['count_a'] = $actives->count();
        $data['count_i'] = ContactRequest::where('response','0')->count();
        $data['table'] = $actives->first() ? $actives->first()->getTable() : '';
        
        $modules[$module->id] = $data;

       
        return view('admin.pages.dashboard')->with('modules', $modules);
    }

    /* VISUALIZZAZIONE IMPOSTAZIONI */
    public function showSettings()
    {   
        $this->authorize('access', User::class);

        $languages = Language::orderBy('ordering','asc')->get();
        $modules = Module::all();
        return view('admin.pages.settings')->with('languages', $languages)->with('modules', $modules);
    }


    /* GESTIONE MODULI */
    public function updateModules(Request $request)
    {
        
        $this->authorize('access', User::class);

        foreach($request->module_data as $key => $module_data){
            
            
            foreach($module_data as $key_lang => $module){
                
                CategoryData::updateOrCreate(['category_id' => $key, 'lang' => $key_lang], ['category_id' => $key, 'name' => $module['name'], 'slug' => $module['slug'], 'lang' => $key_lang]);
            }
        }

    
        $modules = Module::all();
        foreach($modules as $module){
            if(is_array($request->module_active) && array_key_exists($module->id, $request->module_active))
                $module->active = '1';
            else
                $module->active = '0';
            
            
            $roles = isset($request->module_roles[$module->id]) ? $request->module_roles[$module->id] : [];
            array_unshift($roles, "superadmin");
            $module->roles = $roles;
            $module->save();
        }
        
        return back()->with('ok-update', 'Impostazioni salvate con successo');
        
    }


    /* GESTIONE MULTILINGUA */
    public function addLanguage(Request $request)
    {
        $this->authorize('access', User::class);

        if(Language::where('slug', $request->slug)->first())
            return back()->with('already-exist', 'Lingua già esistente');
        
        $last = Language::max('ordering');
        $new = new Language();
        $new->slug = $request->slug;
        $new->name = $request->name;
        $new->ordering = (intval($last)+1);
        $new->save();

        return back()->with('ok-update', 'Impostazioni salvate con successo');
    }

    public function updateLanguage(Request $request)
    {   
        $this->authorize('access', User::class);

        $language = Language::find($request->id);
        $language->name = $request->name;
        $language->save();
        
        return 'ok';
    }

    public function deleteLanguage(Request $request)
    {   
        $this->authorize('access', User::class);
        
        Language::destroy($request->id);
        return 'ok';
    }

    public function reorderLanguages(Request $request)
    {
        // riordino le varianti su DB
        foreach ($request->v as $key => $id) {
            $language = Language::find($id);
            $language->ordering = $key;
            $language->save();
        }
    }


    public function reorderImages(Request $request)
    {
        // riordino le varianti su DB
        foreach ($request->img as $key => $id) {
            $image = Image::find($id);
            if($key == 0)
                $filename = $image->filename;
            $image->ordering = $key;
            $image->save();
        }

        return $filename;
    }

    public function getImagesInfo(Request $request)
    {      
        $img = Image::find($request->id);
  
        return \View::make('admin.layout.modal-img-info')->with('img', $img)->with('ref_id', $request->ref_id)->render();
    }

    public function updateImagesInfo(Request $request)
    {   
        foreach($request->title as $key => $title){
            if($request->title[$key] != "" || $request->alt[$key] != "" || $request->content[$key] != "" || $request->link[$key] != "" || $request->tag[$key] != ""){
                ImageData::updateOrCreate(['image_id' => $request->img, 'lang' => $key], ['image_id' => $request->img, 'title' => $request->title[$key], 'alt' => $request->alt[$key], 'description' => $request->description[$key], 'link' => $request->link[$key], 'tag' => $request->tag[$key], 'lang' => $key]);
            }else{
                ImageData::where('image_id', $request->img)->where('lang', $key)->delete();
            }
        }
    }


    public function artisanMaintenance(Request $request)
    {
        Artisan::call($request->command);
    }

    public function artisanMigrate(Request $request)
    {
        if(isset($request->parameter))
            return Artisan::call($request->command, [$request->parameter => true]);
        else
            return Artisan::call($request->command);

    }


    public function updateFavorites($table, Request $request)
    {   
        $fav = is_null($request->fav) ? array() : $request->fav;
        DB::table($table)->where('active', '1')->whereIn('id', $fav)->update(['fav' => '1']);
        DB::table($table)->where('active', '1')->whereNotIn('id', $fav)->update(['fav' => '0']);

        //return redirect()->route('favorites');
    }
    
}
