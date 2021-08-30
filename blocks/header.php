<edit header="Верхняя часть сайта">
    <div class="alert alert-info">
        Смотри в /blocks/header.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
    <div class="divider-text">Меню сайта</div>
    <wb-multiinput name="sitemenu">
        <div class="col">
            <input class="form-control" type="text" name="label" placeholder="Пункт">
        </div>
        <div class="col">
            <input class="form-control" type="text" name="link" placeholder="Ссылка">
        </div>
        <div class="col-auto">
            <input type="checkbox" class="wd-20 ht-20 m-2" name="active" />
        </div>

    </wb-multiinput>

</edit>
<view>
  <loader class="fade out">
    <div class="loader">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>
    <p>Загрузка...</p>
  </loader>
  <link rel="stylesheet" href="/assets/css/loader.scss" />

    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow t-0 position-fixed w-100 z-index-10">
            <a class="navbar-brand" href="/">
                <img class="ht-30 w-auto filter-invert" data-src="/assets/img/logo.svg" alt="">
            </a>
            <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <img data-src="/module/myicons/menu-burger.svg?size=30&stroke=333333">
            </button>
            <div class="collapse navbar-collapse order-2" id="navbarNav">
                
                <ul class="navbar-nav tx-bold mx-auto">
                    <wb-foreach wb="from=sitemenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{link}}">{{label}}</a>
                    </li>
                    </wb-foreach>
                </ul>
                <div class="d-inline my-2 my-lg-0" id="headsign">
                    <div auto data-ajax="{'url':'/module/yonger/block/headsign','html':'#headsign'}"></div>
                </div>
            </div>
        </nav>
    </header>
</view>