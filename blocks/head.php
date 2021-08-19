<edit header="Содержимое тэга head">
    <div class="alert alert-info">
        Смотри в /blocks/head.php
    </div>
</edit>
<view head>
  <meta charset="UTF-8" />
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Spatium Detox">
  <title>Spatium Detox</title>
  <!--script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script-->

  <link rel="preload" as="style" href="/assets/css/loader.scss" />
  <link rel="preload" as="style" href="/modules/yonger/tpl/assets/css/dashforge.min.css" />
  <link rel="preload" as="style" href="/assets/js/lightgallery/css/lightgallery.min.css" />
  <link rel="preload" as="style" href="/assets/css/custom.less" />
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;500;600;700&subset=latin,cyrillic" />

  <link rel="preload" as="script" href="/modules/yonger/tpl/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js" />
  <link rel="preload" as="script" href="/engine/lib/bootstrap/js/bootstrap.bundle.min.js" />
  <link rel="preload" as="script" href="/assets/js/lightgallery/js/lightgallery.min.js" />
  <link rel="preload" as="script" href="/assets/js/spatium.js" />

  <script src="/engine/js/wbapp.js"></script>
  <script type="wbapp" remove>
    wbapp.loadStyles([
     "/assets/css/loader.scss",
     "/modules/yonger/tpl/assets/css/dashforge.min.css",
     "/assets/js/lightgallery/css/lightgallery.min.css",
     "/assets/css/custom.less",
    ]);
    wbapp.loadScripts([
    "/modules/yonger/tpl/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js",
    "/engine/lib/bootstrap/js/bootstrap.bundle.min.js",
    "/assets/js/lightgallery/js/lightgallery.min.js",
    "/modules/yonger/tpl/assets/js/yonger.js",
    "/assets/js/spatium.js"
    ],'ready')
  </script>
</view>