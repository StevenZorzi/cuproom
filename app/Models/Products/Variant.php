<?php

namespace App\Models\Products;

use App;
use Localization;
use App\Models\Products\Product;
use App\Models\Products\VariantData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    //
    use SoftDeletes;
    protected $table = 'variants';


	//restituisce i dati
    public function data()
	{
		return $this->hasMany('App\Models\Products\VariantData', 'variant_id');
	}

	public function images()
    {
        return $this->morphMany('App\Lib\Image', 'ref')->orderBy('ordering');
    }

    public function getText($language = null)
    {
        if($language == null){
            $language = App::getLocale();
        }
        return VariantData::firstOrNew(['variant_id' => $this->id, 'lang'=> $language]);
    }

    public function getMainText($language = null)
    {   
        $trans = $this->data;
        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            if($main = $trans->where('lang', $localCode)->first())
                return $main;
        }
        return new VariantData();
    }

    //controllo varianti associate ai prodotti
	public function isUsed()
	{
		$id = $this->id;
		$type = $this->type;

		$products = Product::all();

		
		if($type == 'size'){
			foreach ($products as $product) {
				if($product->size != ''){
					if(in_array($id, $product->size)) return true;
				}
			}
		}
		elseif($type == 'color'){
			foreach ($products as $product) {
				if($product->color != ''){
					if(in_array($id, $product->color)) return true;
				}
			}
		}
		return false;
	}


	public function preview($full = "thumb-")
    {

        if($full == "full") $full = "";
        elseif($full == "small") $full = "small-";

        $image = $this->images()->orderBy('ordering')->first();
        if($image){
            $img = $image->filename;
            return config('paths.variants_img').$this->id."/".$full.$img;
        }
        
        return 'img/noimg.jpg';
    }
}
