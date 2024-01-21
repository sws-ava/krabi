@extends('layout.dashboard')

@section('content')
    <div>
        <h5 class="mb-3">Категория</h5>
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
                <li class="breadcrumb-item">
                    <a href="{{route('category.index')}}">
                        Категории меню
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Изменить категорию</li>
            </ol>
        </nav>
        <div class="row">
            <div class="d-flex col-12">
                <div class="form-group mt-2 mr-4">
                    <a href="{{route('goods.create') }}"
                       class="btn btn-sm btn-success"
                       style="color: #fff!important;"
                    >
                        Добавить блюдо

                    </a>
                </div>
                <div class="form-group mt-2">
                    @if($cat->show === 1)
                        <a href="{{route('category.show_category', [$cat->id, 0])}}"
                            class="btn btn-sm btn-danger"
                           style="color: #fff!important;"
                        >
                            Скрыть категорию

                        </a>
                    @elseif($cat->show === 0)
                        <a href="{{route('category.show_category', [$cat->id, 1])}}"
                            class="btn btn-sm btn-success"
                           style="color: #fff!important;"
                        >
                            Показывать категорию

                        </a>
                    @endif
                </div>
            </div>
        </div>
        <form method="POST" action="{{route('category.update2', $cat->id)}}">
            @csrf
            <div class="row">
                <div class="form-group col-lg-7">
                    <small class="form-text text-muted">Название категории ру</small>
                    <input
                        name="title_ru"
                        value="{{$cat->title_ru}}"
                        type="text"
                        class="form-control"
                        required
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small  class="form-text text-muted">Название категории укр</small>
                    <input
                        name="title_ua"
                        value="{{$cat->title_ua}}"
                        type="text"
                        class="form-control"
                        required
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small class="form-text text-muted">Описание категории ру</small>
                    <input
                        name="description_ru"
                        value="{{$cat->description_ru}}"
                        type="text"
                        class="form-control"
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small  class="form-text text-muted">Описание категории укр</small>
                    <input
                        name="description_ua"
                        value="{{$cat->description_ua}}"
                        type="text"
                        class="form-control"
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small class="form-text text-muted">Ссылка категории</small>
                    <input
                        name="slug"
                        value="{{$cat->slug}}"
                        type="text"
                        class="form-control"
                    >
                </div>

                <div class="d-flex justify-content-between col-12">
                    <div class="form-group mt-2">
                        <button
                            type="submit"
                            class="btn btn-sm btn-success"
                        >
                            Сохранить

                        </button>
                    </div>
                    <div class="form-group mt-2">
                        <a
                            href="{{route('category.index')}}"
                            @click="backToCategories()"
                            class="btn btn-sm btn-secondary"
                        >
                            Назад

                        </a>
                    </div>
                </div>
                @if($cat->cat_items === 0)
                <div class="d-flex justify-content-between mt-4 pt-4 col-12">
                    <div class="form-group mt-2">
                        <a href="{{route('category.destroy2', $cat->id)}}"
                            v-if="!category.isChilds"
                            @click="showDeleteModal = true"
                            class="btn btn-sm btn-danger"
                           style="color: #fff!important;"
                        >
                            Удалить

                        </a>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>

@endsection
