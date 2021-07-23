<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <wb-module wb="module=yonger&mode=render&view=header" />

	<div class="breadcrumb-area mb-50">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="breadcrumb-container">
						<ul>
							<li><a href="/"><i class="fa fa-home"></i> Главная</a></li>
							<li class="active">Кабинет</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="my-account-section section position-relative mb-50 fix">
		<div class="container">
			<div class="row">
				<div class="col-12">

					<div class="row">

						<!-- My Account Tab Menu Start -->
						<div class="col-lg-3 col-12">
							<div class="myaccount-tab-menu nav" role="tablist">
								<a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
									Управление</a>

								<a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Мои заказы</a>

								<a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> Адрес доставки</a>

								<a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Детали</a>

								<a href="/signout"><i class="fa fa-sign-out"></i> Выход</a>
							</div>
						</div>
						<!-- My Account Tab Menu End -->

						<!-- My Account Tab Content Start -->
						<div class="col-lg-9 col-12">
							<div class="tab-content" id="myaccountContent">
								<wb-data wb="table=users&item={{_sess.user.id}}">
								<!-- Single Tab Content Start -->
								<div class="tab-pane fade show active" id="dashboad" role="tabpanel">
									<div class="myaccount-content">
										<h3>Кабинет</h3>

										<div class="welcome">
											<p>Приветствуем вас, <strong>{{_sess.user.first_name}} {{_sess.user.last_name}}</strong>! &nbsp; 
                                            (если это не вы, <a href="/signout" class="logout"> Выйдите из аккаунта</a>)
                                        </p>
										</div>

										<p class="mb-0">В панели управления кабинетом вы можете просматривать свои заказы, изменять адрест доставки и другую персональную информацию.</p>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="orders" role="tabpanel">
									<div class="myaccount-content">
										<h3>Мои заказы</h3>

										<div class="myaccount-table table-responsive text-center">
											<table class="table table-bordered table-hover">
												<thead class="thead-light">
													<tr>
														<th>Номер</th>
														<th>Name</th>
														<th>Дата</th>
														<th>Статус</th>
														<th>Сумма</th>
														<th>Действие</th>
													</tr>
												</thead>

												<tbody>
													<wb-foreach wb="table=orders&sort=_created:d&size=10&offset=-170" >
													<tr>
														<td>{{id}}</td>
														<td>Mostarizing Oil</td>
														<td>{{wbDate("d.m.Y",{{_created}})}} - {{wbDate("d.m.Y",{{expired}})}}</td>
														<td>
															<svg wb-if="'{{active}}'=='on'" class="size-35 mi mi-checkmark-circle-1" wb-module="myicons" stroke="28a745"></svg>
															<svg wb-if="'{{active}}'!=='on'" class="size-35 mi mi-delete-circle" wb-module="myicons" stroke="dc3545"></svg>
														</td>
														<td>{{total.sum}}</td>
														<td><a data-ajax="{'url':'/cms/ajax/form/orders/view/{{id}}','html':'modal','callback':'$.deliveryCalendar'}" class="btn">
														<svg class="size-35 mi mi-eye-circle" wb-module="myicons" stroke="666666"></svg>
														</a></td>
													</tr>
													</wb-foreach>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="address-edit" role="tabpanel">
									<div class="myaccount-content">
										<h3>Адрес доставки</h3>
										<form action="#">
										<address>
											<p><strong>{{first_name}} {{last_name}} {{wbPhoneFormat({{phone}})}}</strong></p>
											<textarea class="form-control" name="delivery_address" placeholder="Адрес доставки"></textarea>
										</address>

										<button class="save-change-btn" wb-save="table=users&item={{_sess.user.id}}">Сохранить</button>
										</form>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="account-info" role="tabpanel">
									<div class="myaccount-content">
										<h3>Детали</h3>

										<div class="account-details-form">
											<form action="#">
												<div class="row">
													<div class="col-lg-6 col-12 mb-30">
														<input name="first_name" placeholder="Имя" type="text">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input name="last_name" placeholder="Фамилия" type="text">
													</div>

													<div class="col-12 mb-30">
														<input name="phone" placeholder="Телефон" wb-mask="+9(999) 999-99-99" disabled>
													</div>

													<div class="col-12 mb-30">
														<input name="email" placeholder="Эл.почта" type="email">
													</div>

													<div class="col-12 mb-30">
														<h4>Смена пароля</h4>
													</div>

													<div class="col-12 mb-30">
														<input id="current-pwd" placeholder="Current Password" type="password">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="new-pwd" placeholder="New Password" type="password">
													</div>

													<div class="col-lg-6 col-12 mb-30">
														<input id="confirm-pwd" placeholder="Confirm Password" type="password">
													</div>

													<div class="col-12">
														<button class="save-change-btn" wb-save="table=users&item={{_sess.user.id}}">Сохранить</button>
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
		</div>
	</div>

	<modal>

	</modal>
    <wb-module wb="module=yonger&mode=render&view=footer" />

</body>

</html>