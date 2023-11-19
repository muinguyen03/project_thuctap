<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function UploadImageCloudinary($image, $folder){
        return Cloudinary::upload($image->getRealPath(),['public_id' => $folder.'/'.uniqid()])->getSecurePath();
    }

    protected function UploadImage($image, $folder): bool|string
    {
        return Storage::disk('public')->putFile($folder, $image);
    }

    protected function UploadMultiImage($images, $folder): array
    {
        $arr_images = [];
        foreach ($images as $image){
            $image_path = $this->UploadImage($image, $folder);
            $arr_images[] = $image_path;
        }
        return $arr_images;
    }


}
