@extends('layout.dashboard')

@section('content')   <div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb-my">
            <li class="breadcrumb-item">
                <a href="/dashboard/">
                    Главная
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('menu.show')}}">
                    Меню
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Блюдо "{{$item->title_ru}}"</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 mb-4">
            <a
                href="{{route('category.show', $item->category)}}"
            >
                К категории
            </a>
        </div>
        <div class="col-12 mb-2">
            <h5 class="mb-3">Блюдо "{{$item->title_ru}}"</h5>
        </div>
    </div>
    <form
        method="POST"
        action="{{route('goods.update_good', $item->id)}}"
        enctype="multipart/form-data"
    >
        @csrf
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="w-100">
                                <div class="row mb-4">
                                    <div class="col-lg-4 mb-4" style="min-height: 240px;">

                                        @if($item->picture)
                                            <div class="imageHolder">
                                                <img src="/storage/{{$item->picture}}" >
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 offset-lg-4 mb-4 d-flex flex-column justify-content-between" style="min-height: 240px;">
                                        <div v-if="!item.picture">
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Изменить фото</label>
                                                <input
                                                    name="file"
                                                    accept="image/*"
                                                    type="file"
                                                    class="form-control-file"
                                                >
                                            </div>
                                        </div>

                                        @if($item->picture)
                                            <a href="{{route('goods.remove_goods_photo', $item->id)}}"
                                               class="btn btn-sm btn-danger"
                                               style="color: #fff!important;"
                                            >
                                                Удалить фото

                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <small class="form-text text-muted">Название блюда на русском</small>
                                        <input
                                            required
                                            name="title_ru"
                                            value="{{$item->title_ru}}"
                                            type="text"
                                            class="w-100 form-control priceInput"
                                        >
                                    </div>
                                    <div class="form-group col-6">
                                        <small class="form-text text-muted">Название блюда на украинском</small>
                                        <input
                                            required
                                            name="title_ua"
                                            value="{{$item->title_ua}}"
                                            type="text"
                                            class="w-100 form-control priceInput"
                                        >
                                    </div>
{{--                                    <div class="form-group col-6">--}}
{{--                                        <small class="form-text text-muted">Описание для поисковиков ру</small>--}}
{{--                                        <input--}}
{{--                                            name="description_ru"--}}
{{--                                            value="{{$item->description_ru}}"--}}
{{--                                            type="text"--}}
{{--                                            class="w-100 form-control priceInput"--}}
{{--                                        >--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-6">--}}
{{--                                        <small class="form-text text-muted">Описание для поисковиков укр</small>--}}
{{--                                        <input--}}
{{--                                            name="description_ua"--}}
{{--                                            value="{{$item->description_ua}}"--}}
{{--                                            type="text"--}}
{{--                                            class="w-100 form-control priceInput"--}}
{{--                                        >--}}
{{--                                    </div>--}}
                                    <div class="form-group col-6">
                                        <small class="form-text text-muted">Описание блюда для сайта ру</small>
                                        <input
                                            name="desc_ru"
                                            value="{{$item->desc_ru}}"
                                            type="text"
                                            class="w-100 form-control priceInput"
                                        >
                                    </div>
                                    <div class="form-group col-6">
                                        <small class="form-text text-muted">Описание блюда для сайта укр</small>
                                        <input
                                            name="desc_ua"
                                            value="{{$item->desc_ua}}"
                                            type="text"
                                            class="w-100 form-control priceInput"
                                        >
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="mt-2 controls-holder">

                                            @if($item->show === 1)
                                                <a href="{{route('category.show_item', [$item->id, 0])}}"
                                                   class="btn btn-sm btn-danger"
                                                   style="color: #fff!important;"
                                                >
                                                    Скрыть блюдо

                                                </a>
                                            @elseif($item->show === 0)
                                                <a href="{{route('category.show_item', [$item->id, 1])}}"
                                                   class="btn btn-sm btn-success"
                                                   style="color: #fff!important;"
                                                >
                                                    Показывать блюдо

                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-4 mb-4">
                                <div class="col-12 mb-2 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Разновидность Блюда "{{$item->title_ru}}"</h5>

                                    <a
                                        href="#addSubItem"
                                        type="submit"
                                        class="btn btn-sm btn-success ml-auto"
                                        style="color: white!important;"
                                    >
                                        Добавить разновидность блюда

                                    </a>
                                </div>
                                <div class="subItemsHolder mt-4">
                                    @if($item->goodsItems)
                                        @foreach($item->goodsItems as $subitem)

                                        <div class="subItemsHolderFlex">
                                            <div class="price-holder mb-1">
                                                <div class="subItemHandler">
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <small class="form-text text-muted">Название на русском </small>
                                                            <input
                                                                required
                                                                name="goodsItems[{{$subitem->id}}][title_ru]"
                                                                value="{{$subitem->title_ru}}"
                                                                type="text"
                                                                class="w-100 form-control priceInput"
                                                            >
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <small class="form-text text-muted">Название на украинском </small>
                                                            <input
                                                                required
                                                                name="goodsItems[{{$subitem->id}}][title_ua]"
                                                                value="{{$subitem->title_ua}}"
                                                                type="text"
                                                                class="w-100 form-control priceInput"
                                                            >
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <small class="form-text text-muted">Цена</small>
                                                            <input
                                                                required
                                                                name="goodsItems[{{$subitem->id}}][price]"
                                                                value="{{$subitem->price}}"
                                                                type="text"
                                                                class="w-100 form-control priceInput"
                                                            >
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <small class="form-text text-muted">Вес/шт/мл</small>
                                                            <input
                                                                required
                                                                name="goodsItems[{{$subitem->id}}][weightKind]"
                                                                value="{{$subitem->weightKind}}"
                                                                type="text"
                                                                class="w-100 form-control priceInput"
                                                            >
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <small class="form-text text-muted">Вес/шт/мл</small>
                                                            <input
                                                                required
                                                                name="goodsItems[{{$subitem->id}}][weight]"
                                                                value="{{$subitem->weight}}"
                                                                type="text"
                                                                class="w-100 form-control priceInput"
                                                            >
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <small class="form-text text-muted">Управление</small>
                                                            <style>
                                                                .controls-holder{
                                                                    display: flex;
                                                                    justify-content: start;
                                                                    align-items: center;
                                                                    height: 20px;
                                                                    gap: 20px;
                                                                }
                                                            </style>

                                                            <div class="mt-2 controls-holder">
                                                                @if($subitem->show === 0)
                                                                    <a href="{{ route('goodsItem.show_item', [$subitem->id, 1]) }}" title="Показать разновидность блюда">
                                                                        <svg style="fill: red" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>
                                                                    </a>
                                                                @elseif($subitem->show === 1)
                                                                    <a href="{{ route('goodsItem.show_item', [$subitem->id, 0]) }}" title="Скрыть разновидность блюда">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                                                                    </a>
                                                                @endif
                                                                @if(!$loop->last)
                                                                    <span class="fa-icon-holder " title="Изменить порядок вывода (вниз)">
{{--                                                                            <a href="{{ route('goods.order_bottom', [$cat->id, $item->order]) }}" class="fa-icon-holder mr-4" >--}}
                                                                        <a href="{{ route('goodsItem.order_bottom', [$subitem->item, $subitem->order]) }}" class="fa-icon-holder " >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
                                                                        </a>
                                                                    </span>
                                                                @endif

                                                                @if($loop->index !== 0)
                                                                    <span class="fa-icon-holder " title="Изменить порядок вывода (вверх)">
                                                                        <a href="{{ route('goodsItem.order_top', [$subitem->item, $subitem->order]) }}" class="fa-icon-holder" >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>
                                                                        </a>
                                                                    </span>
                                                                @endif
                                                                <span class="fa-icon-holder ml-4" title="Удалить">
                                                                    <a href="{{ route('goodsItem.remove', $subitem->id) }}" class="fa-icon-holder" >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" height="18" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                                                    </a>
                                                                </span>
                                                            </div>

                                                            <style>
                                                                a:hover{
                                                                    text-decoration: none;
                                                                }
                                                                a:hover svg{
                                                                    scale: 1.1;
                                                                }
                                                            </style>

                                                        </div>
                                                        <div class="col-3">
                                                            <input name="goodsItems[{{$subitem->id}}][id]" type="hidden" value="{{$subitem->id}}">
                                                        </div>
{{--                                                        <div class="col-3 d-flex align-items-center">--}}
{{--                                                            <div class="ml-2">--}}
{{--                                                                @if($subitem->show === 0)--}}
{{--                                                                <a href="{{route('category.show_category', [$cat->id, 1])}}">--}}
{{--                                                                    <a href="#" title="Показать категорию">--}}
{{--                                                                        <svg style="fill: red" xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>--}}
{{--                                                                    </a>--}}
{{--                                                                    @elseif($subitem->show === 1)--}}
{{--                                                                    <a href="#" title="Скрыть категорию">--}}
{{--                                                                <a href="{{route('category.show_category', [$cat->id, 1])}}">--}}
{{--                                                                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>--}}
{{--                                                                    </a>--}}
{{--                                                                    <style>--}}
{{--                                                                        a:hover{--}}
{{--                                                                            text-decoration: none;--}}
{{--                                                                        }--}}
{{--                                                                        a:hover svg{--}}
{{--                                                                            scale: 1.1;--}}
{{--                                                                        }--}}
{{--                                                                    </style>--}}
{{--                                                                @endif--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="mt-4 mb-4">
                                    @endforeach
                                    @endif
                                </div>
                            </td>
                            <td class="btns-holder">
{{--                                <div class="d-flex justify-content-between mb-2" style="gap:10px;">--}}
{{--                                    @if($item->show === 1)--}}
{{--                                        <div class="btn btn-outline-secondary btn-sm" >--}}
{{--                                            Скрыть--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    @if($item->show === 0)--}}
{{--                                    <div class="btn btn-outline-secondary btn-sm" >--}}
{{--                                        Показать--}}
{{--                                    </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                                <div class="upDownHolder">--}}
{{--                                    @if(!$loop->last)--}}
{{--                                        <span class="fa-icon-holder mr-2 ml-2" title="Изменить порядок вывода (вниз)">--}}
{{--                                            <a href="{{ route('goods.order_bottom', [$cat->id, $item->order]) }}" class="fa-icon-holder mr-4" >--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>--}}
{{--                                            </a>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}

{{--                                    @if($loop->index !== 0)--}}
{{--                                        <span class="fa-icon-holder ml-2 mr-2" title="Изменить порядок вывода (вверх)">--}}
{{--                                            <a href="{{ route('goods.order_top', [$cat->id, $item->order]) }}" class="fa-icon-holder" >--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>--}}
{{--                                            </a>--}}
{{--							            </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group mt-2 d-flex justify-content-between">
            <button
                type="submit"
                class="btn btn-sm btn-success"
            >
                Сохранить

            </button>

            <a href="{{route('goods.remove', $item->id)}}"
               class="btn btn-sm btn-danger"
               style="color: #fff!important;"
            >
                Удалить блюдо

            </a>
        </div>
    </form>

    <div
        id="addSubItem"
        style="margin: 150px 0;"
    >
        <h5
            class="text-center mb-4"
        >
            Добавление разновидность блюда</h5>
        <form
            method="POST"
            action="{{route('goodsItem.store')}}"
        >
            @csrf
            <input
                value="{{ $item->id }}"
                type="hidden"
                class="w-100 form-control"
                name="item"
            >
            <div class="row">
                <div class="form-group col-lg-6">
                    <small class="form-text text-muted">название на русском</small>
                    <input
                        type="text"
                        class="w-100 form-control"
                        name="title_ru"
                        required
                    >
                </div>
                <div class="form-group col-lg-6">
                    <small class="form-text text-muted">название на украинском</small>
                    <input
                        type="text"
                        class="w-100 form-control"
                        name="title_ua"
                        required
                    >
                </div>
            </div>
            <div class="row align-items-center">
                <div class="form-group col-lg">
                    <small class="form-text text-muted">цена</small>
                    <input
                        type="text"
                        class="w-100 form-control"
                        name="price"
                        required
                    >
                </div>
                <div class="form-group col-lg">
                    <small class="form-text text-muted">вес/шт/л</small>
                    <input
                        type="text"
                        class="w-100 form-control"
                        name="weight"
                        required
                    >
                </div>
                <div class="form-group col-lg">
                    <small class="form-text text-muted no-wrap">ед. изм</small>
                    <input
                        type="text"
                        class="w-100 form-control"
                        name="weightKind"
                        required
                    >
                </div>
            </div>
            <div class="d-flex justify-content-around mt-4">
                <button
                    type="submit"
                    class="btn btn-sm btn-success"
                >
                    Добавить разновидность блюда
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    .price-holder {
        position: relative;
        display: flex;
        align-items: center;
    }
    .price-holder + .price-holder {
        margin-top: 10px;
    }
    .plus-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        background: green;
        border-radius: 50%;
        padding: 13px;
        margin-left: 5px;
        cursor: pointer;
    }
    .plus-btn svg {
        color: #fff;
    }
    .minus-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        background: red;
        border-radius: 50%;
        padding: 13px;
        margin-left: 5px;
        margin-left: auto;
        cursor: pointer;
    }
    .minus-btn svg {
        color: #fff;
    }
    .imageHolder {
        width: 100%;
        heught: auto;
        cursor: pointer;
    }
    .imageHolder img {
        width: 100%;
        object-fit: contain;
        height: inherit;
    }
    .arrows {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        width: 200px;
    }
    .arrows span {
        cursor: pointer;
    }
    .fa-icon-holder + .fa-icon-holder {
        margin-left: 50px;
    }
    .upDownHolder {
        display: flex;
        justify-content: center;
    }
    .upDownHolder span {
        cursor: pointer;
        padding: 0 10px;
    }
    .edit-btn {
        cursor: pointer;
    }
    .right-btns-holder {
        display: flex;
        align-items: center;
        margin-left: auto;
        gap: 20px;
    }
    .subItemRow {
        cursor: pointer;
    }
    .subItemRow input {
        cursor: pointer;
    }

</style>
@endsection
