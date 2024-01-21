@extends('layout.dashboard')

@section('content')
    <div>
        <h5 class="mb-3">Картнки для сайта</h5>
        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('images.store') }}"
            class="d-flex align-items-center"
        >
            @csrf
            <div class="form-group">
                <label>Добавить картинку</label>
                <input
                    name="file"
                    accept="image/*"
                    type="file"
                    class="form-control-file"
                >
            </div>
            <button type="submit">Добавить фото</button>
        </form>
        <div class="row">
            @foreach($photos as $photo)
                <div class="col-md-4 col-lg-3 mb-4 mt-4" >
                    <div  class="block-holder">
                        <div class="image-holder">
                            <img src="/storage/{{$photo->path}}">
                        </div>
                    </div>
                    <div style="text-align: center; font-size: 15px; overflow: hidden" title="/storage/{{$photo->path}}" alt="/storage/{{$photo->path}}">
                        /storage/{{$photo->path}}
                    </div>
                    <div class="arrows">
                        <span
                            onclick="copyLink('/storage/{{$photo->path}}')"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M208 0H332.1c12.7 0 24.9 5.1 33.9 14.1l67.9 67.9c9 9 14.1 21.2 14.1 33.9V336c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V48c0-26.5 21.5-48 48-48zM48 128h80v64H64V448H256V416h64v48c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V176c0-26.5 21.5-48 48-48z"/></svg>
                        </span>
                        <a
                            href="{{route('images.destroy',$photo->id )}}"
                            @click="showDelModal(photo)"
                            class="fa-icon-holder"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </a>

                        <script>
                            function copyLink(link){
                                console.log(link)
                                document.execCommand("copy");
                                navigator.clipboard.writeText(link);
                            }
                        </script>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .block-holder {
            position: relative;
            width: 100%;
            padding-top: 100%;
        }
        .image-holder {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            font-size: 14px;
            display: flex;
        }
        .image-holder img {
            width: 100%;
            height: auto;
            object-fit: contain;
            cursor: pointer;
        }
        .arrows {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            justify-content: space-around;
        }
        .arrows span {
            cursor: pointer;
        }
        .fa-icon-holder + .fa-icon-holder {
            margin-left: 50px;
        }
    </style>
@endsection
