<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    //
    protected $table = 'seo';

    public function referral()
    {
        return $this->morphTo();
    }
	
}
