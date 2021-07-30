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

								<a href="#orders" data-toggle="tab" data-ajax="{'url':'/cms/ajax/form/users/orders','html':'#orders'}"><i class="fa fa-cart-arrow-down"></i> Мои заказы</a>

								<a href="#delivery" data-toggle="tab" data-ajax="{'url':'/cms/ajax/form/users/delivery','html':'#delivery'}"><i class="fa fa-truck"></i> Мои Доставки</a>

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
											<p>
												Приветствуем вас<strong wb-if="'{{_sess.user.first_name}} {{_sess.user.last_name}}' > ' '">
												, {{_sess.user.first_name}} {{_sess.user.last_name}}</strong>! &nbsp; 
                                            	<span wb-if="'{{_sess.user.first_name}} {{_sess.user.last_name}}' > ' '">
												(если это не вы, <a href="/signout" class="logout"> Выйдите из аккаунта</a>)
												</span>
                                        </p>
										</div>

										<p>В панели управления кабинетом вы можете просматривать свои заказы, изменять адрест доставки и другую персональную информацию.</p>
										<p wb-if="'{{_sess.user.first_name}} {{_sess.user.last_name}}' == ' '">
											Для начала работы, пожалуйста, заполните информацию о себе в разделах 
											<a href="#account-info" data-toggle="tab">Детали</a> и 
											<a href="#address-edit" data-toggle="tab">Адрес доставки</a> и .
										</p>
									</div>
								</div>
								<!-- Single Tab Content End -->
								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="delivery" role="tabpanel">

								</div>
								<!-- Single Tab Content End -->
								<!-- Single Tab Content Start -->
								<div class="tab-pane fade" id="orders" role="tabpanel">

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

										<button type="button" class="save-change-btn" wb-save="table=users&item={{_sess.user.id}}">Сохранить</button>
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
														<input name="phone" placeholder="Телефон" wb-mask="+9(999) 999-99-99" required disabled>
													</div>

													<div class="col-12 mb-30">
														<input name="email" placeholder="Эл.почта" type="email">
													</div>

													<div class="col-12">
														<button type="button" class="save-change-btn" wb-save="table=users&item={{_sess.user.id}}">Сохранить</button>
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