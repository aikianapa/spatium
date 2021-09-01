<html>
<div class="modal fade show" tabindex="-1" role="dialog">
    <wb-data wb="table=products&item={{_route.item}}">
        <wb-var product="{{ _current }}" />
        <wb-var prod="{{ _current.{{_route.day}}.{{_route.pos}} }}" />
        <!-- Отображение основного блюда по дням -->
        <div class="modal-dialog modal-fullscreen" role="document" wb-if="'{{_route.day}}'>''">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h6 class="modal-title tx-semibold tx-success w-100 tx-center">{{ _var.prod.food }}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img data-src="/module/myicons/interface-essential-107.svg?size=30&stroke=10b759">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="mg-b-0 tx-center">{{text}}</div>

                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1">

                                <div id="carouselProd" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <wb-foreach wb-from="_var.prod.images">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <li data-target="#carouselProd" data-slide-to="{{_idx}}"
                                                class="{{_var.active}}">
                                            </li>
                                        </wb-foreach>
                                    </ol>

                                    <div class="carousel-inner pd-md-x-40">
                                        <wb-foreach wb-from="_var.prod.images">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <div class="carousel-item {{_var.active}}">
                                                <img data-src="/thumb/1200x700/src{{img}}" width="1200" height="700"
                                                    alt="{{ _var.prod.food }}" class="img-fluid wd-100p">
                                            </div>
                                        </wb-foreach>

                                    </div>

                                    <a class="carousel-control-prev" href="#carouselProd" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"><i
                                                data-feather="chevron-left"></i></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselProd" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"><i
                                                data-feather="chevron-right"></i></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>


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


                        <div class="row" wb-if="'{{count(_var.prod.components)}}' > '0'">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- Отображение дополнительных блюд -->
        <div class="modal-dialog modal-fullscreen" role="document">
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
                                            <li data-target="#carouselProd" data-slide-to="{{_idx}}"
                                                class="{{_var.active}}">
                                            </li>
                                        </wb-foreach>
                                    </ol>

                                    <div class="carousel-inner pd-md-x-90 pd-y-20">
                                        <wb-foreach wb-from="_var.product.images">
                                            <wb-var wb-if="'{{_idx}}'=='0'" active="active" else="" />
                                            <div class="carousel-item {{_var.active}}">
                                                <img data-src="/thumb/1200x700/src{{img}}" width="1200" height="700"
                                                    alt="{{ _var.product.food }}" class="img-fluid wd-100p">
                                            </div>
                                        </wb-foreach>
                                    </div>

                                    <a class="carousel-control-prev" href="#carouselProd" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"><i
                                                data-feather="chevron-left"></i></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselProd" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"><i
                                                data-feather="chevron-right"></i></span>
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
                                <a href="javascript:void(0);" data-id="{{_var.product.id}}"
                                    data-dismiss="modal" aria-label="Close"
                                    data-name="{{_var.product.name}}" data-price="{{_var.product.price}}"
                                    data-image="{{_var.product.images.0.img}}" data-days="7"
                                    data-discounts="{{_var.product.discounts}}"
                                    data-link="/products/{{_var.product.id}}/{{wbUrlOnly({{_var.product.name}})}}"
                                    class="mod-cart-add mod-cart-data btn btn-success tx-20 px-4 my-3 rounded-30">В
                                    корзину <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF"></a>
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