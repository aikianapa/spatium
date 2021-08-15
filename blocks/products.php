<edit header="Продукция (основное меню)">
    <div class="alert alert-info">
        Смотри в /blocks/products.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
</edit>

<view>
    <section id="products" class="bg-gray-100">
        <div class="content container">
            <div id="productsCaptions" class="carousel slide" data-ride="carousel" data-keyboard="true"
                data-touch="true">
                <ol class="carousel-indicators">
                    <wb-foreach wb="table=products&sort=_created" wb-filter="category=main">
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <li data-target="#productsCaptions" data-slide-to="{{_idx}}" class="{{_var.active}}">
                        </li>
                    </wb-foreach>
                </ol>
                <div class="carousel-inner">
                    <wb-foreach wb="table=products&sort=_created" wb-filter="category=main&active=on">
                        <wb-var product="{{_val}}" />
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <div class="carousel-item {{_var.active}}">
                            <wb-var wid="{{wbNewId()}}" />
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2 text-center px-5">
                                    <h2 class="tx-semibold py-4 tx-40">
                                        {{name}}
                                    </h2>
                                    <div class="tx-16 pb-3">{{text}}</div>
                                </div>
                            </div>

                            <!-- required bootstrap js -->
                            <ul class="nav nav-tabs bd-0 justify-content-center tx-16" role="tablist">
                                <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]' wb-render="server">
                                    <li class="nav-item">
                                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                        <a class="nav-link {{_var.active}}" data-toggle="tab"
                                            href="#{{_var.wid}}-{{_idx}}">{{_val}}</a>
                                    </li>
                                </wb-foreach>
                            </ul>
                            <div class="tab-content mt-5 pb-4">
                                <wb-var tmp="{'Zavtrak':'Завтрак','Obed':'Обед','Poldnik':'Полдник','Ujin':'Ужин'}" />
                                <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]'>
                                    <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                    <div id="{{_var.wid}}-{{_idx}}" class="container tab-pane {{_var.active}}">
                                        <wb-var total_kcal="0" />
                                        <wb-var total_prot="0" />
                                        <wb-var total_fats="0" />
                                        <wb-var total_carb="0" />
                                        <div class="row">
                                            <wb-foreach wb="from=_parent.{{wbTranslit({{_val}})}}"
                                                wb-filter="{'food':{'$gt':''}}">
                                                <div class="col-md-3 bd-0">
                                                    <div class="card bd-0">
                                                        <img data-src="/thumb/400x300/src{{images.0.img}}"
                                                            class="card-img-top" alt="{{food}}">
                                                        <div class="card-body">
                                                            <div class="tx-12 tx-success tx-semibold tx-spacing-4 pb-2">
                                                                {{_var.tmp.{{_key}}}}</div>
                                                            <h6 class="card-title tx-semibold">{{food}}</h6>
                                                            <p class="card-text tx-gray-400 tx-12">{{kcal}} Ккал,
                                                                {{weight}} г.</p>
                                                            <a href="#"
                                                                class="btn btn-success tx-semibold rounded-20">Подробнее</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <wb-var total_kcal="{{_var.total_kcal*1+kcal*1}}" />
                                                <wb-var total_prot="{{_var.total_prot*1+proteins*1}}" />
                                                <wb-var total_fats="{{_var.total_fats*1+fats*1}}" />
                                                <wb-var total_carb="{{_var.total_carb*1+carbs*1}}" />
                                            </wb-foreach>
                                            <div class="col-12">
                                                <div class="row text-center tx-semibold py-4">
                                                    <div class="col-sm-4 offset-sm-4">
                                                        <div class="tx-18">Всего в понедельник {{_var.product.name}}</div>
                                                        <div class="tx-30 tx-success">
                                                            {{_var.total_kcal}} Ккал
                                                        </div>
                                                        <a href="javascript:void(0);" data-id="{{_var.product.id}}"
                                                            data-name="{{_var.product.name}}" data-price="{{_var.product.price}}"
                                                            data-image="{{_var.product.images.0.img}}" data-days="7"
                                                            data-link="/products/{{_var.product.id}}/{{wbUrlOnly({{_var.product.name}})}}"
                                                            class="mod-cart-add mod-cart-data btn btn-success tx-20 px-4 my-3 rounded-30">В
                                                            корзину <img
                                                                src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF"></a>
                                                        <div class="row tx-normal">
                                                            <div class="col">
                                                                <div class="tx-22">{{_var.total_prot}}</div>
                                                                <div class="tx-14 tx-gray-600">белки</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="tx-22">{{_var.total_fats}}</div>
                                                                <div class="tx-14 tx-gray-600">жиры</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="tx-22">{{_var.total_carb}}</div>
                                                                <div class="tx-14 tx-gray-600">углеводы</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </wb-foreach>
                            </div>

                        </div>
                    </wb-foreach>
                </div>
                <a class="carousel-control-prev" href="#productsCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Предыдущий</span>
                </a>
                <a class="carousel-control-next" href="#productsCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Следующий</span>
                </a>
            </div>

        </div>
    </section>
</view>