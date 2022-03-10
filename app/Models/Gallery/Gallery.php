<?php

namespace App\Models\Gallery;

use App;
use Auth;
use Localization;
use App\Lib\Language;
use App\Models\Gallery\GalleryData;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gallery extends Model
{
   
    use SoftDeletes;
    protected $table = 'gallery';

    protected $casts = ['product'=>'array'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    //restituisce l'utente che ha creato il contenuto
    public function user()
	{
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
	}

	//restituisce i dati
    public function data()
	{
		return $this->hasMany('App\Models\Gallery\GalleryData', 'gallery_id');
	}

	// associazione tramite tabella categoryAssoc a Category
	public function categories()
    {
        return $this->morphToMany('App\Models\Core\Category', 'ref', 'categories_assoc');
    }

    public function images()
    {
        return $this->morphMany('App\Lib\Image', 'ref')->orderBy('ordering');
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

    public function getText($language = null)
    {
        if($language == null){
            $language = App::getLocale();
        }
        return GalleryData::firstOrNew(['gallery_id' => $this->id, 'lang'=> $language]);
    }

    public function getMainText($language = null)
    {   
        $trans = $this->data;
        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            if($main = $trans->where('lang', $localCode)->first())
                return $main;
        }
        return new GalleryData();
    }

    public function preview($full = "thumb-")
    {

        if($full == "full") $full = "";
        elseif($full == "small") $full = "small-";

        $image = $this->images()->orderBy('ordering')->first();
        if($image){
            $img = $image->filename;
            return config('paths.gallery_img').$this->id."/".$full.$img;
        }
        
        return 'img/noimg.jpg';
    }


	//restituisce i dati
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

    public function products(){
        $product_array = count($this->product) > 0 ? $this->product : array(); 
        $products = Product::whereIn('id', $product_array)->orderBy('created_at', 'desc')->with('data')->get();
        return $products;
    }

}
