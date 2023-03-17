<?php

namespace App\Traits;

trait OfferTrait
{
    public function saveImage($photo, $folder_path)
    {
        // for uploade image
        $file_ex = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_ex;
        $path = $folder_path;
        $photo->move($path, $file_name);
        return $file_name;
    }
}
