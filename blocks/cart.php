<edit header="Корзина покупок">
<div class="alert alert-info">
        Смотри в /blocks/cart.php
</div>
</edit>
<view>
<script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
<div class="breadcrumb-area mb-50 mt-50">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="breadcrumb-container">
						<ul>
							<li><a href="/"><i class="fa fa-home"></i> Главная</a></li>
							<li class="active">Корзина</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="page-section section mb-50 mt-100">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<form action="#">
						<!--=======  cart table  =======-->

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
												<img data-src="/thumb/359x359/src/{{image}}"class="img-fluid" alt="{{name}}">
												</a>
											</td>
                                            <td class="pro-title"><a href="{{link}}">{{name}}</a></td>
                                            <td class="pro-price"><span>{{price}}₽</span></td>
                                            <td class="pro-quantity">
                                                <div>Кол-во / Дней</div>
                                                <div class="pro-qty"><input name="qty" type="text" value="{{qty}}"
                                                onchange="$.cartSet('{{@index}}','qty',$(this).val());"></div>
                                                <div class="pro-qty">
												<input name="days" type="text" readonly value="{{days}}" enum="1,3,7,14,30"
                                                onchange="$.cartSet('{{@index}}','days',$(this).val());"></div>
                                            </td>
                                            <td class="pro-subtotal"><span>{{sum}}₽</span></td>
                                            <td class="pro-remove"><a href="javascript:void(0);" class="mod-cart-remove" data-id="{{id}}"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    </wb-module>
								</tbody>
							</table>
						</div>

						<!--=======  End of cart table  =======-->


					</form>
					<wb-var reg />
					<div class="row">

						<div class="col-lg-6 col-12">
							<!--=======  Calculate Shipping  =======-->

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
                                            <input type="datepicker" data-date-start="+1day" data-date-end="+30day" wb="module=datetimepicker" name="date" placeholder="Дата первой доставки" value='{{ date("Y-m-d",strtotime("+24hours")) }}'>
                                        </div>

                                        <div class="col-md-6 col-12 mb-25">
                                            <label>Телефон</label>
                                            <input type="phone" wb-mask="+9 (999) 999-99-99" name="phone" placeholder="Телефон">
                                        </div>

										<div class="col-12 mb-25">
                                            <label>Адрес доставки</label>
											<textarea type="text" name="delivery_address" class="form-control" rows="auto" style="border-radius:15px;" placeholder="Адрес доставки"></textarea>
										</div>
										<wb-var wb-if="'{{first_name}}'=='' OR '{{last_name}}'=='' OR '{{delivery_address}}'=='' " reg="false" else="true" />
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
									<p>Продукция <span><ee class="d-inline mod-cart-total-sum">0</ee>₽</span></p>
									<p>Доставка <span>0₽</span></p>
									<h2>Общий итог <ee class="d-inline mod-cart-total-sum">0</ee>₽</span></h2>
								</div>

								<div class="cart-summary-button" wb-if="'{{_sess.user.role}}' !== 'admin' AND '{{_var.reg}}' == 'true' ">
									<button onclick class="checkout-btn">Оплатить</button>
								</div>
								<div class='alert alert-warning' wb-if="'{{_var.reg}}' == 'false' ">
									Пожалуйста, прежде чем сформировать заказ, заполните регистрационные данные в <a href="/cabinet">Личном кабинете</a>
								</div>
							</div>

							<!--=======  End of Cart summery  =======-->

						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

</view>