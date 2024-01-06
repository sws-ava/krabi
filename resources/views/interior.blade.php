@extends('layout.main')


@section('title'){{ $page->title }}@endsection
@section('description'){{ $page->description }}@endsection

@section('banner')
    <section class="section-top-50 section-bottom-66 section-lg-top-160 section-lg-bottom-160 inset-left-15 inset-right-15"
             style="background-image: url('/images/main_images/interer.jpg');     background-position-x: 50%;
        padding-top: 15%;
        padding-bottom: 15%;
        background-position-y: 50%;"
    >
        <div class="header-divider">
            <h3 class="text-uppercase font-logo text-regular letter-spacing-200">{{ $page->title }}</h3>
        </div>
    </section>
@endsection

@section('content')

    <section class="text-center section-50 section-sm-115">
        <div class="shell">
            <div
                data-isotope-layout="masonry"
                data-isotope-group="gallery"
                data-photo-swipe-gallery="gallery"
                class="isotope masonry-gallery range isotope--loaded isotope--loaded"
            >
                @foreach($images as $item)
                    <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3">
                        <div class="thumbnail-gallery">
                            <a href="/{{$item->path}}" data-photo-swipe-item="" data-size="800x534">
                                <img src="/{{$item->path}}" alt="">
                                <span class="overlay"></span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr class="hr-sealine-gray offset-top-45">
        <hr class="hr-gray offset-top-45">
    </section>



@endsection
