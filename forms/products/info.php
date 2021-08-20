<html>
<div class="modal fade show" tabindex="-1" role="dialog">
    <wb-data wb="table=products&item={{_route.item}}">
        <wb-var product="{{ _current }}" />
        <wb-var prod="{{ _current.{{_route.day}}.{{_route.pos}} }}" />
        <div class="modal-dialog modal-fullscreen" role="document">
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
                            <div class="col-12 col-lg-8 offset-lg-2">

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
                                    <div class="col">
                                        <div class="tx-22">{{_var.prod.weight*1}}</div>
                                        <div class="tx-14 tx-gray-600">Вес</div>
                                    </div>

                                    <div class="col">
                                        <div class="tx-22">{{_var.prod.kcal*1}}</div>
                                        <div class="tx-14 tx-gray-600">Ккал</div>
                                    </div>


                                    <div class="col">
                                        <div class="tx-22">{{_var.prod.proteins*1}}</div>
                                        <div class="tx-14 tx-gray-600">белки</div>
                                    </div>
                                    <div class="col">
                                        <div class="tx-22">{{_var.prod.fats*1}}</div>
                                        <div class="tx-14 tx-gray-600">жиры</div>
                                    </div>
                                    <div class="col">
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
    </wb-data>
</div>

</html>