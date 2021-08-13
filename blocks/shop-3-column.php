<edit header="Витрина 3 колонки">
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
</edit>
<view>
<div class="shop-page-container mb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 mb-sm-35 mb-xs-35">

					<!--=======  shop page banner  =======-->

					<div class="shop-page-banner mb-35">
						<a href="shop-left-sidebar.html">
							<img src="assets/images/banners/shop-banner.jpg" class="img-fluid" alt="">
						</a>
					</div>

					<!--=======  End of shop page banner  =======-->

					<!--=======  Shop header  =======-->

					<div class="shop-header mb-35">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center">
								<!--=======  view mode  =======-->

								<div class="view-mode-icons mb-xs-10">
									<a class="active" href="shop-3-column.html#" data-target="grid"><i class="fa fa-th"></i></a>
									<a href="shop-3-column.html#" data-target="list"><i class="fa fa-list"></i></a>
								</div>

								<!--=======  End of view mode  =======-->

							</div>
							<div
								class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
								<!--=======  Sort by dropdown  =======-->

								<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
									<p class="mr-10">Sort By: </p>
									<select name="sort-by" id="sort-by" class="nice-select">
										<option value="0">Sort By Popularity</option>
										<option value="0">Sort By Average Rating</option>
										<option value="0">Sort By Newness</option>
										<option value="0">Sort By Price: Low to High</option>
										<option value="0">Sort By Price: High to Low</option>
									</select>
								</div>

								<!--=======  End of Sort by dropdown  =======-->

								<p class="result-show-message">Showing 1–12 of 41 results</p>
							</div>
						</div>
					</div>

					<!--=======  End of Shop header  =======-->

					<!--=======  Grid list view  =======-->

					<div class="shop-product-wrap grid row no-gutters mb-35">
                        <wb-foreach wb="table=products&size=12" __wb-filter="category=main">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <!--=======  Grid view product  =======-->

                                <div class="gf-product shop-grid-view-product">
                                    <div class="image">
                                        <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}">
                                            <span class="onsale">Sale!</span>
                                            <img src="/thumb/359x359/src/{{images.0.img}}" width="359" height="359" class="img-fluid" alt="{{name}}">
                                        </a>
                                        <div class="product-hover-icons">
                                            <wb-module wb="module=cart">
                                                <a href="javascript:void(0);" 
                                                class="mod-cart-add"
                                                data-id="{{id}}"
                                                data-name="{{name}}"
                                                data-price="{{price}}"
                                                data-image="{{images.0.img}}"
                                                data-days="7"
                                                data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                                                data-tooltip="В корзину"> <span class="icon_cart_alt"></span>
                                                </a>
                                            </wb-module>
                                            <a href="javascript:void(0);" data-tooltip="Просмотр" data-toggle="modal" data-target="#quick-view-modal-container">
                                                <span class="icon_search"></span></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-categories">
                                            <a href="shop-left-sidebar.html">Fast Foods</a>,
                                            <a href="shop-left-sidebar.html">Vegetables</a>
                                        </div>
                                        <h3 class="product-title"><a href="/products/{{id}}/{{wbUrlOnly({{name}})}}">{{name}}</a></h3>
                                        <div class="price-box">
                                            <span class="main-price">{{price}} ₽</span>
                                            <span class="discounted-price">{{price}} ₽</span>
                                        </div>
                                    </div>

                                </div>

                                <!--=======  End of Grid view product  =======-->

                                <!--=======  Shop list view product  =======-->

                                <div class="gf-product shop-list-view-product">
                                    <div class="image">
                                        <a href="single-product.html">
                                            <span class="onsale">Sale!</span>
                                            <img src="assets/images/products/product03.jpg" class="img-fluid" alt="">
                                        </a>
                                        <div class="product-hover-icons">
                                            <a href="shop-3-column.html#" data-tooltip="Quick view" data-toggle="modal" data-target="#quick-view-modal-container">
                                                <span class="icon_search"></span> </a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-categories">
                                            <a href="shop-left-sidebar.html">Fast Foods</a>,
                                            <a href="shop-left-sidebar.html">Vegetables</a>
                                        </div>
                                        <h3 class="product-title"><a href="single-product.html">{{name}}</a></h3>
                                        <div class="price-box mb-20">
                                            <span class="main-price">{{price}} ₽</span>
                                            <span class="discounted-price">{{price}} ₽</span>
                                        </div>
                                        <p class="product-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere esse
                                            tempora magnam dolorem tenetur eos eligendi non temporibus qui enim. Lorem ipsum dolor sit amet
                                            consectetur adipisicing elit. Ullam, magni.</p>
                                        <div class="list-product-icons">
                                            <wb-module wb="module=cart">
                                                <a href="javascript:void(0);" 
                                                class="mod-cart-add"
                                                data-id="{{id}}"
                                                data-name="{{name}}"
                                                data-price="{{price}}"
                                                data-image="{{images.0.img}}"
                                                data-days="7"
                                                data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                                                data-tooltip="В корзину"> <span class="icon_cart_alt"></span>
                                                </a>
                                            </wb-module>
                                            <a href="javascript:void(0);" data-tooltip="Просмотр" data-toggle="modal" data-target="#quick-view-modal-container">
                                                <span class="icon_search"></span></a>
                                        </div>
                                    </div>

                                </div>

                                <!--=======  End of Shop list view product  =======-->
                            </div>
                        </wb-foreach>
					</div>

					<!--=======  End of Grid list view  =======-->

					<!--=======  Pagination container  =======-->

					<div class="pagination-container">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<!--=======  pagination-content  =======-->

									<div class="pagination-content text-center">
										<ul>
											<li><a class="active" href="shop-3-column.html#">1</a></li>
											<li><a href="shop-3-column.html#">2</a></li>
											<li><a href="shop-3-column.html#">3</a></li>
											<li><a href="shop-3-column.html#">4</a></li>
											<li><a href="shop-3-column.html#"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</div>

									<!--=======  End of pagination-content  =======-->
								</div>
							</div>
						</div>
					</div>

					<!--=======  End of Pagination container  =======-->

				</div>
			</div>
		</div>
	</div>

</view>