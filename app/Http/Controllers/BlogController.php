<?php

namespace App\Http\Controllers;

use Localization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Lib\Image;
use App\Lib\ImageRepository;

use App\Models\Core\Module;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogData;
use App\Models\Core\Category;
use App\Models\Core\CategoryAssoc;
use App\Models\Core\Seo;



class BlogController extends Controller
{
    protected $image;

    public $module_id = '1';

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
        $deleted = Blog::onlyTrashed()->count();
     
        $articles = array();

        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            $articles_lang = BlogData::where('lang', $localCode)->whereHas('base')->with('base')->orderBy('created_at', 'desc')->get();

            $articles[$localCode] = $articles_lang;
        }

        return view('admin.pages.blog.listing')->with('articles', $articles)->with('deleted', $deleted)->with('module_id', $this->module_id);
    }

    public function deleted()
    {
        
        $articles = Blog::onlyTrashed()->orderBy('created_at', 'desc')->with('data')->get();

        return view('admin.pages.blog.deleted')->with('articles', $articles)->with('module_id', $this->module_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('blog.index');
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
            $new = new Blog();
            $new->user_id = $request->user()->id;
            $new->save();
            $id = $new->id;
            $created_at = $new->created_at;
        }else{
            $id = $request->id;
            $created_at = Blog::find($request->id)->created_at;
        }

        $new_trans = new BlogData();
        $new_trans->blog_id = $id;
        $new_trans->title = $request->title;
        $new_trans->slug = slug_gen($request->title);
        $new_trans->lang = $request->lang;
        $new_trans->created_at = $created_at;
        $new_trans->save();

        return redirect()->route('blog.edit', ['blog' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return redirect()->route('blog.edit', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {   
        $translates = $blog->data;

        $categories = Category::where('parent_id', $this->module_id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
        $cat_assoc = $blog->categories()->pluck('category_id')->all();

        $preview = $blog->preview();

        $creator = $blog->user;
        
        return view('admin.pages.blog.edit')->with('article', $blog)->with('translates', $translates)->with('categories', $categories)->with('cat_assoc', $cat_assoc)->with('preview', $preview)->with('creator', $creator)->with('module_id', $this->module_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        // update categorie
        if(isset($request->id_category)){
            $blog->categories()->toggle([$request->id_category]);

        // update active
        }elseif(isset($request->active) && !isset($request->main)){
            $blog->active = $request->active;
            if($request->active == '0')
                $blog->fav = '0';
            $blog->save();

        // update dati generali
        }elseif(isset($request->main)){
            
            $blog->created_at = $request->date_created_at." ".$request->time_created_at; 
            $blog->date_from = $request->date_from;
            $blog->date_to = $request->date_to;
            $blog->time = $request->time;
            $blog->place = $request->place;
            $blog->save();

            foreach($blog->data as $trans){
                $trans->created_at = $request->date_created_at." ".$request->time_created_at;
                $trans->save();
            }
        
        // update traduzione    
        }elseif(isset($request->trans)){

            $trans = $blog->getText($request->trans);
            $trans->title = $request->title;
            $trans->subtitle = $request->subtitle ?: '';
            $trans->content = $request->content ?: '';
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
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Blog $blog)
    {
        if(isset($request->trans)){

            $trans = $blog->data()->where('lang', $request->trans)->first();
            if($trans->metaTag())
                   $trans->metaTag()->delete();
            $trans->delete();

        }else{
            $blog->active = '0';
            $blog->save();
            $blog->delete();
        }
    }


    public function restore(Blog $blogtrash)
    {
        $blogtrash->restore();
    }

    public function forceDestroy(Blog $blogtrash)
    {   
        //CANCELLO IMMAGINI ASSOCIATE
        $images = $blogtrash->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $blogtrash );
        }
        //SCOLLEGO EVENTUALI RICHIESTE DA FORM ASSOCIATE
        $requests = $blogtrash->requests;
        foreach($requests as $rq){
            $rq->message = $rq->message."\n\n(RIFERIMENTO RICHIESTA CANCELLATO)";
            $rq->ref_id = NULL;
            $rq->ref_type = NULL;
        }

        //ELIMINO TRADUZIONI CONTENUTI E METATAG SEO
        $trans = $blogtrash->data;
        foreach($trans as $tr){
            $tr->meta()->delete();
            $tr->delete();
        }

        //ELIMINO ASSOCIAZIONE CATEGORIE
        $blogtrash->categories()->detach();

        //FORZO CANCELLAZIONE ELEMENTO
        $blogtrash->forceDelete();
        
    }



    //IMMAGINI

    public function uploadImg(Blog $blog)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $blog);

        $img_id = $response->getData()->id;
        
        return $response;
    }


    public function getImg(Blog $blog)
    {

        $images = $blog->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.blog_img').$blog->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }



    public function deleteImg(Blog $blog)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $blog );

        return $response;
       
    }


    public function checkSlug(Request $request, Blog $blog){
        
        $response = true;
       
        $data = BlogData::where('slug', $request->slug)->whereHas('base', function ($query) use ($blog){
            $query->where('id', '!=', $blog->id);
        })->first();

        if($data){

            $response = false;
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }
}
