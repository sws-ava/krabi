
<div>
    <a href="/dashboard" class="logo-holder" style="display: block">
        <img src="{{asset('/logo.png')}}" alt="">
    </a>
    Меню
    <nav class="nav flex-column">
        <a
            href="/dashboard/orders"
            class="nav-link"
        >
            Заказы
            <?php
            $count = App\Models\Admin\Order::where('status', 1)->count();
            ?>
            @if($count)
                <span>
                    {{ $count }}
                </span>
            @endif
        </a>
        <!-- <router-link
				:to="{name: 'admin-reviews'}"
				class="nav-link"
			>
				Отзывы
				<span v-if="countUnreadedReviews">
{{--					{{countUnreadedReviews}}--}}
        </span>
    </router-link> -->
        <a
            href="/dashboard/menu"
            class="nav-link"
        >
            Меню
        </a>
        <!-- <router-link
				:to="{name: 'admin-feedback'}"
				class="nav-link"
			>
				Обратная связь

				<span v-if="countUnreadedFeedbacks">
{{--					{{countUnreadedFeedbacks}}--}}
        </span>
    </router-link> -->
        <a
            href="/dashboard/pages"
            class="nav-link"
        >
            Страницы
        </a>
        <a
            href="/dashboard/gallery"
            class="nav-link"
        >
            Галерея
        </a>
        <a
            href="/dashboard/interior"
            class="nav-link"
        >
            Интерьер
        </a>

{{--        <a--}}
{{--            href="/dashboard/news"--}}
{{--            :to="{name: 'admin-news'}"--}}
{{--            class="nav-link"--}}
{{--        >--}}
{{--            Новости / Акции--}}
{{--        </a>--}}
        <a
            href="/dashboard/blocks"
            class="nav-link"
        >
            Блоки
        </a>
        <a
            href="/dashboard/images"
            class="nav-link"
        >
            Картинки
        </a>
        <a
            href="/dashboard/paper"
            class="nav-link"
        >
            Фото меню
        </a>
    </nav>
</div>

<style>
    .nav-link {
        display: flex;
        align-items: center;
    }
    .nav-link span {
        margin-left: 5px;
        color: #fff;
        background: red;
        font-size: 12px;
        height: 20px;
        width: 20px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        padding: 5px;
        display: inline-block;
        padding: 5px;
        border-radius: 50%;
    }
    .nav-link .order-in-progress {
        background: blue;
    }

</style>
