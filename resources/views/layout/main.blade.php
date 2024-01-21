
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//RU">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon-16x16.png')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

    <title>@yield('title') | Krabi - Thai & Japanese | Кафе Крабі - тайська и японська кухні в Одесі. Доставка суші, WOK</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="кафе краби, cafe krabi, суши, суши краби, sushi krabi">


    <link rel="stylesheet" href="{{asset('/css/style.css')}}" type="text/css">
    <!-- <script type="text/javascript" src="/jscript.js"></script-->
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->

    <style>
        /* these styles are for the demo, but are not required for the plugin */
        .zoom {
            display:inline-block;
            position: relative;
        }

        /* magnifying glass icon */
        .zoom:after {
            content:'';
            display:block;
            width:33px;
            height:33px;
            position:absolute;
            top:0;
            right:0;
            background:url(icon.png);
        }

        .zoom img {
            display: block;
        }
        .menudiv {margin-bottom:30px;}
        .zoom img::selection { background-color: transparent; }

        #ex2 img:hover { cursor: url(grab.cur), default; }
        #ex2 img:active { cursor: url(grabbed.cur), default; }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139426372-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-139426372-1');
    </script>


</head>


<body>
<!-- Page-->
<div class="page text-center">
    <!-- Page Header-->

    @include('components.front.header.header')
    @include('components.front.header.include.cartBlock')



    @yield('banner')


    <main>
        @yield('content')
    </main>








    <div style="clear: both;"></div>


    @include('components.front.footer.footer')

</div>

<!-- Global Mailform Output-->
<div id="form-output-global" class="snackbars"></div>
<!-- PhotoSwipe Gallery-->
<div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
                <button title="Share" class="pswp__button pswp__button--share"></button>
                <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
                <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
            <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__cent"></div>
            </div>
        </div>
    </div>
</div>
<!-- Java script-->
<script type="text/javascript" src="{{asset('/js/core.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/shop.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#phone").inputmask({"mask": "+38 (999) 999-99-99"});
    });
</script>

<script defer src="{{asset('/js/jquery.zoom.js')}}"></script>

<script>
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;

    $(document).ready(function(){
        if(!isMobile) {
            $('#ex001').zoom();
            $('#ex002').zoom();
            $('#ex1').zoom();
            $('#ex2').zoom();
            $('#ex3').zoom();
            $('#ex4').zoom();
            $('#ex5').zoom();
            $('#ex6').zoom();
            $('#ex7').zoom();
            $('#ex8').zoom();
            $('#ex9').zoom();
            $('#ex10').zoom();
            $('#ex11').zoom();
            $('#ex12').zoom();
            $('#ex13').zoom();
            $('#ex14').zoom();
            $('#ex15').zoom();
            $('#ex16').zoom();
            $('#ex17').zoom();
            $('#ex18').zoom();
            $('#ex19').zoom();
            $('#ex20').zoom();
            $('#ex21').zoom();
            $('#ex22').zoom();
            $('#ex23').zoom();
            $('#ex24').zoom();
            $('#ex25').zoom();
            $('#ex26').zoom();
            $('#ex27').zoom();
            $('#ex28').zoom();
            $('#ex29').zoom();
        }
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        let isUa = window.location.href.includes('/ua/')
        let visited = $.cookie("visited")
        if(!isUa){
            if (!visited) {
                $.cookie('visited', '1', { expires: 365, path: '/' });
                window.location.href = '/ua'
            }
        }
    });
</script>

</div>
</body>
</html>
