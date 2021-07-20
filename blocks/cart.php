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
								<h4>Calculate Shipping</h4>
								<form action="cart.html#">
									<div class="row">
										<div class="col-md-6 col-12 mb-25">
											<select class="nice-select">
												<option>Bangladesh</option>
												<option>China</option>
												<option>country</option>
												<option>India</option>
												<option>Japan</option>
											</select>
										</div>
										<div class="col-md-6 col-12 mb-25">
											<select class="nice-select">
												<option>Dhaka</option>
												<option>Barisal</option>
												<option>Khulna</option>
												<option>Comilla</option>
												<option>Chittagong</option>
											</select>
										</div>
										<div class="col-md-6 col-12 mb-25">
											<input type="text" placeholder="Postcode / Zip">
										</div>
										<div class="col-md-6 col-12 mb-25">
											<input type="submit" value="Estimate">
										</div>
									</div>
								</form>
							</div>

							<!--=======  End of Calculate Shipping  =======-->

							<!--=======  Discount Coupon  =======-->

							<div class="discount-coupon">
								<h4>Discount Coupon Code</h4>
								<form action="cart.html#">
									<div class="row">
										<div class="col-md-6 col-12 mb-25">
											<input type="text" placeholder="Coupon Code">
										</div>
										<div class="col-md-6 col-12 mb-25">
											<input type="submit" value="Apply Code">
										</div>
									</div>
								</form>
							</div>

							<!--=======  End of Discount Coupon  =======-->

						</div>


						<div class="col-lg-6 col-12 d-flex">
							<!--=======  Cart summery  =======-->

							<div class="cart-summary">
								<div class="cart-summary-wrap">
									<h4>Cart Summary</h4>
									<p>Sub Total <span>$1250.00</span></p>
									<p>Shipping Cost <span>$00.00</span></p>
									<h2>Grand Total <span>$1250.00</span></h2>
								</div>
								<div class="cart-summary-button">
									<button class="checkout-btn">Checkout</button>
									<button class="update-btn">Update Cart</button>
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