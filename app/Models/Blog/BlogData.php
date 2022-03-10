<?php

namespace App\Models\Blog;

use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\BlogData;

class BlogData extends Model
{
    //
    protected $table = 'blog_data';

    protected $fillable = [''];

    //server per aggiornare l'updated_at dell'elemento padre
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
		return $this->belongsTo('App\Models\Blog\Blog' , 'blog_id');
	}


	/** Get the route key for the model. @return string
	*/
	public function getRouteKeyName()
	{
	    return 'slug';
	}

    //DA DISATTIVARE PER FAKER FILLING
	public function setCreatedAtAttribute($value)
    {   
        $format = 'd/m/Y H:i';
        if(strpos($value, "-"))
            $format = 'Y-m-d H:i:s';
        $this->attributes['created_at'] = \Carbon\Carbon::createFromFormat($format, $value, Auth::User()->timezone)->tz(config('app.timezone'))->format('Y-m-d H:i');
    }

    //DA ATTIVARE PER FAKER FILLING
    /*public function setCreatedAtAttribute($value)
    {   
        $format = 'd/m/Y H:i';
        if(strpos($value, "-"))
            $this->attributes['created_at'] = $value;
        else
            $this->attributes['created_at'] = \Carbon\Carbon::createFromFormat($format, $value, Auth::User()->timezone)->tz(config('app.timezone'))->format('Y-m-d H:i');
    }*/
    

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
    		$check = BlogData::where('slug', $slug.$suff)->where('blog_id', "!=", $this->blog_id)->first();
    		$index++;
    	}while(!empty($check));
        $this->attributes['slug'] = $slug.$suff;
    }


	public function excerpt($limit = NULL)
	{	
		$limit = $limit ?: 150;
		$excerpt = substr(strip_tags($this->content),0, $limit);
	    return $excerpt != "" ? $excerpt ."..." : "";
	}

}
