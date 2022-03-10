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
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioData;
use App\Models\Brands\Brand;
use App\Models\Brands\BrandData;
use App\Models\Core\Category;
use App\Models\Core\CategoryAssoc;
use App\Models\Core\Seo;



class PortfolioController extends Controller
{
    protected $image;
    protected $document;

    public $module_id = '2';
    
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
        $deleted = Portfolio::onlyTrashed()->count();

        $projects = array();

        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            $projects_lang = PortfolioData::where('lang', $localCode)->whereHas('base')->with('base')->orderBy('created_at', 'desc')->get();

            $projects[$localCode] = $projects_lang;
        }

        return view('admin.pages.portfolio.listing')->with('projects', $projects)->with('deleted', $deleted)->with('module_id', $this->module_id);
    }

    public function deleted()
    {
        
        $projects = Portfolio::onlyTrashed()->orderBy('created_at', 'desc')->with('data')->get();

        return view('admin.pages.portfolio.deleted')->with('projects', $projects)->with('module_id', $this->module_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('portfolio.index');
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
            $new = new Portfolio();
            $new->user_id = $request->user()->id;
            $new->save();
            $id = $new->id;
            $created_at = $new->created_at;
        }else{
            $id = $request->id;
            $created_at = Portfolio::find($request->id)->created_at;
        }

        $new_trans = new PortfolioData();
        $new_trans->portfolio_id = $id;
        $new_trans->title = $request->title;
        $new_trans->slug = slug_gen($request->title);
        $new_trans->lang = $request->lang;
        $new_trans->created_at = $created_at;
        $new_trans->save();

        return redirect()->route('portfolio.edit', ['portfolio' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return redirect()->route('portfolio.edit', ['portfolio' => $portfolio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $translates = $portfolio->data;

        $categories = Category::where('parent_id', $this->module_id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
        $cat_assoc = $portfolio->categories()->pluck('category_id')->all();

        
        $brands = Brand::where('active', '1')->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
        $brands_assoc = $portfolio->brands()->pluck('brand_id')->all();


        $preview = $portfolio->preview();

        $creator = $portfolio->user;
        
        return view('admin.pages.portfolio.edit')->with('project', $portfolio)->with('translates', $translates)->with('categories', $categories)->with('cat_assoc', $cat_assoc)->with('brands', $brands)->with('brands_assoc', $brands_assoc)->with('preview', $preview)->with('creator', $creator)->with('module_id', $this->module_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        // update categorie
        if(isset($request->id_category)){
            $portfolio->categories()->toggle([$request->id_category]);

        // update active
        }elseif(isset($request->active) && !isset($request->main)){
            $portfolio->active = $request->active;
            if($request->active == '0')
                $portfolio->fav = '0';
            $portfolio->save();

        // update dati generali
        }elseif(isset($request->main)){
            

            if(Gate::check('view', \App\Models\Core\Module::find(6))){
                $brands = is_null($request->brand) ? array() : $request->brand;
                $portfolio->brands()->sync($brands);
            }

            $portfolio->created_at = $request->date_created_at." ".$request->time_created_at;
            $portfolio->date_from = $request->date_from;
            $portfolio->date_to = $request->date_to;
            $portfolio->place = $request->place;
            
            $portfolio->save();

            foreach($portfolio->data as $trans){
                $trans->created_at = $request->date_created_at." ".$request->time_created_at;
                $trans->save();
            }
        
        // update traduzione    
        }elseif(isset($request->trans)){

            $trans = $portfolio->getText($request->trans);
            $trans->title = $request->title;
            $trans->subtitle = $request->subtitle ?: '';
            $trans->description = $request->content ?: '';
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
    public function destroy(Request $request, Portfolio $portfolio)
    {
        if(isset($request->trans)){

            $trans = $portfolio->data()->where('lang', $request->trans)->first();
            if($trans->metaTag())
                   $trans->metaTag()->delete();
            $trans->delete();

        }else{
            $portfolio->active = '0';
            $portfolio->save();
            $portfolio->delete();
        }
    }


    public function restore(Portfolio $portfoliotrash)
    {
        $portfoliotrash->restore();
    }

    public function forceDestroy(Portfolio $portfoliotrash)
    {   
        //CANCELLO IMMAGINI ASSOCIATE
        $images = $portfoliotrash->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $portfoliotrash );
        }
        //CANCELLO DOCUMENTI ASSOCIATI
        $documents = $portfoliotrash->documents;
        foreach($documents as $doc){
            $this->document->delete( $doc->id, $portfoliotrash );
        }
        
        //SCOLLEGO EVENTUALI RICHIESTE DA FORM ASSOCIATE
        $requests = $portfoliotrash->requests;
        foreach($requests as $rq){
            $rq->message = $rq->message."\n\n(RIFERIMENTO RICHIESTA CANCELLATO)";
            $rq->ref_id = NULL;
            $rq->ref_type = NULL;
        }

        //ELIMINO TRADUZIONI CONTENUTI E METATAG SEO
        $trans = $portfoliotrash->data;
        foreach($trans as $tr){
            $tr->meta()->delete();
            $tr->delete();
        }

        //ELIMINO ASSOCIAZIONE CATEGORIE
        $portfoliotrash->categories()->detach();

        //FORZO CANCELLAZIONE ELEMENTO
        $portfoliotrash->forceDelete();
        
    }



    //IMMAGINI

    public function uploadImg(Portfolio $portfolio)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $portfolio);

        $img_id = $response->getData()->id;
        
        return $response;
    }

    public function getImg(Portfolio $portfolio)
    {

        $images = $portfolio->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.portfolio_img').$portfolio->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }

    public function deleteImg(Portfolio $portfolio)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $portfolio );

        return $response;
       
    }


    public function uploadFls(Portfolio $portfolio)
    {
        $doc = Input::all();
        $response = $this->document->upload($doc, $portfolio);

        $doc_id = $response->getData()->id;
        
        return $response;
    }

    public function getFls(Portfolio $portfolio)
    {

        $documents = $portfolio->documents;
        
        $documentAnswer = [];

        foreach ($documents as $document) {
            $documentAnswer[] = [
                'original' => $document->original_name,
                'id' => $document->id,
                'server' => $document->filename,
                'size' => File::size(config('paths.portfolio_img').$portfolio->id."/".$document->filename)
            ];
        }

        return response()->json([
            'images' => $documentAnswer,
        ]);
    }

    public function deleteFls(Portfolio $portfolio)
    {
        $doc_id = Input::get('id');

        if(!$doc_id) { return 0; }

        $response = $this->document->delete( $doc_id, $portfolio );

        return $response;   
    }


    public function checkSlug(Request $request, Portfolio $portfolio){
        
        $response = true;
       
        $data = PortfolioData::where('slug', $request->slug)->whereHas('base', function ($query) use ($portfolio){
            $query->where('id', '!=', $portfolio->id);
        })->first();

        if($data){

            $response = false;
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }
}
