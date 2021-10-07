<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Image;

class BaseController extends Controller
{
    // saveImageFile($full_path = full path to the image folder, $image_category = category of image eg, product, brand, etc. , $imageFile = actual Image File)
    // returns filename of the saved image file
    public function saveImageFile($full_path, $image_category, $imageFile){
        //check directory and make if doesnot exist
        if(!is_dir($full_path.'thumbnails/')){
            mkdir($full_path.'thumbnails/', 0777, true);
        }

        $filename = $image_category.'-'.time().'-'.md5(rand()). '.'.strtolower($imageFile->getClientOriginalExtension());
        $img = Image::make($imageFile);
        $img->save($full_path.$filename);

        // resize the image to a height of 100 and constrain aspect ratio (auto width)
        $img->resize(300, 215, function ($constraint) {
            $constraint->aspectRatio();
        })->save($full_path.'thumbnails/'.$filename);

        return $filename;
    }

    //deleteImageFile($full_path = full path to the image folder, $filename = File Name)
    public function deleteImageFile($full_path, $filename){
        if(file_exists($full_path.$filename)){
            @unlink($full_path.$filename); //delete file
            @unlink($full_path.'thumbnails/'.$filename); //delete thumbnail file
        }
        return true;
    }

    //save generalfile
    public function saveGeneralFile($full_path, $file_category, $file){
        //check directory and make if doesnot exist
        if(!is_dir($full_path)){
            mkdir($full_path, 0777, true);
        }

        $filename = $file_category.'-'.time().'-'.md5(rand()).'.'.strtolower($file->getClientOriginalExtension());
        $file->move($full_path,$filename);
        return $filename;
    }

}
