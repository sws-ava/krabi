<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Models\Admin\Gallery;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use App\Models\Admin\Goods;
use App\Models\Admin\GoodsItems;
use App\Models\Admin\GoodsCats;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/qwe', function () {
    // step 1

    $items = DB::table('goods')->get();
    foreach($items as $item){
        $good = Goods::where('id', $item->id)->first();
        $good->picture = str_replace('/images/', '', $item->picture);
        $good->save();
    }
});

Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath' ]], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', [PageController::class, 'main_page']);
    Route::get('/menyu', [PageController::class, 'menu']);
    Route::get('/dostavka', [PageController::class, 'delivery']);
    Route::get('/kontseptsiya', [PageController::class, 'conception']);
    Route::get('/kontakty', [PageController::class, 'contacts']);
    Route::get('/galereya', [PageController::class, 'gallery']);
    Route::get('/interer', [PageController::class, 'interior']);
    Route::get('/aktsii', [PageController::class, 'sale']);
    Route::get('/novosti', [PageController::class, 'news']);
    Route::get('/cart', [CartController::class, 'index']);



});




//
//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




