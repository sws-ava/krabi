@extends('layout.main')


@section('title'){{ $page->title }}@endsection
@section('description'){{ $page->description }}@endsection

@section('banner')
    <section class="section-top-50 section-bottom-66 section-lg-top-160 section-lg-bottom-160 inset-left-15 inset-right-15"
        style="background-image: url({{asset('/images/main_images/main.jpg')}});     background-position-x: 50%;
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

    @if($translates['showWarning'])
        <section class="section-top-70 section-bottom-70">
            <div class="shell">
                {!! $translates['warning'] !!}
                <hr class="hr-gray offset-top-50">
            </div>
        </section>
    @endif

    {!! $page->content !!}

    <main class="page-content">
        <section class="section-bottom-70">
            <div class="shell">
                <hr class="hr-gray offset-top-50">
            </div>
        </section>
        <section class="section-top-50 section-bottom-66 section-lg-top-160 section-lg-bottom-160 inset-left-15 inset-right-15 bg-menu">
            <div class="header-divider">
                <h3 class="text-uppercase font-logo text-regular letter-spacing-200">
                    {{ $translates['ourMenu']}}
                </h3>
                <div class="text-center offset-top-9">
                    <ol class="breadcrumb">
                        <li>
                            <a
                                href="{{ LaravelLocalization::localizeUrl('/menyu') }}"
                            >
                                {{ $translates['lookAll']}}
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <main class="page-content">
            <section class="text-center section-50 section-sm-70 section-sm-bottom-83">
                <div class="shell">
                    <div data-isotope-layout="masonry" data-isotope-group="gallery" data-photo-swipe-gallery="gallery" class="isotope masonry-gallery range isotope--loaded isotope--loaded" style="position: relative; height: 807.95px;">
                        <div data-filter="type-1" class="isotope-item cell-xs-6 cell-sm-6 cell-md-4" style="position: absolute; left: 0px; top: 0px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/01.jpg')}}" data-photo-swipe-item="" data-size="800x607">
                                    <img src="{{asset('/images/main/01s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div data-filter="type-1" class="isotope-item cell-xs-6 cell-sm-6 cell-md-4" style="position: absolute; left: 399px; top: 0px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/02.jpg')}}" data-photo-swipe-item="" data-size="800x530">
                                    <img src="{{asset('/images/main/02s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div data-filter="type-2" class="isotope-item cell-xs-6 cell-sm-6 cell-md-4" style="position: absolute; left: 799px; top: 0px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/03.jpg')}}" data-photo-swipe-item="" data-size="800x540">
                                    <img src="{{asset('/images/main/03s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div data-filter="type-2" class="isotope-item cell-xs-6 cell-sm-6 cell-md-4" style="position: absolute; left: 0px; top: 403px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/04.jpg')}}" data-photo-swipe-item="" data-size="800x545">
                                    <img src="{{asset('/images/main/04s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div data-filter="type-2" class="isotope-item cell-xs-6 cell-sm-6 cell-md-4" style="position: absolute; left: 399px; top: 403px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/05.jpg')}}" data-photo-swipe-item="" data-size="800x681">
                                    <img src="{{asset('/images/main/05s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div data-filter="type-3" class="isotope-item cell-xs-6 cell-sm-6 cell-md-4" style="position: absolute; left: 799px; top: 403px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/06.jpg')}}" data-photo-swipe-item="" data-size="401x600">
                                    <img src="{{asset('/images/main/06s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                    </div>
                    <hr class="hr-sealine-gray offset-top-45">
                    <hr class="hr-gray offset-top-45">
                </div>
            </section>
        </main>	<section class="section-top-50 section-bottom-66 section-lg-top-160 section-lg-bottom-160 inset-left-15 inset-right-15 bg-int">
            <div class="header-divider">
                <h3 class="text-uppercase font-logo text-regular letter-spacing-200">
                    {{ $translates['interior']}}
                </h3>
                <div class="text-center offset-top-9">
                    <ol class="breadcrumb">
                        <li>
                            <a
                                href="{{ LaravelLocalization::localizeUrl('/interer') }}"
                            >
                                {{ $translates['lookAll']}}
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
        <main class="page-content">
            <section class="text-center section-50 section-sm-115">
                <div class="shell">
                    <div data-isotope-layout="masonry" data-isotope-group="gallery" data-photo-swipe-gallery="gallery" class="isotope masonry-gallery range isotope--loaded isotope--loaded" style="position: relative; height: 1087px;">
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3" style="position: absolute; left: 0px; top: 0px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/10.jpg')}}" data-photo-swipe-item="" data-size="400x600">
                                    <img src="{{asset('/images/main/10s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-6" style="position: absolute; left: 300px; top: 0px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/11.jpg')}}" data-photo-swipe-item="" data-size="800x600">
                                    <img src="{{asset('/images/main/11s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3" style="position: absolute; left: 900px; top: 0px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/12.jpg')}}" data-photo-swipe-item="" data-size="450x600">
                                    <img src="{{asset('/images/main/12s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3" style="position: absolute; left: 900px; top: 313px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/13.jpg')}}" data-photo-swipe-item="" data-size="800x600">
                                    <img src="{{asset('/images/main/13s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-6" style="position: absolute; left: 0px; top: 461px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/14.jpg')}}" data-photo-swipe-item="" data-size="800x600">
                                    <img src="{{asset('/images/main/14s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3" style="position: absolute; left: 600px; top: 461px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/15.jpg')}}" data-photo-swipe-item="" data-size="800x600">
                                    <img src="{{asset('/images/main/15s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3" style="position: absolute; left: 900px; top: 626px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/16.jpg')}}" data-photo-swipe-item="" data-size="427x600">
                                    <img src="{{asset('/images/main/16s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-3" style="position: absolute; left: 0px; top: 774px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/17.jpg')}}" data-photo-swipe-item="" data-size="450x600">
                                    <img src="{{asset('/images/main/17s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                        <div class="isotope-item cell-xs-6 cell-sm-6 cell-md-6" style="position: absolute; left: 300px; top: 774px;">
                            <div class="thumbnail-gallery"><a href="{{asset('/images/main/18.jpg')}}" data-photo-swipe-item="" data-size="800x600">
                                    <img src="{{asset('/images/main/18s.jpg')}}" alt=""><span class="overlay"></span></a></div>
                        </div>
                    </div>
                    <hr class="hr-sealine-gray offset-top-45">
                    <hr class="hr-gray offset-top-45">
                </div>
            </section>
        </main>
        <!-- cont here end -->
    </main>
@endsection
