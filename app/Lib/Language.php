<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    
    public $timestamps = false;

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = trim(strtolower($value));
    }
}
