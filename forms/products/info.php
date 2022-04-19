<html>
<div class="modal fade show" tabindex="-1" role="dialog">
    <wb-var week="{'pn':'понедельник','vt':'вторник','sr':'среда','cht':'четверг','pt':'пятница','sb':'суббота','vs':'воскресенье'}"
    />
    <wb-var meals="{{getMealsJson()}}" />
    <wb-data wb="table=products&item={{_route.item}}">
        <wb-var product="{{ _current }}" />
        <wb-var prod="{{ _current.{{_route.day}}.{{_route.pos}} }}" />
        <wb-var imgfld="{{_route.pos}}_images" />
        <!-- Отображение основного блюда по дням -->
        <div class="modal-dialog modal-xl" role="document" wb-if="'{{_route.day}}'>''">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h6 class="modal-title tx-semibold tx-success w-100 tx-center">
                        {{name}} ({{_var.week.{{_route.day}}}})
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img data-src="/module/myicons/interface-essential-107.svg?size=30&stroke=10b759">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h3 class="text-center mb-5 tx-success">{{_var.meals.{{_route.pos}}}}</h3>

                        <wb-foreach wb-from="_var.prod" wb-tpl="false">
                            <div class="row pb-3">
                                <div class="col-lg-8 offset-lg-2 px-5">

                                    <div class="media" wb-module="photoswipe" wb-imgset="img{{_key}}">
                                        <a href="{{image.0.img}}">
                                        <img src="/thumbc/400x300/src{{image.0.img}}" class="wd-200 rounded mg-r-20" alt="{{food}}">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="mg-b-15 tx-success">{{food}}</h5>
                                            <p wb-if="'{{text}}'>''">{{text}}</p>
                                            <div class="tx-12 tx-success">
                                                <span wb-if="'{{weight}}'>''">
                                                    <b class="tx-gray-600">Вес:</b> {{weight}}гр. </span>
                                                <span wb-if="'{{kcal}}'>''">
                                                    <b class="tx-gray-600">Ккал:</b> {{kcal}} </span>
                                                <span wb-if="'{{proteins}}'>''">
                                                    <b class="tx-gray-600">Белки:</b> {{proteins}}гр. </span>
                                                <span wb-if="'{{fats}}'>''">
                                                    <b class="tx-gray-600">Жиры:</b> {{fats}}гр. </span>
                                                <span wb-if="'{{carbs}}'>''">
                                                    <b class="tx-gray-600">Углеводы:</b> {{carbs}}гр. </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </wb-foreach>

<!--
                        <div class="row pb-3">
                            <div class="col-lg-8 offset-lg-2 px-5">

                                <wb-var imgs="{{_current.{{_route.day}}.{{_var.imgfld}}}}" />


                                <div id="carouselProd" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <wb-foreach wb-from="_var.prod" wb-tpl="false">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <li data-target="#carouselProd" data-slide-to="{{_idx}}" class="{{_var.active}}">
                                            </li>
                                        </wb-foreach>
                                    </ol>

                                    <div class="carousel-inner pd-md-x-40">
                                        <wb-foreach wb-from="_var.prod" wb-tpl="false">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <div class="carousel-item {{_var.active}} b-0">
                                                <img data-src="/thumbc/1200x700/src{{image.0.img}}" width="1200" height="700" alt="{{ _var.prod.food }}" class="img-fluid wd-100p">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <span class="h3 tx-white px-2 py-0 rounded-20" style="background-color: #7a9f5788;">{{_var.meals.{{_route.pos}}}}</span>
                                                    <br>
                                                    <span class="tx-white px-2 py-0 rounded-10" style="background-color: #7a9f5788;">{{food}}</span>
                                                </div>
                                            </div>
                                        </wb-foreach>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselProd" role="button" data-slide="prev" wb-if="'{{count({{_var.imgs}})}}'>'1'">
                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                            <i data-feather="chevron-left"></i>
                                        </span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselProd" role="button" data-slide="next" wb-if="'{{count({{_var.imgs}})}}'>'1'">
                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                            <i data-feather="chevron-right"></i>
                                        </span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
-->
                        <div class="row mg-t-20">
                            <div class="col-sm-6 offset-sm-3">
                                <div class="row tx-normal tx-center">
                                    <div class="col" wb-if="'{{_var.prod.weight}}'>''">
                                        <div class="tx-22">{{_var.prod.weight*1}}</div>
                                        <div class="tx-14 tx-gray-600">Вес</div>
                                    </div>

                                    <div class="col" wb-if="'{{_var.prod.kcal}}'>''">
                                        <div class="tx-22">{{_var.prod.kcal*1}}</div>
                                        <div class="tx-14 tx-gray-600">Ккал</div>
                                    </div>


                                    <div class="col" wb-if="'{{_var.prod.proteins}}'>''">
                                        <div class="tx-22">{{_var.prod.proteins*1}}</div>
                                        <div class="tx-14 tx-gray-600">белки</div>
                                    </div>
                                    <div class="col" wb-if="'{{_var.prod.fats}}'>''">
                                        <div class="tx-22">{{_var.prod.fats*1}}</div>
                                        <div class="tx-14 tx-gray-600">жиры</div>
                                    </div>
                                    <div class="col" wb-if="'{{_var.prod.carbs}}'>''">
                                        <div class="tx-22">{{_var.prod.carbs*1}}</div>
                                        <div class="tx-14 tx-gray-600">углеводы</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" wb-if="'{{_var.prod.descr}}'>''">
                            <div class="col-lg-8 offset-lg-2 px-5">
                                <div class="divider-text mb-3">Описание</div>
                                {{_var.prod.descr}}
                            </div>
                        </div>

                        <!--
                        <div class="row" wb-if="'{{count(_var.prod.components)}}' > '0' AND '{{_var.prod.components.0.c_name}}'>''">
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
                                        <wb-foreach wb-from="_var.prod.components">
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
-->
                        <div class="row mg-b-100 mg-t-20">
                            <div class="col-lg-8 offset-lg-2 px-5 tx-center">
                                <h3 class="tx-gray-700">Добавить в корзину</h3>
                                <p class="tx-semibold tx-16 tx-gray-700">{{name}}</p>
                                <wb-include wb-tpl="price_table.php" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Отображение дополнительных блюд -->
        <div class="modal-dialog modal-fullscreen" role="document" wb-if="'{{_route.day}}'==''">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h6 class="modal-title tx-semibold tx-success w-100 tx-center">{{name}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img data-src="/module/myicons/interface-essential-107.svg?size=30&stroke=10b759">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="tx-center" wb-if="'{{_var.product.images.0.img}}'==''">
                                    <img data-src="/module/myicons/asian-food.1.svg?size=300&stroke=EEEEEE" class="img-fluid ht-300">
                                </div>

                                <div id="carouselProd" class="carousel slide" data-ride="carousel" wb-if="'{{_var.product.images.0.img}}'>''">
                                    <ol class="carousel-indicators">
                                        <wb-foreach wb-from="_var.product.images">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <li data-target="#carouselProd" data-slide-to="{{_idx}}" class="{{_var.active}}">
                                            </li>
                                        </wb-foreach>
                                    </ol>

                                    <div class="carousel-inner pd-md-x-90 pd-y-20">
                                        <wb-foreach wb-from="_var.product.images">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <div class="carousel-item {{_var.active}}">
                                                <img data-src="/thumb/1200x700/src{{img}}" width="1200" height="700" alt="{{ _var.product.food }}" class="img-fluid wd-100p">
                                            </div>
                                        </wb-foreach>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselProd" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                            <i data-feather="chevron-left"></i>
                                        </span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselProd" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                            <i data-feather="chevron-right"></i>
                                        </span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="">
                            {{_var.product.text}}
                        </div>




                        <div class="row tx-center">
                            <div class="col-sm-4 offset-sm-4">
                                <a href="javascript:void(0);" data-id="{{_var.product.id}}" data-dismiss="modal" aria-label="Close" data-name="{{_var.product.name}}"
                                    data-price="{{_var.product.price}}" data-image="{{_var.product.images.0.img}}" data-days="7"
                                    data-discounts="{{_var.product.discounts}}" data-link="/products/{{_var.product.id}}/{{wbUrlOnly({{_var.product.name}})}}"
                                    class="mod-cart-add mod-cart-data btn btn-success tx-20 px-4 my-3 rounded-30">В корзину
                                    <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF">
                                </a>
                                <div class="row tx-normal">
                                    <div class="col" wb-if="'{{_var.product.proteins*1}}'>'0'">
                                        <div class="tx-22">{{_var.product.proteins*1}}</div>
                                        <div class="tx-14 tx-gray-600">белки</div>
                                    </div>
                                    <div class="col" wb-if="'{{_var.product.fats*1}}'>'0'">
                                        <div class="tx-22">{{_var.product.fats*1}}</div>
                                        <div class="tx-14 tx-gray-600">жиры</div>
                                    </div>
                                    <div class="col" wb-if="'{{_var.product.carbs*1}}'>'0'">
                                        <div class="tx-22">{{_var.product.carbs*1}}</div>
                                        <div class="tx-14 tx-gray-600">углеводы</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" wb-if="'{{_var.product.components.0.c_name}}' > ''">
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

                </div>
            </div>
        </div>
    </wb-data>
</div>

</html>