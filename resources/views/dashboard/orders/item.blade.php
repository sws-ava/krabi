@extends('layout.dashboard')

@section('content')

<div>
    <div class="text-right mt-3 mb-3 review-header__status ">
        <b
            @click="getNewOrders()"
            class="red-text mr-4 pointer"
        >
            <a href="/dashboard/orders">Новые заказы</a>
        </b>
        <b
            @click="getDoneOrders()"
            class="green-text pointer"
        >
            <a href="/dashboard/orders/done">Выполненые заказы</a>
        </b>
    </div>

    <h5 class="mb-3">Детали заказа</h5>
    <div class="mb-4">
        <div class="review-header__status mb-2">
            <b>
                @if($order->status === 1)
                    <span class="red-text">
                        Новый заказ
                    </span>
                @elseif($order->status === 2)
                    <span v-else-if="order.status === 2" class="green-text">
                        Заказ выполнен
                    </span>
                    {{ $order->date }}
                @endif
            </b>
        </div>
        <div class="review-header mb-2">
            <div class="row">
                <div class="form-group col-lg-5">
                    <div class="option-title">Имя:</div>
                    <input
                        readonly
                        value="{{$order->name}}"
                        class="form-text w-100 form-control"
                        type="text"
                    />
                </div>
                <div class="form-group col-lg-4">
                    <div class="option-title">Телефон:</div>
                    <input
                        readonly
                        value="{{$order->phone}}"
                        class="form-text w-100 form-control"
                        type="text"
                    />
                </div>
                <div class="form-group col-lg-3">
                    <div class="option-title">Сумма:</div>
                    <div class="option-text ">
                        <span class="orderTotalTop"> {{ $order->total }} </span>грн
                    </div>
                </div>
                <div v-if="order.address" class="mb-2 col-lg-6 form-group ">
                    <span class="option-title">Адрес:</span>
                    <input
                        readonly
                        value="{{$order->address}}"
                        class="form-text w-100 form-control"
                        type="text"
                    />
                </div>
                <div v-if="order.address" class="mb-2 col-lg-3 form-group ">
                    <span class="option-title">Персон:</span>
                    <input
                        readonly
                        value="{{$order->persons}}"
                        class="form-text w-100 form-control"
                        type="number"
                    />
                </div>
                <div class="form-group mb-2 col-12">
                    <span class="option-title">Комментарий к заказу:</span>
                    <textarea
                        readonly
                        style="height: 130px; resize: none;"
                        class="form-text w-100 form-control"
                        type="text"
                    >{{$order->comment}}</textarea>
                </div>
            </div>
        </div>
        <div class="mt-4 mb-2 d-flex align-items-center">
            Заказ:
{{--            <span--}}
{{--                @click="showAddOrderItemsModal = true"--}}
{{--                class="btn btn-outline-primary btn-sm ml-auto"--}}
{{--            >--}}
{{--              Добавить блюдо--}}
{{--            </span>--}}
        </div>
        <hr class="mb-2 mt-1" />
        <div>
            @foreach($order->items as $item)


            <div
                class="row mb-4 d-flex align-items-center"
            >
                <div class="col-lg-6">
                    {{ $loop->index +1 }}.
{{--                    {{ idx + 1 }}.--}}
                    @if($item->title !== $item->full_title)
                        <span>
                        {{$item->full_title}}
                    </span>
                    @endif
                    {{ $item->title }} {{ $item->weight }}
                </div>
                <div class="col-lg-2 text-right">
                    {{ $item->price }} грн
                </div>
                <div class="col-lg plus-minus-holder">
{{--                    <div class="plus-minus">--}}
{{--                      <span--}}
{{--                          @click="decrementOrderItem(item)"--}}
{{--                      >--}}
{{--                        <font-awesome-icon--}}
{{--                            :icon="['fas', 'minus-circle']"--}}
{{--                            style="width:17px; height: 17px"--}}
{{--                        />--}}
{{--                      </span>--}}
{{--                    </div>--}}
                    {{ $item->amount }} ед.
{{--                    <div class="plus-minus">--}}
{{--                      <span--}}
{{--                          @click="incrementOrderItem(item)"--}}
{{--                      >--}}
{{--                        <font-awesome-icon--}}
{{--                            :icon="['fas', 'plus-circle']"--}}
{{--                            style="width:17px; height: 17px"--}}
{{--                        />--}}
{{--                      </span>--}}
{{--                    </div>--}}
                </div>
                <div class="col-lg text-right">
                    {{ $item->price * $item->amount }} грн

                    <span
                        @click="showRemoveOrderItemModal(item)"
                        class="fa-icon-holder"
                    >
{{--                        <font-awesome-icon--}}
{{--                            :icon="['fas', 'trash']"--}}
{{--                            style="width:17px; height: 17px"--}}
{{--                        />--}}
{{--                    </span>--}}
                </div>
            </div>
            @endforeach
        </div>
        <hr class="mb-1 mt-2 mb-4" />
        <div class="row text-right mt-4 mb-4">
            <div class="offset-lg-7 col-lg-5">Сумма: <span class="orderTotal"> {{ $order->total }} </span> грн</div>
        </div>
        <div class="d-flex justify-content-between col-12">
{{--            <div class="form-group mt-2">--}}
{{--                <button--}}
{{--                    @click="saveOrder()"--}}
{{--                    type="submit"--}}
{{--                    class="btn btn-success"--}}
{{--                >--}}
{{--                    Сохранить--}}

{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="form-group mt-2">--}}
{{--                <button--}}
{{--                    @click="saveOrderAndExit()"--}}
{{--                    type="submit"--}}
{{--                    class="btn btn-primary"--}}
{{--                >--}}
{{--                    Сохранить и выйти--}}

{{--                </button>--}}
{{--            </div>--}}
            <div class="form-group mt-2">
                <button
                    onclick="window.history.back();"
                    class="btn btn-secondary"
                >
                    Назад
                </button>
            </div>
        </div>
        <div class="buttons mt-4">
            <div>
                @if($order->status === 1)
{{--                    <form method="POST" action="/dashboard/orders/set-status/{{$order->id}}/2">--}}
{{--                        @csrf--}}
{{--                        <button--}}
{{--                            type="submit"--}}
{{--                            class="btn btn-outline-success btn-sm"--}}
{{--                        >--}}
{{--                            Заказ выполнен--}}
{{--                        </button>--}}
{{--                    </form>--}}
                    <a href="/dashboard/orders/set-status/{{$order->id}}" class="btn btn-outline-success btn-sm"  >
                        Заказ выполнен
                    </a>
                @elseif($order->status === 2)
                    <a href="/dashboard/orders/set-status/{{$order->id}}" class="btn btn-outline-secondary btn-sm" >
                        Заказ не выполнен
                    </a>
                @endif
            </div>
            <a href="/dashboard/orders/remove/{{$order->id}}" class="btn btn-outline-danger btn-sm btn-delete" >
                Удалить заказ
            </a>
        </div>
    </div>


{{--    --}}
{{--    <!-- delete subItem modal -->--}}
{{--    <modal-delete-window--}}
{{--        :showDeleteModal="showDeleteModal"--}}
{{--    >--}}
{{--        <h5 class="text-center mb-4">Удалить это блюдо?</h5>--}}
{{--        <div class="d-flex justify-content-around mt-4">--}}
{{--            <div--}}
{{--                @click="removeOrderItem()"--}}
{{--                class="btn btn-outline-danger btn-sm"--}}
{{--            >--}}
{{--                Удалить--}}
{{--            </div>--}}
{{--            <div--}}
{{--                @click="hideRemoveOrderItemModal()"--}}
{{--                class="btn btn-outline-secondary btn-sm"--}}
{{--            >--}}
{{--                Отменить--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </modal-delete-window>--}}


{{--    <!-- delete order modal -->--}}
{{--    <modal-delete-window--}}
{{--        :showDeleteModal="showDeleteOrderModal"--}}
{{--    >--}}
{{--        <h5 class="text-center mb-4">Удалить этот заказ?</h5>--}}
{{--        <div class="d-flex justify-content-around mt-4">--}}
{{--            <div--}}
{{--                @click="removeOrder()"--}}
{{--                class="btn btn-outline-danger btn-sm"--}}
{{--            >--}}
{{--                Удалить--}}
{{--            </div>--}}
{{--            <div--}}
{{--                @click="showDeleteOrderModal = false"--}}
{{--                class="btn btn-outline-secondary btn-sm"--}}
{{--            >--}}
{{--                Отменить--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </modal-delete-window>--}}

{{--    <!-- add new item to order modal -->--}}
{{--    <modal-delete-window--}}
{{--        :showDeleteModal="showAddOrderItemsModal"--}}
{{--    >--}}
{{--        <h5 class="text-center mb-4">Добавить блюдо к заказу</h5>--}}
{{--        <div class="row">--}}
{{--            <div class="mb-2 col-12 form-group ">--}}
{{--                <span class="option-title">Поиск блюда, мин 2 символа (ру)</span>--}}
{{--                <input--}}
{{--                    v-model="searchDish"--}}
{{--                    @input="fetchDishesByQuery()"--}}
{{--                    class="form-text w-100 form-control"--}}
{{--                    type="text"--}}
{{--                />--}}
{{--            </div>--}}
{{--            <div class="col-12 mt-2 mb-2">--}}
{{--                <b>Итого блюд: {{ totalDishesByQuery }}</b>--}}
{{--            </div>--}}
{{--            <div--}}
{{--                v-if="searchSpinner"--}}
{{--                class="spinner-border text-primary spinnerItem mt-4 mb-4 mx-auto"--}}
{{--                role="status"--}}
{{--            >--}}
{{--                <span class="sr-only">Загрузка...</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row modalItemsScroll">--}}
{{--            <div v-for="dish in menuItems" :key="dish.id"--}}
{{--                 class="col-12 mb-2"--}}
{{--            >--}}
{{--                <div class="d-flex justify-content-between">--}}
{{--                    <div>--}}
{{--                  <span v-if="dish.title != dish.title_ru">--}}
{{--                    {{ dish.title }}--}}
{{--                  </span>--}}
{{--                        {{ dish.title_ru }}--}}
{{--                        <br>--}}
{{--                        {{ dish.weight }} {{ dish.weightKind }} {{ dish.price }}грн--}}

{{--                    </div>--}}
{{--                    <span--}}
{{--                        @click="addDishToOrderMenuItems(dish)"--}}
{{--                        class="addDish"--}}
{{--                    >--}}
{{--                  Добавить--}}
{{--                </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="d-flex justify-content-around mt-4">--}}
{{--            <div--}}
{{--                @click="showAddOrderItemsModal = false, menuItems = [], searchDish = '', totalDishesByQuery = 0"--}}
{{--                class="btn btn-outline-secondary btn-sm"--}}
{{--            >--}}
{{--                Отменить--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </modal-delete-window>--}}

</div>

<style>
    .review-header__status {
        margin-left: auto;
    }
    .review-header__status .green-text {
        color: green;
    }
    .review-header__status .red-text {
        color: red;
    }
    .review-header__status .blue-text {
        color: blue;
    }
    .answer {
        max-width: 80%;
        margin-left: auto;
        text-align: right;
        border-radius: 20px;
        background: #f3f0f0;
        padding: 4px 10px;
        width: max-content;
    }
    .buttons {
        display: flex;
        gap: 10px;
    }
    .star {
        width: 20px;
        fill: #ebeb00;
    }
    .btn-delete {
        margin-left: auto;
    }
    .option-title {
        font-size: 12px;
        display: block;
    }
    .option-text {
        padding-left: 20px;
    }
    .plus-minus-holder {
        display: flex;
        align-items: center;
    }
    .plus-minus {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        line-height: 20px;
        cursor: pointer;
        margin: 0 10px;
    }
    span.edit-item {
        font-size: 12px;
        font-weight: bold;
    }
    span.edit-item:hover {
        text-decoration: underline;
    }
    .fa-icon {
        cursor: pointer;
    }
    .fa-icon-holder {
        cursor: pointer;
    }
    .fa-icon-holder svg {
        transition: scale 0.25s ease-in-out;
    }
    .fa-icon-holder:hover svg {
        scale: 1.1;
    }
    .orderTotal {
        font-weight: bold;
        font-size: 30px;
    }
    .orderTotalTop {
        font-weight: bold;
        font-size: 20px;
    }
    .addDish {
        cursor: pointer;
        color: green;
    }
    .addDish:hover {
        text-decoration: underline;
    }
    .modalItemsScroll {
        overflow-y: scroll;
        max-height: 500px;
        overflow-x: auto;
    }

</style>


@endsection
