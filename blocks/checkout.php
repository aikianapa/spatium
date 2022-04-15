<edit header="Страница оплаты заказа">
<div>
<wb-module wb="module=yonger&mode=edit&block=common.inc" />
</div>
    <div class="alert alert-info">
        Смотри в /blocks/checkout.php
    </div>
</edit>
<view>

    <div class="breadcrumb-area mb-50 mt-50">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumb-container">
                        <ul>
                            <li><a href="/"><i class="fa fa-home"></i> Главная</a></li>
                            <li class="active">Заказ № {{_get.order}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of breadcrumb area  ======-->

    <!--=============================================
	=            Checkout page content         =
	=============================================-->

    <div class="page-section section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Checkout Form s-->
                    <form action="#" class="checkout-form">
                        <div class="row row-40">
                            <div class="col-12 alert alert-info">
                                После нажатия кнопки оплатить, на странице корзины, содержимое корзины перейдёт в статус
                                заказа и очистится.
                                После процесса оплаты на этой странице отображается результат SUCCESS/DENY
                            </div>
                            <wb-var order_id="{{_get.order}}" />
                            <wb-include wb-tpl="orderlist.php" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script type="wbapp">
        wbapp.storage('mod.cart',null);
    </script>

</view>