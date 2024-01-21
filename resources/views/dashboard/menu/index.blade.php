@extends('layout.dashboard')

@section('content')

    <div>
        <h5 class="mb-3">Меню</h5>
        <spinner v-if="$store.state.adminMenuItems.showSpinner"></spinner>
        <spinner v-if="showSpinner"></spinner>
        <div class="menu-top-row">
            <div class="menu-top-row__left">
                <a href="{{ route('goods.create') }}">
                    Добавить блюдо
                </a>
            </div>
            <div>
                <a href="{{route('category.index')}}">
                    Категории меню
                </a>
            </div>
        </div>
        <h5 class="mb-1" style="margin-top: 50px">Блюда по категориям</h5>
        <div class="row seacrh-block">
            <div class="form-group col-md-12 mt-4">
                @foreach($cats as $cat)
				<a href="{{route('category.show', $cat->id)}}" class="categoryBtn">
						<span
                            :style="!cat.show ? 'color: red' : ''"
                        >
							{{$cat->title_ru}}
						</span>
				</a>
                @endforeach
            </div>
        </div>


{{--        <table class="table">--}}
{{--            <tbody>--}}
{{--            <tr v-for="(item, index) in $store.state.adminMenuItems.menuItems" :key="item.id">--}}
{{--                <th scope="row">{{ item.id }}</th>--}}
{{--                <td class="w-100">--}}
{{--                    {{item.title_ru}}--}}
{{--                    <div class="subItemsHolder mt-2">--}}
{{--                        <div  v-for="subItem in item.items" :key="subItem.id" class="subItemsHolderFlex">--}}
{{--                            <div class="price-holder mb-1">--}}
{{--                                <small class="form-text text-muted w-100show: 1, ">--}}
{{--                                    {{subItem.title_ru}} {{subItem.weight}} {{subItem.weightKind}}--}}
{{--                                </small>--}}
{{--                                <div class="subItemHandler">--}}
{{--                                    <input--}}
{{--                                        disabled="disabled"--}}
{{--                                        @change="changePriceHandler($event)"--}}
{{--                                        :value="subItem.price"--}}
{{--                                        type="text"--}}
{{--                                        class="w-100 form-control priceInput"--}}
{{--                                    >--}}
{{--                                    <div--}}
{{--                                        @click="changePriceActive($event)"--}}
{{--                                        class="editPrice"--}}
{{--                                    >--}}
{{--                                        <font-awesome-icon--}}
{{--                                            :icon="['fas', 'edit']"--}}
{{--                                            style="width:13px; height: 13px"--}}
{{--                                            class="fa-icon"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div--}}
{{--                                        @click="changePriceFetch(subItem)"--}}
{{--                                        class="done"--}}
{{--                                    >--}}
{{--                                        <font-awesome-icon--}}
{{--                                            :icon="['fas', 'check']"--}}
{{--                                            style="width:13px; height: 13px"--}}
{{--                                            class="fa-icon"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="ml-2">--}}
{{--                                        <div--}}
{{--                                            @click="showSubItem(subItem)"--}}
{{--                                            v-if="!subItem.show"--}}
{{--                                            class="btn btn-outline-secondary btn-sm"--}}
{{--                                            style="color:green"--}}
{{--                                        >--}}

{{--                                            <font-awesome-icon--}}
{{--                                                :icon="['fas', 'eye']"--}}
{{--                                                style="width:13px; height: 13px"--}}
{{--                                                class="fa-icon"--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                        <div--}}
{{--                                            @click="showSubItem(subItem)"--}}
{{--                                            v-else--}}
{{--                                            class="btn btn-outline-secondary btn-sm"--}}
{{--                                            style="color:red"--}}
{{--                                        >--}}
{{--                                            <font-awesome-icon--}}
{{--                                                :icon="['fas', 'eye-slash']"--}}
{{--                                                style="width:13px; height: 13px"--}}
{{--                                                class="fa-icon"--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--                <td class="btns-holder">--}}
{{--                    <div class="d-flex justify-content-between mb-2" style="gap:10px;">--}}
{{--                        <router-link--}}
{{--                            :to="'/admin/menu/'+item.id"--}}
{{--                            class="btn btn-outline-primary btn-sm"--}}
{{--                        >--}}
{{--                            Ред--}}
{{--                        </router-link>--}}
{{--                        <div--}}
{{--                            @click="showItem(item)"--}}
{{--                            v-if="item.show"--}}
{{--                            class="btn btn-outline-secondary btn-sm"--}}
{{--                        >--}}
{{--                            Скрыть--}}
{{--                        </div>--}}
{{--                        <div--}}
{{--                            @click="showItem(item)"--}}
{{--                            v-else--}}
{{--                            class="btn btn-outline-secondary btn-sm"--}}
{{--                        >--}}
{{--                            Показать--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="upDownHolder">--}}
{{--							<span--}}
{{--                                v-if="index !== $store.state.adminMenuItems.menuItems.length - 1"--}}
{{--                                @click="orderBottom(item)"--}}
{{--                                class="fa-icon-holder mr-2 ml-2"--}}
{{--                            >--}}
{{--								<font-awesome-icon--}}
{{--                                    :icon="['fas', 'arrow-down']"--}}
{{--                                    style="width:16px; height: 16px"--}}
{{--                                    class="fa-icon"--}}
{{--                                />--}}
{{--							</span>--}}
{{--                        <span--}}
{{--                            v-if="index !== 0"--}}
{{--                            @click="orderTop(item)"--}}
{{--                            class="fa-icon-holder ml-2 mr-2"--}}
{{--                        >--}}
{{--								<font-awesome-icon--}}
{{--                                    :icon="['fas', 'arrow-up']"--}}
{{--                                    style="width:16px; height: 16px"--}}
{{--                                    class="fa-icon"--}}
{{--                                />--}}
{{--							</span>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}

{{--            </tbody>--}}
{{--        </table>--}}

    </div>

    <style>
        .menu-top-row {
            display: flex;
            justify-content: space-between;
        }
        .menu-top-row__left a {
            margin-right: 20px;
        }
        .categoryBtn {
            margin-right: 20px;
        }
        .btns-holder {
            white-space: nowrap;
            text-align: right;
        }
        .price-holder {
            position: relative;
            width: 170px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
        }
        .price-holder + .price-holder {
            margin-top: 10px;
        }
        .price-holder input {
            margin-left: 5px;
            min-width: 90px;
        }
        .nowrap {
            white-space: nowrap;
        }
        .categoryBtn {
            cursor: pointer;
            display: inline-block;
        }
        .categoryBtn:hover {
            text-decoration: underline;
        }
        .categoryBtn + .categoryBtn {
            margin-bottom: 10px;
        }
        .subItemsHolder {
            max-width: 80%;
            margin-left: auto;
        }
        .subItemHandler {
            display: flex;
            align-items: center;
            width: 180px;
            min-width: 180px;
            max-width: 180px;
        }
        .done {
            display: none;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            background: green;
            border-radius: 50%;
            padding: 13px;
            margin-left: 5px;
            cursor: pointer;
        }
        .done svg {
            color: #fff;
        }
        .editPrice {
            display: none;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            background: lightblue;
            border-radius: 50%;
            padding: 13px;
            margin-left: 5px;
            cursor: pointer;
        }
        .editPrice svg {
            color: #000;
        }
        .subItemHandler .done {
            display: none;
        }
        .subItemHandler .editPrice {
            display: flex;
        }
        .subItemHandler.priceRowFocus .done {
            display: flex;
        }
        .subItemHandler.priceRowFocus .editPrice {
            display: none;
        }
        .subItemsHolderFlex {
            display: flex;
            align-items: center;
        }
        .saveOrderButton {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: green;
            color: #fff;
            padding: 10px 20px;
            cursor: pointer;
            transition: opacity 0.25s ease-in-out;
        }
        .saveOrderButton:hover {
            opacity: 0.7;
        }
        .orderNum {
            width: 50px;
            margin-right: 50px;
        }
        .upDownHolder {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .upDownHolder span {
            cursor: pointer;
            padding: 0 10px;
        }

    </style>
@endsection
