<!DOCTYPE html>
<html lang="en">
<wb-var assets="/modules/yonger/tpl/assets" />
<wb-include wb-src="signhead.inc.php" />

<body class="bg-light" id="signup">
    <div class="row h-100">
        <div class="col-12 d-none d-sm-inline col-sm-6 col-lg-7 pr-0" id="image">
            <div class="d-flex align-items-center">
                <div class="container">
                    <img src="/module/yonger/logo" class="position-absolute" style="top: 10vh; width: 150px;">
                    <h1>
                        Легко создавайте,
                        <br />развивайте сайты
                        <br />и онлайн-сервисы
                    </h1>
                    <p class="mt-5">
                        Yonger - это мощное, многофункциональное ядро для разработки веб-приложений любой сложности. Мы
                        подготовили все необходимое, чтобы вам было как можно комфортнее работать.
                    </p>
                    <a class="btn btn-secondary btn-rounded">Подробнее</a>
                </div>

            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-5" id="form">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12 col-md-6 offset-md-4 offset-xl-5">
                        <p class="">Ещё нет аккаунта?</p>
                        <h4><a href="/signup">Зарегистрироваться</a></h4>
                    </div>
                </div>
                <div class="d-flex">
                    <form class="d-block">
                        <h2 class="mb-4">Вход</h2>
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <label class="form-control-label">Телефон</label>
                                <input type="phone" wb-mask='+7 (999) 999-99-99' placeholder="" class="form-control"
                                    name="phone" required>
                            </div>
                            <div class="col-12 col-md-5">
                                <a href="#" onclick="wbapp.sign.checkphone('login');" class="btn btn-primary mt-4 w-100">
                                    <nobr>Получить код</nobr>
                                </a>
                                <label class="form-control-label after-send-code d-none">Проверочный код</label>
                                <input type="text" placeholder="Проверочный код" wb-mask='999-999'
                                        class="form-control after-send-code d-none" name="code">
                                <a href="/workspace" class="btn btn-primary d-none after-reg mt-4 w-100">Войти в систему</a>
                            </div>
                            <div class="col-12 after-send-code d-none tx-secondary pt-3">
                                Мы отправили код подтверждения<br>
                                на номер <phone></phone><br>
                                <a href="#" class="d-none btn-repeat login">Отправить код ещё раз</a>
                                <br>
                                <span class="msg-repeat">Повторная отправка возможна через <span class='wait'></span> секунд</span>
                                <a href="#" onclick="wbapp.sign.login();"
                                    class="btn btn-secondary mt-5 w-100">Войти</a>
                            </div>
                            <div class="col-12 d-none tx-danger pt-3"></div>
                        </div>
                        <p class="mt-5 tx-12">
                            *Бесплатное использование по плану Free рассчитывается ежедневно. Детали немного отличаются
                            для
                            облачных функций, Firebase ML, Phone Auth и Test Lab.
                            <br><br>
                            Дополнительные сведения см. в разделе
                            <a href="/faq">Часто задаваемые вопросы</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <wb-include wb-snippet="wbapp" />
</body>

</html>