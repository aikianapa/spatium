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

                <ul class="navbar-nav w-100">
                    <wb-foreach wb="from=_parent.sitemenu&tpl=false">
                    <li class="nav-item" wb-if="'{{active}}'=='on'">
                        <a class="nav-link" href="{{link}}">{{label}}</a>
                    </li>
                    </wb-foreach>
                </ul>

</view>