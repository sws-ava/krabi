<?php

namespace App\Services\DynamicTranlateService;

use App\Models\Blocks;
use Illuminate\Support\Facades\App;

class DynamicTranlateService

{
    public function __construct()
    {

    }

    public static function getNavigation()
    {
        $current_locale = App::getLocale();
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
        if($current_locale === 'ua'){
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
        }

        return $navigation;
    }

    public static function getDynamicTranslates()
    {
        $ua = Blocks::where('locale', 'ua')->get();
        $ru = Blocks::where('locale', 'ru')->get();

        $current_locale = App::getLocale();

        $static = $ru[0];
        $static->ourMenu = 'Наше меню';
        $static->interior = 'Интерьер';
        $static->lookAll = 'Посмотреть все';
        $static->siteName = "Krabi - Thai & Japanese | Кафе Краби - тайская и японская кухня в Одессе. Доставка суши, WOK";
        $static->newsTitle = "Новости";
        $static->salesTitle = "Акции";
        $static->galleryTitle = "Галерея";
        $static->interiorTitle = "Интерьер";
        $static->menuTitle = "Меню";
        $static->addressName = "Адрес";
        $static->phones = "Телефоны";
        $static->opened = "Мы открыты";
        $static->socs = "Мы в соцсетях";
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
        if($current_locale === 'ua'){
            $static = $ua[0];
            $static->ourMenu = 'Наше меню';
            $static->interior = "Інтер'єр";
            $static->lookAll = 'ПОДИВИТИСЬ ВСЕ';
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
        }


        return $static;
    }
}
