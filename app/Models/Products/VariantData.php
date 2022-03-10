<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class VariantData extends Model
{
    //
    protected $table = 'variants_data';

    protected $fillable = ['variant_id', 'name', 'lang'];
}
