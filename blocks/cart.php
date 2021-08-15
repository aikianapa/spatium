<edit header="Корзина покупок">
    <div class="alert alert-info">
        Смотри в /blocks/cart.php
    </div>
</edit>
<view>

    <div>

        <wb-module wb="module=cart" />

        <div id="cart" class="off-canvas off-canvas-overlay off-canvas-right off-canvas-push show wd-300 wd-md-400">
            <div class="off-canvas-header tx-20 tx-success bd-0"><span>
                    <img src="/module/myicons/shopping-cart.svg?size=26&stroke=10b759"> Корзина</span>
                <a href="#" class="close">
                    <img src="/module/myicons/32/323232/interface-essential-109.svg" width="32" height="32"
                        class="dd-remove">
                </a>

            </div>
            <div class="off-canvas-body scroll-y p-2">
                <div class="position-relative" id="shopping-cart">

                    <!-- cart floating box -->
                    <div class="cart-floating-box" id="cart-floating-box">
                        <ul class="list-group cart-items">
                            <wb-module wb="module=cart&list=header&sum=price*qty*days">
                                <li class="list-group-item d-flex align-items-center mod-cart-item">
                                    <img data-src="/thumbc/100x100/src/{{image}}" class="wd-60 wd-md-80 rounded mg-r-15"
                                        alt="{{name}}">
                                    <a href="javascript:void(0)" class="position-absolute t-5 r-5 mod-cart-remove"
                                        data-id="{{id}}">
                                        <img src="/module/myicons/24/dc3545/interface-essential-107.svg" width="24"
                                            height="24" class="dd-remove bg-white rounded-circle">
                                    </a>
                                    <div>
                                        <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">
                                            {{name}}
                                        </h6>
                                        <div class="row">
                                            <div class="col">
                                                <label>Дней</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend mod-cart-dec">
                                                        <span class="input-group-text">-</span>
                                                    </div>
                                                    <input name="days" type="text" value="{{days}}"
                                                        class="form-control input-sm" readonly enum="1,3,7,14,30">

                                                    <div class="input-group-append mod-cart-inc">
                                                        <span class="input-group-text">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label>Кол-во</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend mod-cart-dec">
                                                        <span class="input-group-text">-</span>
                                                    </div>
                                                    <input name="qty" type="number" readonly value="{{qty}}"
                                                        class="form-control input-sm">

                                                    <div class="input-group-append mod-cart-inc">
                                                        <span class="input-group-text">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="price py-1 m-0 tx-semibold tx-primary mod-cart-item-sum">{{days}}дн x {{qty}}шт = {{sum}}₽</p>
                                    </div>
                                </li>
                            </wb-module>
                        </ul>
                        <p class="tx-16 tx-semibold py-3">Итого: <span class="mod-cart-total-sum tx-primary"></span><span class="tx-primary">₽</span></p>
                    </div>
                    <!-- end of cart floating box -->
                </div>
            </div>
        </div>
        <div class="backdrop"></div>



    </div>



    <template>
        <div class="page-section section mb-50 mt-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="#">


                            <div class="cart-table table-responsive mb-40">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Изображение</th>
                                            <th class="pro-title">Наименование</th>
                                            <th class="pro-price">Цена</th>
                                            <th class="pro-quantity">Кол-во</th>
                                            <th class="pro-subtotal">Всего</th>
                                            <th class="pro-remove">Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <wb-module wb="module=cart&list=cart&sum=price*qty*days">
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a href="{{link}}">
                                                        <img data-src="/thumb/359x359/src/{{image}}" class="img-fluid"
                                                            alt="{{name}}">
                                                    </a>
                                                </td>
                                                <td class="pro-title"><a href="{{link}}">{{name}}</a></td>
                                                <td class="pro-price"><span>{{price}}₽</span></td>
                                                <td class="pro-quantity">
                                                    <div>Кол-во / Дней</div>
                                                    <div class="pro-qty"><input name="qty" type="text" value="{{qty}}"
                                                            onchange="$.cartSet('{{@index}}','qty',$(this).val());">
                                                    </div>
                                                    <div class="pro-qty">
                                                        <input name="days" type="text" readonly value="{{days}}"
                                                            enum="1,3,7,14,30"
                                                            onchange="$.cartSet('{{@index}}','days',$(this).val());">
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal"><span>{{sum}}₽</span></td>
                                                <td class="pro-remove"><a href="javascript:void(0);"
                                                        class="mod-cart-remove" data-id="{{id}}"><i
                                                            class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        </wb-module>
                                    </tbody>
                                </table>
                            </div>



                        </form>
                        <wb-var reg />
                        <div class="row">

                            <div class="col-lg-6 col-12">

                                <div class="calculate-shipping">
                                    <h4>Детали доставки</h4>
                                    <form action="#" id="Details">
                                        <input type="hidden" name="id" value="{{_sess.user.id}}">
                                        <wb-data wb="table=users&item={{_sess.user.id}}">
                                            <div class="row">
                                                <!--div class="col-md-6 col-12 mb-25">
											<select class="nice-select">
												<option>Bangladesh</option>
												<option>China</option>
											</select>
										</div-->


                                                <div class="col-md-6 col-12 mb-25">
                                                    <label>Имя</label>
                                                    <input name="first_name" placeholder="Имя">
                                                </div>

                                                <div class="col-md-6 col-12 mb-25">
                                                    <label>Фамилия</label>
                                                    <input name="last_name" placeholder="Фамилия">
                                                </div>

                                                <div class="col-md-6 col-12 mb-25">
                                                    <label>Первая доставка</label>
                                                    <input type="datepicker" data-date-start="+1day"
                                                        data-date-end="+30day" wb="module=datetimepicker" name="date"
                                                        placeholder="Дата первой доставки"
                                                        value='{{ date("Y-m-d",strtotime("+24hours")) }}'>
                                                </div>

                                                <div class="col-md-6 col-12 mb-25">
                                                    <label>Телефон</label>
                                                    <input type="phone" wb-mask="+9 (999) 999-99-99" name="phone"
                                                        placeholder="Телефон">
                                                </div>

                                                <div class="cross-delivery d-none alert alert-warning">
                                                    <p>
                                                        Доставка заказа пересекается с более ранними заказами. Если вы
                                                        не
                                                        желаете
                                                        объединить доставки, выберите другую дату доставки:
                                                        <span class='cursor-pointer'
                                                            style="text-decoration:underline;">&nbsp;</span>.
                                                    </p>
                                                    <ul>
                                                        <wb-foreach wb="bind=tmp.crossdelivery&render=client">
                                                            <li>Заказ № {{number}} от {{date}} - {{expired}}</li>
                                                        </wb-foreach>
                                                    </ul>
                                                </div>


                                                <div class="col-12 mb-25">
                                                    <label>Адрес доставки</label>
                                                    <textarea type="text" name="delivery_address" class="form-control"
                                                        rows="auto" style="border-radius:15px;"
                                                        placeholder="Адрес доставки"></textarea>
                                                </div>
                                                <wb-var
                                                    wb-if="'{{first_name}}'=='' OR '{{last_name}}'=='' OR '{{delivery_address}}'=='' "
                                                    reg="false" else="true" />
                                        </wb-data>
                                </div>
                                </form>
                            </div>

                            <!--=======  End of Calculate Shipping  =======-->


                        </div>


                        <div class="col-lg-6 col-12 d-flex">
                            <!--=======  Cart summery  =======-->

                            <div class="cart-summary">
                                <div class="cart-summary-wrap">
                                    <h4>Калькуляция</h4>
                                    <p>Продукция <span>
                                            <ee class="d-inline mod-cart-total-sum">0</ee>₽
                                        </span></p>
                                    <p>Доставка <span>0₽</span></p>
                                    <h2>Общий итог <ee class="d-inline mod-cart-total-sum">0</ee>₽</span></h2>
                                </div>

                                <div class="cart-summary-button"
                                    wb-if="'{{_sess.user.role}}' !== 'admin' AND '{{_var.reg}}' == 'true' ">
                                    <button onclick class="checkout-btn">Оплатить</button>
                                </div>
                                <div class='alert alert-warning' wb-if="'{{_var.reg}}' == 'false' ">
                                    Пожалуйста, прежде чем сформировать заказ, заполните регистрационные данные в <a
                                        href="/cabinet">Личном кабинете</a>
                                </div>
                            </div>

                            <!--=======  End of Cart summery  =======-->

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </template>
    </div>
    <script type="wbapp" remove>
        $(document).on('main-ready',function(){
			$('#Details [name=date]').on('change',function(){
				if (wbapp._session.user.id == undefined) return;
				let data = wbapp.postSync('/orders/get_date_dlvrs',{date: $(this).val()});
				if (data == null || data.result == undefined) return;
				if (data.result.length) {
					wbapp.storage('tmp.crossdelivery',data.result);
					$('#Details .cross-delivery p > span').html(data.freedate);
					$('#Details .cross-delivery').removeClass('d-none');
					$('#Details .cross-delivery p > span').off(wbapp.evClick);
					$('#Details .cross-delivery p > span').on(wbapp.evClick,function(){
						$('#Details [name=date]').val(data.freedate);
						$('#Details [name=date]:last-child').trigger('change');
					});
				} else {
					$('#Details .cross-delivery').addClass('d-none');
				}
			})
			$('#Details [name=date]:last-child').trigger('change');
		})
	</script>

</view>