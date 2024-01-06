@extends('layout.main')


@section('title'){{ $page->title }}@endsection
@section('description'){{ $page->description }}@endsection

@section('banner')

@section('content')

    <div class="mb200">
        <loading v-if="isLoading" />
        <template v-if="items.length">
            <div class="shell">
                <h2 class="text-center" style="margin-bottom: 50px;">
                    {{--                TODO--}}
                    $t('static.yourOrder')
                </h2>
                <div class="cartItems">
                    <div
                        v-for="item in items"
                        class="cartItem"
                        :key="item.id"
                    >
            <span class="itemTitle" style="">
              <template v-if="item.titleMain !== item.title">item.titleMain</template>
{{--                TODO--}}
{{--                {{item.title}} {{item.weight}}{{item.weightKind}}--}}
            </span>
                        <div class="amountBlock">
                            <font-awesome-icon
                                @click="decrementItem(item)"
                                :icon="['fas', 'minus-circle']"
                                class="icons"
                            />
                            <span class="amount">{{item.amount}}</span>
                            <font-awesome-icon
                                @click="incrementItem(item)"
                                :icon="['fas', 'plus-circle']"
                                class="icons"
                            />
                            <span class="price">{{(item.price  * item.amount).toFixed(2)}} грн</span>
                            <font-awesome-icon
                                @click="removeItem(item)"
                                :icon="['fas', 'trash']"
                                class="icons trashIcon"
                            />
                        </div>
                    </div>
                    <div class="cartSum">
                        {{$t('static.orderSum')}} <span>{{ totalSum ? totalSum.toFixed(2) : 0.00}}</span> грн
                    </div>
                </div>
                <div
                    @click="showDesignOrder()"
                    class="designCart"
                >
                    {{$t('static.toDesignOrder')}}
                </div>
            </div>
            <template v-if="showDesignOrderBlock">
                <form class="shell"  @submit.prevent>
                    <div class="range cartForm">
                        <div class="cell-sm-12 cell-md-4">
                            <label for="" class="text-left">
                                {{$t('static.orderName')}}
                            </label>
                            <input
                                required
                                v-model="formData.name"
                                type="text"
                                class="form-control"
                            >
                        </div>
                        <div class="cell-sm-12 cell-md-4">
                            <label for="" class="text-left">
                                {{$t('static.orderPhone')}}
                            </label>
                            <input
                                v-model="formData.phone"
                                maxlength="13"
                                minlength="13"
                                type="text"
                                class="form-control"
                            >
                        </div>
                        <div class="cell-sm-12 cell-md-6">
                            <label for="" class="text-left">
                                {{$t('static.orderAddress')}}
                            </label>
                            <input
                                required
                                v-model="formData.address"
                                type="text"
                                class="form-control"
                            >
                        </div>
                        <div class="cell-sm-12 cell-md-2">
                            <label for="" class="text-left">
                                {{$t('static.orderPersons')}}
                            </label>
                            <input
                                v-model="formData.persons"
                                type="number"
                                class="form-control"
                            >
                        </div>
                        <div class="cell-sm-12 cell-md-8">
                            <label for="" class="text-left">
                                {{$t('static.orderComment')}}
                            </label>
                            <textarea name="" id="" cols="30" rows="10"
                                      v-model="formData.comment"
                                      class="form-control"
                            ></textarea>
                        </div>
                    </div>
                    <div class="range cartForm">
                        <button
                            type="submit"
                            @click="checkout()"
                            class="designCart designCartCheckout"
                        >
                            {{$t('static.orderNow')}}
                        </button>
                    </div>
                </form>
            </template>
        </template>
        <template  v-if="noItems">
            <div class="range" style="margin-top: 50px; margin-bottom: 50px; flex-direction: column;">
                <h2 class="text-center" style="margin: 0 auto 50px;">
                    {{$t('static.orderEpmty')}}
                </h2>
                <div>
                    <nuxt-link
                        :to="localePath('menu')"
                        class="text-center"
                        style="font-size: 30px; margin-top: 10px; display: block;"
                    >
                        {{$t('static.toMenu')}}
                    </nuxt-link>
                </div>
            </div>
        </template>
        <template v-if="orderDone">
            <div class="range" style="margin-top: 50px; margin-bottom: 50px;">
                <h2 class="text-center" style="margin: 0 auto 50px;">
                    {{$t('static.orderGet')}}
                </h2>
            </div>
        </template>
    </div>

@endsection
