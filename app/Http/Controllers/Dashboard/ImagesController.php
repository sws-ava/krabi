<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = SiteImages::orderBy('id', 'desc')->get();
        return view('dashboard.images.index', compact('photos'));
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
        $path = $request['file']->store('/site_images', 'public');

        $countPhotos = SiteImages::get();
        $countPhotos = $countPhotos->count();

        $photo = new SiteImages();
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

        $photo = SiteImages::where('id', $id)->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($photo->path);
        return redirect()->back();
    }
}
