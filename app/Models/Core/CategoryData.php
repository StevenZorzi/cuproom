<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use App\Models\Core\CategoryData;

class CategoryData extends Model
{
    //
    protected $table = 'categories_data';

    protected $fillable = ['category_id', 'name', 'slug', 'lang'];

    protected $touches = ['base'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    //SEO
    public function meta()
    {
        return $this->morphMany('App\Models\Core\Seo', 'ref');
    }
    
    public function metaTag(){
        return $this->meta->where('lang', $this->lang)->first();
    }

    //restituisce l'elemento parent base
    public function base()
    {
        return $this->belongsTo('App\Models\Core\Category', 'category_id');
    }
    

    public function setSlugAttribute($value)
    {
        $slug = str_replace(" ","-",rtrim(ltrim(strtolower($value))));
        $suff = "";     
        $index = 0;
        do{
            $flag = 0;
            if($index != 0){
                $suff = "-".$index;
            }
            $check = CategoryData::where('slug', $slug.$suff)->where('category_id', "!=", $this->category_id)->get();
            
            foreach($check as $f){
                if($this->base->module() == $f->base->module())
                    $flag = 1;
            }
            $index++;

        }while($flag == 1);

        $this->attributes['slug'] = $slug.$suff;
    }

}
