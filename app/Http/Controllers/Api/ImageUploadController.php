<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageUploadRequest;

class ImageUploadController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $image_uploaded = $request->file('image')
            ->store('series_cover', 'public');

        if ($image_uploaded){
            return response()->json(['data' => 'Image uploaded successfully at series_cover/'.$image_uploaded], 200);
        }
        return response()->json(['data' => 'Failed to upload image'], 400);
    }
}
