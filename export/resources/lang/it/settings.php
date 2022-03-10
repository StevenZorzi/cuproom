<?php
use App\Models\Core\CategoryData;
$blog = CategoryData::where('category_id', '1')->where('lang', 'it')->select('slug', 'name')->first();
$portfolio = CategoryData::where('category_id', '2')->where('lang', 'it')->select('slug', 'name')->first();
$products = CategoryData::where('category_id', '3')->where('lang', 'it')->select('slug', 'name')->first();
$gallery = CategoryData::where('category_id', '4')->where('lang', 'it')->select('slug', 'name')->first();
$requests =  CategoryData::where('category_id', '5')->where('lang', 'it')->select('slug', 'name')->first();
$brands = CategoryData::where('category_id', '6')->where('lang', 'it')->select('slug', 'name')->first();


return [

    'module-1' => $blog ? $blog->name : '',
    'module-2' => $portfolio ? $portfolio->name : '',
    'module-3' => $products ? $products->name : '',
    'module-4' => $gallery ? $gallery->name : '',
    'module-5' => $requests ? $requests->name : '',
    'module-6' => $brands ? $brands->name : '',

    'module-1-slug' => $blog ? $blog->slug : '',
    'module-2-slug' => $portfolio ? $portfolio->slug : '',
    'module-3-slug' => $products ? $products->slug : '',
    'module-4-slug' => $gallery ? $gallery->slug : '',
    'module-5-slug' => $requests ? $requests->slug : '',
    'module-6-slug' => $brands ? $brands->slug : '',
    

];
