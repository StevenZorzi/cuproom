<?php

namespace App\Http\Controllers;

use Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use App\Lib\Image;
use App\Lib\ImageRepository;

use App\Models\Core\Module;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryData;
use App\Models\Core\Category;
use App\Models\Core\CategoryAssoc;
use App\Models\Core\Seo;
use App\Models\Products\Product;

class GalleryController extends Controller
{
    protected $image;

    public $module_id = '4';
    
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
        $deleted = Gallery::onlyTrashed()->count();

        $galleries = array();

        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            $galleries_lang = GalleryData::where('lang', $localCode)->whereHas('base')->with('base')->orderBy('created_at', 'desc')->get();
            $galleries[$localCode] = $galleries_lang;
        }


        return view('admin.pages.gallery.listing')->with('galleries', $galleries)->with('deleted', $deleted)->with('module_id', $this->module_id);
    }

    public function deleted()
    {
        
        $galleries = Gallery::onlyTrashed()->orderBy('created_at', 'desc')->with('data')->get();

        return view('admin.pages.gallery.deleted')->with('galleries', $galleries)->with('module_id', $this->module_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('gallery.index');
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
            $new = new Gallery();
            $new->user_id = $request->user()->id;
            $new->save();
            $id = $new->id;
            $created_at = $new->created_at;
        }else{
            $id = $request->id;
            $created_at = Gallery::find($request->id)->created_at;
        }

        $new_trans = new GalleryData();
        $new_trans->gallery_id = $id;
        $new_trans->title = $request->title;
        $new_trans->slug = slug_gen($request->title);
        $new_trans->lang = $request->lang;
        $new_trans->created_at = $created_at;
        $new_trans->save();

        return redirect()->route('gallery.edit', ['gallery' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return redirect()->route('gallery.edit', ['gallery' => $gallery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $translates = $gallery->data;

        $categories = Category::where('parent_id', $this->module_id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
        $cat_assoc = $gallery->categories()->pluck('category_id')->all();

        $preview = $gallery->preview();

        if(Gate::check('view', \App\Models\Core\Module::find(3))){
            $products = Product::where('active', '1')->get();
            $products_assoc = $gallery->product;
        }else{
            $products = array();
            $products_assoc = array();
        }
        
        $creator = $gallery->user;

        return view('admin.pages.gallery.edit')->with('gallery', $gallery)->with('translates', $translates)->with('categories', $categories)->with('cat_assoc', $cat_assoc)->with('preview', $preview)->with('creator', $creator)->with('module_id', $this->module_id)->with('products', $products)->with('products_assoc', $products_assoc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        // update categorie
        if(isset($request->id_category)){
            $gallery->categories()->toggle([$request->id_category]);

        // update active
        }elseif(isset($request->active) && !isset($request->main)){
            $gallery->active = $request->active;
            if($request->active == '0')
                $gallery->fav = '0';
            $gallery->save();

        // update dati generali
        }elseif(isset($request->main)){
            
            $gallery->created_at = $request->date_created_at." ".$request->time_created_at; 

            if(Gate::check('view', \App\Models\Core\Module::find(3))){
                $gallery->product = $request->product;
            }

            $gallery->save();

            foreach($gallery->data as $trans){
                $trans->created_at = $request->date_created_at." ".$request->time_created_at;
                $trans->save();
            }
        
        // update traduzione    
        }elseif(isset($request->trans)){

            $trans = $gallery->getText($request->trans);
            $trans->title = $request->title;
            $trans->description = $request->content ?: '';
            $trans->period = $request->period ?: '';
            $trans->place = $request->place ?: '';
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
    public function destroy(Request $request, Gallery $gallery)
    {
        if(isset($request->trans)){

            $trans = $gallery->data()->where('lang', $request->trans)->first();
            if($trans->metaTag())
                   $trans->metaTag()->delete();
            $trans->delete();

        }else{
            $gallery->active = '0';
            $gallery->save();
            $gallery->delete();
        }
    }


    public function restore(Gallery $gallerytrash)
    {
        $gallerytrash->restore();
    }

    public function forceDestroy(Gallery $gallerytrash)
    {
        
        //CANCELLO IMMAGINI ASSOCIATE
        $images = $gallerytrash->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $gallerytrash );
        }
        //SCOLLEGO EVENTUALI RICHIESTE DA FORM ASSOCIATE
        $requests = $gallerytrash->requests;
        foreach($requests as $rq){
            $rq->message = $rq->message."\n\n(RIFERIMENTO RICHIESTA CANCELLATO)";
            $rq->ref_id = NULL;
            $rq->ref_type = NULL;
        }

        //ELIMINO TRADUZIONI CONTENUTI E METATAG SEO
        $trans = $gallerytrash->data;
        foreach($trans as $tr){
            $tr->meta()->delete();
            $tr->delete();
        }

        //ELIMINO ASSOCIAZIONE CATEGORIE
        $gallerytrash->categories()->detach();

        //FORZO CANCELLAZIONE ELEMENTO
        $gallerytrash->forceDelete();
        
    }



    //IMMAGINI

    public function uploadImg(Gallery $gallery)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $gallery);

        $img_id = $response->getData()->id;
        
        return $response;
    }


    public function getImg(Gallery $gallery)
    {

        $images = $gallery->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.gallery_img').$gallery->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }


    public function deleteImg(Gallery $gallery)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $gallery );

        return $response;
       
    }


    public function checkSlug(Request $request, Gallery $gallery){
        
        $response = true;
       
        $data = GalleryData::where('slug', $request->slug)->whereHas('base', function ($query) use ($gallery){
            $query->where('id', '!=', $gallery->id);
        })->first();

        if($data){

            $response = false;
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }
}