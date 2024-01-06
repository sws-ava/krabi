<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
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






Route::get('/qwe', function () {
    // step 1

    $oldItems = DB::table('sing_goods')->orderBy('id', 'asc')->get();
    foreach($oldItems as $item){
        $newItem = new Goods();
        $newItem->id = $item->id;
        $newItem->category = $item->cat;
        $newItem->title_ru = $item->title;
        $newItem->code = $item->code;
        $newItem->show = 1;
        $newItem->description_ru = $item->description;
        $newItem->desc_ru = $item->title.': '.$item->description;
        if($item->photos == ''){
            $newItem->picture = $item->old_photo;
        }else{
            $newItem->picture = $item->photos;
        }

        $newItem->rem_ru = $item->remarks;
        $newItem->price0 = $item->price0;
        $newItem->price1 = $item->price1;
        $newItem->price2 = $item->price2;
        $newItem->price3 = $item->price3;
        $newItem->price4 = $item->price4;
        $newItem->price5 = $item->price5;

        $newItem->save();

    }

    // ----------------------------------------------------------------------------------

    // step 2

    $oldUaItems = DB::table('sing_ua_goods')->orderBy('id', 'asc')->get();
    foreach($oldUaItems as $uaItem){
        DB::table('goods')->where('id', $uaItem->id)->update(
            [
                'title_ua' => $uaItem->title,
                'description_ua' => $uaItem->description,
                'desc_ua' => $uaItem->title .': '. $uaItem->description,
                'rem_ua' => $uaItem->remarks,
            ]
        );
    }

    // ----------------------------------------------------------------------------------

    // step 3 - order goods in cat


    $cats = GoodsCats::get();
    foreach($cats as $cat){
        $goods = Goods::where('category', $cat->id)->get();
        $i = 1;
        foreach($goods as $good){
            $good = Goods::where('id', $good->id)->first();
            $good->order = $i;
            $good->save();
            $i++;
        }


    }


    // ----------------------------------------------------------------------------------

    // step 4 - items from goods to goodsItems

    $allGoods = Goods::orderBy('id')->get();

    foreach($allGoods as $good){

        if($good->rem_ru !== ''){

            $remarks_ruArr = explode('|', $good->rem_ru);
            $remarks_uaArr = explode('|', $good->rem_ua);

            $i = 0;
            foreach($remarks_ruArr as $remarkItem){

                $newGoodsItem = new GoodsItems();

                $newGoodsItem->item = $good->id;
                $newGoodsItem->show = 1;

                if($good->code !== ''){
                    $codeArr = explode(' ', $good->code);
                    $newGoodsItem->weight = $codeArr[0];
                    $newGoodsItem->weightKind = $codeArr[1];
                }

                if($i == 0){
                    $newGoodsItem->price = $good->price0;
                }elseif($i == 1){
                    $newGoodsItem->price = $good->price1;
                }elseif($i == 2){
                    $newGoodsItem->price = $good->price2;
                }elseif($i == 3){
                    $newGoodsItem->price = $good->price3;
                }elseif($i == 4){
                    $newGoodsItem->price = $good->price4;
                }elseif($i == 5){
                    $newGoodsItem->price = $good->price5;
                }
                $newGoodsItem->title_ru = $remarks_ruArr[$i];
                $newGoodsItem->title_ua = $remarks_uaArr[$i];

                $newGoodsItem->save();

                $i++;
            }

        }else{

            $newGoodsItem = new GoodsItems();

            $newGoodsItem->item = $good->id;
            $newGoodsItem->show = 1;

            if($good->code !== ''){
                $codeArr = explode(' ', $good->code);
                $newGoodsItem->weight = $codeArr[0];
                $newGoodsItem->weightKind = $codeArr[1];
            }

            $newGoodsItem->price = $good->price0;
            $newGoodsItem->title_ru = $good->title_ru;
            $newGoodsItem->title_ua = $good->title_ua;


            $newGoodsItem->save();

        }
    }


    // ----------------------------------------------------------------------------------

    // step 5 - goods items order

    $goods = Goods::orderBy('id')->get();

    foreach($goods as $good){
        $items = GoodsItems::where('item', $good->id)->get();
        $i = 1;
        foreach($items as $itemm){
            $item = GoodsItems::where('id', $itemm->id)->first();
            $item->order = $i;
            $item->save();
            $i++;
        }
    }

});
