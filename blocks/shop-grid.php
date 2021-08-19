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
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0 mg-y-80">
                <div class="row">
                    <div class="col-lg-3 mg-t-40 mg-lg-t-0">
                        <div class="d-flex align-items-center justify-content-between mg-b-20">
                            <h6 class="tx-uppercase tx-semibold mg-b-0">Popular Groups</h6>
                        </div>
                        <ul class="list-unstyled media-list mg-b-15">
                            <li class="media align-items-center">
                                <a href="">
                                    <div class="avatar"><img src="https://via.placeholder.com/500"
                                            class="rounded-circle" alt=""></div>
                                </a>
                                <div class="media-body pd-l-15">
                                    <h6 class="mg-b-2"><a href="" class="link-01">Human Resources</a></h6>
                                    <span class="tx-13 tx-color-03">1,232,099 Members</span>
                                </div>
                            </li>
                            <li class="media align-items-center mg-t-15">
                                <a href="">
                                    <div class="avatar"><span class="avatar-initial rounded-circle bg-dark">ui</span>
                                    </div>
                                </a>
                                <div class="media-body pd-l-15">
                                    <h6 class="mg-b-2"><a href="" class="link-01">UI Designers World</a></h6>
                                    <span class="tx-13 tx-color-03">1,055,767 Members</span>
                                </div>
                            </li>
                            <li class="media align-items-center mg-t-15">
                                <a href="">
                                    <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-500">b</span>
                                    </div>
                                </a>
                                <div class="media-body pd-l-15">
                                    <h6 class="mg-b-2"><a href="" class="link-01">Backend Developers</a></h6>
                                    <span class="tx-13 tx-color-03">1,002,005 Members</span>
                                </div>
                            </li>
                            <li class="media align-items-center mg-t-15">
                                <a href="">
                                    <div class="avatar"><span class="avatar-initial rounded-circle bg-indigo">b</span>
                                    </div>
                                </a>
                                <div class="media-body pd-l-15">
                                    <h6 class="mg-b-2"><a href="" class="link-01">Bootstrap Wizards</a></h6>
                                    <span class="tx-13 tx-color-03">1,032,292 Members</span>
                                </div>
                            </li>
                            <li class="media align-items-center mg-t-15">
                                <a href="">
                                    <div class="avatar"><span class="avatar-initial rounded-circle bg-pink">s</span>
                                    </div>
                                </a>
                                <div class="media-body pd-l-15">
                                    <h6 class="mg-b-2"><a href="" class="link-01">SASS Gurus</a></h6>
                                    <span class="tx-13 tx-color-03">990,010 Members</span>
                                </div>
                            </li>
                        </ul>

                        <h6 class="tx-uppercase tx-semibold mg-t-50 mg-b-15">Groups By Position</h6>

                        <nav class="nav nav-classic tx-13">
                            <a href="" class="nav-link"><span>Software Engineer</span> <span class="badge">20</span></a>
                            <a href="" class="nav-link"><span>UI/UX Designer</span> <span class="badge">18</span></a>
                            <a href="" class="nav-link"><span>Sales Representative</span> <span
                                    class="badge">14</span></a>
                            <a href="" class="nav-link"><span>Product Representative</span> <span
                                    class="badge">12</span></a>
                            <a href="" class="nav-link"><span>Full-Stack Developer</span> <span
                                    class="badge">10</span></a>
                        </nav>

                    </div>
                    <div class="col-lg-9">

                        <nav class="navbar navbar-light bg-light rounded mb-3">
                            <form class="form-inline mg-l-auto">
                                <select name="category" class="mr-5 rounded-20 form-control" placeholder="Категория"
                                    wb-tree="dict=menu-categories"
                                    data-ajax="{'target':'#productsList','filter_add':{ 'category': '$value' } }">
                                    <option value="{{id}}">{{name}}</option>
                                </select>

                                <input class="form-control rounded-20" type="search" placeholder="Поиск"
                                    aria-label="Search" data-ajax="{'target':'#productsList',
                                                                    'filter_add':{'$or':[
                                                                        { 'name': {'$like' : '$value'} }, 
                                                                        { 'articul': {'$like' : '$value'} }
                                                                    ]} }">
                            </form>
                        </nav>

                        <div class="row row-xs mg-b-25" id="productsList">
                            <wb-foreach wb="{'ajax':'/api/query/products/',
                            'render':'server',
                            'bind':'cms.list.products',
                            'sort':'category:d',
                            'size':'24',
                            'filter': {'active':'on'}
                }">
                                <div class="col-sm-6 col-md-4 mg-b-20">
                                    <div class="card card-profile bd-0 shadow">
                                        <img data-src="/thumbc/500x450/src/{{images.0.img}}"
                                            class="img-fluid rounded-top" alt="">
                                        <div class="card-body bd-b-0-f bd-r-0-f bd-l-0-f tx-13">
                                            <div>
                                                <a href="/products/{{id}}/{{wbUrlOnly({{name}})}}">
                                                    <div class="avatar avatar-lg">
                                                        <img class="avatar-initial p-2 rounded-circle bg-success"
                                                            src="/module/myicons/search-arrow-circle.svg?size=26&stroke=FFFFFF">
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