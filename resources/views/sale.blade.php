@extends('layout.main')


@section('title'){{ $page->title }}@endsection
@section('description'){{ $page->description }}@endsection

@section('banner')
    <section class="section-top-50 section-bottom-66 section-lg-top-160 section-lg-bottom-160 inset-left-15 inset-right-15"
             style="background-image: url('/images/main_images/aktsii.jpg');     background-position-x: 50%;
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
    {!! $page->content !!}
@endsection
