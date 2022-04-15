							<!-- shopping cart -->
							
							<div class="shopping-cart" id="shopping-cart">
								<a href="/cart">
									<div class="cart-icon d-inline-block">
										<span class="icon_bag_alt"></span>
									</div>
									<div class="cart-info d-inline-block">
										<p>Ваша корзина
											<span>
												продуктов <span class="mod-cart-count">0</span> = <span class="mod-cart-total-sum">0</span>₽
											</span>
										</p>
									</div>
								</a>
								<!-- end of shopping cart -->

								<!-- cart floating box -->
								<div class="cart-floating-box" id="cart-floating-box">
									<div class="cart-items">
									<wb-module wb="module=cart&list=header&sum=price*qty*days">
										<div class="mod-cart-item cart-float-single-item d-flex">
											<span class="remove-item">
												<a href="javascript:void(0)" class="mod-cart-remove" data-id="{{id}}"><i class="fa fa-times"></i></a>
											</span>
											<div class="cart-float-single-item-image">
												<a href="{{link}}">
													<img data-src="/thumb/359x359/src/{{image}}" class="img-fluid" alt="{{name}}">
												</a>
											</div>
											<div class="cart-float-single-item-desc">
												<p class="product-title"> <a href="single-product.html">{{name}} </a></p>
												<p class="price"><span class="count">{{days}}x{{qty}}x</span> {{price}}₽</p>
											</div>
										</div>
									</wb-module>
									</div>
									<div class="cart-calculation">
										<div class="calculation-details">
											<p class="total">Итого <span class="mod-cart-total-sum"></span></p>
										</div>
										<div class="floating-cart-btn text-center">
											<a href="/cart">Корзина покупок</a>
										</div>
									</div>
								</div>
								<!-- end of cart floating box -->
							</div>