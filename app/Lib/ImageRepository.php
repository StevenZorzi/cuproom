<?php

namespace App\Lib;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

use Auth;
use App\Lib\Image;
use App\Lib\ImageData;



class ImageRepository
{

    public function upload( $form_data, $obj )
    {

        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension, $obj );

        $uploadSuccess = $this->original( $photo, $allowed_filename, $obj );
        $uploadSuccess = $this->thumb( $photo, $allowed_filename, $obj );
        $uploadSuccess = $this->small( $photo, $allowed_filename, $obj );
        

        if( !$uploadSuccess ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

        $sessionImage = new Image;
        $sessionImage->filename      = $allowed_filename;
        $sessionImage->original_name = $originalName;
        
        $obj->images()->save($sessionImage);

        return Response::json([
            'error' => false,
            'code'  => 200,
            'id'    => $sessionImage->id,
            'filename' => $allowed_filename
        ], 200);

    }

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete( $id, $obj)
    {

        $path = config('paths.'.$obj->getTable()."_img").$obj->id."/";

        $sessionImage = Image::find($id);

        if(empty($sessionImage))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $name = $sessionImage->filename;

        $full_path = $path . $name;
        $full_path_thumb = $path ."thumb-". $name;
        $full_path_small = $path ."small-". $name;

        if ( File::exists( $full_path ) ) { File::delete( $full_path ); }
        if ( File::exists( $full_path_thumb ) ) { File::delete( $full_path_thumb ); }
        if ( File::exists( $full_path_small ) ) { File::delete( $full_path_small ); }

        if( !empty($sessionImage))
        {   
            ImageData::where('image_id', $sessionImage->id)->delete();
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200,
            //'path' => config('paths.'.$obj->getTable().'_img'),
        ], 200);
    }




    /*public function iconProfile( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo );
        $dim = ($image->height() < $image->width()) ? $image->height() : $image->width();
        
        $image->crop($dim, $dim)->resize(250, 250);
        $image->save( config('paths.users_img') . $filename );

        return $image;
    }*/
       
    public function thumb( $photo, $filename, $obj )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo );
        $dim = ($image->height() < $image->width()) ? $image->height() : $image->width();
        
        $image->crop($dim, $dim)->resize(500, 500);

        $path = config('paths.'.$obj->getTable().'_img') .$obj->id;

        if(!File::exists($path)) {
            File::makeDirectory($path);
        }

        $image->save($path ."/". "thumb-" .$filename );

        return $image;
    }

    public function small( $photo, $filename, $obj )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo );
        $dim = ($image->height() < $image->width()) ? $image->height() : $image->width();
        
        if($image->height() < $image->width())
            $image->widen(500);
        else
            $image->heighten(500);

        $path = config('paths.'.$obj->getTable().'_img') .$obj->id;

        if(!File::exists($path)) {
            File::makeDirectory($path);
        }

        $image->save($path ."/". "small-" .$filename );

        return $image;
    }
       
    /* Optimize Original Image */

    public function original( $photo, $filename, $obj )
    {
        $manager = new ImageManager();

        $path = config('paths.'.$obj->getTable()."_img") .$obj->id;

        if(!File::exists($path)) {
             File::makeDirectory($path, 0775, true);
        }

        $image = $manager->make( $photo );
        $dim = ($image->height() < $image->width()) ? $image->height() : $image->width();
        
        if($image->height() < $image->width())
            $image->widen(1920, function ($constraint) {$constraint->upsize();});
        else
            $image->heighten(1280, function ($constraint) {$constraint->upsize();});

        $image->save($path. "/". $filename );

        return $image;
    }

    public function createUniqueFilename( $filename, $extension, $obj )
    { 
        $full_size_dir = config('paths.'.$obj->getTable()."_img"). $obj->id."/";

        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }


    function sanitize($str){
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
        $clean = preg_replace("/[^a-zA-Z0-9_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[_|+ -]+/", '-', $clean);

        return $clean;
    }
}