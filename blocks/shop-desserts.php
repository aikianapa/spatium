<edit header="Витрина">
    <div class="alert alert-info">
        Смотри в /blocks/shop-grid.php
    </div>

    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
</edit>
<view>
    <section>
        <div class="content">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="row">
                    <div class="col-12">
                        <form class="form-inline row mb-4">
                            <div class="col-12">
                                <input class="form-control w-100 rounded-20 px-3" type="search" placeholder="Поиск"
                                    aria-label="Search" data-ajax="{'target':'#productsList',
                                                                    'filter_add':{'$or':[
                                                                        { 'name': {'$like' : '$value'} }, 
                                                                        { 'articul': {'$like' : '$value'} }
                                                                    ]} }">
                            </div>
                        </form>


                        <ul class="list-group mb-4" id="productsList">
                            <wb-foreach wb="{'ajax':'/api/query/products/',
                            'render':'server',
                            'bind':'cms.list.products',
                            'sort':'category:d',
                            'size':'24',
                            'filter': {
                                'active':'on',
                                'category': 'desserts'
                            }}">
                            <li class="list-group-item d-flex align-items-center">
                            <img data-src="/thumbc/100x75/src/{{images.0.img}}" width="100" height="75"
                                            class="img-fluid wd-70 rounded mg-r-15" alt="{{name}}">
                                            <div>
                                            <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                                            class="btn px-0 pd-y-6 bg-success position-absolute wd-40 ht-40 r-60 rounded-20">
                                                        <img src="/module/myicons/search-arrow-circle.svg?size=26&stroke=FFFFFF">
                                                </a>

                                                <a href="javascript:void(0);"
                                                        class="mod-cart-add btn px-0 pd-y-6 bg-success position-absolute wd-40 ht-40 r-10 rounded-20"
                                                        data-id="{{id}}" data-name="{{name}}" data-price="{{price}}"
                                                        data-image="{{images.0.img}}" data-days="7"
                                                        data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                                                        data-tooltip="В корзину">
                                                        <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF">
                                                    </a>
                                                <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">{{name}}</h6>
                                                <span class="d-block tx-11 text-muted">Калорийность: {{kcal}}, Вес: {{weight}}</span>
                                                <span class="d-block tx-11 text-primary">Цена: {{price}} ₽</span>
                                            </div>
                            </li>
                            <wb-empty>
                                <li class="d-flex align-items-center alert alert-info">
                                    К сожалению, в этом разделе ничего не найдено.
                                </li>
                            </wb-empty>
                            </wb-foreach>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</view>