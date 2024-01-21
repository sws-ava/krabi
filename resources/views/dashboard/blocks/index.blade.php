@extends('layout.dashboard')

@section('content')

    <div>
        <div class="row mb-4">
            <div class="col-12">Редактирование статичных блоков на сайте</div>
        </div>
        <form method="POST"  action="{{ route('blocks.save') }}" >
            @csrf
            <div class="row">
                <div class="form-group col-lg-6">
                    <small class="form-text text-muted">Адрес на русском</small>
                    <input
                        name="ru[address]"
                        value="{{$ru->address}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
                <div class="form-group col-lg-6">
                    <small class="form-text text-muted">Адрес на украинском</small>
                    <input
                        name="ua[address]"
                        value="{{$ua->address}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
                <div class="form-group col-6">
                    <small class="form-text text-muted">Телефон 1 по шаблону "(068) 168 96 95"</small>
                    <input
                        name="ru[phone1]"
                        value="{{$ru->phone1}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
                <div class="form-group col-6">
                    <small class="form-text text-muted">Телефон 1 по шаблону "+380681689695"</small>
                    <input
                        name="ru[phone1full]"
                        value="{{$ru->phone1full}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
                <div class="form-group col-6">
                    <small class="form-text text-muted">Телефон 2 по шаблону "(063) 877 78 51"</small>
                    <input
                        name="ru[phone2]"
                        value="{{$ru->phone2}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
                <div class="form-group col-6">
                    <small class="form-text text-muted">Телефон 2 по шаблону "+380638777851"</small>
                    <input
                        name="ru[phone2full]"
                        value="{{$ru->phone2full}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <small class="form-text text-muted">Рабочие часы</small>
                    <input
                        name="ru[workHours]"
                        value="{{$ru->workHours}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <small class="form-text text-muted">E-mail</small>
                    <input
                        name="ru[email]"
                        value="{{$ru->email}}"
                        class="form-control"
                        type="text"
                        required
                    >
                </div>
            </div>
            <div class="row">

                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Показывать на сайте информациооные блоки? </small>
                    <input
                        @if($ru->showWarning) checked @endif
                        name="ru[showWarning]"
                        value="{{$ru->showWarning}}"
                        type="checkbox"
                    >
                </div>

                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Информационный блок везде вверху страницы ру </small>
                    <textarea
                        name="ru[warning]"
                        class="form-control"
                        style="min-height: 200px;"
                    >{{$ru->warning}}</textarea>
                </div>
                <div class="form-group col-lg-12">
                    <small class="form-text text-muted">Информационный блок везде вверху страницы укр </small>
                    <textarea
                        name="ua[warning]"
                        class="form-control"
                        style="min-height: 200px;"
                    >{{$ua->warning}}</textarea>
                </div>
            </div>

            <div class="row">
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
                            href="/dashboard"
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
