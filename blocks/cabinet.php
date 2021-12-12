<edit header="Корзина покупок">
    <div><wb-module wb="module=yonger&mode=edit&block=common.inc" /></div>
    <div class="alert alert-info">
        Смотри в /tpl/cabinet.php
    </div>
</edit>

<view>
    <wb-include wb-tpl="cabinet.php" wb-if="'{{_sess.user.role}}'=='user'"></wb-include>
    <div class="container mg-t-150 mg-b-80" wb-if="'{{_sess.user.role}}'!=='user'">
    <div class="alert alert-info" role="alert">
        Личный кабинет доступен только зарегистрированным пользователям.
    </div>
    </div>
</view>