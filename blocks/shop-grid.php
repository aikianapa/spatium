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
                    <div class="col-12">
                        <div class="row row-xs mg-b-25" id="productsList">
                            <wb-foreach wb="{'table':'products',
                            'render':'server',
                            'bind':'cms.list.products',
                            'sort':'category:d',
                            'size':'24',
                            'filter': {
                                'active':'on',
                                'category': 'main'
                                }
                              }">
                                <div class="col-sm-6 col-md-4 mg-y-20">
                                    <div class="card card-profile bd-1 shadow">
                                        <img data-src="/thumbc/500x450/src/{{images.0.img}}" width="500" height="450" class="img-fluid rounded-top" alt="{{name}}">
                                        <div class="card-body bd-b-0-f bd-r-0-f bd-l-0-f tx-13">
                                            <div>
                                                <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}">
                                                    <div class="avatar avatar-lg">
                                                        <img class="avatar-initial p-1 rounded-circle bg-white" src="/module/myicons/search-arrow-circle.svg?size=26&stroke=10b759">
                                                    </div>
                                                </a>

                                                <h5 class="tx-semibold">
                                                    <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}">{{name}}</a>
                                                </h5>
                                                <p class="ht-25">{{wbGetWords({{text}},7)}}</p>

                                                <div class="img-group img-group-sm mg-b-5">
                                                    <wb-var tmp="0" />
                                                    <wb-foreach wb="from=pn" wb-filter="{'images.0.img':{'$gt':''}}">
                                                        <img src="/thumbc/40x40/src{{images.0.img}}" class="bd img wd-40 ht-40 rounded-circle" alt="">
                                                        <wb-var tmp="{{_var.tmp*1 + 1}}" />
                                                    </wb-foreach>
                                                    <img wb-if="'{{_var.tmp}}' == '0'" data-src="/thumbc/40x40/src{{images.0.img}}" class="bd img wd-40 ht-40 rounded-circle"
                                                        alt="">
                                                </div>
                                                <div class="mg-b-25">
                                                    <span class="tx-12 tx-color-03">{{kcal}} Ккал
                                                        <span wb-if="'{{category}}'=='main'"> / день
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="wd-100p">
                                                    <wb-var product="{{_val}}" />
                                                    <wb-include wb-tpl="price_table.php" />
                                                </div>
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