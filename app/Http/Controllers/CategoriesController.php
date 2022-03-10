<?php

namespace App\Http\Controllers;

use App\Models\Core\Module;
use App\Models\Core\Category;
use App\Models\Core\CategoryData;
use App\Models\Core\CategoryAssoc;
use App\Models\Core\Seo;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module)
    {
        $categories = Category::where('parent_id', $module->category_id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->withCount('data')->get();

        $main_category = Category::find($module->category_id);

        return view('admin.pages.categories')->with('module', $module)->with('categories', $categories)->with('main_category', $main_category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module)
    {
        return redirect()->route('categories.index', ['module' => $module]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $module)
    {
        if(!isset($request->ref)){
            $category = new Category(['parent_id' => $request->parent]);
            $category->save();
        }else{
           $category = Category::find($request->ref);
        }

        $categoryData = new CategoryData(['name' => $request->name, 'category_id' => $category->id, 'slug' => slug_gen($request->name), 'lang' => $request->lang]);
        $category->data()->save($categoryData);

        //SEO
        if(!is_null($request->meta_title) || !is_null($request->meta_description)){
    
            $meta = $categoryData->metaTag() ?: new Seo;
            $meta->title = $request->meta_title;
            $meta->description = $request->meta_description;
            $meta->lang = $categoryData->lang;
            $categoryData->meta()->save($meta);
        }

        return redirect()->back()->with('ok-add', 'Categoria aggiunta con successo')->with('expanded', $request->ref);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($module, $category)
    {
        return redirect()->route('categories.index', ['module' => $module]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($module, $category)
    {
        return redirect()->route('categories.index', ['module' => $module]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $module, $category)
    {
        $cat = CategoryData::find($request->trans);

        if(!Module::find($cat->category_id)){
            $cat->name = $request->name;
            $cat->slug = $request->slug;
            $cat->save();
        }

        //SEO
        if(is_null($request->meta_title) && is_null($request->meta_description)){
            if($cat->metaTag())
               $cat->metaTag()->delete();
        }else{
            $meta = $cat->metaTag() ?: new Seo;
            $meta->title = $request->meta_title;
            $meta->description = $request->meta_description;
            $meta->lang = $cat->lang;
            $cat->meta()->save($meta);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $module, $category)
    {
        if(isset($request->id)){
            CategoryData::find($request->id)->delete();
        }else{
            CategoryAssoc::where('category_id', $category->id)->delete();
            Category::where('parent_id', $category->id)->update(['parent_id' => $category->parent_id]);
            $category->data()->delete();
            $category->delete();
        }
    }

    public function checkSlug(Request $request, $table){
        
        $response = true;

        $check = CategoryData::where('slug', $request->slug)->where('category_id', "!=", $request->id)->get();
        foreach($check as $f){
            if(CategoryData::find($request->trans)->base->module() == $f->base->module())
                $response = false;
        }
        
        echo json_encode(array(
            'valid' => $response,
        ));
    }
}
