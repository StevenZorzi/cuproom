<?php

use Illuminate\Database\Seeder;
use App\Models\Core\Category;
use App\Models\Core\CategoryData;
use App\Models\Core\Module;
use App\Lib\Language;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    	$eng = Language::where('slug', 'en')->first();

        //BLOG
        $module = Category::create( [
            'id' => 1,
            'parent_id' => NULL 
        ] );
       	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Blog',
            'slug' => 'blog',
            'lang' => 'it',
        ] );
        if($eng){
        	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Blog',
            'slug' => 'blog',
            'lang' => 'en',
        	] );
        }
       	Module::create( [
            'category_id' => $module->id,
            'active' => '0',
            'roles' => ["superadmin"],
        ] );



       	//PORTFOLIO 
        $module = Category::create( [
            'id' => 2,
            'parent_id' => NULL 
        ] );
       	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Portfolio',
            'slug' => 'portfolio',
            'lang' => 'it',
        ] );
        if($eng){
        	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Portfolio',
            'slug' => 'portfolio',
            'lang' => 'en',
        	] );
        }
       	Module::create( [
            'category_id' => $module->id,
            'active' => '0',
            'roles' => ["superadmin"],
        ] );


        
       	//PRODOTTI 
        $module = Category::create( [
            'id' => 3,
            'parent_id' => NULL 
        ] );
       	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Prodotti',
            'slug' => 'prodotti',
            'lang' => 'it',
        ] );
        if($eng){
        	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Products',
            'slug' => 'products',
            'lang' => 'en',
        	] );
        }
       	Module::create( [
            'category_id' => $module->id,
            'active' => '0',
            'roles' => ["superadmin"],
        ] );



       	//GALLERY 
        $module = Category::create( [
            'id' => 4,
            'parent_id' => NULL 
        ] );
       	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Gallery',
            'slug' => 'gallery',
            'lang' => 'it',
        ] );
        if($eng){
        	CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Gallery',
            'slug' => 'gallery',
            'lang' => 'en',
        	] );
        }
       	Module::create( [
            'category_id' => $module->id,
            'active' => '0',
            'roles' => ["superadmin"],
        ] );



        //REQUESTS 
        $module = Category::create( [
            'id' => 5,
            'parent_id' => NULL 
        ] );
        CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Richieste',
            'slug' => 'richieste',
            'lang' => 'it',
        ] );
        if($eng){
            CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Requests',
            'slug' => 'requests',
            'lang' => 'en',
            ] );
        }
        Module::create( [
            'category_id' => $module->id,
            'active' => '0',
            'roles' => ["superadmin"],
        ] );


        
        //BRANDS 
        $module = Category::create( [
            'id' => 6,
            'parent_id' => NULL 
        ] );
        CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Brands',
            'slug' => 'brands',
            'lang' => 'it',
        ] );
        if($eng){
            CategoryData::create( [
            'category_id' => $module->id,
            'name' => 'Brands',
            'slug' => 'brands',
            'lang' => 'en',
            ] );
        }
        Module::create( [
            'category_id' => $module->id,
            'active' => '0',
            'roles' => ["superadmin"],
        ] );


        


    }
}
