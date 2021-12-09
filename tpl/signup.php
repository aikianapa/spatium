<!DOCTYPE html>
<html lang="en">
<wb-var assets="/modules/yonger/tpl/assets" />
<wb-include wb-tpl="signhead.inc.php" />

<body class="bg-light" id="signup">

    <div class="row">
        <wb-include wb-tpl="signleft.php" />
        <div class="d-flex col-12 col-sm-6 col-lg-5 ht-100v overflow-y" id="form">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12 col-md-6 offset-md-4 offset-xl-5 text-right">
                        <p>Уже зарегистрированы?</p>
                        <h4><a href="/signin">Войти</a></h4>
                    </div>
                </div>

                <div class="d-block">
                    <form class="d-block">
                        <h2 class="mb-4">Регистрация</h2>
                        <div class="row after-send-code">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-control-label">Имя</label>
                                <input type="text" placeholder="" class="form-control" name="first_name" required>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-control-label">Фамилия</label>
                                <input type="text" placeholder="" class="form-control" name="last_name">
                            </div>


                            <div class="col-12 mb-3">
                                <label class="form-control-label">Адрес доставки</label>
                                <textarea placeholder="" rows="auto" class="form-control" name="delivery_address"
                                    required></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-control-label">Эл.почта <span class="tx-10">(для уведомлений и
                                        чеков)</span></label>
                                <input type="email" placeholder="" class="form-control" name="email">
                            </div>

                            <div class="col-12 col-md-7">
                                <label class="form-control-label">Телефон <span class="tx-10">(для
                                        авторизаций)</span></label>
                                <input type="phone" wb-mask='+7 (999) 999-99-99' placeholder="" class="form-control"
                                    name="phone" required>
                            </div>
                            <div class="col-12 col-md-5">
                                <a href="#" onclick="wbapp.sign.checkphone();"
                                    class="btn btn-primary mt-4 btn-block rounded-20">
                                    <nobr>Подтвердить</nobr>
                                </a>
                                <label class="form-control-label after-send-code d-none">Проверочный код</label>
                                <input type="text" placeholder="Проверочный код" wb-mask='999-999'
                                    class="form-control after-send-code d-none" name="code">
                            </div>
                            <div class="col-12 after-send-code d-none tx-secondary pt-3">
                                Мы отправили код подтверждения<br>
                                на номер <phone></phone><br>
                                <a href="#" class="d-none btn-repeat">Отправить код ещё раз</a>
                                <br>
                                <span class="msg-repeat">Повторная отправка возможна через <span class='wait'></span>
                                    секунд</span>
                                <a href="#" onclick="wbapp.sign.reg();"
                                    class="btn btn-success mt-5 btn-block rounded-20">Зарегистрироваться</a>
                            </div>
                        </div>
                        <div class="col-12 d-none tx-center tx-danger pt-3">
                            Что-то пошло не так, попробуйте позже.
                        </div>
                        <div class="col-12 d-none tx-center tx-success pt-3">
                            <p class="alert alert-success">Регистрация успешно завершена.</p>
                        </div>
                        <div class="col-12 after-reg">
                            <a href="/workspace"
                                class="btn btn-primary d-none after-reg mt-4 btn-block rounded-20">Перейти в кабинет</a>
                        </div>
                        <p class="mt-5 tx-12">
                            Регистрируясь на сайте вы соглашаетесь принять <a href="/rules">правила использования
                                сервиса</a> и <a href="/privacy">политику конфидициальности</a>
                            <!--
                            <br><br>
                            Дополнительные сведения см. в разделе
                            <a href="/faq">Часто задаваемые вопросы</a>
                            -->
                        </p>
                        <a href="/" class="btn btn-secondary btn-block rounded-20 mt-5 tx-16">
                            <img data-src="/module/myicons/home-house.4.svg?size=20&stroke=FFFFFF">
                            На главную</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <wb-include wb-snippet="wbapp" />
    <wb-include wb-snippet="lineawesome" />


</body>

</html>