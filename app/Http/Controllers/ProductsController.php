<?php

namespace App\Http\Controllers;

use Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use App\Lib\Image;
use App\Lib\ImageRepository;
use App\Lib\DocumentRepository;

use App\Models\Core\Module;
use App\Models\Products\Product;
use App\Models\Products\ProductData;
use App\Models\Brands\Brand;
use App\Models\Brands\BrandData;
use App\Models\Core\Category;
use App\Models\Core\CategoryAssoc;
use App\Models\Core\Seo;


class ProductsController extends Controller
{
    
    protected $image;
    protected $document;

    public $module_id = '3';
    
    public function __construct(ImageRepository $imageRepository, DocumentRepository $documentRepository){

        $this->middleware(function ($request, $next) {
            
            $this->authorize('view', Module::find($this->module_id));

            return $next($request);
        });
        
        $this->image = $imageRepository;
        $this->document = $documentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deleted = Product::onlyTrashed()->count();

        $products = array();

        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            $products_lang = ProductData::where('lang', $localCode)->whereHas('base')->with('base')->orderBy('created_at', 'desc')->get();

            $products[$localCode] = $products_lang;
        }

        return view('admin.pages.products.listing')->with('products', $products)->with('deleted', $deleted)->with('module_id', $this->module_id);
    }

    public function deleted()
    {
        
        $products = Product::onlyTrashed()->orderBy('created_at', 'desc')->with('data')->get();

        return view('admin.pages.products.deleted')->with('products', $products)->with('module_id', $this->module_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('products.index');
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
            $new = new Product();
            $new->user_id = $request->user()->id;
            $new->save();
            $id = $new->id;
            $created_at = $new->created_at;
        }else{
            $id = $request->id;
            $created_at = Product::find($request->id)->created_at;
        }

        $new_trans = new ProductData();
        $new_trans->product_id = $id;
        $new_trans->name = $request->name;
        $new_trans->slug = slug_gen($request->name);
        $new_trans->lang = $request->lang;
        $new_trans->created_at = $created_at;
        $new_trans->save();

        return redirect()->route('products.edit', ['product' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return redirect()->route('products.edit', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $translates = $product->data;

        $categories = Category::where('parent_id', $this->module_id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
        $cat_assoc = $product->categories()->pluck('category_id')->all();

        if(Gate::check('view', \App\Models\Core\Module::find(6))){
            $brands = Brand::where('active', '1')->with(['data' => function ($query) {
                $query->orderBy('name');
            }])->get();
            $brands_assoc = $product->brands()->pluck('brand_id')->all();
        }else{
            $brands = array();
            $brands_assoc = array();
        }


        $preview = $product->preview();

        $creator = $product->user;

        $sizes = sizes();
        $colors = colors();

        $variants = $product->getChilds();
        $parents = Product::where('parent_id', NULL)->where('id', '!=', $product->id)->where('active', '1')->get();
        
        return view('admin.pages.products.edit')->with('product', $product)->with('translates', $translates)->with('categories', $categories)->with('cat_assoc', $cat_assoc)->with('brands', $brands)->with('brands_assoc', $brands_assoc)->with('preview', $preview)->with('creator', $creator)->with('sizes', $sizes)->with('colors', $colors)->with('variants', $variants)->with('parents', $parents)->with('module_id', $this->module_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // update categorie
        if(isset($request->id_category)){
            $product->categories()->toggle([$request->id_category]);

        // update active
        }elseif(isset($request->active) && !isset($request->main)){
            $product->active = $request->active;
            if($request->active == '0')
                $product->fav = '0';
            $product->save();

        // update dati generali
        }elseif(isset($request->main)){
            
            $product->created_at = $request->date_created_at." ".$request->time_created_at;
            $product->code = $request->code;
            $product->price = $request->price;
            $product->dimensions = $request->dimensions;
            $product->collection = $request->collection;
            $product->interactive = $request->interactive;

            $product->save();

            foreach($product->data as $trans){
                $trans->created_at = $request->date_created_at." ".$request->time_created_at;
                $trans->save();
            }
        
        // update traduzione    
        }elseif(isset($request->trans)){

            $trans = $product->getText($request->trans);
            $trans->name = $request->name;
            $trans->description = $request->content ?: '';
            $trans->data_sheet = $request->data_sheet ?: '';
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

        }elseif(isset($request->assoc)){
            $product->size = $request->size;
            $product->color = $request->color;

            if(Gate::check('view', \App\Models\Core\Module::find(6))){
                $brands = is_null($request->brand) ? array() : $request->brand;
                $product->brands()->sync($brands);
               
            }

            $product->parent_id = $request->parent;

            $product->save();
        }
       
        //return back()->with('ok-update', 'Dati salvati con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        if(isset($request->trans)){

            $trans = $product->data()->where('lang', $request->trans)->first();
            if($trans->metaTag())
                   $trans->metaTag()->delete();
            $trans->delete();

        }else{
            $product->active = '0';
            $product->save();
            $product->delete();
        }
    }


    public function restore(Product $producttrash)
    {
        $producttrash->restore();
    }

    public function forceDestroy(Product $producttrash)
    {   
        //CANCELLO IMMAGINI ASSOCIATE
        $images = $producttrash->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $producttrash );
        }
        //CANCELLO DOCUMENTI ASSOCIATI
        $documents = $producttrash->documents;
        foreach($documents as $doc){
            $this->document->delete( $doc->id, $producttrash );
        }
        //SCOLLEGO EVENTUALI RICHIESTE DA FORM ASSOCIATE
        $requests = $producttrash->requests;
        foreach($requests as $rq){
            $rq->message = $rq->message."\n\n(RIFERIMENTO RICHIESTA CANCELLATO)";
            $rq->ref_id = NULL;
            $rq->ref_type = NULL;
        }

        //ELIMINO TRADUZIONI CONTENUTI E METATAG SEO
        $trans = $producttrash->data;
        foreach($trans as $tr){
            $tr->meta()->delete();
            $tr->delete();
        }

        //ELIMINO ASSOCIAZIONE CATEGORIE
        $producttrash->categories()->detach();

        //FORZO CANCELLAZIONE ELEMENTO
        $producttrash->forceDelete();
        
    }


    //IMMAGINI

    public function uploadImg(Product $product)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $product);

        $img_id = $response->getData()->id;
        
        return $response;
    }


    public function getImg(Product $product)
    {

        $images = $product->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.products_img').$product->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }



    public function deleteImg(Product $product)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $product );

        return $response;
       
    }


    public function uploadFls(Product $product)
    {
        $doc = Input::all();
        $response = $this->document->upload($doc, $product);

        $doc_id = $response->getData()->id;
        
        return $response;
    }


    public function getFls(Product $product)
    {

        $documents = $product->documents;
        
        $documentAnswer = [];

        foreach ($documents as $document) {
            $documentAnswer[] = [
                'original' => $document->original_name,
                'id' => $document->id,
                'server' => $document->filename,
                'size' => File::size(config('paths.products_img').$product->id."/".$document->filename)
            ];
        }

        return response()->json([
            'images' => $documentAnswer,
        ]);
    }



    public function deleteFls(Product $product)
    {
        $doc_id = Input::get('id');

        if(!$doc_id) { return 0; }

        $response = $this->document->delete( $doc_id, $product );

        return $response;   
    }


    public function checkSlug(Request $request, Product $product){
        
        $response = true;
       
        $data = ProductData::where('slug', $request->slug)->whereHas('base', function ($query) use ($product){
            $query->where('id', '!=', $product->id);
        })->first();

        if($data){

            $response = false;
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }
}
