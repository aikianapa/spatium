<edit header="Программа питания">
    <div class="alert alert-info">
        Смотри в /blocks/programs.php
    </div>
    <div>
        <wb-include wb-src="/modules/yonger/common/blocks/common.inc.php" />
        <div class="form-group row">
            <div class="col-12">
                <label class="form-control-label">Текст</label>
                <textarea name="text" class="form-control" rows="auto" placeholder="Текст"></textarea>
            </div>
        </div>
    </div>
</edit>

<view>

    <section class="bg-white" id="programs">
        <div class="content container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center px-5">
                    <h2 class="tx-semibold pb-4 tx-40">
                        {{header}}
                    </h2>
                    <p class="tx-16">
                        {{text}}
                    </p>
                </div>
            </div>
            <div id="programsList">
            <div class="card-columns pt-4">
            <wb-var prog="{'0':{'count':1,'name':'Дневной'},'1':{'count':7,'name':'Недельный'},'2':{'count':30,'name':'Месячный'}}" />
            <wb-foreach wb="{'table':'products',
                            'render':'server',
                            'limit':'3',
                            'rand':true,
                            'filter': {'category':'main'}
                }">
                <div class="card bd-0">
                    <figure class="img-caption pos-relative mg-b-0" data-iframe="true" data-src="{{images.0.img}}">
                        <img data-src="{{images.0.img}}" class="card-img-top object-cover" height="300"
                            alt="Responsive image">
                        <figcaption
                            class="pos-absolute a-0 wd-100p pd-20 d-flex flex-column justify-content-center bg-white-9 transition-base op-0">
                            <h6 class="tx-inverse tx-semibold mg-b-20">{{name}}</h6>
                            <p class="mg-b-0">{{text}}</p>
                        </figcaption>
                    </figure>
                    <wb-var days="{{_var.prog.{{_idx}}.count}}" />
                    <wb-var discount="{{discounts.{{_var.days}}}}" wb-if="'{{discounts.{{_var.days}}}}'>'0'" else="1" />
                    <div class="card-body text-center">
                        <h5 class="tx-semibold">{{_var.prog.{{_idx}}.name}}</h5>
                        <p>{{price * {{_var.days}} * {{_var.discount}} }} р.</p>
                    </div>
                    <div class="card-footer text-center bd-0 pd-t-0">
                    <a href="javascript:void(0);" data-id="{{id}}"
                            data-name="{{name}}" data-price="{{price}}"
                            data-image="{{images.0.img}}" data-days="{{_var.days}}"
                            data-discounts="{{json_encode({{discounts}})}}"
                            data-link="/products/{{id}}/{{wbUrlOnly({{name}})}}"
                            class="mod-cart-add mod-cart-data btn btn-success tx-20 px-4 my-3 rounded-30">Заказать
                            <img src="/module/myicons/shopping-cart.svg?size=26&stroke=FFFFFF"></a>
                    </div>
                </div>
                </wb-foreach>
            </div>
            </div>
        </div>
    </section>
</view>