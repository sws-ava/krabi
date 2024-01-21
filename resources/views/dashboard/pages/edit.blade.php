@extends('layout.dashboard')

@section('content')


    <div>
        <spinner v-if="showSpinner" />
        <div class="row mb-4">
            <div class="col-12">Редактирование страницы</div>
        </div>
        <form method="POST" action="{{ route('page.update', $page->id) }}" >
            @csrf
            <div class="row">
                <div class="form-group col-lg-6">
                    <small class="form-text text-muted">Название страницы на украинском</small>
                    <input
                        name="title_ru"
                        value="{{$page->title_ru}}"
                        class="form-control"
                        type="text"
                    >
                </div>
                <div class="form-group col-lg-6">
                    <small class="form-text text-muted">Название страницы на украинском</small>
                    <input
                        name="title_ua"
                        value="{{$page->title_ua}}"
                        class="form-control"
                        type="text"
                    >
                </div>
                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Описание страницы на русском</small>
                    <input
                        name="description_ru"
                        value="{{$page->description_ru}}"
                        class="form-control"
                        type="text"
                    >
                </div>
                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Описание страницы на украинском</small>
                    <input
                        name="description_ua"
                        value="{{$page->description_ua}}"
                        class="form-control"
                        type="text"
                    >
                </div>
                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Контент страницы на русском </small>
                    <textarea
                        name="content_ru"
                        class="form-control"
                        style="min-height: 600px;"
                    >{{$page->content_ru}}</textarea>
                </div>
                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Контент страницы на украинском </small>
                    <textarea
                        name="content_ua"
                        class="form-control"
                        style="min-height: 600px;"
                    >{{$page->content_ua}}</textarea>
                </div>
                <div class="d-flex justify-content-between col-12">
                    <div class="form-group mt-2">
                        <button
                            @click="savePage()"
                            type="submit"
                            class="btn btn-sm btn-success"
                        >
                            Сохранить

                        </button>
                    </div>
                    <div class="form-group mt-2">
                        <a
                            href="{{route('pages.index')}}"
                            @click="backToPages()"
                            class="btn btn-sm btn-secondary"
                        >
                            Назад

                        </a>
                    </div>
                </div>
            </div>
        </form>
        <div>
            <div class="row">
                <div class="col-12">
                    Фото:
                </div>
            </div>
            <div class="row mb-4" style="height: 500px;  overflow-y: scroll;">
                @foreach($photos as $photo)
                    <div class="col-md-2 mt-4 mb-4">
                        <div  class="block-holder1">
                            <div class="image-holder1">
                                <img src="{{asset('storage/'.$photo->path)}}">
                            </div>
                        </div>
                        <div style="text-align: center; font-size: 15px; overflow: hidden" title="/storage/{{$photo->path}}" alt="/storage/{{$photo->path}}">
                            /storage/{{$photo->path}}

                            <span
                                style="cursor: pointer;"
                                onclick="copyLink('/storage/{{$photo->path}}')"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M208 0H332.1c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9V336c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V48c0-26.5 21.5-48 48-48zM48 128h80v64H64V448H256V416h64v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48z"/></svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function copyLink(link){
            console.log(link)
            document.execCommand("copy");
            navigator.clipboard.writeText(link);
        }
    </script>

    <style>
        .block-holder1 {
            position: relative;
            width: 100%;
            padding-top: 100%;
        }
        .image-holder1 {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            font-size: 14px;
            display: flex;
        }
        .image-holder1 img {
            width: 100%;
            height: auto;
            object-fit: contain;
            cursor: pointer;
        }

    </style>

@endsection
