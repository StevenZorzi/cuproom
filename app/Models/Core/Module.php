<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

use App;
use App\Models\Core\CategoryData;

class Module extends Model
{
    //
    protected $table = 'modules';
    
    public $timestamps = false;

    protected $casts = [
        'roles' => 'array',
    ];



    //restituisce i dati della categoria modulo
    public function category()
	{
		return $this->belongsTo('App\Models\Core\Category', 'category_id');
	}
    
	public function data()
	{
		return $this->hasMany('App\Models\Core\CategoryData', 'category_id');
	}

    //restituisce i dati della categoria modulo
    public function categories()
    {
        return $this->hasMany('App\Models\Core\Category', 'parent_id');
    }

	public function getText($language = null)
    {
        if($language == null){
            $language = App::getLocale();
        }
        return CategoryData::firstOrNew(['category_id' => $this->id, 'lang'=> $language]);

    }
}
