@extends('layout.main')


@section('title'){{ $page->title }}@endsection
@section('description'){{ $page->description }}@endsection

@section('banner')
    <section class="section-top-50 section-bottom-66 section-lg-top-160 section-lg-bottom-160 inset-left-15 inset-right-15"
             style="background-image: url({{asset('/images/main_images/test-menyu.jpg')}});     background-position-x: 50%;
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

    <div class="shell" style="margin-top: 30px">
        <div class="panel-group menu_all" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="range">
                @foreach($cats as $cat)
                    @if($cat->show == 1)
                        <div class="cell-sm-12">
                    <div class="" role="tab" id="heading-{{$cat->id}}">
                        <h2 class="">
                            <a role="button" data-toggle="collapse" href="#collapse-{{$cat->id}}" aria-expanded="true" aria-controls="collapse-{{$cat->id}}">
                                {{$cat->title}}
                            </a>
                        </h2>
                    </div>
                    <div id="collapse-{{$cat->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{$cat->id}}">
                        <div class="range">
                            @foreach($cat->goods as $good)

                                @if($good->show == 1)
                                    <div class="cell-sm-6 cell-md-4 item_holder">
                                    <div class="image_holder">
                                        @if($good->picture)
                                            <img class="image 2" src="{{asset('storage/'.$good->picture)}}">

                                        @endif
                                    </div>
                                    <h4>{{ $good->title }}</h4>
                                    <p class="description">{{ $good->desc }}</p>

                                    @foreach($good->goodsItems as $goodItem)
                                        @if($goodItem->show == 1)
                                            <div class="price_weight text_left" style="justify-content: space-between; align-items: center;">
                                                <span style="font-size: 12px; text-align: left;padding-right: 20px;">
                                                    {{ $goodItem->title }} {{ $goodItem->weight }} {{ $goodItem->weightKind }}
                                                </span>
                                                @php
                                                    $title = '';
                                                    if($good->title == $goodItem->title){
                                                        $title = $good->title;
                                                    }else{
                                                        $title = $good->title . ' ' . $goodItem->title;
                                                    }

                                                @endphp
                                                @if($catalog_settings->is_online_order)
                                                    <span
                                                        onclick="addToCart({{ $goodItem->id }}, {{ $goodItem->price }}, '{{ $title }} {{ $goodItem->weight }} {{ $goodItem->weightKind }}')"
                                                        class="price"
                                                    >
                                                        {{ $goodItem->price }}
                                                        <i class="fa-icon fa fa-cart-plus" aria-hidden="true"></i>
                                                    </span>
                                                @else
                                                    <span
                                                        class="price"
                                                    >
                                                    {{ $goodItem->price }}
                                                </span>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <section class="section-top-50 section-bottom-83 section-sm-top-70 section-sm-bottom-83 text-center text-sm-left">
        <div class="col-xs-12 section-bottom-34 clearfix">
            <div class="row">
                @foreach($paper_menu as $pmenu)
                        <div class="menudiv col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <span class="zoom" id="ex{{ $loop->index + 1 }}" style="position: relative; overflow: hidden;">
                                <img src="{{asset('storage/'.$pmenu->path)}}" width="100%" alt="">
                            <img role="presentation" src="{{asset('storage/'.$pmenu->path)}}" class="zoomImg" style="position: absolute; top: -128.095px; left: -152.937px; opacity: 0; width: 636px; height: 1026px; border: none; max-width: none; max-height: none;"></span>
                        </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>

        .price_weight {
            max-width: 80%;
            margin: 0 auto 12px;
        }
        @media (max-width: 992px){
            .price_weight {
                margin: 0 auto 20px;
            }
        }
        .price {
            display: flex;
            align-items: center;
            cursor: pointer;
            opacity: 1;
            transition: opacity 0.25s ease-in-out;
        }
        .price:hover{
             opacity: 0.7;
             transition: opacity 0.25s ease-in-out;
        }
        .price .fa-icon{
            margin-left: 10px;
            color: #e0ca8f;
            width: 36px;
            height: 21px;
        }
        .image_holder img{
            max-width: 250px;
        }
    </style>


@endsection
