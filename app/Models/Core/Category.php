<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

use App;
use Localization;
use App\Models\Core\Category;
use App\Models\Core\CategoryData;


class Category extends Model
{
    
    protected $table = 'categories';

    protected $fillable = ['parent_id'];


    //restituisce i dati
    public function data()
	{
		return $this->hasMany('App\Models\Core\CategoryData', 'category_id');
	}

    public function getText($language = null)
	{
		if($language == null){
			$language = App::getLocale();
		}
		return CategoryData::firstOrNew(['category_id' => $this->id, 'lang'=> $language]);
	}

	public function getMainName()
	{
		$trans = $this->data;
		foreach(Localization::getSupportedLocales() as $localCode => $lang){
			if($main = $trans->where('lang', $localCode)->first())
				return $main->name;
		}
	}

	public function getChilds(){
		return Category::where('parent_id', $this->id)->with(['data' => function ($query) {
            $query->orderBy('name');
        }])->withCount('data')->get();
	}

	
	public function getChildsData(){
		$id = $this->id;
		$cat = CategoryData::where('lang', config('app.locale'))->whereHas('base', function ($query) use($id){
                $query->where('parent_id', $id);
            })->with('base')->get();
		return $cat;
	}

	public function parent(){
		return Category::firstOrNew(['id' => $this->parent_id]);
	}
	
	public function count($module_id, $collection = null){
		switch($module_id){
			case 1:
				return $this->posts->count();
			case 2:
				return $this->projects->count();
			case 3:
				if(is_null($collection))
                    return $this->products->count();
                else
                    return $this->products->where('collection', $collection)->count();
			case 4:
				return $this->gallery->count();
			case 6:
				return $this->brands->count();
		}
	}

	public function posts(){
		return $this->morphedByMany('App\Models\Blog\Blog', 'ref', 'categories_assoc');
	}
	public function projects(){
		return $this->morphedByMany('App\Models\Portfolio\Portfolio', 'ref', 'categories_assoc');
	}
	public function products(){
		return $this->morphedByMany('App\Models\Products\Product', 'ref', 'categories_assoc');
	}
	public function gallery(){
		return $this->morphedByMany('App\Models\Gallery\Gallery', 'ref', 'categories_assoc');
	}
	public function brands(){
		return $this->morphedByMany('App\Models\Brands\Brand', 'ref', 'categories_assoc');
	}


	//restituisce l'elemento parent module
    public function module()
    {   
        if(!is_null($this->parent_id)){
            return $this->parent()->module();
        }else{
            return $this->id;
        }
    }

}
