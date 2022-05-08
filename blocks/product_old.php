<edit header="Страница продукта">
    <div class="alert alert-info">
        Смотри в /blocks/product.php
    </div>
    <div>
        <wb-module wb="module=yonger&mode=edit&block=common.inc" />
    </div>
</edit>


<view>
    <div class="product-item mg-b-50">
        <div class="row" wb-if="'{{_route.form}}' == 'pages'">
            <div class="col-lg-8 offset-lg-2 text-center px-5">
                <h2 class="tx-light py-4 tx-40">
                    {{_var.product.name}}
                </h2>
                <div class="tx-16 pb-3">{{_var.product.text}}</div>
            </div>
        </div>

        <div class="parallax d-flex ht-sm-50v mg-b-50" data-img="{{_var.product.images.0.img}}" wb-if="'{{_route.form}}' == 'products'">
            <div class="position-absolute d-block wd-100v ht-100v op-7 bg-black-8">&nbsp;</div>
            <div class="parallax-overlay row justify-content-center">
                <div class="col-sm-8 text-center text-center text-white mg-t-100">
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

        <div class="container text-center pb-3">
            <p>Рационы здорового питания составлены на каждый день недели, изготавливаются и доставляются ежедневно. В зависимости
                от дня доставки вы получите рацион дня, следующего за датой доставки. Например, во вторник вечером мы развозим
                рационы на среду. Изменить день доставки после заказа вы можете в личном кабинете, отменив доставки на ненужные
                дни.
            </p>
        </div>

        <div wb-if="'{{_var.product.category}}'=='main'">

            <ul class="nav nav-tabs bd-0 justify-content-center tx-16" role="tablist">
                <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]' wb-tpl="false" wb-render="server">
                    <li class="nav-item">
                        <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                        <a class="nav-link {{_var.active}}" data-toggle="tab" href="#{{_var.wid}}-{{_idx}}">{{_val}}</a>
                    </li>
                </wb-foreach>
            </ul>

            <div class="tab-content mt-5">
                <wb-var tmp="{{getMealsJson()}}" />
                <wb-foreach wb-json='["пн","вт","ср", "чт","пт","сб","вс"]' wb-tpl="false" wb-parent="true">
                    <wb-var day="{{wbTranslit({{_val}})}}" />
                    <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                    <div id="{{_var.wid}}-{{_idx}}" class="container tab-pane {{_var.active}}">
                        <wb-var total_kcal="0" />
                        <wb-var total_prot="0" />
                        <wb-var total_fats="0" />
                        <wb-var total_carb="0" />
                        <wb-var menu="{{_parent.{{_var.day}}}}" />
                        <div class="row justify-content-center">
                            <wb-foreach wb="from=_var.tmp" wb-tpl="false" wb-parent="true">
                                <wb-var meals="{{_key}}" />
                                <wb-var image="{{_var.day}}.{{_key}}_images" />
                                <wb-var prod="{{_var.menu.{{_key}}}}" />
                                <wb-var wb-if="'{{ _parent.{{_var.image}}.0.img }}'>''" img="{{ _parent.{{_var.image}}.0.img }}" else="{{_var.prod.0.image.0.img}}" />
                                <div class="col-md-3 bd-0" wb-if="'{{_var.prod.0.food}}'>''">
                                    <div class="card ht-100p bd-0 text-center">
                                        <img data-src="/thumbc/240x180/src{{_var.img}}" width="240" height="180" class="wd-100p img-fluid rounded-top" width="240" height="180" alt="{{food}}">
                                        <div class="card-body pb-0">
                                            <div class="tx-12 tx-success tx-semibold tx-spacing-4 pb-2">
                                                {{_var.tmp.{{_var.meals}}}}
                                            </div>
                                        </div>
                                        <div class="card-footer bd-0">
                                            <a href="javascript:void(0)" class="btn btn-success tx-semibold rounded-20" data-ajax="{'url':'/products/info/{{_var.product.id}}/{{wbTranslit({{_var.day}})}}/{{_var.meals}}','html':'modal'}">Подробнее</a>
                                        </div>
                                    </div>

                                    <wb-var total_kcal="{{_var.total_kcal*1+kcal*1}}" />
                                    <wb-var total_prot="{{_var.total_prot*1+proteins*1}}" />
                                    <wb-var total_fats="{{_var.total_fats*1+fats*1}}" />
                                    <wb-var total_carb="{{_var.total_carb*1+carbs*1}}" />

                                </div>
                            </wb-foreach>
                            <div class="col-12">
                                <div class="row text-center tx-semibold py-4">
                                    <div class="col-sm-6 offset-sm-3">
                                        <wb-var week="{'пн':'в понедельник','вт':'во вторник','ср':'в среду','чт':'в четверг','пт':'в пятницу','сб':'в субботу','вс':'в воскресенье'}" />
                                        <div class="tx-18" wb-if="'{{_var.total_kcal}}'>''">Всего {{_var.week.{{_val}}}}
                                        </div>
                                        <div class="tx-30 tx-success" wb-if="'{{_var.total_kcal}}'>''">
                                            {{_var.total_kcal}} Ккал
                                        </div>
                                        <div class="row tx-normal mb-3" wb-if="'{{_var.product.category}}'!=='main'">
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
                                        <wb-include wb-tpl="price_table.php" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </wb-foreach>
            </div>
        </div>
        <div wb-if="'{{_var.product.category}}'!=='main'" class="d-block text-center">
            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-3">
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
                    <wb-include wb-tpl="price_table.php" />
                </div>
            </div>
        </div>

        <div class="row" wb-if="'{{count(_var.product.components)}}' > '0' AND '{{_route.form}}' == 'products' AND '{{_var.product.components.0.c_name}}'>''">
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
                        <wb-foreach wb-from="_var.product.components" wb-tpl="false">
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