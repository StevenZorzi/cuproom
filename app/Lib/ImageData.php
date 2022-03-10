<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Model;

class ImageData extends Model
{
    protected $table = 'images_data';

    protected $fillable = ['image_id', 'title', 'alt', 'description', 'link', 'tag', 'lang'];


    //restituisce l'elemento parent base
    public function base()
    {
        return $this->belongsTo('App\Lib\Image' , 'image_id');
    }

}
