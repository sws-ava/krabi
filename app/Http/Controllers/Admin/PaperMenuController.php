<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PaperMenu;
use Illuminate\Support\Facades\Storage;

class PaperMenuController extends Controller
{
    
    public function getPhotos(){
        $photos = PaperMenu::orderBy('order', 'asc')->get();
        return $photos;
    }
    public function orderLeft(Request $request){
        $photoToRight = PaperMenu::where('order', $request->order - 1)->first();
        $photoToLeft = PaperMenu::where('order', $request->order)->first();
        $photoToRight->order = $request->order;
        $photoToRight->save();
        $photoToLeft->order = $request->order - 1;
        $photoToLeft->save();
    }
    public function orderRight(Request $request){
        $photoToLeft = PaperMenu::where('order', $request->order + 1)->first();
        $photoToRight = PaperMenu::where('order', $request->order)->first();
        $photoToRight->order = $request->order + 1;
        $photoToRight->save();
        $photoToLeft->order = $request->order;
        $photoToLeft->save();
    }
    public function deletePhoto(Request $request){
        $photo = PaperMenu::where('id', $request->photo['id'])->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($request->photo['path']);
        // reOrder photos
        $photos = PaperMenu::orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($photos as $item) {
            $photoItem = PaperMenu::where('id', $item->id)->first();
            $photoItem->order = $i;
            $photoItem->save();
            $i++;
        }
    }
    public function uploadPhoto(Request $request){
        // return 1;
        // return $request->all();
        // return 111;
        foreach ($request['files'] as $file) {
            $path = $file->store('/paper', 'public');
            $countPhotos = PaperMenu::get();
            $countPhotos = $countPhotos->count();
            $photo = new PaperMenu();
            $photo->path = $path;
            $photo->order = $countPhotos + 1;
            $photo->save();
        }
        // $path = $request['file']->store('/paper', 'public');

        // $countPhotos = PaperMenu::get();
        // $countPhotos = $countPhotos->count();

        // $photo = new PaperMenu();
        // $photo->path = $path;
        // $photo->order = $countPhotos + 1;
        // $photo->save();
    }
    public function deleteAllPhoto(){
        $items = PaperMenu::get();
        
        foreach ($items as $item) {
            Storage::disk('public')->delete($item->path);
        }



        PaperMenu::truncate();
    }
}
