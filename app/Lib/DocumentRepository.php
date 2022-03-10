<?php

namespace App\Lib;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

use Auth;
use App\Lib\Document;

use App\Models\Order;
use App\Models\Subscription;


class DocumentRepository
{

    public function upload( $form_data, $obj )
    {

        $validator = Validator::make($form_data, Document::$rules, Document::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

        $file = $form_data['file'];

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension, $obj );

        $uploadSuccess = $this->save( $file, $allowed_filename, $obj );



        if( !$uploadSuccess ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

        $sessionFile = new Document;
        $sessionFile->filename      = $allowed_filename;
        $sessionFile->original_name = $originalName;
        
        $obj->documents()->save($sessionFile);

        return Response::json([
            'error' => false,
            'code'  => 200,
            'id'    => $sessionFile->id,
            'filename' => $allowed_filename
        ], 200);

    }

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete( $id, $obj)
    {   

        $path = config('paths.'.$obj->getTable()."_img").$obj->id."/";

        $sessionFile = Document::find($id);

        if(empty($sessionFile))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $name = $sessionFile->filename;

        $full_path = $path . $name;

        if ( File::exists( $full_path ) ) { File::delete( $full_path ); }

        if( !empty($sessionFile))
        {   
            $sessionFile->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200,
            //'path' => config('paths.'.$obj->getTable().'_img'),
        ], 200);

    }

       
    /* Optimize Original Image */

    public function save( $document, $filename, $obj )
    {

        $path = config('paths.'.$obj->getTable()."_img").$obj->id;

        $saved = $document->move($path, $filename);

        return $saved;
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