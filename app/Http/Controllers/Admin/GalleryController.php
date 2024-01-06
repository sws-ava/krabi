<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function getPhotos(){
        $photos = Gallery::orderBy('order', 'asc')->get();
        return $photos;
    }
    public function orderLeft(Request $request){
        $photoToRight = Gallery::where('order', $request->order - 1)->first();
        $photoToLeft = Gallery::where('order', $request->order)->first();
        $photoToRight->order = $request->order;
        $photoToRight->save();
        $photoToLeft->order = $request->order - 1;
        $photoToLeft->save();
    }
    public function orderRight(Request $request){
        $photoToLeft = Gallery::where('order', $request->order + 1)->first();
        $photoToRight = Gallery::where('order', $request->order)->first();
        $photoToRight->order = $request->order + 1;
        $photoToRight->save();
        $photoToLeft->order = $request->order;
        $photoToLeft->save();
    }
    public function deletePhoto(Request $request){
        $photo = Gallery::where('id', $request->photo['id'])->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($request->photo['path']);
        // reOrder photos
        $photos = Gallery::orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($photos as $item) {
            $photoItem = Gallery::where('id', $item->id)->first();
            $photoItem->order = $i;
            $photoItem->save();
            $i++;
        }
    }
    public function uploadPhoto(Request $request){

        $path = $request['file']->store('/photos', 'public');

        $countPhotos = Gallery::get();
        $countPhotos = $countPhotos->count();

        $photo = new Gallery();
        $photo->path = $path;
        $photo->order = $countPhotos + 1;
        $photo->save();
    }
}
