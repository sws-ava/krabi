@extends('layout.dashboard')

@section('content')

    <style>
        .order-in-orders{
            background-color: rgb(0 209 0 / 50%);
            padding: 20px;
            border-radius: 20px;
        }
        .order-in-orders.new-order{
            background-color: rgb(241 178 178 / 50%);
        }
    </style>

    <div>
        <h5 class="mb-3">Заказы с сайта</h5>
        <div class="mt-3 mb-3 review-header__status ">
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

        @foreach($orders as $order)
        <div
            v-for="order in orders"
            :key="order.id"
            class="mt-4 order-in-orders @if($order->status == 1) new-order @endif "
        >
            <div class="review-header__status ">
                <b>
                    @if($order->status === 1)
                        <span class="red-text" >
							Новый заказ
					    </span>
                    @elseif($order->status === 2)
                        <span class="green-text">
                            Заказ выполнен
                        </span>
                    @endif
                    {{ $order->date }}
                </b>
            </div>
            <div class="review-header mb-2">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="option-title">Имя:</div>
                        <div class="option-text">{{ $order->name }}</div>
                    </div>
                    <div class="col-lg-4">
                        <div class="option-title">Телефон:</div>
                        <div class="option-text"> {{ $order->phone }} </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="option-title">Сумма:</div>
                        <div class="option-text"> {{ $order->total }} грн</div>
                    </div>
                    <div v-if="order.address" class="mb-2 col-lg-6">
                        <span class="option-title">Адрес:</span>
                        <span class="option-text"> {{ $order->address }} </span>
                    </div>
                    <div v-if="order.persons" class="mb-2 col-lg-6">
                        <span class="option-title">Персон:</span>
                        <span class="option-text"> {{ $order->persons }} </span>
                    </div>
                    @if($order->comment)
                        <div class="mb-2 col-12">
                            <span class="option-title"><b>Комментарий к заказу:</b></span>
                            <span class="option-text"> {{ $order->comment }} </span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="buttons mt-1 text-right">
                <a
                    :to="`/admin/orders/${order.id}`"
                    href="/dashboard/orders/{{$order->id}}"
                    class="btn btn-outline-danger btn-sm btn-delete"
                >
                    Детали
                </a>
                <div class=""></div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
