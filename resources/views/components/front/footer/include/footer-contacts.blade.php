
<section class="section-top-50 section-sm-top-70 text-center text-sm-left">
    <div class="shell">
        <h3 class="text-center">
            {{--                                    TODO--}}
{{--            {{$t('contacts.title')}}--}}
            {{ $navigation['contacts']}}
        </h3>
        <div class="range range-xs-center offset-top-34">
            <div class="cell-sm-6">
                <div class="range">
                    <div class="cell-sm-12 text-center text-sm-left offset-top-110">
                        <div class="unit unit-sm-horizontal unit-spacing-xs unit-sm-bottom">
                            <div class="unit-left min-width-sm"><span class="h6 text-regular">
                                    {{ $translates['addressName']}}:
								</span></div>
                            <div class="unit-body"><a href="#" class="text-base">
                                    {{ $translates['address']}}
                                </a>
                            </div>
                            <div class="unit-body">
                                <a
                                    v-html="$t('static.address')"
                                    href="#"
                                    class="text-base">

                                </a></div>
                        </div>
                        <div class="unit unit-sm-horizontal unit-spacing-xs unit-sm-bottom offset-top-12">
                            <div class="unit-left min-width-sm"><span class="h6 text-regular">
                                    {{ $translates['phones']}}:
                                </span></div>
                            <div class="unit-body">
                                <a
                                    href="tel:{{ $translates['phone1full']}}"
                                    class="text-base"
                                >
                                    {{ $translates['phone1']}}

                                </a>,
                                <a
                                    href="tel:{{ $translates['phone2full']}}"
                                    class="text-base"
                                >
                                    {{ $translates['phone2']}}

                                </a>
                            </div>
                        </div>
                        <div class="unit unit-sm-horizontal unit-spacing-xs unit-sm-bottom offset-top-12">
                            <div class="unit-left min-width-sm"><span class="h6 text-regular">E-mail:</span></div>
                            <div class="unit-body">
                                {{ $translates['email']}}
                            </div>
                        </div>
                        <div class="unit unit-sm-horizontal unit-spacing-xs unit-sm-bottom offset-top-12">
                            <div class="unit-left min-width-sm"><span class="h6 text-regular">
                                    {{ $translates['opened']}}:
                                </span></div>
                            <div class="unit-body">
                                {{ $translates['workHours']}}
                            </div>
                        </div>
                        <div class="unit unit-sm-horizontal unit-spacing-xs unit-sm-bottom offset-top-12">
                            <div class="unit-left min-width-sm"><span class="h6 text-regular">
                                {{ $translates['socs']}}:
                                </span></div>
                            <div class="unit-body">
                                <a target="_blank" style="padding-left: 2em;" href="https://www.facebook.com/krabisushicafe/">
                                    <span class="icon icon-sm mdi mdi-facebook"></span>
                                </a>
                                <a target="_blank" style="padding-left: 2em;" href="https://www.instagram.com/krabicafe/">
                                    <span class="icon icon-sm mdi mdi-instagram"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell-sm-6">
                <div class="img-wrap-1"><img src="{{asset('/images/cont.jpg')}}">
                </div>
            </div>
            <div class="cell-xs-12 offset-top-42">
                <hr class="hr-sealine-gray">
            </div>
        </div>
    </div>
</section>
