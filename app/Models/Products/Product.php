<?php

namespace App\Models\Products;

use App;
use Auth;
use Localization;
use App\Lib\Language;
use App\User;
use App\Models\Products\Product;
use App\Models\Products\ProductData;
use App\Models\Products\Variant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = ['size'=>'array', 'color'=>'array'];

    protected $fillable = ['parent_id'];
    
    
    //restituisce l'utente che ha creato il contenuto
    public function user()
	{
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
	}

	//restituisce i dati
    public function data()
	{
		return $this->hasMany('App\Models\Products\ProductData', 'product_id');
	}

	// associazione tramite tabella categoryAssoc a Category
	public function categories()
    {
        return $this->morphToMany('App\Models\Core\Category', 'ref', 'categories_assoc');
    }

    // associazione tramite tabella categoryAssoc a Category
    public function brands()
    {
        return $this->morphToMany('App\Models\Brands\Brand', 'ref', 'brands_assoc');
    }

    public function images()
    {
        return $this->morphMany('App\Lib\Image', 'ref')->orderBy('ordering');
    }

    public function documents()
    {
        return $this->morphMany('App\Lib\Document', 'ref')->orderBy('ordering');
    }

    public function requests()
    {
        return $this->morphMany('App\Models\ContactRequests\ContactRequest', 'ref');
    }

    public function setCreatedAtAttribute($value)
    {   
        $format = 'd/m/Y H:i';
        if(strpos($value, "-"))
            $this->attributes['created_at'] = $value;
        else
            $this->attributes['created_at'] = \Carbon\Carbon::createFromFormat($format, $value, Auth::User()->timezone)->tz(config('app.timezone'))->format('Y-m-d H:i');
    }

    public function getCreatedAtAttribute()
    {
        $tz = Auth::User() ? Auth::User()->timezone : config('app.timezone');
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->tz($tz);
    }
    public function getUpdatedAtAttribute()
    {
        $tz = Auth::User() ? Auth::User()->timezone : config('app.timezone');
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->tz($tz);
    }

    public function getPriceAttribute()
    {
        return str_replace('.',',', $this->attributes['price']);
    }

    public function setPriceAttribute($value)
    {
        if($value != NULL)
            $this->attributes['price'] =  str_replace(',','.', $value);
        else
            $this->attributes['price'] = $value;
    }

    public function getText($language = null)
    {
        if($language == null){
            $language = App::getLocale();
        }
        return ProductData::firstOrNew(['product_id' => $this->id, 'lang'=> $language]);
    }

    public function getMainText($language = null)
    {   
        $trans = $this->data;
        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            if($main = $trans->where('lang', $localCode)->first())
                return $main;
        }
        return new ProductData();
    }

    public function preview($full = "thumb-")
    {

        if($full == "full") $full = "";
        elseif($full == "small") $full = "small-";

        $image = $this->images()->orderBy('ordering')->first();
        if($image){
            $img = $image->filename;
            return config('paths.products_img').$this->id."/".$full.$img;
        }
        
        return 'img/noimg.jpg';
    }

	//verifica se è pubblicato
    public function isActive()
	{
		return $this->active == '1';
	}

    public function getStatus()
    {
        $status = $this->active ? 'published' : 'draft';
        $color = $this->active ? 'success' : 'warning';
        return '<small><span class="label label-'.$color.'">'.trans('interface.'.$status).'</span></small>';
    }

    public function getChilds(){
        return Product::where('parent_id', $this->id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->get();
    }

    //IN BASE ALL'ASSOCIAZIONE DELLE VARIANTI
    /*public function getRelated(){

        $related = Product::where('id', $this->parent_id)->orWhere('parent_id', $this->id);
        if(!is_null($this->parent_id))
            $related = $related->orWhere('parent_id', $this->parent_id);
        $related = $related->where('id', '!=', $this->id);

        return $related->get();
    }*/

    //IN BASE ALLA CATEGORIA
    public function getRelated(){

        $id = $this->id;
        //Cerco le categorie non pricipali per trovare i prodotti correlati
        $categories = $this->categories()->where('parent_id','!=','3')->where('parent_id','!=','8')->pluck('category_id')->all();

        $products = ProductData::where('lang', config('app.locale'))->whereHas('base', function ($query) use ($categories, $id){

            $query->where('active', '1')->where('id', '!=', $id)
                  ->whereHas('categories', function ($query) use($categories){
                        $query->whereIn('categories.id', $categories);
                  });
        })->distinct('parent_id')->inRandomOrder()->take(8)->get();

        $products_array = $products->pluck('id')->all();

        $count = $products->count();
        $miss = 8 - $count;

        if($miss > 0){
            $categories_r = $this->categories()->whereNotIn('categories.id', $categories)->where('parent_id','!=','3')->where('parent_id','!=','8')->pluck('category_id')->all();

            $other_products = ProductData::where('lang', config('app.locale'))->whereHas('base', function ($query) use ($categories,$products_array, $id){
                $query->where('active', '1')->where('id', '!=', $id)
                      ->whereNotIn('id', $products_array)
                      ->whereHas('categories', function ($query) use ($categories){
                            $query->whereIn('categories.id', $categories);
                      });
            })->distinct('parent_id')->inRandomOrder()->take($miss)->get();
            $products = $products->merge($other_products);
        }

        return $products;
    }
    

    public function sizes(){
        $size_array = count($this->size) > 0 ? $this->size : array(); 
        $sizes = Variant::where('type','size')->whereIn('id', $size_array)->orderBy('ordering', 'asc')->with('data')->get();
        return $sizes;
    }

    public function colors(){
        $color_array = count($this->color) > 0 ? $this->color : array(); 
        $colors = Variant::where('type','color')->whereIn('id', $color_array)->orderBy('ordering', 'asc')->with('data')->get();
        return $colors;
    }


    // trova la categoria principale
    public function mainCategory()
    {
        return $this->categories()->where('categories.id', '7')->orWhere('categories.id','8')->first();
    }

    // trova la sottocategoria CR classic
    public function subCategoryCR()
    {
        return $this->categories()->where('parent_id', '7')->first();
    }

    // trova la sottocategoria CR classic
    public function subCategoryCup()
    {
        return $this->categories()->where('parent_id', '8')->first();
    }

}
