<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Gallery::orderBy('order', 'asc')->get();
        return view('dashboard.gallery.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request['file']->store('/gallery', 'public');

        $countPhotos = Gallery::get();
        $countPhotos = $countPhotos->count();

        $photo = new Gallery();
        $photo->path = $path;
        $photo->order = $countPhotos + 1;
        $photo->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = Gallery::where('id', $id)->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($photo->path);
        // reOrder photos
        $photos = Gallery::orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($photos as $item) {
            $photoItem = Gallery::where('id', $item->id)->first();
            $photoItem->order = $i;
            $photoItem->save();
            $i++;
        }
        return redirect()->back();
    }

    public function left(string $order)
    {
        $photoToRight = Gallery::where('order', $order - 1)->first();
        $photoToLeft = Gallery::where('order', $order)->first();
        $photoToRight->order = $order;
        $photoToRight->save();
        $photoToLeft->order = $order - 1;
        $photoToLeft->save();

        return redirect()->back();
    }

    public function right(string $order)
    {
        $photoToLeft = Gallery::where('order', $order + 1)->first();
        $photoToRight = Gallery::where('order', $order)->first();
        $photoToRight->order = $order + 1;
        $photoToRight->save();
        $photoToLeft->order = $order;
        $photoToLeft->save();

        return redirect()->back();
    }
}
