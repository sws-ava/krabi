<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\PaperMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = PaperMenu::orderBy('order', 'asc')->get();
        return view('dashboard.paper.index', compact('photos'));
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
        foreach ($request['files'] as $file) {
            $path = $file->store('/paper_menu', 'public');
            $countPhotos = PaperMenu::get();
            $countPhotos = $countPhotos->count();
            $photo = new PaperMenu();
            $photo->path = $path;
            $photo->order = $countPhotos + 1;
            $photo->save();
        }

//        $path = $request['file']->store('/paper_menu', 'public');
//
//        $countPhotos = PaperMenu::get();
//        $countPhotos = $countPhotos->count();
//
//        $photo = new PaperMenu();
//        $photo->path = $path;
//        $photo->order = $countPhotos + 1;
//        $photo->save();

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
        $photo = PaperMenu::where('id', $id)->first();
        $photo->delete();
        // remove file from server
        Storage::disk('public')->delete($photo->path);
        // reOrder photos
        $photos = PaperMenu::orderBy('order', 'asc')->get();
        $i = 1;
        foreach ($photos as $item) {
            $photoItem = PaperMenu::where('id', $item->id)->first();
            $photoItem->order = $i;
            $photoItem->save();
            $i++;
        }
        return redirect()->back();
    }

    public function left(string $order)
    {
        $photoToRight = PaperMenu::where('order', $order - 1)->first();
        $photoToLeft = PaperMenu::where('order', $order)->first();
        $photoToRight->order = $order;
        $photoToRight->save();
        $photoToLeft->order = $order - 1;
        $photoToLeft->save();

        return redirect()->back();
    }

    public function right(string $order)
    {
        $photoToLeft = PaperMenu::where('order', $order + 1)->first();
        $photoToRight = PaperMenu::where('order', $order)->first();
        $photoToRight->order = $order + 1;
        $photoToRight->save();
        $photoToLeft->order = $order;
        $photoToLeft->save();

        return redirect()->back();
    }
    public function destroyAll(){
        $items = PaperMenu::get();
        foreach ($items as $item) {
            Storage::disk('public')->delete($item->path);
        }
        PaperMenu::truncate();

        return redirect()->back();
    }
}
