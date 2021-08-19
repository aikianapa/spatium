<!DOCTYPE html>
<html>

<head>
    <script type="wbapp" src="/modules/yonger/tpl/assets/js/dashforge.js"></script>
</head>

<body>

    <wb-module wb="module=yonger&mode=render&view=header" />
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb mg-b-0 mg-t-70 bg-white">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Кабинет</li>
        </ol>
    </nav>

    <div class="my-account-section section position-relative mb-50 fix">
        <div class="container">

                    <div class="row">

                        <!-- My Account Tab Menu Start -->
                        <div class="col-lg-3 col-12">
                            <div id="sidebarMenu" class="sidebar sidebar-components bg-white z-index-10">
                                <div class="sidebar-header">
                                    <a href="#" id="mainMenuOpen"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-menu">
                                            <line x1="3" y1="12" x2="21" y2="12"></line>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <line x1="3" y1="18" x2="21" y2="18"></line>
                                        </svg></a>
                                    <h5>Кабинет</h5>
                                    <a href="#" id="sidebarMenuClose"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg></a>
                                </div>
                                <div class="sidebar-body">
                                    <ul class="sidebar-nav nav d-block tx-16" role="tablist">
                                        <li class="nav-label mg-b-15">Кабинет</li>
                                        <li class="nav-item">
                                            <a href="#dashboad" onclick="$('body').removeClass('sidebar-show');" class=" tx-gray-700 active" data-toggle="tab">
                                                <i class="fa fa-dashboard"></i>
                                                Управление</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="tx-gray-700" onclick="$('body').removeClass('sidebar-show');" href="javascript:$('#cart').addClass('show');"><i
                                                    class="fa fa-shopping-cart"></i> Корзина</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="tx-gray-700" onclick="$('body').removeClass('sidebar-show');" href="#orders" data-toggle="tab"
                                                data-ajax="{'url':'/cms/ajax/form/users/orders','html':'#orders'}"><i
                                                    class="fa fa-cart-arrow-down"></i> Мои заказы</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="tx-gray-700" onclick="$('body').removeClass('sidebar-show');" href="#delivery" data-toggle="tab"
                                                data-ajax="{'url':'/cms/ajax/form/users/delivery','html':'#delivery'}"><i
                                                    class="fa fa-truck"></i> Мои Доставки</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="tx-gray-700" onclick="$('body').removeClass('sidebar-show');" href="#account-info" data-toggle="tab"><i
                                                    class="fa fa-user"></i> Детали</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="tx-gray-700" href="/signout"><i class="fa fa-sign-out"></i>
                                                Выход</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-12 mn-ht-50v pl-3">
                            <a href="#" id="sidebarMenuOpen" class="d-lg-none burger-menu pb-2"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-left">
                                    <line x1="19" y1="12" x2="5" y2="12"></line>
                                    <polyline points="12 19 5 12 12 5"></polyline>
                                </svg> Меню</a>


                            <div class="tab-content mt-3" id="myaccountContent">
                                <wb-data wb="table=users&item={{_sess.user.id}}">
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="pb-3">Кабинет</h3>

                                            <div class="welcome">
                                                <p>
                                                    Приветствуем вас<strong
                                                        wb-if="'{{_sess.user.first_name}} {{_sess.user.last_name}}' > ' '">
                                                        , {{_sess.user.first_name}} {{_sess.user.last_name}}</strong>!
                                                    &nbsp;
                                                    <span
                                                        wb-if="'{{_sess.user.first_name}} {{_sess.user.last_name}}' > ' '">
                                                        (если это не вы, <a href="/signout" class="logout"> Выйдите из
                                                            аккаунта</a>)
                                                    </span>
                                                </p>
                                            </div>

                                            <p>В панели управления кабинетом вы можете просматривать свои заказы,
                                                изменять адрест доставки и другую персональную информацию.</p>
                                            <p wb-if="'{{_sess.user.first_name}} {{_sess.user.last_name}}' == ' '">
                                                Для начала работы, пожалуйста, заполните информацию о себе в разделах
                                                <a href="#account-info" data-toggle="tab">Детали</a> и
                                                <a href="#address-edit" data-toggle="tab">Адрес доставки</a> и .
                                            </p>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                                    </div>

                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                    </div>

                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="pb-3">Детали</h3>

                                            <div class="account-details-form">
                                                <form action="#">

                                                    <div class="row">
                                                        <div class="col-12 mb-2">

                                                            <div class="input-group mb-2">
                                                                <div class="col-4 p-0 input-group-prepend">
                                                                    <span class="wd-100p input-group-text">Имя</span>
                                                                </div>
                                                                <input class="form-control" name="first_name"
                                                                    placeholder="Имя">
                                                            </div>


                                                            <div class="input-group mb-2">
                                                                <div class="col-4 p-0 input-group-prepend">
                                                                    <span
                                                                        class="wd-100p input-group-text">Фамилия</span>
                                                                </div>
                                                                <input class="form-control" name="last_name"
                                                                    placeholder="Фамилия">
                                                            </div>

                                                            <div class="input-group mb-2">
                                                                <div class="col-4 p-0 input-group-prepend">
                                                                    <span
                                                                        class="wd-100p input-group-text">Эл.почта</span>
                                                                </div>
                                                                <input class="form-control" name="email"
                                                                    placeholder="Эл.почта" type="email">
                                                            </div>

                                                            <div class="input-group mb-2">
                                                                <div class="col-4 p-0 input-group-prepend">
                                                                    <span
                                                                        class="wd-100p input-group-text">Телефон</span>
                                                                </div>
                                                                <input class="form-control" type="phone" readonly
                                                                    wb-mask="+9 (999) 999-99-99" name="phone"
                                                                    placeholder="Телефон">
                                                            </div>

                                                            <div class="input-group mb-2">
                                                                <div class="col-4 p-0 input-group-prepend">
                                                                    <span class="wd-100p input-group-text">Адрес
                                                                        доставки</span>
                                                                </div>
                                                                <textarea class="form-control" type="text"
                                                                    name="delivery_address" class="form-control"
                                                                    rows="auto" placeholder="Адрес доставки"></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-success rounded-20"
                                                                wb-save="table=users&item={{_sess.user.id}}">Сохранить</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                </wb-data>
                            </div>
                        </div>
                        <!-- My Account Tab Content End -->
                    </div>
        </div>
    </div>

    <modal>

    </modal>
    <wb-module wb="module=yonger&mode=render&view=footer" />
</body>

</html>