@extends('layout.dashboard')

@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <h5 class="mb-3">Возможность принимать онлайн заказы</h5>
            </div>
            @if($catalog_settings->is_online_order)
                <div class="col-12">
                    Статус:  Включено - заказы принимаются с сайта
                    <a
                        class="btn btn-sm btn-danger ml-4" style="color: #fff!important;"
                        href="{{route('catalog_settings.is_online_order', 0)}}"
                    >
                        Выключить
                    </a>
                </div>
            @else
                <div class="col-12">
                    Статус:  Выключено - заказы НЕ принимаются с сайта
                    <a
                        class="btn btn-sm btn-success ml-4" style="color: #fff!important;"
                        href="{{route('catalog_settings.is_online_order', 1)}}"
                    >
                        Включить
                    </a>
                </div>
            @endif
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
@endsection
