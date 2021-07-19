<edit header="Верхняя часть сайта">
	<div class="alert alert-info">
        Смотри в /blocks/header.php
    </div>
</edit>
<view>
<header>
		<!--=======  header top  =======-->

		<div class="header-top pt-10 pb-10 pt-lg-10 pb-lg-10 pt-md-10 pb-md-10">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center text-sm-left">
						<!-- currncy language dropdown -->
						<div class="lang-currency-dropdown">
							<ul>
								<li> <a href="my-account.html#">English <i class="fa fa-chevron-down"></i></a>
									<ul>
										<li><a href="my-account.html#">French</a></li>
										<li><a href="my-account.html#">Japanease</a></li>
									</ul>
								</li>
								<li><a href="my-account.html#">Dollar <i class="fa fa-chevron-down"></i></a>
									<ul>
										<li><a href="my-account.html#">Euro</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<!-- end of currncy language dropdown -->
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  text-center text-sm-right">
						<!-- header top menu -->
						<div class="header-top-menu">
							<ul>
								<li><a href="/cabinet">Личный кабинет</a></li>
								<li><a href="wishlist.html">Wishlist</a></li>
								<li><a href="checkout.html">Checkout</a></li>
							</ul>
						</div>
						<!-- end of header top menu -->
					</div>
				</div>
			</div>
		</div>

		<!--=======  End of header top  =======-->

		<!--=======  header bottom  =======-->

		<div class="header-bottom header-bottom-one header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-12 col-xs-12 text-lg-left text-md-center text-sm-center">
						<!-- logo -->
						<div class="logo mt-15 mb-15">
							<a href="/">
								<img src="assets/images/logo.png" class="img-fluid" alt="">
							</a>
						</div>
						<!-- end of logo -->
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div
							class="menubar-top d-flex justify-content-between align-items-center flex-sm-wrap flex-md-wrap flex-lg-nowrap mt-sm-15">
							<!-- header phone number -->
							<div class="header-contact d-flex">
								<div class="phone-icon">
									<img src="assets/images/icon-phone.png" class="img-fluid" alt="">
								</div>
								<div class="phone-number">
									Телефон: <span class="number">{{_sett.phone}}</span>
								</div>
							</div>
							<!-- end of header phone number -->
							<!-- search bar -->
							<div class="header-advance-search">
								<form action="my-account.html#">
									<input type="text" placeholder="Поиск по продуктам">
									<button><span class="icon_search"></span></button>
								</form>
							</div>
							<!-- end of search bar -->
							<wb-include wb-tpl="cartbox.php" />
							
						</div>

						<!-- navigation section -->
						<div class="main-menu">
							<nav>
								<ul>
									<li class="active menu-item-has-children"><a href="/">Главная</a>
										<ul class="sub-menu">
											<li><a href="index.html">Home Shop 1</a></li>
											<li><a href="index-2.html">Home Shop 2</a></li>
											<li><a href="index-3.html">Home Shop 3</a></li>
											<li><a href="index-4.html">Home Shop 4</a></li>
											<li><a href="index-5.html">Home Shop 5</a></li>
											<li><a href="index-6.html">Home Shop 6</a></li>
										</ul>
									</li>
									<li class="menu-item-has-children"><a href="/shop">Магазин</a>
										<ul class="sub-menu">
											<li class="menu-item-has-children"><a href="shop-4-column.html">shop grid</a>
												<ul class="sub-menu">
													<li><a href="shop-3-column.html">shop 3 column</a></li>
													<li><a href="shop-4-column.html">shop 4 column</a></li>
													<li><a href="shop-left-sidebar.html">shop left sidebar</a></li>
													<li><a href="shop-right-sidebar.html">shop right sidebar</a></li>
												</ul>
											</li>
											<li class="menu-item-has-children"><a href="shop-list.html">shop List</a>
												<ul class="sub-menu">
													<li><a href="shop-list.html">shop List</a></li>
													<li><a href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
													<li><a href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
												</ul>
											</li>
											<li class="menu-item-has-children"><a href="single-product.html">Single Product</a>
												<ul class="sub-menu">
													<li><a href="single-product.html">Single Product</a></li>
													<li><a href="single-product-variable.html">Single Product variable</a></li>
													<li><a href="single-product-affiliate.html">Single Product affiliate</a></li>
													<li><a href="single-product-group.html">Single Product group</a></li>
													<li><a href="single-product-tabstyle-2.html">Tab Style 2</a></li>
													<li><a href="single-product-tabstyle-3.html">Tab Style 3</a></li>
													<li><a href="single-product-gallery-left.html">Gallery Left</a></li>
													<li><a href="single-product-gallery-right.html">Gallery Right</a></li>
													<li><a href="single-product-sticky-left.html">Sticky Left</a></li>
													<li><a href="single-product-sticky-right.html">Sticky Right</a></li>
													<li><a href="single-product-slider-box.html">Slider Box</a></li>

												</ul>
											</li>
										</ul>
									</li>
									<li class="menu-item-has-children"><a href="my-account.html#">PAGES</a>
										<ul class="mega-menu three-column">
											<li><a href="my-account.html#">Column One</a>
												<ul>
													<li><a href="cart.html">Cart</a></li>
													<li><a href="checkout.html">Checkout</a></li>
													<li><a href="wishlist.html">Wishlist</a></li>

												</ul>
											</li>
											<li><a href="my-account.html#">Column Two</a>
												<ul>
													<li><a href="my-account.html">My Account</a></li>
													<li><a href="login-register.html">Login Register</a></li>
													<li><a href="faq.html">FAQ</a></li>
												</ul>
											</li>
											<li><a href="my-account.html#">Column Three</a>
												<ul>
													<li><a href="compare.html">Compare</a></li>
													<li><a href="contact.html">Contact</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li class="menu-item-has-children"><a href="my-account.html#">BLOG</a>
										<ul class="sub-menu">
											<li><a href="blog-3-column.html">Blog 3 column</a></li>
											<li><a href="blog-grid-left-sidebar.html">Blog Grid Left Sidebar</a></li>
											<li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
											<li><a href="blog-list-left-sidebar.html">Blog List Left Sidebar</a></li>
											<li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
											<li><a href="blog-post-left-sidebar.html">Blog Post Left Sidebar</a></li>
											<li><a href="blog-post-right-sidebar.html">Blog Post Right Sidebar</a></li>
											<li><a href="blog-post-image-format.html">Blog Post Image Format</a></li>
											<li><a href="blog-post-image-gallery.html">Blog Post Image Gallery Format</a></li>
											<li><a href="blog-post-audio-format.html">Blog Post Audio Format</a></li>
											<li><a href="blog-post-video-format.html">Blog Post Video Format</a></li>
										</ul>
									</li>
									<li><a href="/contacts">Контакты</a></li>
								</ul>
							</nav>
						</div>
						<!-- end of navigation section -->
					</div>
					<div class="col-12">
						<!-- Mobile Menu -->
						<div class="mobile-menu d-block d-lg-none"></div>
					</div>
				</div>
			</div>
		</div>

		<!--=======  End of header bottom  =======-->
	</header>
	</view>