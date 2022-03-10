<?php

namespace App\Models\ContactRequests;

use Auth;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    //
    protected $table = 'requests';



	public function referral()
    {
        return $this->morphTo('ref');
    }

    public function getStatus()
    {
        $status = $this->response ? 'success' : 'warning';
        return '<span class="badge badge-'.$status.'"> </span>';
    }

    public function documents()
    {
        return $this->morphMany('App\Lib\Document', 'ref')->orderBy('ordering');
    }
    
    public function getCreatedAtAttribute()
    {
        $tz = Auth::User() ? Auth::User()->timezone : config('app.timezone');
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->tz($tz);
    }
}

