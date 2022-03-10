<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp,pdf,xls,xlxs,txt,doc,docx,ai,cdr,eps,psd,tiff'
    ];

    public static $messages = [
        'file.mimes' => 'Uploaded file has not a correct format',
        'file.required' => 'File is required'
    ];
}
