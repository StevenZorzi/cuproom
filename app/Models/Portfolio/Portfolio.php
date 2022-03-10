<?php

namespace App\Models\Portfolio;

use App;
use Auth;
use Localization;
use App\Lib\Language;
use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\PortfolioData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{

    use SoftDeletes;
    protected $table = 'portfolio';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_from',
        'date_to'
    ];

  
    //restituisce l'utente che ha creato il contenuto
    public function user()
	{
		return $this->belongsTo('App\User', 'user_id')->withTrashed();
	}

	//restituisce i dati
    public function data()
	{
		return $this->hasMany('App\Models\Portfolio\PortfolioData', 'portfolio_id');
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
    public function setDateFromAttribute($value)
    {
        $this->attributes['date_from'] = ($value == "" || is_null($value)) ? null : \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    public function setDateToAttribute($value)
    {
        $this->attributes['date_to'] = ($value == "" || is_null($value)) ? null : \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getText($language = null)
    {
        if($language == null){
            $language = App::getLocale();
        }
        return PortfolioData::firstOrNew(['portfolio_id' => $this->id, 'lang'=> $language]);
    }

    public function getMainText($language = null)
    {   
        $trans = $this->data;
        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            if($main = $trans->where('lang', $localCode)->first())
                return $main;
        }
        return new PortfolioData();
    }

    public function preview($full = "thumb-")
    {

        if($full == "full") $full = "";
        elseif($full == "small") $full = "small-";

        $image = $this->images()->orderBy('ordering')->first();
        if($image){
            $img = $image->filename;
            return config('paths.portfolio_img').$this->id."/".$full.$img;
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


    //IN BASE ALLA CATEGORIA
    public function getRelated(){

        $id = $this->id;
        //Cerco le categorie non pricipali per trovare i prodotti correlati
        $categories = $this->categories()->where('parent_id','!=','3')->pluck('category_id')->all();

        $projects = PortfolioData::where('lang', config('app.locale'))->whereHas('base', function ($query) use ($categories, $id){

            $query->where('active', '1')->where('id', '!=', $id)
                  ->whereHas('categories', function ($query) use($categories){
                        $query->whereIn('categories.id', $categories);
                  });
        })->get();

        $projects_array = $projects->pluck('id')->all();

        $count = $projects->count();
        $miss = 4 - $count;

        if($miss > 0){
            $categories = $this->categories()->whereNotIn('categories.id', $categories)->pluck('category_id')->all();
            $other_projects = PortfolioData::where('lang', config('app.locale'))->whereHas('base', function ($query) use ($categories,$projects_array, $id){
                $query->where('active', '1')->where('id', '!=', $id)
                      ->whereNotIn('id', $projects_array)
                      ->whereHas('categories', function ($query) use($categories){
                            $query->whereIn('categories.id', $categories);
                      });
            })->get();
            $projects = $projects->merge($other_projects);
        }

        return $projects;
    }

	
}
