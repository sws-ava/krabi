<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SiteImages;
use Illuminate\Support\Facades\Storage;

class SiteImagesController extends Controller
{
    public function getPhotos(){
        $photos = SiteImages::orderBy('id', 'desc')->get();
        return $photos;
    }
    public function deletePhoto(Request $request){
        $photo = SiteImages::where('id', $request->photo['id'])->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($request->photo['path']);
    }
    public function uploadPhoto(Request $request){

        $path = $request['file']->store('/site_images', 'public');

        $countPhotos = SiteImages::get();
        $countPhotos = $countPhotos->count();

        $photo = new SiteImages();
        $photo->path = $path;
        $photo->order = $countPhotos + 1;
        $photo->save();
    }
}
