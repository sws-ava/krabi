<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Interior;
use Illuminate\Support\Facades\Storage;

class InteriorController extends Controller
{
    
    public function getPhotosInterior(){
        $photos = Interior::orderBy('order', 'asc')->get();
        return $photos;
    }
    public function orderLeftInterior(Request $request){
        $photoToRight = Interior::where('order', $request->order - 1)->first();
        $photoToLeft = Interior::where('order', $request->order)->first();
        $photoToRight->order = $request->order;
        $photoToRight->save();
        $photoToLeft->order = $request->order - 1;
        $photoToLeft->save();
    }
    public function orderRightInterior(Request $request){
        $photoToLeft = Interior::where('order', $request->order + 1)->first();
        $photoToRight = Interior::where('order', $request->order)->first();
        $photoToRight->order = $request->order + 1;
        $photoToRight->save();
        $photoToLeft->order = $request->order;
        $photoToLeft->save();
    }
    public function deletePhotoInterior(Request $request){
        $photo = Interior::where('id', $request->photo['id'])->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($request->photo['path']);
        // reOrder photos
        $photos = Interior::orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($photos as $item) {
            $photoItem = Interior::where('id', $item->id)->first();
            $photoItem->order = $i;
            $photoItem->save();
            $i++;
        }
    }
    public function uploadPhotoInterior(Request $request){

        $path = $request['file']->store('/interior', 'public');

        $countPhotos = Interior::get();
        $countPhotos = $countPhotos->count();

        $photo = new Interior();
        $photo->path = $path;
        $photo->order = $countPhotos + 1;
        $photo->save();



    }
}
