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
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="{{route('category.index')}}">--}}
{{--                        Категории меню--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="breadcrumb-item active" aria-current="page">Создать блюдо</li>
            </ol>
        </nav>

        <form method="POST" action="{{route('goods.store')}}">
            @csrf
            <div class="row">
                <div class="form-group col-lg-7">
                    <small class="form-text text-muted">Выбрать категорию</small>
                    <select
                        name="category"
                        required
                        class="form-control"
                    >
                        @foreach($cats as $cat)
                            <option value="">Выбрать категорию</option>
                            <option value="{{$cat->id}}">{{ $cat->title_ru }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-7">
                    <small class="form-text text-muted">Название ру</small>
                    <input
                        name="title_ru"
                        value=""
                        type="text"
                        class="form-control"
                        required
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small  class="form-text text-muted">Название укр</small>
                    <input
                        name="title_ua"
                        value=""
                        type="text"
                        class="form-control"
                        required
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small class="form-text text-muted">Описание ру</small>
                    <input
                        name="desc_ru"
                        value=""
                        type="text"
                        class="form-control"
                    >
                </div>
                <div class="form-group col-lg-7">
                    <small  class="form-text text-muted">Описание укр</small>
                    <input
                        name="desc_ua"
                        value=""
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
                            href="{{route('menu.show')}}"
                            @click="backToCategories()"
                            class="btn btn-sm btn-secondary"
                        >
                            Назад

                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
