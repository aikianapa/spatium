<edit header="Форма доставки">
    <div><wb-module wb="module=yonger&mode=edit&block=common.inc" /></div>
    <div class="alert alert-info">
        Смотри в /blocks/cartdev.php
    </div>
</edit>
<view>

    <div wb-if="'{{_sess.user.id}}' == ''" id="cartLogin">
        <p class="alert alert-info">Чтобы продолжить оформление заказа,
            введите свой номер телефона
        </p>

        <div class="input-group mb-2">
                        <div class="col-3 p-0 input-group-prepend">
                            <span class="wd-100p input-group-text">Телефон</span>
                        </div>
                        <input class="form-control checkphone" type="phone" wb-mask="+7 (999) 999-99-99" placeholder="Телефон" value="">
                        <div class="p-0 input-group-append">
                            <span class="input-group-text p-0 cursor-pointer" onclick="cartCheckPhone();">
                            <img class="mx-1" data-src="/module/myicons/arrow-right-circle.1.svg?size=30&stroke=10b759"  width="30" height="30">
                            </span>
                        </div>
                    </div>
        <div class="input-group mb-2 checkcode d-none">
            <div class="col-3 p-0 input-group-prepend">
                <span class="wd-100p input-group-text">Код из SMS</span>
            </div>
            <input type="hidden" class="token">
            <input class="form-control checkcode" type="text" wb-mask="999-999" 
                placeholder="Проверочный код">
                <div class="p-0 input-group-append">
                            <span class="input-group-text p-0 cursor-pointer" onclick="cartLogin();">
                            <img class="mx-1" data-src="/module/myicons/login-enter-arrow-right-circle.svg?size=30&stroke=10b759" width="30" height="30">
                            </span>
                </div>

            </div>
    </div>
    <wb-var class="d-block" wb-if="'{{_sess.user.id}}' > ''" else="d-none" />
    <form action="#" id="Details" class="{{_var.class}}">
        <input type="hidden" name="id" value="{{_sess.user.id}}">
        <wb-data wb="table=users&item={{_sess.user.id}}">
            <div class="row">
                <div class="col-12 mb-2">

                    <div class="input-group mb-2">
                        <div class="col-4 p-0 input-group-prepend">
                            <span class="wd-100p input-group-text">Имя</span>
                        </div>
                        <input class="form-control" name="first_name" readonly placeholder="Имя">
                    </div>


                    <div class="input-group mb-2">
                        <div class="col-4 p-0 input-group-prepend">
                            <span class="wd-100p input-group-text">Фамилия</span>
                        </div>
                        <input class="form-control" name="last_name" readonly placeholder="Фамилия">
                    </div>

                    <div class="input-group mb-2">
                        <div class="col-4 p-0 input-group-prepend">
                            <span class="wd-100p input-group-text">Телефон</span>
                        </div>
                        <input class="form-control" type="phone" readonly wb-mask="+9 (999) 999-99-99" name="phone"
                            placeholder="Телефон">
                    </div>

                    <div class="input-group mb-2">
                        <div class="col-4 p-0 input-group-prepend">
                            <span class="wd-100p input-group-text">Адрес доставки</span>
                        </div>
                        <textarea class="form-control" type="text" readonly name="delivery_address" class="form-control"
                            rows="auto" placeholder="Адрес доставки"></textarea>
                    </div>
                    <p class="tx-12 py-1 mb-1 tx-secondary">Изменить адрес доставки вы можете в
                        <a href="/cabinet#address">личном кабинете</a>
                    </p>


                    <div class="input-group mb-2">
                        <div class="col-4 p-0 input-group-prepend">
                            <span class="wd-100p input-group-text">
                                <span class="d-flex">Доставка с</span>
                            </span>
                        </div>
                        <input class="form-control" type="datepicker" data-date-start="+1day" data-date-end="+30day"
                            wb="module=datetimepicker" name="date" placeholder="Дата первой доставки"
                            value='{{ date("Y-m-d",strtotime("+24hours")) }}'>
                    </div>

                    <div class="col-12 px-0 my-2">
                        <div class="cross-delivery d-none alert alert-warning">
                            <p>
                                Доставка заказа пересекается с более ранними заказами. Если вы
                                не
                                желаете
                                объединить доставки, выберите другую дату доставки:
                                <span class='cursor-pointer' style="text-decoration:underline;">&nbsp;</span>.
                            </p>
                            <ul>
                                <wb-foreach wb="bind=tmp.crossdelivery&render=client">
                                    <li>Заказ № {{number}} от {{date}} - {{expired}}</li>
                                </wb-foreach>
                            </ul>
                        </div>
                    </div>

                    <wb-var wb-if="'{{first_name}}'=='' OR '{{last_name}}'=='' OR '{{delivery_address}}'=='' "
                        reg="false" else="true" />
                </div>
        </wb-data>


        <div class="col-12">
            <h4>Калькуляция</h4>
            <p>Продукция <span>
                    <ee class="d-inline mod-cart-total-sum">0</ee>₽
                </span></p>
            <p>Доставка <span>0₽</span></p>
            <h2 class="tx-semibold">Общий итог <ee class="d-inline mod-cart-total-sum">0</ee>₽</span></h2>
            <div class="row d-none" id="cartRegButton">
                <div class="col py-1">
                        <a href="javascript:cartReg(true)" class="wd-100p btn btn-success btn-block rounded-20" disabled>Продолжить покупку</a>
                    </div>

            </div>
            
            <div class="row" id="cartButtons">
                <div class="col-sm-12 py-1">
                    <a href="javascript:void(0)" class="wd-100p checkout-btn btn btn-success rounded-20">Оплата
                        картой</a>
                </div>

                <div class="col-sm-12 py-1">
                    <a href="javascript:void(0)" class="wd-100p checkin-btn btn btn-primary rounded-20">Оплата
                        курьеру наличными</a>
                </div>

            </div>
        </div>


    </form>
</view>