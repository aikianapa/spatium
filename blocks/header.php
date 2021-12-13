<edit header="Верхняя часть сайта">
    <div class="alert alert-info">
        Смотри в /blocks/header.php
    </div>
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
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
    <wb-include wb-tpl="loader.php" />
    <header>
        <nav class="navbar navbar-expand-md bg-white shadow t-0 position-fixed w-100 z-index-10">
            <a class="navbar-brand" href="/">
                <img class="ht-30 w-auto filter-invert" data-src="/assets/img/logo.svg" width="47" height="30" alt="">
            </a>
            <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <img data-src="/module/myicons/menu-burger.svg?size=30&stroke=333333"  width="30" height="30">
            </button>
            <div class="collapse navbar-collapse order-2" id="navbarNav">
                <div class="d-inline  mx-auto my-2 my-lg-0"><wb-module wb="module=yonger&mode=render&view=sitemenu" /></div>
                <div class="d-inline my-2 my-lg-0" id="headsign">
                    <div auto data-ajax="{'url':'/module/yonger/block/headsign','html':'#headsign'}"></div>
                </div>
            </div>
        </nav>
    </header>
</view>