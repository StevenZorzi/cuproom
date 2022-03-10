<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Core\Module;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use Session;
use App\Lib\Image;
use App\Lib\ImageRepository;

use App\Models\Products\Product;
use App\Models\Products\ProductData;
use App\Models\Products\Variant;
use App\Models\Products\VariantData;
use Illuminate\Http\Request;

class VariantsController extends Controller
{   

    protected $image;
    
    public function __construct(ImageRepository $imageRepository)
    {

        $this->middleware(function ($request, $next) {
            
            $this->authorize('view', Module::find(3));

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
        $sizes = sizes();
        $colors = colors();

        return view('admin.pages.products.variants')->with('sizes', $sizes)->with('colors', $colors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('variants.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $new = new Variant();
        $new->type = $request->type;
        $new->save();
        $id = $new->id;

        foreach($request->name as $keylang => $name){
            if($name != ""){
                $new_trans = new VariantData();
                $new_trans->variant_id = $id;
                $new_trans->name = $name;
                $new_trans->lang = $keylang;
                $new_trans->save();
            }
        }

        return redirect()->route('variants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Variant $variant)
    {
        return redirect()->route('variants.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    {
        return redirect()->route('variants.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
        foreach($request->name as $keylang => $name){
            if($name != ""){
                VariantData::updateOrCreate(['variant_id' => $variant->id, 'lang' => $keylang], ['variant_id' => $variant->id, 'name' => $name, 'lang' => $keylang]);
            }else{
                VariantData::where('variant_id', $variant->id)->where('lang', $keylang)->delete();
            }
        }

        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        if($variant->isUsed())
            return false;

        $images = $variant->images;
        foreach($images as $img){
            $this->image->delete( $img->id, $variant );
        }

        $variant->data()->delete();
        $variant->delete();
        return 'ok';
    }


    public function reorderSizes(Request $request)
    {
        // riordino le varianti su DB
        foreach ($request->s as $key => $id) {
            $variant = Variant::find($id);
            $variant->ordering = $key;
            $variant->save();
        }
    }

    public function reorderColors(Request $request)
    {
        // riordino le varianti su DB
        foreach ($request->c as $key => $id) {
            $variant = Variant::find($id);
            $variant->ordering = $key;
            $variant->save();
        }
    }


    //IMMAGINI

    public function uploadImg(Variant $variant)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $variant);

        $img_id = $response->getData()->id;
        
        return $response;
    }


    public function getImg(Variant $variant)
    {

        $images = $variant->images;
        
        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'id' => $image->id,
                'server' => $image->filename,
                'size' => File::size(config('paths.variants_img').$variant->id."/".$image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer,
        ]);
    }


    public function deleteImg(Variant $variant)
    {
        $img_id = Input::get('id');

        if(!$img_id) { return 0; }

        $response = $this->image->delete( $img_id, $variant );

        return $response;
       
    }

}
