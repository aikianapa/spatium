<edit header="Содержимое тэга head">
    <div class="alert alert-info">
        Смотри в /blocks/head.php
    </div>
</edit>
<view head>

    <head>
        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Spatium Detox">
        <title></title>
        <!--script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script-->
        <link rel="preload" href="/engine/lib/fonts/roboto/roboto.css" as="style"/>

        <link rel="stylesheet" href="/engine/modules/yonger/tpl/assets/css/dashforge.css" />
        <link rel="stylesheet" href="/engine/modules/datetimepicker/datetimepicker/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="/engine/modules/datetimepicker/datetimepicker.less" />
        <link rel="stylesheet" href="/assets/css/animate.css" />
        <link rel="stylesheet" href="/assets/css/custom.less" />

        <link rel="preload" as="script" href="/engine/lib/bootstrap/js/bootstrap.bundle.min.js" />
        <link rel="preload" as="script" href="/engine/modules/yonger/tpl/assets/js/dashforge.js" />
        <link rel="preload" as="script" href="/engine/modules/yonger/tpl/assets/js/yonger.js" />
        <link rel="preload" as="script" href="/assets/js/jquery.appear.js" />
        <link rel="preload" as="script" href="/assets/js/spatium.js" />


        <script src="/engine/js/wbapp.js"></script>
        <script type="wbapp" remove>
          setTimeout(function(){
            wbapp.loadStyles(["/engine/lib/fonts/roboto/roboto.css"]);
            wbapp.loadScripts([
                  "/engine/lib/bootstrap/js/bootstrap.bundle.min.js",
                  "/engine/modules/yonger/tpl/assets/js/dashforge.js",
                  "/engine/modules/yonger/tpl/assets/js/yonger.js",
                  "/assets/js/jquery.appear.js",
                  "/assets/js/counters.js",
                  "/assets/js/spatium.js"
            ],'ready')
          },1500);

  </script>
        <!-- Yandex.Metrika counter -->
        <noscript wb-if="'{{_route.domain}}'!=='spatium.loc'">
            <div><img src="https://mc.yandex.ru/watch/86835257" style="position:absolute; left:-9999px;" alt="" /></div>
        </noscript>
        <!-- Facebook Pixel Code -->
        <noscript wb-if="'{{_route.domain}}'!=='spatium.loc'">
            <img height="1" width="1" src="https://www.facebook.com/tr?id=590247188715538&ev=PageView&noscript=1" />
        </noscript>
    </head>
</view>