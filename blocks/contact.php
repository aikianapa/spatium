<edit header="Контакты">
    <div class="alert alert-info">
        Смотри в /blocks/contact.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />

        <form>

                <div class="divider-text">Контакты</div>
                <div class="input-group mb-2">
                    <div class="col-4 p-0 input-group-prepend">
                        <span class="wd-100p input-group-text">Адрес</span>
                    </div>
                    <textarea class="form-control" rows="auto" name="address" placeholder="Адрес"></textarea>
                </div>

                <div class="input-group mb-2">
                    <div class="col-4 p-0 input-group-prepend">
                        <span class="wd-100p input-group-text">Телефоны</span>
                    </div>
                    <textarea class="form-control" rows="auto" name="phones" placeholder="Телефоны"></textarea>
                </div>

                <div class="input-group mb-2">
                    <div class="col-4 p-0 input-group-prepend">
                        <span class="wd-100p input-group-text">Эл.почта</span>
                    </div>
                    <input class="form-control" type="email" name="email" placeholder="Эл.почта">
                </div>

                <div class="input-group mb-2">
                    <div class="col-4 p-0 input-group-prepend">
                        <span class="wd-100p input-group-text">Время работы</span>
                    </div>
                    <textarea class="form-control" rows="auto" name="schedule" placeholder="Время работы"></textarea>
                </div>


        </form>

    </div>
</edit>

<view>
    <section>
        <div class="row mg-b-50">
            <div class="col-sm-6">
                <div class="media tx-16 mg-b-30">
                    <img data-src="/module/myicons/house-location-pin.svg?size=40&stroke=10b759" alt="Адрес">
                    <div class="media-body mg-l-30">
                        <h5 class="mg-y-10 tx-20 tx-semibold tx-success">Адрес</h5>
                        <span class="ws-break">{{address}}</span>
                    </div>
                </div>

                <div class="media tx-16 mg-b-30">
                <img data-src="/module/myicons/phones-04.svg?size=40&stroke=10b759" alt="Телефоны">
                    <div class="media-body mg-l-30">
                        <h5 class="mg-y-10 tx-20 tx-semibold tx-success">Телефоны</h5>
                        <span class="ws-break">{{phones}}</span>
                    </div>
                </div>

                <div class="media tx-16 mg-b-30">
                <img data-src="/module/myicons/@-email-mail-1.svg?size=40&stroke=10b759" alt="Email">
                    <div class="media-body mg-l-30">
                        <h5 class="mg-y-10 tx-20 tx-semibold tx-success">Электронная почта</h5>
                        <span class="ws-break">{{email}}</span>
                    </div>
                </div>

                <div class="media tx-16 mg-b-30">
                <img data-src="/module/myicons/calendar-schedule-clock-time.svg?size=40&stroke=10b759" alt="Schedule">
                    <div class="media-body mg-l-30">
                        <h5 class="mg-y-10 tx-20 tx-semibold tx-success">Расписание работы</h5>
                        <span class="ws-break">{{schedule}}</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-6">
                <form class="tx-16">
                    <wb-data wb="form=pages&item=_null">
                        <div class="divider-text">Обратная связь</div>
                        <input type="hidden" name="_subject" placeholder="Сообщение с сайта"/>
                        <div class="input-group mb-2">
                            <div class="col-4 p-0 input-group-prepend">
                                <span class="wd-100p input-group-text">Ваше имя</span>
                            </div>
                            <input class="form-control" type="text" name="name" placeholder="Ваше имя" required>
                        </div>

                        <div class="input-group mb-2">
                            <div class="col-4 p-0 input-group-prepend">
                                <span class="wd-100p input-group-text">Телефон</span>
                            </div>
                            <input class="form-control" type="phone" name="phone" placeholder="Телефон"
                                wb-mask="+7 (999) 999-99-99" required>
                        </div>

                        <div class="input-group mb-2">
                            <div class="col-4 p-0 input-group-prepend">
                                <span class="wd-100p input-group-text">Сообщение</span>
                            </div>
                            <textarea class="form-control" rows="auto" name="msg"
                                placeholder="Сообщение" required></textarea>
                        </div>

                        <div class="input-group mb-2">
                            <button type="button" class="btn btn-success btn-block feedback-btn rounded-20">Отправить сообщение</button>
                        </div>
                    </wb-data>
                </form>

            </div>
        </div>

    </section>

</view>