<?php

namespace App\Lib;

use App;
use Localization;
use Illuminate\Database\Eloquent\Model;
use App\Lib\ImageData;

class Image extends Model
{
    //
    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];

    public static $messages = [
        'file.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];


    public function referral()
    {
        return $this->morphTo();
    }

    public function data()
    {
        return $this->hasMany('App\Lib\ImageData', 'image_id');
    }

    public function getText($language = null)
    {
        if($language == null){
            $language = App::getLocale();
        }
        return ImageData::firstOrNew(['image_id' => $this->id, 'lang'=> $language]);
    }

    public function getMainText($language = null)
    {   
        $trans = $this->data;
        foreach(Localization::getSupportedLocales() as $localCode => $lang){
            if($main = $trans->where('lang', $localCode)->first())
                return $main;
        }
        return new ImageData();
    }
}
