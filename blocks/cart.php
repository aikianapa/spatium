<edit header="Корзина покупок">
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
    <div class="alert alert-info">
        Смотри в /blocks/cart.php
    </div>
</edit>
<view>
    <div>
        <div id="cart" class="off-canvas off-canvas-overlay off-canvas-right wd-300 wd-md-400 d-none">
            <div class="off-canvas-header tx-20 tx-success bd-0"><span>
                    <img src="/module/myicons/shopping-cart.svg?size=26&stroke=10b759" width="32" height="32"> Мои покупки</span>
                <a href="javascript:$('#cart').removeClass('show')" class="close cursor-pointer">
                    <img src="/module/myicons/32/323232/interface-essential-109.svg" width="40" height="40">
                </a>
            </div>
            <wb-var discounts="{{getDiscounts()}}" />
            <div class="off-canvas-body p-2">
                <div class="position-relative scroll-y" id="shopping-cart">
                    <div class="accordion">
                        <h6 class="cart">Покупки</h6>
                        <!-- cart floating box -->
                        <div class="cart-floating-box p-0" id="cart-floating-box">
                            <ul class="list-group cart-items" data-discounts="{{_var.discounts}}">
                                <wb-module wb="module=cart&list=header&sum=price*discounts[days].percent*qty*days">
                                    <li class="list-group-item bd-r-0 bd-l-0 d-flex px-1 align-items-center mod-cart-item">
                                        {{#if image == ""}}
                                            <img data-src="/module/myicons/asian-food.1.svg?size=50&stroke=EEEEEE" width="120" height="100" class="img-fluid wd-120 rounded mg-r-15" alt="{{name}}">
                                        {{else}}
                                            <img data-src="/thumbc/100x100/src/{{image}}" class="img-fluid wd-60 wd-md-80 rounded mg-r-15" width="100" height="100" alt="{{name}}">
                                        {{/if}}
                                        <a href="javascript:void(0)" class="position-absolute t-5 r-5 mod-cart-remove" data-id="{{id}}">
                                            <img src="/module/myicons/24/dc3545/interface-essential-107.svg" width="24" height="24" class="dd-remove bg-white rounded-circle">
                                        </a>
                                        <div>
                                            <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">
                                                {{name}}
                                            </h6>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Дней</label>
                                                    {{#if promo == "1"}}
                                                        <input name="days" type="text" value="{{days}}" class="form-control input-sm" readonly>
                                                    {{else}}
                                                        <div class="input-group">
                                                            <div class="input-group-prepend mod-cart-dec">
                                                                <span class="input-group-text">-</span>
                                                            </div>
                                                            <input name="days" type="text" value="{{days}}" class="form-control input-sm" readonly enum="1,3,7,14,30">

                                                            <div class="input-group-append mod-cart-inc">
                                                                <span class="input-group-text">+</span>
                                                            </div>
                                                        </div>
                                                    {{/if}}
                                                </div>
                                                <div class="col">
                                                    <label>Кол-во</label>
                                                    {{#if promo == "1"}}
                                                        <input name="qty" type="number" readonly value="{{qty}}" class="form-control input-sm">
                                                    {{else}}
                                                        <div class="input-group">
                                                            <div class="input-group-prepend mod-cart-dec">
                                                                <span class="input-group-text">-</span>
                                                            </div>
                                                            <input name="qty" type="number" readonly value="{{qty}}" class="form-control input-sm">

                                                            <div class="input-group-append mod-cart-inc">
                                                                <span class="input-group-text">+</span>
                                                            </div>
                                                        </div>
                                                    {{/if}}
                                                </div>
                                            </div>
                                            <p class="price py-1 m-0 tx-center tx-semibold tx-primary mod-cart-item-sum">
                                                {{days}}дн x {{qty}}шт = {{sum}}₽
                                            </p>
                                        </div>
                                    </li>
                                </wb-module>
                            </ul>
                            <div class="d-block p-3">
                                <button type="button" class="btn btn-outline-warning btn-block mod-cart-clear rounded-20">Очистить корзину</button>
                                <button type="button" class="btn btn-outline-success btn-block cart-payment rounded-20" onclick='$("#cart h6.delivery").trigger("click");'>Перейти к оплате</button>
                            </div>
                            <p class="tx-16 tx-semibold py-3 m-0 tx-center">
                                Итого: <span class="mod-cart-total-sum tx-primary"></span><span class="tx-primary">₽</span></p>
                        </div>
                        <!-- end of cart floating box -->
                        <h6 class="delivery">Доставка и оплата</h6>
                        <div class="p-2" id="cartdev">
                            <div auto data-ajax="{'url':'/module/yonger/block/cartdev','html':'#cartdev'}"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <wb-module wb="module=cart"></wb-module>
        <div class="backdrop"></div>
    </div>
</view>