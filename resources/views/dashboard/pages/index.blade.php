@extends('layout.dashboard')

@section('content')

    <div>
        <h5>Страницы сайта</h5>
        <div class="mt-4">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Просмотров</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <th scope="row">
                            {{ $page->id }}
                        </th>
                        <td>
                            @if($page->id === 1)
                                Главная
                            @else
                                {{ $page->title_ru }}
                            @endif
                        </td>
{{--                        <td>{{$page->views}}</td>--}}
                        <td>
                            <a
                                href="/dashboard/page/{{$page->id}}"
                                class="btn btn-outline-primary btn-sm"
                            >
                                Редактировать
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
