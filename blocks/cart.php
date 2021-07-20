<edit header="Корзина покупок">
<div class="alert alert-info">
        Смотри в /blocks/cart.php
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
                                            <td class="pro-thumbnail"><a href="{{link}}"><img data-src="/thumb/359x359/src/{{image}}"
                                                        class="img-fluid" alt="{{name}}"></a></td>
                                            <td class="pro-title"><a href="{{link}}">{{name}}</a></td>
                                            <td class="pro-price"><span>{{price}}₽</span></td>
                                            <td class="pro-quantity">
                                                <div>Кол-во / Дней</div>
                                                <div class="pro-qty"><input name="qty" type="text" value="{{qty}}"
                                                onchange="wbapp.storage('mod.cart.list.{{@index}}.qty',$(this).val());"></div>
                                                <div class="pro-qty"><input name="days" type="text" value="{{days}}"
                                                onchange="wbapp.storage('mod.cart.list.{{@index}}.days',$(this).val());"></div>
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

					<div class="row">

						<div class="col-lg-6 col-12">
							<!--=======  Calculate Shipping  =======-->

							<div class="calculate-shipping">
								<h4>Детали доставки</h4>
								<form action="#">
                                    <wb-data wb-json="{{_sess.user}}">
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
                                            <input type="datepicker" data-date-start="+1day" data-date-end="+30day" wb="module=datetimepicker" name="date" placeholder="Дата первой доставки">
                                        </div>

                                        <div class="col-md-6 col-12 mb-25">
                                            <label>Телефон</label>
                                            <input type="phone" wb-mask="+9 (999) 999-99-99" name="phone" placeholder="Телефон">
                                        </div>

										<div class="col-12 mb-25">
                                            <label>Адрес доставки</label>
											<textarea type="text" name="delivery_address" class="form-control" rows="auto" style="border-radius:15px;" placeholder="Адрес доставки"></textarea>
										</div>
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
									<p>Продукция <span><ee class="d-inline mod-cart-total-sum">$1250.00</ee>₽</span></p>
									<p>Доставка <span>0₽</span></p>
									<h2>Общий итог <ee class="d-inline mod-cart-total-sum">$1250.00</ee>₽</span></h2>
								</div>
								<div class="cart-summary-button">
									<button class="checkout-btn">Оплатить</button>
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