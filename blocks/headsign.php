<edit header="Верхняя часть - кнопки входа и корзины">
    <div class="alert alert-info">
        Смотри в /blocks/headsign.php
    </div>
</edit>
<view>
                    <a href="javascript:$('#cart').addClass('show');" class="my-2 my-sm-0">
                    <img data-src="/module/myicons/shopping-cart.svg?size=26&stroke=10b759" alt="Мои покупки">
                    </a>

                    <a href="/signin" class="btn btn-outline-success rounded-20 my-2 my-sm-0" wb-if="'{{_sett.user.id}}'==''">Вход</a>
                    <a href="/cabinet" class="btn btn-outline-success rounded-20 my-2 my-sm-0" wb-if="'{{_sett.user.role}}'=='user'">Кабинет</a>
                    <a href="/workspace" class="btn btn-outline-success rounded-20 my-2 my-sm-0" wb-if="'{{_sett.user.role}}'=='admin'">Кабинет</a>
                    <a href="/workspace" class="btn btn-outline-success rounded-20 my-2 my-sm-0" wb-if="'{{_sett.user.role}}'=='manager'">Кабинет</a>
</view>