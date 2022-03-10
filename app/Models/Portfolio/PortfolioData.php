<?php

namespace App\Models\Portfolio;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Portfolio\PortfolioData;

class PortfolioData extends Model
{
    //
    protected $table = 'portfolio_data';

    protected $fillable = [''];

    protected $touches = ['base'];

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
		return $this->belongsTo('App\Models\Portfolio\Portfolio' , 'portfolio_id');
	}

	/** Get the route key for the model. @return string
	*/
	public function getRouteKeyName()
	{
	    return 'slug';
	}

	public function setCreatedAtAttribute($value)
    {   
        $format = 'd/m/Y H:i';
        if(strpos($value, "-"))
            $format = 'Y-m-d H:i:s';
        $this->attributes['created_at'] = \Carbon\Carbon::createFromFormat($format, $value, Auth::User()->timezone)->tz(config('app.timezone'))->format('Y-m-d H:i');
    }

    public function getCreatedAtAttribute()
    {
        $tz = Auth::User() ? Auth::User()->timezone : config('app.timezone');
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->tz($tz);
    }

	public function setSlugAttribute($value)
    {
    	$slug = str_replace(" ","-",rtrim(ltrim(strtolower($value))));
    	$suff = "";  	
    	$index = 0;
    	do{
    		if($index != 0){
    			$suff = "-".$index;
    		}
    		$check = PortfolioData::where('slug', $slug.$suff)->where('portfolio_id', "!=", $this->portfolio_id)->first();
    		$index++;
    	}while(!empty($check));
        $this->attributes['slug'] = $slug.$suff;
    }


	public function excerpt($limit = NULL)
	{	
		$limit = $limit ?: 150;
		$excerpt = substr(strip_tags($this->description),0, $limit);
	    return $excerpt != "" ? $excerpt ."..." : "";
	}
}
