@extends('layout.dashboard')

@section('content')
    <div>

        <h5 class="mb-3">Интерьер</h5>
        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('interior.store') }}"
            class="d-flex align-items-center"
        >
            @csrf
            <div class="form-group">
                <label>Добавить фото</label>
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
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div  class="block-holder">
                        <div class="image-holder">
                            <img src="{{asset('storage/'.$photo->path)}}">
                        </div>
                    </div>

                    <div class="arrows">
                        @if($loop->index !==0 )
                            <a
                                href="{{route('interior.left',$photo->order )}}"
                                class="fa-icon-holder"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
                            </a>
                        @endif
                        <a
                            href="{{route('interior.destroy',$photo->id )}}"
                            @click="showDelModal(photo)"
                            class="fa-icon-holder"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </a>
                        @if(!$loop->last)
                            <a
                                href="{{route('interior.right',$photo->order )}}"
                                v-if="index !== photos.length - 1"
                                class="fa-icon-holder"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
                            </a>
                        @endif
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
        }
        .arrows span {
            cursor: pointer;
        }
        .fa-icon-holder + .fa-icon-holder {
            margin-left: 50px;
        }

    </style>
@endsection
