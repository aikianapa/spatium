<edit header="Витрина">
    <div class="alert alert-info">
        Смотри в /blocks/shop-grid.php
    </div>

    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
    </div>
    <div class="form-group row">
        <div class="col-12">
            <label class="form-control-label">Текст</label>
            <wb-module wb="{'module':'jodit'}" name="text" />
        </div>
    </div>

</edit>
<view>
    <section>
        <div class="content">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="row">
                    <div class="col-lg-3 mg-t-40 mg-lg-t-0">
                        <div class=" d-none d-lg-block">
                        <div class="divider-text">Поиск</div>

                        <form class="">
                            <input class="form-control rounded-20 mn-wd-100p" type="search" placeholder="Поиск"
                                aria-label="Search" data-ajax="{'target':'#productsList',
                                'filter_add':{'$or':[
                                    { 'name': {'$like' : '$value'} }, 
                                    { 'articul': {'$like' : '$value'} }
                                ]} }">
                            <div class="divider-text">Категории</div>
                            <ul class="list-unstyled text-center mg-t-20" wb-tree="dict=menu-categories">
                                <li class="py-2" wb-if="'{{_idx}}'=='0'">
                                    <a href="#"
                                        data-ajax="{'target':'#productsList','filter_add':{ 'category': '' }, 'filter_clear':{'category': ''} }"
                                        class="tx-20 tx-gray-700">Все</a>
                                </li>

                                <li class="py-2" wb-if="'{{id}}'!=='desserts'">
                                    <a href="#"
                                        data-ajax="{'target':'#productsList','filter_add':{ 'category': '{{id}}' } }"
                                        class="tx-20 tx-gray-700">{{name}}</a>
                                </li>
                            </ul>

                        </form>

                        <div class="divider-text">{{header}}</div>
                        </div>
                        <p>
                            {{text}}
                        </p>

                    </div>
                    <div class="col-lg-9">


                        <form class="form-inline row d-lg-none">
                            <div class="col-12 col-sm-6">
                                <select name="category" class="mb-2 rounded-20 w-100 form-control" placeholder="Категория"
                                    wb-tree="dict=menu-categories"
                                    data-ajax="{'target':'#productsList','filter_add':{ 'category': '$value' }, 'filter_clear':{'category': ''} }">
                                    <option value="{{id}}">{{name}}</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input class="form-control w-100 rounded-20" type="search" placeholder="Поиск"
                                    aria-label="Search" data-ajax="{'target':'#productsList',
                                                                    'filter_add':{'$or':[
                                                                        { 'name': {'$like' : '$value'} }, 
                                                                        { 'articul': {'$like' : '$value'} }
                                                                    ]} }">
                            </div>
                        </form>


                        <div class="row row-xs mg-b-25" id="productsList">
                            <wb-foreach wb="{'ajax':'/api/query/products/',
                            'render':'server',
                            'bind':'cms.list.products',
                            'sort':'category:d',
                            'size':'24',
                            'filter': {
                                'active':'on',
                                'category': {'$ne' : 'desserts'} 
                                }
                              }">
                                <div class="col-sm-6 col-md-4 mg-y-20">
                                    <div class="card card-profile bd-1 shadow">
                                        <img data-src="/thumbc/500x450/src/{{images.0.img}}" width="500" height="450"
                                            class="img-fluid rounded-top" alt="{{name}}">
                                        <div class="card-body bd-b-0-f bd-r-0-f bd-l-0-f tx-13">
                                            <div>
                                                <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}">
                                                    <div class="avatar avatar-lg">
                                                        <img class="avatar-initial p-1 rounded-circle bg-white"
                                                            src="/module/myicons/search-arrow-circle.svg?size=26&stroke=10b759">
                                                    </div>
                                                </a>

                                                <h5 class="tx-semibold"><a href="">{{name}}</a></h5>
                                                <p class="ht-25">{{wbGetWords({{text}},7)}}</p>

                                                <div class="img-group img-group-sm mg-b-5">
                                                    <wb-var tmp="0" />
                                                    <wb-foreach wb="from=pn" wb-filter="{'images.0.img':{'$gt':''}}">
                                                        <img src="/thumbc/40x40/src{{images.0.img}}"
                                                            class="bd img wd-40 ht-40 rounded-circle" alt="">
                                                        <wb-var tmp="{{_var.tmp*1 + 1}}" />
                                                    </wb-foreach>
                                                    <img wb-if="'{{_var.tmp}}' == '0'"
                                                        data-src="/thumbc/40x40/src{{images.0.img}}"
                                                        class="bd img wd-40 ht-40 rounded-circle" alt="">
                                                </div>
                                                <div class="mg-b-25"><span class="tx-12 tx-color-03">{{kcal}}
                                                        Ккал<span wb-if="'{{category}}'=='main'"> /
                                                            день</span></span></div>

                                                <wb-module wb="module=cart">
                                                    <a href="javascript:void(0);"
                                                        class="mod-cart-add btn btn-block btn-outline-success rounded-20"
                                                        data-id="{{id}}" data-name="{{name}}" data-price="{{price}}"
                                                        data-image="{{images.0.img}}" data-days="7"
                                                        data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                                                        data-tooltip="В корзину"> В корзину
                                                    </a>
                                                </wb-module>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </wb-foreach>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</view>