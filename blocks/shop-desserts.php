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
                                    aria-label="Search" data-ajax="{'target':'#dessertsList',
                                                                    'filter_add':{'$or':[
                                                                        { 'name': {'$like' : '$value'} }, 
                                                                        { 'articul': {'$like' : '$value'} }
                                                                    ]} }">
                            </div>
                        </form>

                        <wb-var group="" />
                        <ul class="list-group mb-4" id="dessertsList">
                            <wb-foreach wb="{'table':'products',
                            'render':'server',
                            'bind':'cms.list.products',
                            'sort':'name catname',
                            'size':'30',
                            'group':'category',
                            'filter': {
                                'active':'on',
                                'category': {'$ne':'main'}
                            }}">
                            <li class="list-group-item tx-center bg-success" wb-if="'{{_var.group}}'=='' && '{{id}}'>''">
                                <h4 wb-tree="dict=menu-categories&branch={{category}}" class="my-0 tx-white">{{name}}</h4>
                                <wb-var group="1" />
                            </li>
                            <wb-var group="" wb-if="'{{_class}}'=='group-total'" />
                            <li class="list-group-item d-flex align-items-center" wb-if="'{{id}}'>''">
                            <img data-src="/thumbc/120x100/src/{{images.0.img}}" width="120" height="100" class="img-fluid wd-120 rounded mg-r-15" alt="{{name}}">
                                            <div class="pb-4">
                                                <div class="position-absolute wd-auto r-0 b-5">
                                                    <a href="javascript:void(0);"
                                                            class="mod-cart-add"
                                                            data-id="{{id}}" data-name="{{name}}" data-price="{{price}}"
                                                            data-image="{{images.0.img}}" data-days="7"
                                                            data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                                                            data-tooltip="В корзину">
                                                            <span class="tx-18 tx-semibold tx-danger">{{price}}₽</span>
                                                            <img src="/module/myicons/shopping-cart.svg?size=26&stroke=10b759" alt="В корзину" class="ht-md-40 wd-auto">
                                                    </a>
                                                    <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}/?ajax=true" data-iframe="true" >
                                                        <img src="/module/myicons/search-arrow-circle.svg?size=26&stroke=10b759" class="ht-md-40 wd-auto">
                                                    </a>
                                                </div>
                                                <h6 class="tx-13 tx-inverse tx-semibold mg-b-0">{{name}}</h6>
                                                <span class="d-block tx-11 text-muted">Калорийность: {{kcal}}, Вес: {{weight}}</span>
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