<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Interior;
use App\Models\Admin\Gallery;
use App\Models\Admin\GoodsCats;
use App\Models\Admin\Goods;
use App\Models\Admin\GoodsItems;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItems;
use App\Models\Admin\PaperMenu;
use App\Models\Blocks;

class PageController extends Controller
{
    public function getPages(){
        $pages = Page::get();
        return $pages;
    }
    public function getPage(Request $request){
        $page = Page::find($request->pageId);
        return $page;
    }
    public function savePage(Request $request){
        $page = Page::find($request->page['id']);
        $page->title_ru = $request->page['title_ru'];
        $page->title_ua = $request->page['title_ua'];
        $page->description_ru = $request->page['description_ru'];
        $page->description_ua = $request->page['description_ua'];
        $page->content_ru = $request->page['content_ru'];
        $page->content_ua = $request->page['content_ua'];
        $page->save();
    }


    // client
    
    public function getMainPage(Request $request){
        // return 123;
        $page = Page::where('id', 1)->first();
        if($request->locale == 'ua'){
            $page->title = $page->title_ua;
            $page->description = $page->description_ua;
            $page->content = $page->content_ua;
        }else{
            $page->title = $page->title_ru;
            $page->description = $page->description_ru;
            $page->content = $page->content_ru;
        }
        return $page;
    }
    public function getConcept(Request $request){
        $page = Page::where('id', 2)->first();
        return $page;
    }
    public function getContacts(){
        $page = Page::where('id', 3)->first();
        return $page;
    }
    public function getDelivery(){
        $page = Page::where('id', 4)->first();
        return $page;
    }
    public function addView(Request $request){
        $page = Page::where('id', $request->id)->first();
        $page->views = $page->views + 1;
        $page->save();
    }

    
    public function getTranslateRu(){
        $main = Page::where('id', 1)->first();
        $main->title = $main->title_ru;
        $main->content = $main->content_ru;
        $main->description = $main->description_ru;
        $main->ourMenu = 'Наше меню';
        $main->interior = 'Интерьер';
        $main->lookAll = 'Посмотреть все';
        
        $main->address = '';
        $main->phone1 = '(068) 168 96 95';
        $main->phone1full = '+380681689695';
        $main->phone2 = '(063) 877 78 51';
        $main->phone2full = '+380638777851';
        $main->workHours = '10:00 - 23:30';

        $static = Blocks::where('locale', 'ru')->first();

        $static->siteName = "Krabi - Thai & Japanese | Кафе Краби - тайская и японская кухня в Одессе. Доставка суши, WOK";
        $static->newsTitle = "Новости";
        $static->salesTitle = "Акции";
        $static->galleryTitle = "Галерея";
        $static->interiorTitle = "Интерьер";
        $static->menuTitle = "Меню";
        $static->addressName = "Адрес";
        $static->phones = "Телефоны";
        $static->opened = "Мы открыты";
        $static->socs = "Мы в соцсетя";
        $static->to_site = 'На сайт';
        $static->page_not_found = 'Страница не найдена';
        $static->locale = 'ru';
        $static->yourOrder = 'Ваш заказ:';
        $static->orderSum = 'Итого:';
        $static->toDesignOrder = 'К оформлению заказа';
        $static->orderName = 'Имя';
        $static->orderPhone = 'Телефон';
        $static->orderAddress = 'Адрес';
        $static->orderPersons = 'Персон';
        $static->orderComment = 'Комментарий к заказу';
        $static->orderNow = 'Оформить заказ';
        $static->orderEpmty = 'Список пуст';
        $static->toMenu = 'В меню';
        $static->orderGet = 'Спасибо! Ваш заказ принят!';
        
        
        $concept = Page::where('id', 2)->first();
        $concept->title = $concept->title_ru;
        $concept->content = $concept->content_ru;
        $concept->description = $concept->description_ru;
        
        $contacts = Page::where('id', 3)->first();
        $contacts->title = $contacts->title_ru;
        $contacts->content = $contacts->content_ru;
        $contacts->description = $contacts->description_ru;
        
        $delivery = Page::where('id', 4)->first();
        $delivery->title = $delivery->title_ru;
        $delivery->content = $delivery->content_ru;
        $delivery->description = $delivery->description_ru;
        

        // Menu items
        $navigation = [
            'menu' => 'Меню',
            'concept' => 'Концепция',
            'interior' => 'Интерьер',
            'delivery' => 'Доставка',
            'news' => 'Новости',
            'sale' => 'Акции',
            'gallery' => 'Галерея',
            'contacts' => 'Контакты',
        ];


        return response()->json(
            collect([
                'main' => $main,
                'concept' => $concept,
                'contacts' => $contacts,
                'delivery' => $delivery,
                'navigation' => $navigation,
                'static' => $static,
            ])
        );
    }

    public function getTranslateUa(){
        $main = Page::where('id', 1)->first();
        $main->title = $main->title_ua;
        $main->content = $main->content_ua;
        $main->description = $main->description_ua;
        $main->ourMenu = 'Наше меню';
        $main->interior = "Інтер'єр";
        $main->lookAll = 'ПОДИВИТИСЬ ВСЕ';

        $static = Blocks::where('locale', 'ua')->first();
        
        $static->siteName = 'Krabi - Thai & Japanese | Кафе Крабі - тайська та японська кухня в Одесі. Доставка суші, WOK';
        $static->newsTitle = 'Новини';
        $static->salesTitle = 'Акції';
        $static->galleryTitle = 'Галерея';
        $static->interiorTitle = "Інтер'єр";
        $static->menuTitle = "Меню";
        $static->addressName = 'Адреса';
        $static->phones = 'Телефони';
        $static->opened = 'Ми відкриті';
        $static->socs = 'Ми у соцмережах';
        $static->to_site = 'До сайту';
        $static->page_not_found = 'Сторінку не знайдено';
        $static->locale = 'ua';
        $static->yourOrder = 'Ваше замовлення:';
        $static->orderSum = 'Разом:';
        $static->toDesignOrder = 'До оформлення замовлення';
        $static->orderName = "Ім'я";
        $static->orderPhone = 'Телефон';
        $static->orderAddress = 'Адреса';
        $static->orderPersons = 'Персон';
        $static->orderComment = 'Коментар для замовлення';
        $static->orderNow = 'Оформити замовлення';
        $static->orderEpmty = 'Список порожній';
        $static->toMenu = 'До меню';
        $static->orderGet = 'Дякуємо! Ваше замовлення прийнято!';

        $concept = Page::where('id', 2)->first();
        $concept->title = $concept->title_ua;
        $concept->content = $concept->content_ua;
        $concept->description = $concept->description_ua;
        
        $contacts = Page::where('id', 3)->first();
        $contacts->title = $contacts->title_ua;
        $contacts->content = $contacts->content_ua;
        $contacts->description = $contacts->description_ua;
        
        $delivery = Page::where('id', 4)->first();
        $delivery->title = $delivery->title_ua;
        $delivery->content = $delivery->content_ua;
        $delivery->description = $delivery->description_ua;
        

        // Menu items
        $navigation = [
            'menu' => 'Меню',
            'concept' => 'Концепція',
            'interior' => "Інтер'єр",
            'delivery' => 'Доставка',
            'news' => 'Новини',
            'sale' => 'Акції',
            'gallery' => 'Галерея',
            'contacts' => 'Контакти',
        ];

        return response()->json(
            collect([
                'main' => $main,
                'concept' => $concept,
                'contacts' => $contacts,
                'delivery' => $delivery,
                'navigation' => $navigation,
                'static' => $static,
            ])
        );
    }

    public function getInteriorImages(){
        $images = Interior::orderBy('order', 'asc')->get();
        $images = $images->chunk(9);
        return $images;
    }

    public function getGalleryImages(){
        $images = Gallery::orderBy('order', 'asc')->get();
        $images = $images->chunk(9);
        return $images;
    }

    public function getMenu(Request $request){
        // return $request->locale;
        $locale = $request->locale;
        $goodsCats = GoodsCats::orderBy('order', 'asc')->get();
        foreach ($goodsCats as $goodsCat) {
            $goodsCat->goods = Goods::where('category', $goodsCat->id)->orderBy('order', 'asc')->get();
            if($locale === 'ua'){
                $goodsCat->title = $goodsCat->title_ua;
                $goodsCat->description = $goodsCat->description_ua;
            }else if($locale === 'ru'){
                $goodsCat->title = $goodsCat->title_ru;
                $goodsCat->description = $goodsCat->description_ru;
            }
            foreach ($goodsCat->goods as $good) {
                if($request->locale == 'ua'){
                    $good->title = $good->title_ua;
                    $good->description = $good->description_ua;
                }else{
                    $good->title = $good->title_ru;
                    $good->description = $good->description_ru;
                }
                $goodsItems = GoodsItems::where('item', $good->id)->orderBy('order', 'asc')->get();
                foreach ($goodsItems as $goodsItem) {
                    if($request->locale == 'ua'){
                        $goodsItem->title = $goodsItem->title_ua;
                    }else{
                        $goodsItem->title = $goodsItem->title_ru;
                    }
                }
                $good->goodsItems = $goodsItems;
            }
        }
        return $goodsCats;
    }

    public function getMenuPhotos(){
        $menuPhotos = PaperMenu::get();
        return $menuPhotos;
    }

    public function getCartItems(Request $request){
        $itemsArr = [];
        $itemsToClient = [];
        foreach ($request->itemsToServer as $item) {
            array_push($itemsArr, $item['id']) ;
        }
        $itemsToClient = GoodsItems::whereIn('id', $itemsArr)->get();
        foreach ($itemsToClient as $itemToClient) {
            $mainItem = Goods::where('id', $itemToClient['item'])->first();
            foreach ($request->itemsToServer as $requestAmount) {
                if($itemToClient->id == $requestAmount['id']){
                    $itemToClient->amount = $requestAmount['amount'];
                }
            }
            if($request->locale == 'ua'){
                $itemToClient->titleMain = $mainItem->title_ua;
                $itemToClient->title = $itemToClient->title_ua;
            }else{
                $itemToClient->titleMain = $mainItem->title_ru;
                $itemToClient->title = $itemToClient->title_ru;
            }
        }
        return $itemsToClient;
    }

    
    public function setNewOrder(Request $request){

        $order = new Order();
        $order->name = $request->formData['name'];
        $order->address = $request->formData['address'];
        $order->phone = $request->formData['phone'];
        $order->persons = $request->formData['persons'];
        if(isset($request->formData['comment'])){
            $order->comment = $request->formData['comment'];
        }
        $order->status = 1;
        $order->total = $request->totalSum;
        $order->save();

        foreach ($request->items as $item) {
            $newItem = new OrderItems();
            $newItem->order = $order->id;
            $newItem->item = $item['id'];
            $newItem->amount = $item['amount'];
            $newItem->price = $item['price'];
            $newItem->save();
        }

        return $request;
    }
}
