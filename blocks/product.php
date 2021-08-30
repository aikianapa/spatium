<edit header="Страница продукта">
    <div class="alert alert-info">
        Смотри в /blocks/product.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
</edit>


<view>
    <div class="product-item mg-b-50" >
        <div class="row" wb-if="'{{_route.form}}' == 'pages'">
            <div class="col-lg-8 offset-lg-2 text-center px-5">
                <h2 class="tx-semibold py-4 tx-40">
                    {{_var.product.name}}
                </h2>
                <div class="tx-16 pb-3">{{_var.product.text}}</div>
            </div>
        </div>

        <div class="parallax d-flex ht-sm-50v mg-b-50" data-img="{{_var.product.images.0.img}}"
            wb-if="'{{_route.form}}' == 'products'">
            <div class="position-absolute d-block wd-100v ht-100v op-7 bg-black-8">&nbsp;</div>
            <div class="parallax-overlay row justify-content-center">
                <div class="col-sm-8 text-center text-center text-white">
                    <h1 class="text-white tx-semibold py-4 tx-md-50">
                        {{_var.product.name}}
                    </h1>
                    <p class="pb-4 tx-md-20">
                        {{strip_tags({{_var.product.text}})}}
                    </p>

                    <a href="{{link}}" class="btn btn-{{color}} rounded-30 tx-semibold pd-x-40 pd-y-15 ">
                        {{button}}
                    </a>
                </div>
            </div>
        </div>



        <div wb-if="'{{_var.product.category}}'=='main'">

            <ul class="nav nav-tabs bd-0 justify-content-center tx-16" role="tablist">
                <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]' wb-render="server">
                    <li class="nav-item">
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <a class="nav-link {{_var.active}}" data-toggle="tab" href="#{{_var.wid}}-{{_idx}}">{{_val}}</a>
                    </li>
                </wb-foreach>
            </ul>
            <div class="tab-content mt-5">
                <wb-var tmp="{'Zavtrak':'Завтрак','Obed':'Обед','Poldnik':'Полдник','Ujin':'Ужин'}" />
                <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]'>
                    <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                    <div id="{{_var.wid}}-{{_idx}}" class="container tab-pane {{_var.active}}">
                        <wb-var total_kcal="0" />
                        <wb-var total_prot="0" />
                        <wb-var total_fats="0" />
                        <wb-var total_carb="0" />
                        <div class="row justify-content-center">
                            <wb-foreach wb="from=_parent._var.product.{{wbTranslit({{_val}})}}"
                                wb-filter="{'food':{'$gt':''}}">
                                <div class="col-md-3 bd-0">
                                    <div class="card ht-100p bd-0">
                                        <img data-src="/thumb/400x300/src{{images.0.img}}" class="img-fluid rounded-top"
                                            width="400" height="300" alt="{{food}}">
                                        <div class="card-body pb-0">
                                            <div class="tx-12 tx-success tx-semibold tx-spacing-4 pb-2">
                                                {{_var.tmp.{{_key}}}}</div>
                                            <h6 class="card-title tx-semibold">{{food}}</h6>
                                            <p class="card-text tx-gray-400 tx-12">{{kcal}} Ккал,
                                                {{weight}} г.</p>
                                        </div>
                                        <div class="card-footer bd-0">
                                        <a href="javascript:void(0)" class="btn btn-success tx-semibold rounded-20"
                                            data-ajax="{'url':'/products/info/{{_var.product.id}}/{{wbTranslit({{_parent._val}})}}/{{_key}}','html':'modal'}">Подробнее</a>
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
                                        <wb-var week="{'пн':'в понедельник','вт':'во вторник','ср':'в среду','чт':'в четверг','пт':'в пятницу','сб':'в субботу','вс':'в воскресенье'}" />
                                        <div class="tx-18">Всего {{_var.week.{{_val}}}}
                                        </div>
                                        <div class="tx-30 tx-success">
                                            {{_var.total_kcal}} Ккал
                                        </div>
                                        <wb-var days="7" wb-if="'{{_post.days}}'==''" else="{{_post.days}}" />
                                        <a href="javascript:void(0);" data-id="{{_var.product.id}}"
                                            wb-if="'{{_route.params.ajax}}'==''" 
                                            data-name="{{_var.product.name}}" data-price="{{_var.product.price}}"
                                            data-image="{{_var.product.images.0.img}}" data-days="{{_var.days}}"
                                            data-discounts="{{json_encode({{_var.product.discounts}})}}"
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
        <div wb-if="'{{_var.product.category}}'!=='main'" class="d-block text-center">
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <a href="javascript:void(0);" data-id="{{_var.product.id}}" data-name="{{_var.product.name}}"
                        wb-if="'{{_route.params.ajax}}'==''" 
                        data-price="{{_var.product.price}}" data-image="{{_var.product.images.0.img}}" data-days="7"
                        data-discounts="{{_var.product.discounts}}"
                        data-link="/products/{{_var.product.id}}/{{wbUrlOnly({{_var.product.name}})}}"
                        class="mod-cart-add mod-cart-data btn btn-success tx-20 px-4 my-3 rounded-30">В
                        корзину <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF"></a>
                    <div class="row tx-normal">
                        <div class="col">
                            <div class="tx-22">{{_var.product.proteins*1}}</div>
                            <div class="tx-14 tx-gray-600">белки</div>
                        </div>
                        <div class="col">
                            <div class="tx-22">{{_var.product.fats*1}}</div>
                            <div class="tx-14 tx-gray-600">жиры</div>
                        </div>
                        <div class="col">
                            <div class="tx-22">{{_var.product.carbs*1}}</div>
                            <div class="tx-14 tx-gray-600">углеводы</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" wb-if="'{{count(_var.product.components)}}' > '0' AND '{{_route.form}}' == 'products'">
            <div class="col-lg-8 offset-lg-2 px-5">

                <div class="divider-text mb-1">Состав</div>
                <table class="table">
                    <thead>
                        <tr class="tx-success">
                            <th scope="col" class="pt-0 bd-t-0-f"></th>
                            <th scope="col" class="pt-0 bd-t-0-f">Наименование</th>
                            <th scope="col" class="pt-0 bd-t-0-f text-center">Вес гр.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <wb-foreach wb-from="_var.product.components">
                            <tr>
                                <th scope="row" class="text-right">{{_ndx}}</th>
                                <td>{{c_name}}</td>
                                <td class="text-center">{{c_weight}}</td>
                            </tr>
                        </wb-foreach>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</view>