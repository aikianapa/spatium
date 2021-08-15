<edit header="Верхняя часть сайта">
    <div class="alert alert-info">
        Смотри в /blocks/header.php
    </div>
</edit>
<view>
  <loader class="fade out">
    <div class="loader">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>
    <p>Загрузка...</p>
  </loader>


    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow t-0 position-fixed w-100 z-index-10">
            <a class="navbar-brand" href="/">
                <img class="ht-30 w-auto filter-invert" data-src="/assets/img/logo.svg" alt="">
            </a>
            <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <img data-src="/module/myicons/menu-burger.svg?size=30&stroke=333333">
            </button>
            <div class="collapse navbar-collapse order-2" id="navbarNav">
                <ul class="navbar-nav tx-bold tx-uppercase mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ежедневное меню</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#">
                            Полезные десерты
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            Кейтеринг
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            Доставка
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            Контакты
                        </a></li>
                </ul>
                
                <div class="d-inline my-2 my-lg-0">
                    <a href="javascript:$('#cart').addClass('show');" class="my-2 my-sm-0">

                    <img data-src="/module/myicons/shopping-cart.svg?size=26&stroke=10b759" alt="Мои покупки">

                    </a>
                    <a href="/signin" class="btn btn-outline-success rounded-20 my-2 my-sm-0">Вход</a>
                </div>
            </div>
        </nav>
    </header>
</view>