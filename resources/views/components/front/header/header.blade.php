    <header class="page-head section-top-15 section-lg-top-0">
        <!-- RD Navbar-->
        <div
            class="rd-navbar-wrap rd-navbar-variant-1"
        >
            <nav class="rd-navbar rd-navbar-original "
                 data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-layout="rd-navbar-fullwidth"
                 data-lg-layout="rd-navbar-fullwidth" data-device-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed"
                 data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fullwidth" data-lg-stick-up-offset="207px">



                <button
                    data-rd-navbar-toggle=".rd-navbar-top-panel" type="submit" class="rd-navbar-collapse-toggle"><span></span></button>
                <div
                    ref="subMenuHolder"
                    class="rd-navbar-top-panel toggle-original-elements">
                    <div class="rd-navbar-top-panel-inner">
                        <div class="rd-navbar-address">
                            <div class="unit unit-horizontal unit-spacing-xs">
                                <div class="unit-left"><span class="icon icon-xxs mdi mdi-map-marker"></span></div>
                                <div class="unit-body"><a href="#" class="text-base">{{ $translates['address']}}</a></div>

                                <div class="unit-left">
                                    <a target="_blank" style="padding-left: 2em;" href="https://www.facebook.com/krabisushicafe/">
                                        <span class="icon icon-sm mdi mdi-facebook"></span>
                                    </a>
                                    <a target="_blank" style="padding-left: 2em;" href="https://www.instagram.com/krabicafe/">
                                        <span class="icon icon-sm mdi mdi-instagram"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="rd-navbar-address">
                            <div class="unit unit-horizontal unit-spacing-xs">
                                <div class="unit-left"><span class="icon icon-xxs mdi mdi-phone"></span></div>
                                <div class="unit-body">
                                    <a
                                        href="tel:{{ $translates['phone1full']}}"
                                        class="text-base"
                                        style="display: block; margin-bottom: 5px;"
                                    >
                                        {{ $translates['phone1']}}
                                    </a>
                                    <a
                                        href="tel:{{ $translates['phone2full']}}"
                                        class="text-base"

                                    >
                                        {{ $translates['phone2']}}
                                    </a>
                                </div>
                            </div>
                            <div class="unit unit-horizontal unit-spacing-xs">
                                <div class="unit-left"><span class="icon icon-xxs mdi mdi-clock"></span></div>
                                <div class="unit-body">
                                    <time datetime="2016">{{ $translates['workHours']}}</time>
                                    <div class="localesHolder">
                                        <div>
                                            <a href="{{ LaravelLocalization::getLocalizedURL('ru') }}">RU</a>
                                            <a href="{{ LaravelLocalization::getLocalizedURL('ua') }}">UA</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rd-navbar-main-panel">
                    <div class="rd-navbar-inner">
                        <!-- RD Navbar Panel-->
                        <div class="rd-navbar-panel">
                            <!-- RD Navbar Toggle-->
                            <button
                                data-rd-navbar-toggle=".rd-navbar-nav-wrap" type="submit" class="rd-navbar-toggle toggle-original"><span></span></button>
                            <!-- Little logo-->
                            <a
                                href="{{ LaravelLocalization::localizeUrl('/') }}"
                                class="little-logo"
                            >
							<span>
								<img src="/images/logo-mini.png">
							</span>
                            </a>

                            <!-- RD Navbar Brand-->
                            <div class="rd-navbar-brand">

                                <a
                                    href="{{ LaravelLocalization::localizeUrl('/') }}"
                                    class="brand-name"
                                >
                                    <span title="Кафе Краби, кафе krabi, суши краби, sushi krabi" alt="Кафе Краби, кафе krabi, суши краби, sushi krabi" >Sushi Krabi</span>
                                    <span>Thai & Japanese Cafe</span>
                                    <div class="rd-navbar-address"></div>
                                </a>
                                <!-- <router-link
                                    :to="{ path: '/' }"
                                    class="brand-name"
                                >
                                </router-link> -->
                                <!-- <a href="/" class="brand-name"></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="rd-navbar-nav-inner justify-around display-flex align-center">
                        <div
                            ref="menuHolder"
                            class="rd-navbar-nav-wrap">
                            <!-- RD Navbar Nav-->
                            <ul class="rd-navbar-nav">

                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/menyu') }}"
                                    >
                                        {{ $navigation['menu']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/kontseptsiya') }}"
                                    >
                                        {{ $navigation['concept']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/interer') }}"
                                    >
                                        {{ $navigation['interior']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/dostavka') }}"
                                    >
                                        {{ $navigation['delivery']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/novosti') }}"
                                    >
                                        {{ $navigation['news']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/aktsii') }}"
                                    >
                                        {{ $navigation['sale']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/galereya') }}"
                                    >
                                        {{ $navigation['gallery']}}
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ LaravelLocalization::localizeUrl('/kontakty') }}"
                                    >
                                        {{ $navigation['contacts']}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>



<style>
    .localesHolder {
        margin-top: 10px;
        text-align: revert;
        display: flex;
        justify-content: flex-end;
        gap: 6px;
    }
    .localesHolder a + a {
        margin-left: 30px;
    }
</style>
