<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blocks;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $ua = Blocks::where('locale', 'ua')->get();
        $ru = Blocks::where('locale', 'ru')->get();

        $ua = $ua[0];
        $ru = $ru[0];
        return view('dashboard.blocks.index', compact('ru', 'ua'));
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
        //
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
    public function edit(Request $request)
    {
        $showWarning = 0;
        if(isset($request->ru['showWarning'])){
            $showWarning = 1;
        }

        $ruBlock = Blocks::where('locale', 'ru')->first();
        $ruBlock->address = $request->ru['address'];
        $ruBlock->email = $request->ru['email'];
        $ruBlock->phone1 = $request->ru['phone1'];
        $ruBlock->phone1full = $request->ru['phone1full'];
        $ruBlock->phone2 = $request->ru['phone2'];
        $ruBlock->phone2full = $request->ru['phone2full'];
        $ruBlock->workHours = $request->ru['workHours'];
        $ruBlock->showWarning =  $showWarning;
        $ruBlock->warning = $request->ru['warning'];
        $ruBlock->save();


        $uaBlock = Blocks::where('locale', 'ua')->first();
        $uaBlock->address = $request->ua['address'];
        $uaBlock->email = $request->ru['email'];
        $uaBlock->phone1 = $request->ru['phone1'];
        $uaBlock->phone1full = $request->ru['phone1full'];
        $uaBlock->phone2 = $request->ru['phone2'];
        $uaBlock->phone2full = $request->ru['phone2full'];
        $uaBlock->workHours = $request->ru['workHours'];
        $uaBlock->showWarning =  $showWarning;
        $uaBlock->warning = $request->ua['warning'];
        $uaBlock->save();

        return redirect()->back()->with('succsess');
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
        //
    }
}
