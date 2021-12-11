<edit header="Меню сайта">
    <div class="alert alert-info">
        Смотри в /blocks/sitemenu.php
    </div>

    <div>
    <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    
    
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

<ul class="navbar-nav tx-bold tx-uppercase">
                    <li class="nav-item">
                        <a class="nav-link" href="/shop">Ежедневное меню</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="/desserts">
                            Полезные десерты
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="/catering">
                            Кейтеринг
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            Доставка
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            Контакты
                        </a></li>
</ul>

</view>