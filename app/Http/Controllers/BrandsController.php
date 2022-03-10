<?php

namespace App\Http\Controllers;

use Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Lib\Image;
use App\Lib\ImageRepository;

use App\Models\Core\Module;
use App\Models\Brands\Brand;
use App\Models\Brands\BrandData;
use App\Models\Products\Product;
use App\Models\Products\ProductData;
use App\Models\Core\Category;
use App\Models\Core\CategoryAssoc;
use App\Models\Core\Seo;


class BrandsController extends Controller
{
    
    protected $image;

    public $module_id = '6';
    
    public function __construct(ImageRepository $imageRepository)
    {

        $this->middleware(function ($request, $next) {
            
            $this->authorize('view', Module::find($this->module_id));

            return $next($request);
        });
        
        $this->image = $imageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deleted = Brand::onlyTrashed()->count();

        $brands = array();

        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            $brands_lang = BrandData::where('lang', $localCode)->whereHas('base')->with('base')->orderBy('created_at', 'desc')->get();

            $brands[$localCode] = $brands_lang;
        }


        return view('admin.pages.brands.listing')->with('brands', $brands)->with('deleted', $deleted)->with('module_id', $this->module_id);
    }

    public function deleted()
    {
        
        $brands = Brand::onlyTrashed()->orderBy('created_at', 'desc')->with('data')->get();

        return view('admin.pages.brands.deleted')->with('brands', $brands)->with('module_id', $this->module_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('brands.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset($request->id)){
            $new = new Brand();
            $new->save();
            $id = $new->id;
            $created_at = $new->created_at;
            
        }else{
            $id = $request->id;
            $created_at = Brand::find($request->id)->created_at;
        }

        $new_trans = new BrandData();
        $new_trans->brand_id = $id;
        $new_trans->name = $request->name;
        $new_trans->slug = slug_gen($request->name);
        $new_trans->lang = $request->lang;
        $new_trans->created_at = $created_at;
        $new_trans->save();

        return redirect()->route('brands.edit', ['brand' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return redirect()->route('brands.edit', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $translates = $brand->data;

        $categories = Category::where('parent_id', $this->module_id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
        $cat_assoc = $brand->categories()->pluck('category_id')->all();

        $preview = $brand->preview();

        $creator = $brand->user;
        
        return view('admin.pages.brands.edit')->with('brand', $brand)->with('translates', $translates)->with('preview', $preview)->with('creator', $creator)->with('categories', $categories)->with('cat_assoc', $cat_assoc)->with('module_id', $this->module_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        // update categorie
        if(isset($request->id_category)){
            $brand->categories()->toggle([$request->id_category]);

        // update active
        }elseif(isset($request->active) && !isset($request->main)){
            $brand->active = $request->active;
            if($request->active == '0')
                $brand->fav = '0';
            $brand->save();

        // update dati generali
        }elseif(isset($request->main)){
            
            $brand->created_at = $request->date_created_at." ".$request->time_created_at;
            $brand->save();
            
            foreach($brand->data as $trans){
                $trans->created_at = $request->date_created_at." ".$request->time_created_at;
                $trans->save();
            }
            
        // update traduzione    
        }elseif(isset($request->trans)){

            $trans = $brand->getText($request->trans);
            $trans->name = $request->name;
            $trans->description = $request->description ?: '';
            $trans->slug = $request->slug;
            $trans->save();

            //SEO
            if(is_null($request->meta_title) && is_null($request->meta_description)){
                if($trans->metaTag())
                   $trans->metaTag()->delete();
            }else{
                $meta = $trans->metaTag() ?: new Seo;
                $meta->title = $request->meta_title;
                $meta->description = $request->meta_description;
                $meta->lang = $trans->lang;
                $trans->meta()->save($meta);
            }

        }   
       
        //return back()->with('ok-update', 'Dati salvati con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        if(isset($request->trans)){

            $trans = $brand->data()->where('lang', $request->trans)->first();
            if($trans->metaTag())
                   $trans->metaTag()->delete();
            $trans->delete();

        }else{
            $brand->active = '0';
            $brand->save();
            $brand->delete();
        }
    }


    public function restore(Brand $brandtrash)
    {
        $brandtrash->restore();
    }

    public function forceDestroy(Brand $brandtrash)
    {
        
        //CANCELLO IMMAGINI ASSOCIATE
        $images = $brandtrash->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $brandtrash );
        }
        //SCOLLEGO EVENTUALI RICHIESTE DA FORM ASSOCIATE
        $requests = $brandtrash->requests;
        foreach($requests as $rq){
            $rq->message = $rq->message."\n\n(RIFERIMENTO RICHIESTA CANCELLATO)";
            $rq->ref_id = NULL;
            $rq->ref_type = NULL;
        }

        //ELIMINO TRADUZIONI CONTENUTI E METATAG SEO
        $trans = $brandtrash->data;
        foreach($trans as $tr){
            $tr->meta()->delete();
            $tr->delete();
        }

        //ELIMINO ASSOCIAZIONE CATEGORIE
        $brandtrash->categories()->detach();

        //FORZO CANCELLAZIONE ELEMENTO
        $brandtrash->forceDelete();
        
    }



    //IMMAGINI

    public function uploadImg(Brand $brand)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $brand);

        $img_id = $response->getData()->id;
        
        return $response;
    }


    public function getImg(Brand $brand)
    {

        $images = $brand->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.brands_img').$brand->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }


    public function deleteImg(Brand $brand)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $brand );

        return $response;
       
    }


    public function checkSlug(Request $request, Brand $brand){
        
        $response = true;
        
        $data = BrandData::where('slug', $request->slug)->whereHas('base', function ($query) use ($brand){
            $query->where('id', '!=', $brand->id);
        })->first();

        if($data){

            $response = false;
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }
}
